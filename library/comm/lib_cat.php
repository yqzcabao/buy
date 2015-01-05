<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @lib_cat.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
/**
 * 基于左右值无级分类
 *
 */
class lib_cat
{
	protected static $left;
	protected static $right;
	protected static $name;
	protected static $id;
	protected static $level;
	protected static $pid;
	protected static $catTable;

	/**
    * 构造方法
    *
    * @param unknown_type $catTable
    */
	function setCatTable($catTable){
		self::$catTable=$catTable;
	}

	/**
	 * 添加分类
	 *
	 * @param unknown_type $cat
	 */
	public function addCat($cat){
		if($cat['pid']!=0){
			//查询父级别左右节点
			$parent=lib_database::get_one('select * From `'.self::$catTable.'` where id=\''.$cat['pid'].'\'');
			//设置本分类参数
			$cat['left']=$parent['right'];
			$cat['right']=$parent['right']+1;
			//级别
			$cat['level']=$parent['level']+1;
			//更新节点
			lib_database::wquery('update `'.self::$catTable.'` set `left`=`left`+2 where `left`>'.$cat['left']);
			lib_database::wquery('update `'.self::$catTable.'` set `right`=`right`+2 where `right`>='.$cat['left']);
		}else{
			//查询父级别左右节点
			$before=lib_database::get_one('select * from `'.self::$catTable.'` order by `right` desc limit 0,1');
			$cat['left']=$before['right']+1;
			$cat['right']=$before['right']+2;
			$cat['level']=1;
		}
		//保存数据
		lib_database::insert(self::$catTable,array_keys($cat),$cat);
	}


	/**
	 * 删除分类
	 *
	 */
	public function delcat($id){
		//查询左右节点
		$cat=lib_database::get_one('select * From `'.self::$catTable.'` where id='.$id);
		lib_database::delete(self::$catTable,'`left`>='.$cat['left'].' AND `right`<='.$cat['right']);
		//处理其他节点 使之连续
		$poor=($cat['right']-$cat['left'])+1;
		lib_database::wquery('update '.self::$catTable.' set `left`=`left`-'.$poor.',`right`=`right`-'.$poor.' where `left`>'.$cat['right']);
		lib_database::wquery('update '.self::$catTable.' set `right`=`right`-'.$poor.' where `right`>'.$cat['right'].' AND `left`<'.$cat['right']);
	}

	/**
	 * 分类列表
	 *
	 */
	public function catList($id=0){
		if(!empty($id)){
			$cat=lib_database::get_one('select * From `'.self::$catTable.'` where id='.$id);
			//查询子分类
			$query = 'Select * From `'.self::$catTable.'` where `left`>='.$cat['left'].' AND `right`<='.$cat['right'].' ORDER BY `left`,`sort` DESC';
		}else{
			//所有分类
			$query = 'Select * From `'.self::$catTable.'` ORDER BY `left`,`sort` DESC';
		}
		$rc = lib_database::rquery( $query );
		$catlist=array();
		while( $row = lib_database::fetch_one($rc) )
		{
			$catlist[$row['id']]=$row;
		}
		return $catlist;
	}

	/**
	 * 更新节点
	 *
	 */
	public function updataCat($cat){
		if(empty($cat['id'])){
			throw new Exception('操作错误！');
			return false;
		}
		//修改节点
		$old=self::getOneCat($cat['id']);//节点原本信息
		//位置发生变化
		if($old['pid']!=$cat['pid']){
			//标记为待修改状态
			lib_database::wquery('update '.self::$catTable.' set `left`=0-`left`,`right`=0-`right` where `left`>='.$old['left'].' AND `right`<='.$old['right']);
			//开始修改（先保持连续）
			$poor=($old['right']-$old['left'])+1;
			lib_database::wquery('update '.self::$catTable.' set `left`=`left`-'.$poor.',`right`=`right`-'.$poor.' where `left`>'.$old['right']);
			lib_database::wquery('update '.self::$catTable.' set `right`=`right`-'.$poor.' where `right`>'.$old['right'].' AND `left`<'.$old['right']);
			//腾出空间
			if($cat['pid']>0){
				$newparent=self::getOneCat($cat['pid']);//新的父节点原本信息
				lib_database::wquery('update '.self::$catTable.' set `left`=`left`+'.$poor.',`right`=`right`+'.$poor.' where `left`>'.$newparent['right']);
				lib_database::wquery('update '.self::$catTable.' set `right`=`right`+'.$poor.' where `right`>='.$newparent['right'].' AND `left`<'.$newparent['right']);
				//添加进去
				lib_database::wquery('update '.self::$catTable.' set `left`=abs(`left`)-'.$old['left'].'+'.$newparent['right'].',`right`=abs(`right`)-'.$old['left'].'+'.$newparent['right'].',`level`=`level`-'.$old['level'].'+'.$newparent['level'].'+1 where `left`<0 AND `left`<0');
			}elseif($cat['pid']==0){
				$newparent=lib_database::get_one('select max(`right`) as `right` from '.self::$catTable);//新的父节点原本信息
				//查找最大节点
				lib_database::wquery('update '.self::$catTable.' set `left`=abs(`left`)-'.$old['left'].'+'.$newparent['right'].'+1,`right`=abs(`right`)-'.$old['left'].'+'.$newparent['right'].'+1,`level`=`level`-'.$old['level'].'+1 where `left`<0 AND `left`<0');
			}
		}
		lib_database::update(self::$catTable,$cat,'id='.$cat['id']);
	}

	/**
	 * 查询分类详细
	 *
	 */
	public function getOneCat($id){
		if(empty($id)){
			//抛出异常
			throw new Exception('分类不存在');
			return false;
		}
		//查询
		return lib_database::get_one('select * from '.self::$catTable.' where id='.$id);
	}
}
?>
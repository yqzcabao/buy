<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		D:\website\taobaoke\jiu2\admin\mod\main\cat.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @cat.act.php
 * =================================================
*/
$ops=array('add','list');
$op=request('op','list',$ops);
$active[$op]='class="active"';
//添加表单
if($op=='add'){
	$cat=request('cat',array());
	if(empty($cat)){
		$hadeset=boutiquecidtocat();
	}else{
		//添加
		$cat['type']='goods';
		$cid=typeAdd($cat);
		del_cache('goods','cat');
		$boutiquecat=request('boutiquecat',array());
		addcatgather(array('cid'=>$cid,'boutiquecat'=>serialize($boutiquecat)));
		del_cache('gather','gathercid');
		show_message('操作成功','分类设置成功','?mod='.MODNAME.'&ac='.ACTNAME);
	}
}
$catlist=getgoodscat();
//编辑显示
$id=request('id',0);
if(!empty($id)){
	$cat=$catlist['cid_'.$id];
}
/* End of file cat.act.php */
/* Location: D:\website\taobaoke\jiu2\admin\mod\main\cat.act.php */
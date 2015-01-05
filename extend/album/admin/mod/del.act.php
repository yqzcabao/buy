<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\album\admin\mod\del.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @del.act.php
 * =================================================
*/
$op=request('op');
$id=request('id');
$idstr=(!empty($id) && is_array($id))?implode(',',$id):'';
if(empty($idstr)){
	show_message('操作成功','数据删除成功',-1);
}
//返回跳转
$gomod=request('gomod');
$goop=request('goop');
switch ($op){
	case 'goods'://删除活动
		//删除图片
		lib_database::rquery('select pic from '.tname('goods').' where id in ('.$idstr.')');
		while ($value=lib_database::fetch_one()){
			if(!empty($value['pic']) && check_img($value['pic'])){
				@unlink(PATH_ROOT.$value['pic']);
				@unlink(PATH_ROOT.$value['pic'].'_290x190.jpg');
			}
		}
		lib_database::wquery('delete a,b from '.tname('goods').' as a left join '.tname('urls').' as b on a.num_iid=b.iid where a.id in('.$idstr.')');
		//删除专题缓存
		del_cache('album','index');
		$gourl='&pmod='.$gomod.'&op='.$goop;
		break;
	case 'album'://删除专题
		lib_database::wquery('delete from '.tname('album').' where aid in('.$idstr.')');
		//删除缓存
		del_cache('album','index');
		$gourl='&pmod='.$gomod.'&op='.$goop;
		break;
		
}
show_message('操作成功','数据删除成功',$_extend_url.$gourl);
/* End of file del.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\album\admin\mod\del.act.php */
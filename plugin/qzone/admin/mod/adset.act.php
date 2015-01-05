<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\plugin\qzone\admin\mod\adset.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @adset.act.php
 * =================================================
*/
$op=request('op','list',array('list','add','del'));
if($op=='add'){
	if(submitcheck('slidesAdd')){
		$slides=request('slides',array());
		if(!empty($slides)){
			$slides['start']=strtotime($slides['start']);
			$slides['end']=strtotime($slides['end']);
			$slides['type']=3;//3qq空间广告
			system::adset($slides);
			show_message('系统提示','广告添加成功',$_plugin_url.'&pmod=adset');
		}
	}else{
		$id=request('id');
		if(!empty($id)){
			$slides=$_ad['ad_3'][$id];
		}
	}
}
//删除广告
elseif ($op=='del'){
	$id=request('id');
	$idstr=(!empty($id) && is_array($id))?implode(',',$id):'';
	if(empty($idstr)){
		show_message('操作成功','数据删除成功',-1);
	}
	//删除图片
	lib_database::rquery('select pic from '.tname('advertise').' where id in('.$idstr.')');
	while ($value=lib_database::fetch_one()){
		if(!empty($value['pic']) && check_img($value['pic'])){
			@unlink(PATH_ROOT.$value['pic']);
		}
	}
	lib_database::delete('advertise','id in ('.$idstr.')');
	del_cache('advertise','ad');
	$gourl=$_plugin_url.'&pmod=adset&op=list';
	show_message('操作成功','数据删除成功',$gourl);
}
elseif ($op=='list'){
	$qzone_slides=$_ad['ad_3'];
}
/* End of file adset.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\plugin\qzone\admin\mod\adset.act.php */
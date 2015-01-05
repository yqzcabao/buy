<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @author		bank
 * @link		http://www.wangyue.cc
 * @ad.act.php
 * =================================================
*/
require PATH_PLUGIN.'lib/admin.fun.php';
$ops=array('index','adadd','addel');
$op=request('op','index',$ops);
//添加频道
if($op=='adadd'){
	$ad=array();
	$ad['title']=request('title','');
	$ad['img']=request('img','');
	$ad['href']=request('href','');
	$ad['sort']=intval(request('sort',''));
	$ad['aid']=intval(request('aid',''));
	android_ad_add($ad);
	message(0,'广告管理','添加成功',-1);
}elseif ($op=='addel'){
	$aid=request('aid',array());
	android_ad_del($aid);
	show_message('广告管理','删除成功',$_plugin_url.'&pmod=ad');
}
$ad=get_android_ad();
/* End of file ad.act.php */
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
 * @recapp.act.php
 * =================================================
*/
require PATH_PLUGIN.'lib/admin.fun.php';
$ops=array('index','appadd','appdel');
$op=request('op','index',$ops);
//添加频道
if($op=='appadd'){
	$app=array();
	$app['title']=request('title','');
	$app['intro']=request('intro','');
	$app['img']=request('img','');
	$app['href']=request('href','');
	$app['sort']=intval(request('sort',''));
	$app['aid']=intval(request('aid',''));
	android_app_add($app);
	message(0,'推荐App','添加成功',-1);
}elseif ($op=='appdel'){
	$aid=request('aid',array());
	android_app_del($aid);
	show_message('推荐App','删除成功',$_plugin_url.'&pmod=recapp');
}
$app=get_android_app();
/* End of file recapp.act.php */
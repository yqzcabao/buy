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
 * @channel.act.php
 * =================================================
*/
require PATH_PLUGIN.'lib/admin.fun.php';
$ops=array('index','navadd','navdel');
$op=request('op','index',$ops);
//添加频道
if($op=='navadd'){
	$nav=array();
	$nav['title']=request('title','');
	$nav['type']=request('type','');
	$nav['nav']=request('navstr','');
	$nav['home']=request('home','');
	$nav['img']=request('img','');
	$nav['imghover']=request('imghover','');
	$nav['sort']=intval(request('sort',''));
	$nav['nid']=intval(request('nid',''));
	add_nav($nav);
	message(0,'频道管理','添加成功',-1);
}elseif ($op=='navdel'){
	$nid=request('nid',array());
	nav_del($nid);
	show_message('频道管理','删除成功',$_plugin_url.'&pmod=channel');
}
$nav=get_nav_add();
/* End of file channel.act.php */
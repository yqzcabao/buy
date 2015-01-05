<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		D:\website\taobaoke\jiu2\admin\mod\seting\user.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @user.act.php
 * =================================================
*/
$ops=array('set','connect','install','uninstall');
$op=request('op','set',$ops);
//用户基本设置
if($op=='set'){
	if(submitcheck('userset')){
		$user=request('user',array());
		system::webset($user);
		show_message('操作成功','设置成功','-1');
	}
}
//快捷登陆
elseif ($op=='connect'){
	$fileconnect=getDir(PATH_API.'/fastlogin/');
	$connectconfig=system::getconnect();
	foreach ($fileconnect as $key=>$value){
		require PATH_API.'/fastlogin/'.$value.'/config.php';
		$connect[$value]=!empty($connectconfig[$value])?$connectconfig[$value]:array();
		$connect[$value] = array_merge_multi($modules[$value], $connect[$value]);
	}
}
//安装
elseif ($op=='install'){
	$connectkey=request('key');
	//安装
	$connectconfig=request('connect',array());
	if(!empty($connectconfig) && !empty($connectkey)){
		system::connectinstall($connectkey,$connectconfig);
		show_message('安装提示','安装成功','?mod='.MODNAME.'&ac='.ACTNAME.'&op=connect');
	}
	//调用文件
	if(!file_exists(PATH_API.'/fastlogin/'.$connectkey.'/config.php')){
		exit("文件不存在");
	}
	require PATH_API.'/fastlogin/'.$connectkey.'/config.php';
	$connect=system::getconnect($connectkey);
	$connect=array_merge_multi($modules[$connectkey], $connect);
}
//卸载
elseif ($op=='uninstall'){
	$connectkey=request('key');
	system::connectuninstall($connectkey);
	show_message('卸载提示','卸载成功','?mod='.MODNAME.'&ac='.ACTNAME.'&op=connect');
}
/* End of file user.act.php */
/* Location: D:\website\taobaoke\jiu2\admin\mod\seting\user.act.php */
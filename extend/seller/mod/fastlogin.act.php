<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\mod\seller\fastlogin.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @fastlogin.act.php
 * =================================================
*/
$op=request('op');
$api=request('api');
if(empty($api)){
	message('-1','登陆提示','快捷登陆操作错误',u('seller','login'));
}
require PATH_API.'/fastlogin.php';
$connect=new fastlogin($api);
if($op=='callback'){
	$data=$connect->callback();
	//用户快捷登陆操作
	falselogin($data);
	header('location:'.u(MODNAME,'index'));
}else{
	$connect->set_callback($_webset['site_url'].'/?mod='.MODNAME.'&ac='.ACTNAME.'&op=callback&api='.$api);
	$login=$connect->login();
	//登陆地址
	header('location:'.$login);
}
exit();
/* End of file fastlogin.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\mod\seller\fastlogin.act.php */
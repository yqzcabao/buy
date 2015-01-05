<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @email_signed.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
//注册邮件验证
$email=request('email','');
if(!empty($email)){
	preg_match('/.*?\@(.*+)/',$email,$domain);
	$maildomain='http://mail.'.$domain[1];
	//判断类型
	$activatinglog=activatinglog($email);
	if(empty($activatinglog)){
		message(0,'系统提示','操作错误',-1);
	}
}

?>
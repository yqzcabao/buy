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
 * @push.act.php
 * =================================================
*/
require PATH_PLUGIN.'lib/admin.fun.php';
if(submitcheck('push')){
	$msg=request('msg');
	if(empty($msg['content'])){
		message('-1','系统提示','消息内容不能为空',-1);
	}
	$type=1;
	if(!empty($msg['url'])){
		$type=2;
	}
	$errmsg=push($msg['content'],$msg['title'],$type,$msg['url']);
}
/* End of file push.act.php */
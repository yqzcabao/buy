<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\wap\mod\login.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @login.act.php
 * =================================================
*/
if(submitcheck('loginform')){
	$login=request('login');
	if( !empty($login['email']) && !empty($login['userpwd']) )
	{
		$keeptime = isset($login['save']) ? 86400 : 0;
		$rs = $access->check_user($login['email'], $login['userpwd'], $keeptime);
		if( $rs['code']==1 )
		{
			header('location:'.u(MODNAME,'sign'));
			exit();
		}
		if($rs['code']!=1){
			$error=$rs['msg'];
		}
	}
	if(empty($login['email'])){$error='请输入用户名';}
	elseif (empty($login['userpwd'])){$error='密码错误';}
}else{
	if(!empty($user['uid'])){
		header('location:'.u(MODNAME,'sign'));
		exit();
	}
	$gourl=request('gourl','');
}
require tpl_extend(WAP_TPL.'/login.tpl.php');
/* End of file login.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\wap\mod\login.act.php */
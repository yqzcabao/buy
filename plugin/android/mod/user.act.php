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
 * @index.act.php
 * =================================================
*/
$ops=array('fastlogin','login','register','forget','fav','dofav','sign','task');
$op=request('op','',$ops);
/*快捷登录*/
if ($op=='fastlogin'){
	user_fast_login();
}
/*用户登录*/
elseif ($op=='login'){
	app_user_login();
}
/*用户注册*/
elseif ($op=='register'){
	app_user_register();
}
/*找回密码*/
elseif ($op=='forget'){
	app_user_forget();
}
/*用户收藏*/
elseif ($op=='fav'){
	app_user_fav();
}
/*用户收藏操作*/
elseif ($op=='dofav'){
	app_user_dofav();
}
/*用户签到*/
elseif ($op=='sign'){
	app_user_sign();
}
/*用户任务*/
elseif ($op=='task'){
	app_user_task();
}
/* End of file index.act.php */
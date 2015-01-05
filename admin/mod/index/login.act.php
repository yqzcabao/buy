<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @login.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
/*登陆*/
$username=request('username');
$password=request('password');
if(!empty($username) && !empty($password))
{
	//验证码
	$validate=request('validate');
	if(strtolower($validate)!=strtolower($_SESSION['ckstr'])){
		$errmsg = '验证码错误！';
	}else{
		$rs = $access->check_user($username, $password);
		if($rs['code']==1){
			$jumpurl = empty($gourl) ? '?mod=index' : $gourl;
			show_message ('成功登录', '成功登录，正在重定向你访问的页面',$jumpurl);
		}else{
			$errmsg=$rs['msg'];
		}
	}
}elseif (request('adminsubmit')){
	$errmsg = '请输入登录帐号和密码！';
}

?>
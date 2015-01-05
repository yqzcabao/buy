<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @activation.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
$op=request('op');
if(empty($op)){
	message('-1','系统提示','操作错误',u('index','index'));
}
//查询记录
$code=request('code');
switch ($op){
	//绑定邮箱
	case 'bind':
		if(empty($code)){
			message('-1','系统提示','操作超时',u('index','index'));
		}
		$activatinglog=activatinglog($code);
		if(empty($activatinglog)){
			message('-1','系统提示','操作超时',u('index','index'));
		}
		if((!empty($_webset['base_bindemailactivate']) && (!empty($_webset['base_bindemailactivate']) && $activatinglog['addtime']<$_timestamp-$_webset['base_bindemailactivate']))){
			message('-1','系统提示','操作超时',u('index','index'));
		}
		if($activatinglog['type']!=$op){
			message('-1','系统提示','操作错误',u('index','index'));
		}
		bind_email($activatinglog['email'],$activatinglog['uid']);
		break;
		//注册激活
	case 'register':
		if(empty($code)){
			message('-1','系统提示','操作超时',u('index','index'));
		}
		$activatinglog=activatinglog($code);
		if(empty($activatinglog)){
			message('-1','系统提示','操作超时',u('index','index'));
		}
		if((!empty($_webset['base_registeractivate']) && (!empty($_webset['base_registeractivate']) && $activatinglog['addtime']<$_timestamp-$_webset['base_registeractivate']))){
			message('-1','系统提示','操作超时',u('index','index'));
		}
		if($activatinglog['type']!=$op){
			message('-1','系统提示','操作错误',u('index','index'));
		}
		register_email($activatinglog['email'],$activatinglog['uid']);
		require PATH_TPL.'/user/email_activating.tpl.php';
		break;
		//重新发送激活邮件
	case 'againactivation':
		$email=request('email');
		if(empty($op)){
			message('-1','系统提示','操作错误',u('index','index'));
		}
		$userinfo=check_account_exist($email);
		if(empty($userinfo)){
			message('-1','系统提示','邮箱不存在',u('index','index'));
		}
		if($userinfo['sta']==1){
			message('-1','系统提示','无需激活',u('index','index'));
		}
		//发送激活邮件
		$activatinglog=activatinglog($email);
		//if(empty($activatinglog) || $activatinglog['addtime']<$_timestamp-$_webset['base_registeractivate']){
			$userinfo['user_name']=empty($userinfo['user_name'])?$userinfo['user_name']=$userinfo['email']:$userinfo['user_name'];
			send_register_email($userinfo['email'],$userinfo['uid'],array('username'=>$userinfo['user_name']));
		//}
		header("location:".u('user','email_signed',array('email'=>$userinfo['email'])));
		break;
		//忘记密码
	case 'forget':
		if(empty($code)){
			message('-1','系统提示','操作超时',u('index','index'));
		}
		$activatinglog=activatinglog($code);
		if(empty($activatinglog)){
			message('-1','系统提示','操作超时',u('index','index'));
		}
		if((!empty($_webset['base_forgetactivate']) && (!empty($_webset['base_forgetactivate']) && $activatinglog['addtime']<$_timestamp-$_webset['base_forgetactivate']))){
			message('-1','系统提示','操作超时',u('index','index'));
		}
		if($activatinglog['type']!=$op){
			message('-1','系统提示','操作错误',u('index','index'));
		}
		//判断用户有无密码
		$userinfo=check_account_exist($activatinglog['email']);
		if(empty($userinfo['userpwd'])){
			//查询用户的第三方登陆
			$bind=bind_account($userinfo['uid']);
		}
		require PATH_TPL.'/user/email_forget.tpl.php';
		break;
	case 'noactivregister':
		require PATH_TPL.'/user/email_activating.tpl.php';
		break;
	default:
		message('-1','系统提示','操作错误',u('index','index'));
		break;
}
exit();
?>
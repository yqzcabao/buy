<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @forget.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}

$forget=request('forget',array());
if(!empty($forget)){
	//判断验证码
	if(strtolower($forget['verify'])!=strtolower($_SESSION['ckstr'])){
		message(-5,'注册提示','验证码错误！','-1');
	}
	//验证邮箱是否存在
	if(!lib_validate::email($forget['email'])){
		message('-1','找回密码','邮箱格式错误','-1');
	}
	//判断邮箱是否存在
	$userinfo=check_account_exist($forget['email']);
	if(!$userinfo){
		message('-1','找回密码','邮箱不存在','-1');
	}
	//写入激活记录
	if(empty($userinfo['user_name'])){
		$userinfo['user_name']=$userinfo['user_name'];
	}
	send_forget_email($forget['email'],$userinfo['uid'],array('user_name'=>$userinfo['user_name']));
	header("location:".u('user','email_signed',array('email'=>$forget['email'])));
}
$userpwd=request('userpwd',array());
if(!empty($userpwd)){
	//判断code
	$activatinglog=activatinglog($userpwd['code']);
	if(empty($activatinglog) || $activatinglog['type']!=='forget' || (!empty($_webset['base_forgetactivate']) && $activatinglog['addtime']<$_timestamp-intval($_webset['base_forgetactivate']))){
		message('-1','找回密码','操作超时，连接已失效',u('index','index'));
	}
	//判断密码是否正确
	if(empty($userpwd['userpwd']) || $userpwd['userpwd']!=$userpwd['reuserpwd']){
		message('-1','找回密码','确认密码错误','-1');
	}
	//验证密码
	if(preg_match('/[^\x00-\x80]+/',$userpwd['userpwd']) || strlen($userpwd['userpwd'])<6 || strlen($userpwd['userpwd'])>16){
		message('-1','找回密码','密码格式不合法','-1');
	}
	unset($userpwd['reuserpwd'],$userpwd['code']);
	$userpwd['uid']=$activatinglog['uid'];
	updateuser($userpwd);
	//删除 激活记录
	lib_database::delete('activating','uid='.$activatinglog['uid'].' and type=\'forget\'');
	email_message('0','恭喜!您已经成功设置九块屋通行证密码!','请您妥善保管好密码!<br />为了您的账户安全，请去安全中心完善其他密保设置！',u('index','center'));
}

?>
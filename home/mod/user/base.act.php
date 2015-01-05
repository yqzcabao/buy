<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\mod\user\base.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @base.act.php
 * =================================================
*/
$ops=array('index','pwd','avatar','account','bind','unbind','bindcallback','email');
$op=request('op','index',$ops);

$gourl = request('gourl');
if(empty($gourl))
{
	$gourl =u('user','base',array('op'=>$op));
}
//保存用户资料
$userinfo=request('userinfo',array());
if(!empty($userinfo)){
	$userinfo['uid']=$user['uid'];
	if(!empty($user['user_name'])){
		unset($userinfo['user_name']);
	}
	if(isset($userinfo['province']) && $userinfo['province']=='省份')unset($userinfo['province']);
	if(isset($userinfo['city']) && $userinfo['city']=='地级市')unset($userinfo['city']);
	if(isset($userinfo['county']) && $userinfo['county']=='市、县级市')unset($userinfo['county']);
	//修改密码
	if($op=='pwd'){
		if(empty($userinfo['newuserpwd'])){
			message('0','提示','请填写新密码','-1');
		}
		if(!lib_validate::same($userinfo['newuserpwd'],$userinfo['reuserpwd'])){
			message('0','提示','确认密码错误','-1');
		}
		$oldpwd=check_set_pwd();
		if($oldpwd){
			if(!lib_validate::same($oldpwd,$access->_get_encodepwd($userinfo['userpwd']))){
				message('0','提示','原密码错误','-1');
			}else{
				$userinfo['userpwd']=$userinfo['newuserpwd'];
				unset($userinfo['newuserpwd'],$userinfo['reuserpwd']);
			}
		}else{
			$userinfo['userpwd']=$userinfo['newuserpwd'];
			unset($userinfo['newuserpwd'],$userinfo['reuserpwd']);
		}
	}
	try{
		updateuser($userinfo);
		//确定是否需要奖励
		reward_user_perfect($userinfo);
	}catch ( Exception $e ){
		$err_msg = $e->getMessage();
		message('0','提示',$err_msg,-1);
	}
	message('0','提示','个人资料修改成功',$gourl);
}
//绑定邮箱
if ($op=='email'){
	$email=request('email');
	//是否已经绑定
	if($user['sta']==1 && !empty($user['email'])){
		message('-2','邮箱绑定','邮箱已经绑定过了,不能修改',-1);
	}
	if(!empty($email)){
		//邮件格式
		if(!lib_validate::email($email)){
			message('-2','邮箱绑定','邮箱格式不正确',-1);
		}
		//验证是否被占用
		$emainbindinfo=check_account_exist($email);
		if(!empty($emainbindinfo) && $emainbindinfo['uid']!=$user['uid']){
			message('-3','邮箱绑定','邮箱被占用',-1);
		}else{
			//发送绑定邮件
			if(send_bind_email($email,$user['uid'],array('user_name'=>$user['user_name']))){
				header("location:".u('user','email_signed',array('email'=>$email)));
			}
		}
	}
}
//绑定
elseif ($op=='account'){
	//查询用户绑定的账号
	$bind=bind_account($user['uid']);
	//系统开启的
	$otherlogon=system::getconnect();
}
//解除账号绑定
elseif ($op=='unbind'){
	$api=request('api');
	if(empty($api)){
		message('-1','解绑失败','操作错误',-1);
	}
	unbind($api);
	message('0','解绑成功','已经解除绑定',u('user','base',array('op'=>'account')));
}
//绑定第三方登陆
elseif ($op=='bind' || $op=='bindcallback'){
	require PATH_API.'/fastlogin.php';
	$api=request('api');
	if(empty($api)){
		message('-1','绑定失败','操作错误',-1);
	}
	$connect=new fastlogin($api);
	if($op=='bindcallback'){
		$data=$connect->callback();
		//绑定操作
		if(!bind($data)){
			message('-1','绑定失败','此账号已被别人绑定',-1);
		}
		//绑定奖励
		reward_quick_login($api);
		message('0','绑定成功','绑定成功',u('user','base',array('op'=>'account')));
	}else{
		//设置
		$connect->set_callback($_webset['site_url'].'/?mod=user&ac=base&op=bindcallback&api='.$api);
		$bindurl=$connect->login();
		//绑定
		header('location:'.$bindurl);
	}
}
/* End of file base.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\mod\user\base.act.php */
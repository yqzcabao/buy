<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @register.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
$reg=request('reg',array());
if(!empty($reg)){
	//注册开始
	try
	{
		//判断验证码
		if(strtolower($reg['verify'])!=strtolower($_SESSION['ckstr'])){
			message(-5,'注册提示','验证码错误！');
		}
		//判断密码
		if($reg['reuserpwd']!=$reg['userpwd']){
			message(-6,'注册提示','确认密码错误！');
		}
		unset($reg['verify'],$reg['reuserpwd']);
		$reg['apps']=APPNAME;
		$rs = register($reg);
		if( $rs>0)
		{
			//判断是否注册需要激活
			if($_webset['site_activation']==1){
				//发送激活邮件
				send_register_email($reg['email'],$rs,array('username'=>$reg['email']));
				message(0,'注册提示','请激活',u('user','email_signed',array('email'=>$reg['email'])));
			}else{
				message(0,'注册提示',"注册成功，立即登录",u('user','activation',array('op'=>'noactivregister')));
			}
		}else{
			message($rs,'注册失败',$errmsg,"-1");
		}
	}
	catch ( Exception $e )
	{
		//错误提示
		$errmsg = $e->getMessage();
		message($rs,'注册失败',$errmsg,"-1");
	}
}else{
	if(!empty($user['uid'])){
		message('-1','您已经登陆','若要继续请先退出',u('index','index'));
	}
}
?>
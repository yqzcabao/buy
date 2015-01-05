<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\mod\merchant\register.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @register.act.php
 * =================================================
*/
if (submitcheck('register_form')) {
	try
	{
		$reg=request('reg',array());
		//判断密码
		if($reg['reuserpwd']!=$reg['userpwd']){
			extend_message(-6,'注册提示','确认密码错误！');
		}
		unset($reg['reuserpwd']);
		$rs = register($reg);
		if( $rs>0)
		{
			//判断是否注册需要激活
			if($_webset['extend_seller_emaik_activation']==1){
				//发送激活邮件
				send_seller_register_email($reg['email'],$rs,array('username'=>$reg['email']));
				header("location:".u(MODNAME,'callback',array('op'=>'email_signed','email'=>$reg['email'])));
				exit();
				//extend_message(0,'注册提示','请激活',u(MODNAME,'email_signed',array('email'=>$reg['email'])));
			}else{
				extend_message(0,'注册提示',"注册成功，立即登录",u(MODNAME,'login'));
			}
		}else{
			extend_message($rs,'注册失败',$errmsg,"-1");
		}
	}catch ( Exception $e )
	{
		//错误提示
		$errmsg = $e->getMessage();
		extend_message('-1','注册失败',$errmsg,"-1");
	}
}
require tpl_extend('register.tpl.php');
/* End of file register.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\mod\merchant\register.act.php */
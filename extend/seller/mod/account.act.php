<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\mod\merchant\account.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @account.act.php
 * =================================================
*/
$ops=array('profile','profile_edit','password','pwdcallback','bind_mail','bank_accounts');
$op=request('op','profile',$ops);
if($op=='profile' || $op=='profile_edit'){
	if(submitcheck('profile_edit')){
		$seller=request('seller');
		$seller['uid']=$user['uid'];
		if(save_seller($seller)){
			extend_message('0','系统提示','数据保存成功',-1);
		}else{
			extend_message('-1','系统提示','操作失败',-1);
		}
	}
}elseif ($op=='password' || $op=='pwdcallback'){
	if(submitcheck('setpwd')){
		$seller=request('seller');
		//验证密码
		if(strlen($seller['password'])<6 && strlen($seller['password'])>16){
			extend_message('0','提示','最少6位,最长16位','-1');
		}
		//判断原密码是否正确
		$oldpwd=check_set_pwd();
		if($oldpwd){
			if(!lib_validate::same($oldpwd,$access->_get_encodepwd($seller['oldpassword']))){
				extend_message('0','提示','原密码错误','-1');
			}
			unset($seller['oldpassword']);
		}
		//判断密码是否正确
		if(!lib_validate::same($seller['password'],$seller['password_confirm'])){
			extend_message('0','提示','确认密码错误','-1');
		}
		//开始修改密码
		updateuser(array('userpwd'=>$seller['password'],'uid'=>$user['uid']),'seller');
		header('location:'.u(MODNAME,'account',array('op'=>'pwdcallback')));
		exit();
	}
}
elseif ($op=='bind_mail'){
	if(submitcheck('bind_mail')){
		$email=request('email','');
		if(!lib_validate::email($email)){
			extend_message('0','提示','邮箱格式错误','-1');
		}
		//验证是否被占用
		$emainbindinfo=check_account_exist($email,'email',$user['uid'],'seller');
		if(!empty($emainbindinfo) && $emainbindinfo['uid']!=$user['uid']){
			extend_message('-3','邮箱绑定','邮箱被占用',-1);
		}
		//发送绑定邮件
		if(send_bind_email($email,$user['uid'],array('user_name'=>$user['user_name']))){
			header("location:".u(MODNAME,'callback',array('op'=>'email_signed','email'=>$email)));
		}
	}
}
elseif ($op=='bank_accounts'){

}
require tpl_extend('account.tpl.php');
/* End of file account.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\mod\merchant\account.act.php */
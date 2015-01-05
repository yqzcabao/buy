<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\wap\mod\forget.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @forget.act.php
 * =================================================
*/
if(submitcheck('forgetform')){
	$forget=request('forget');
	if(!empty($forget)){
		//判断验证码
		if(strtolower($forget['verify'])!=strtolower($_SESSION['ckstr'])){
			$error='验证码错误！';
		}elseif (empty($forget['email'])){
			$error='请输入邮箱\账号';
		}else{
			//发送邮件找回密码
			if($_webset['site_activation']==1){
				if(lib_validate::email($forget['email'])){
					$files=check_account_exist($forget['email']);
				}else{
					$files=check_account_exist($forget['email'],'user_name');
				}
				if(!empty($files['email'])){
					$error='用户不存在';
				}else{
					//发送找回密码邮件
					send_forget_email($files['email'],$files['uid'],array('user_name'=>$files['user_name'],'url'=>u(MODNAME,'callback',array('op'=>'fgcall','code'=>$code)),'code'=>$code));
					$error='找回密码邮件已发出';
				}
			}else{
				$error='请联系管理员，找回密码';
			}
		}
	}
}
require tpl_extend(WAP_TPL.'/forget.tpl.php');
/* End of file forget.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\wap\mod\forget.act.php */
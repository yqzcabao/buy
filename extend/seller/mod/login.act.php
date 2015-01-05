<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\mod\merchant\login.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @login.act.php
 * =================================================
*/
$gourl = request('gourl');
if(empty($gourl))
{
	$gourl =base64_encode(u('seller','account'));
}
if(submitcheck('login_form')){
	$login=request('login');
	if( !empty($login['email']) && !empty($login['userpwd']) )
	{
		$gourl=base64_decode($gourl);
		$rs = $access->check_user($login['email'], $login['userpwd']);
		if( $rs['code']==1)
		{
			extend_message(0,'登陆提示','登陆成功！',$gourl);
		}
		if($rs['code']!=1){
			extend_message(-1,'登陆提示',$rs['msg']);
		}
	}
	//登陆界面数据处理快捷登陆
	else{
		extend_message(-1,'登陆提示',"请填写账号和密码");
	}
}
require tpl_extend('login.tpl.php');
/* End of file login.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\mod\merchant\login.act.php */
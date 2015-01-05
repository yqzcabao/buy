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
$gourl = request('gourl');
if(empty($gourl))
{
	$gourl =base64_encode(u('user','base'));
}else{
	$gourl=$gourl;
}
$login=request('login');
if(!empty($login)){
	if( !empty($login['email']) && !empty($login['userpwd']) )
	{
		$gourl=base64_decode($gourl);
		//try
		//{
			$keeptime = isset($login['save']) ? 86400 : 0;
			$rs = $access->check_user($login['email'], $login['userpwd'], $keeptime);
			if( $rs['code']==1 )
			{
				message(0,'登陆提示','登陆成功！',$gourl);
			}
			if($rs['code']!=1){
				message(-1,'登陆提示',$rs['msg']);
			}
		//}
		//catch ( Exception $e )
		//{
			//$err_msg = $e->getMessage();
			//message(-1,'登陆提示',$err_msg);
		//}
	}
	//登陆界面数据处理快捷登陆
	else{
		message(-1,'登陆提示',"请填写账号和密码");
	}
}
else{
	if(!empty($user['uid'])){
		message('-1','您已经登陆','若要继续请先退出',u('index','index'));
	}
}
?>
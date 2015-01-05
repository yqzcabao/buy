<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @check.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
$op=request('op');
$jsonp_callback=request('callback','');
switch ($op){
	//验证邮箱
	case 'email':
		$email=request('email');
		if(!empty($email)){
			if(!lib_validate::email($email)){
				echo $jsonp_callback.'({"code":-2,"msg":"邮箱格式不正确"})';
				exit();
			}
			//验证是否被占用
			if(check_account_exist($email)){
				echo $jsonp_callback.'({"code":-3,"msg":"该邮箱已被用过啦"})';
			}else{
				echo $jsonp_callback.'({"code":0,"msg":"邮箱可以使用"})';
			}
		}else{
			echo $jsonp_callback.'({"code":-1,"msg":"邮箱不能为空"})';
		}
		break;
		//验证昵称
	case 'user_name':
		$user_name=request('user_name');
		if(!empty($user_name)){
			if(!lib_validate::user_name($user_name)){
				echo $jsonp_callback.'({"code":-2,"msg":"昵称格式不正确"})';
				exit();
			}
			//验证是否被占用
			if(check_account_exist($user_name,'user_name')){
				echo $jsonp_callback.'({"code":-3,"msg":"昵称被占用"})';
			}else{
				echo $jsonp_callback.'({"code":0,"msg":"昵称可以使用"})';
			}
		}else{
			echo $jsonp_callback.'({"code":-1,"msg":"昵称不能为空"})';
		}
		break;
		//验证原密码是否正确，修改密码是使用
	case 'password':
		$userpwd=request('userpwd');
		if(empty($user['uid'])){
			echo $jsonp_callback.'({"code":-1,"msg":"请登录"})';
			exit();
		}
		if(lib_validate::same($user['userpwd'],$access->_get_encodepwd($userpwd))){
			echo $jsonp_callback.'({"code":0,"msg":"密码正确"})';
		}else{
			echo $jsonp_callback.'({"code":-1,"msg":"密码错误"})';
		}
		break;
	case 'againemail':
		$email=request('email');
		$type=request('type');
		if(!in_array($type,array('register','bind','forget'))){
			message('-1','操作提示','操作错误');
		}
		againemail($email,$type);
		break;
	case 'check_goods':
		$num_iid=request('num_iid');
		$aid=intval(request('aid'));
		if(empty($user['uid'])){
			echo $jsonp_callback.'({"code":-1,"msg":"请登录"})';
			exit();
		}
		//验证是否完善信息
		if(empty($user['user_name']) || empty($user['email']) || empty($user['mobile'])){
			echo $jsonp_callback.'({"code":-1,"msg":"您的资料不完整，请先<a href=\''.u('seller','account').'\' target=\'_blank\' style=\'color: blue;\'>完善个人资料</a>"})';
			exit();
		}
		if(empty($num_iid) || empty($aid)){
			echo $jsonp_callback.'({"code":-1,"msg":"操作错误"})';
			exit();
		}
		check_goods_status($num_iid,$aid);
		break;
	default:
		echo $jsonp_callback.'({"code":-10,"msg":"操作失败"})';
}
exit();

?>
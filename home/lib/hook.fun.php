<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\home\lib\hook.fun.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @hook.fun.php
 * =================================================
*/
function hook_home_register($uid){
	global $_webset;
	//注册赠送积分-------------------------------
	$reward_register=intval($_webset['reward_register']);
	if($reward_register>0){
		//积分记录
		changelog(array('uid'=>$uid,'integ'=>$reward_register,'type'=>'reward','exp'=>'注册赠送'));
		lib_database::update('users_'.APPNAME.'_fields',array('integral'=>$reward_register),'uid='.$uid);
	}
}
function hook_home_falselogin($data){
	global $uid;
	//邀请记录
	$usertag=lib_request::$cookies['usertag'];
	if(!empty($usertag)){
		$invitelog=array('usertag'=>$usertag,'tuser_name'=>$data['api'].$data['user_name'],'tuid'=>$uid);
		invitelog($invitelog);
	}
}
/* End of file hook.fun.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\home\lib\hook.fun.php */
<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\plugin\qzone\lib\common.fun.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @common.fun.php
 * =================================================
*/
//获取iframe数据
function get_qzone_data($key){
	$data=get_cookie('qzone_'.$key);
	if(empty($data)){
		$data=request($key);
		if(!empty($data)){
			_put_cookie('qzone_'.$key,$data);
		}
	}
	return $data;
}
//检测用户是否存在
function check_qzone_user($openid){
	$user=lib_database::get_one('select * from '.tname('users').' as a left join '.tname('users_qzone_fields').' as b on a.uid=b.uid where a.apps=\'qzone\' and b.openid=\''.$openid.'\'');
	if(empty($user)){
		return false;
	}
	return $user;
}
//qq空间签到积分
function get_qzone_integral($day="today"){
	global $user,$_webset;
	if($day=="today" && $user['lastsign']>(strtotime('today')-3600*24)){
		$signday=$user['sign']+1;
	}elseif ($day=="tomorrow" && $user['lastsign']>(strtotime('today'))){
		$signday=$user['sign']+1;
	}elseif ($day=="todayhade" && $user['lastsign']>(strtotime('today'))){
		$signday=$user['sign'];
	}else{
		//未连续签到
		$signday=1;
	}
	$signintegral=$_webset['reward_qzone_plus']*ceil(($signday-1)/$_webset['reward_qzone_continuous_day']);
	$signintegral+=$_webset['reward_qzone_sign_day'];
	if($signintegral>$_webset['reward_qzone_daymax']){
		$signintegral=$_webset['reward_qzone_daymax'];
	}
	return array('sign'=>$signday,'integral'=>$signintegral);
}
//qq空间签到
function qzone_sign(){
	global $user,$_timestamp;
	$signintegral=get_qzone_integral();
	if(!empty($user['uid'])){
		lib_database::update('users_'.APPNAME.'_fields',array('sign'=>$signintegral['sign'],'integral'=>$user['integral']+$signintegral['integral'],'lastsign'=>$_timestamp),'uid=\''.$user['uid'].'\'');
		lib_database::update('users_'.APPNAME.'_session',array('sign'=>$signintegral['sign'],'integral'=>$user['integral']+$signintegral['integral'],'lastsign'=>$_timestamp),'uid=\''.$user['uid'].'\'');
		return $signintegral;
	}
	return false;
}
//获取用户信息
function get_qzone_user_info($sdk, $openid, $openkey, $pf)
{
	$params = array(
	'openid' => $openid,
	'openkey' => $openkey,
	'pf' => $pf,
	);
	$script_name = '/v3/user/get_info';
	return $sdk->api($script_name, $params,'post');
}
//验证用户是否登陆
function check_is_login($sdk, $openid, $openkey, $pf){
	$params = array(
	'openid' => $openid,
	'openkey' => $openkey,
	'pf' => $pf,
	);
	$script_name = '/v3/user/is_login';
	return $sdk->api($script_name, $params,'post');
}
//检测是否添加应用到主面板
function  check_add_widget($sdk, $openid, $openkey, $pf){
	$params = array(
	'openid' => $openid,
	'openkey' => $openkey,
	'pf' => $pf,
	);
	$script_name = '/v3/spread/is_app_onpanel';
	return $sdk->api($script_name, $params,'get');
}
/* End of file common.fun.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\plugin\qzone\lib\common.fun.php */
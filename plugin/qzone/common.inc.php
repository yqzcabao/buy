<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\plugin\qzone\common.inc.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @common.inc.php
 * =================================================
*/
define('IS_PLUGIN',true);
define('APPNAME','qzone');
system::_init();
system::check_purview();
define('PATH_TPL','./home/template/'.$_webset['site_tpl']);
define('PAGE',empty($_webset['base_goodspagenum'])?30:$_webset['base_goodspagenum']);
define('INTEGRAL',empty($_webset['base_integralName'])?'积分':$_webset['base_integralName']);
define('DEF_GD_LOGO',empty($_webset['site_goodlogo'])?'static/images/default.gif':$_webset['site_goodlogo']);
include PATH_APP.'/lib/common.fun.php';
//腾讯api调用================================================
$appid='1103103017';
$appkey='RYEwcHwQ20ubOjCg';
$server_name = 'openapi.tencentyun.com';
$server_name = '119.147.19.43';
//判断是否被保存
$platform=get_qzone_data('pf');
$platform=empty($platform)?'qzone':$platform;
$openid=get_qzone_data('openid','');
$openkey=get_qzone_data('openkey','');
require_once PATH_APP.'/lib/api/OpenApiV3.php';
//实例化api
$sdk = new OpenApiV3($appid, $appkey);
$sdk->setServerName($server_name);

if(empty($user['uid']) && !empty($openid)){
	$userinfo = get_qzone_user_info($sdk, $openid, $openkey, $platform);
	//处理用户信息
	$sex=0;
	if($userinfo['gender']=='男'){$sex=1;}
	if($userinfo['gender']=='女'){$sex=-1;}
	//查询用户是否存在
	$user=check_qzone_user($openid);
	if(!$user){
		//保存数据
		$user=array('apps'=>'qzone','groups'=>'qzone-qzone','user_name'=>$userinfo['nickname'],'sta'=>1,'sex'=>$sex,'province'=>$userinfo['province'],'city'=>$userinfo['city'],'country'=>$userinfo['country'],'figureurl'=>$userinfo['figureurl'],'is_yellow_vip'=>$userinfo['is_yellow_vip'],'is_yellow_year_vip'=>$userinfo['is_yellow_year_vip'],'yellow_vip_level'=>$userinfo['yellow_vip_level'],'is_yellow_high_vip'=>$userinfo['is_yellow_high_vip'],'openid'=>$openid);
		//赠送积分
		$user['integral']=intval($_webset['reward_qzone_register']);
		$user['uid']=save_user($user);
	}
	$access->keep_user($user['uid']);
}
//广告信息
$qzone_slides=$_ad['ad_3'];
/* End of file common.inc.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\plugin\qzone\common.inc.php */
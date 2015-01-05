<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @author		bank
 * @link		http://www.wangyue.cc
 * @common.inc.php
 * =================================================
*/
define('IS_PLUGIN',true);
define('APPNAME','home');
system::_init();
include PATH_APP.'/lib/common.fun.php';
define('INTEGRAL',empty($_webset['base_integralName'])?'积分':$_webset['base_integralName']);
/*app请求检测*/
if(ACTNAME!='about' && ACTNAME!='task' && ACTNAME!='jump'){
	check_safety();
	//当前版本
	$_versions=get_app_versions();
	$_os=get_app_os();
}
/* End of file common.inc.php */
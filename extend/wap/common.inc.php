<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\wap\common.inc.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @common.inc.php
 * =================================================
*/
define('IS_EXTEND',true);
define('APPNAME','home');
system::_init();
system::check_purview();
register_shutdown_function('statistics');
//设置常量
define('PAGE',empty($_webset['base_goodspagenum'])?30:$_webset['base_goodspagenum']);
define('CPAGE',empty($_webset['base_commentpagenum'])?20:$_webset['base_commentpagenum']);
define('INTEGRAL',empty($_webset['base_integralName'])?'积分':$_webset['base_integralName']);
//当前手机网站模板
define('WAP_TPL',empty($_webset['wap_tpl'])?'default':$_webset['wap_tpl']);
define('WAP_TPL_PATH',PATH_APP.'/template/'.WAP_TPL);
define('WAP_LOGO',empty($_webset['wap_logo'])?WAP_TPL_PATH.'/static/images/logo.png':$_webset['wap_logo']);
define('DEF_GD_LOGO',empty($_webset['site_goodlogo'])?'../static/images/default.gif':$_webset['site_goodlogo']);
include PATH_APP.'/lib/common.fun.php';
/* End of file common.inc.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\wap\common.inc.php */
<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\seller\common.inc.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @common.inc.php
 * =================================================
*/
define('IS_EXTEND',true);
define('APPNAME','seller');
system::_init();
system::check_purview();
register_shutdown_function('statistics');
define('PATH_TPL','./home/template/'.$_webset['site_tpl']);
include PATH_APP.'/lib/common.fun.php';
define('PAGE',empty($_webset['base_goodspagenum'])?30:$_webset['base_goodspagenum']);
define('SELLER_LOGO',empty($_webset['seller_logo'])?PATH_APP.'/static/images/logo.png':$_webset['seller_logo']);
define('SELLER_SUB_LOGO',empty($_webset['seller_sub_logo'])?PATH_APP.'/static/images/sub_logo.png':$_webset['seller_sub_logo']);
define('DEF_GD_LOGO',empty($_webset['site_goodlogo'])?PATH_TPL.'/static/images/default.gif':$_webset['site_goodlogo']);

//充值方式
$_method=array('alipay'=>1,'audit'=>2);
//记录类型 recharge-充值记录|spend-消费记录|withdraw提现纪录|deposit保证金|unfreeze保证金解冻
$_logtype=array('recharge'=>1,'spend'=>2,'withdraw'=>3,'deposit'=>4,'unfreeze'=>5);
/* End of file common.inc.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\seller\common.inc.php */
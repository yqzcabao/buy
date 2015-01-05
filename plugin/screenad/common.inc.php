<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\plugin\screenad\common.inc.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @common.inc.php
 * =================================================
*/
define('IS_PLUGIN',true);
define('APPNAME','screenad');
system::_init();
system::check_purview();
define('PATH_TPL','./home/template/'.$_webset['site_tpl']);
include PATH_APP.'/lib/common.fun.php';
/* End of file common.inc.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\plugin\screenad\common.inc.php */
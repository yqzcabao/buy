<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @install.php
 * =================================================
*/
define('PATH_APP',getcwd());
define('APPNAME','install');
define('PATH_TPL','./template');
require '../library/init.php';
require './lib/comm/var.php';
require './lib/func/common.func.php';
system::check();
require execute_mod('',ACTNAME);
require tpl_mod('',ACTNAME);
?>
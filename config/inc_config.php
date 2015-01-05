<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @inc_config.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
define('DEBUG_LEVEL',false);
//调试选项（指定某些IP允许开启调试）
//数组格式为 array('ip1', 'ip2'...)
$GLOBALS['config']['safe_client_ip'] = array('127.0.0.1', '192.168.1.145');
//-------------------------------------------
//memcache配置
$GLOBALS['config']['memcache'] = array(
    'is_mc_enable'  => false,
    'mc_cache_time' => 300,
    'mc' => array(
        'default' => 'memcache://192.168.1.12:11211/default10-21',
    )
);
//#-------------------------
//# 非固定配置
//#-------------------------
$GLOBALS['config']['charset']	 = 'utf-8';
$GLOBALS['config']['upload_dir'] = './upload';
$GLOBALS['config']['onlinehold'] = 300;//在线时间判断
//MySql配置
$GLOBALS['config']['db_charset'] = 'utf8';
require PATH_DATA.'/inc_db.php';
?>
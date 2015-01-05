<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @var.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
if(!defined('V_MODE')){
	define('V_MODE','free');
}
if(V_MODE=='free'){
	define('VERSION','2.0.5');
}else{
	define('VERSION','2.0.6');
}
define('DBCHARSET', 'utf8');
define('TABLEPRE','pre_');
if(V_MODE=='free'){
	$sqlfile = PATH_ROOT.'./install/data/install_free.sql';
	$sqldata =PATH_ROOT.'./install/data/install_data_free.sql';	
}else{
	$sqlfile = PATH_ROOT.'./install/data/install_vip.sql';
	$sqldata =PATH_ROOT.'./install/data/install_data_vip.sql';	
}
$lockfile = PATH_ROOT.'./data/install.lock';

$dirfile_items = array
(
	'extend' => array('type' => 'dir', 'path' => './extend'),
	'plugin' => array('type' => 'dir', 'path' => './plugin'),
	'data' => array('type' => 'dir', 'path' => './data'),
	'config'=>array('type' => 'file', 'path' => './data/inc_db.php'),
	'words' => array('type' => 'file', 'path' => './data/filterwords.inc.php'),
	'cache'=> array('type' => 'dir', 'path' => './data/cache'),
	'slow_query'=> array('type' => 'file', 'path' => './data/log/slow_query_log.log'),
	'sql_safe'=> array('type' => 'file', 'path' => './data/log/sql_safe_alert.log'),
	'session'=> array('type' => 'dir', 'path' => './data/session'),
	'upload'=>array('type' => 'dir', 'path' => $GLOBALS['config']['upload_dir']),
);

$func_items = array('mysql_connect','file_get_contents', 'xml_parser_create');
$filesock_items = array('fsockopen', 'pfsockopen', 'stream_socket_client', 'curl_init');

$env_items = array
(
	'os' => array('c' => 'PHP_OS', 'r' => '不限制', 'b' => 'unix','name'=>'操作系统'),
	'php' => array('c' => 'PHP_VERSION', 'r' => '5.1', 'b' => '5.3','name'=>'PHP 版本','err'=>'版本5.1或5.1以上'),
	'attachmentupload' => array('r' => '不限制', 'b' => '2M','name'=>'附件上传'),
	'gdversion' => array('r' => '1.0', 'b' => '2.0','name'=>'GD 库','err'=>'版本2.0或2.0以上'),
	'diskspace' => array('r' => '10M', 'b' => '不限制','name'=>'磁盘空间'),
);

?>
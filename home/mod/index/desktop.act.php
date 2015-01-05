<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @desktop.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
$Shortcut = "[InternetShortcut]
URL={$_webset['site_url']}
IDList=
IconFile={$_webset['site_url']}/favicon.ico
IconIndex=1
[{000214A0-0000-0000-C000-000000000046}]
Prop3=19,2
";
Header("Content-type: application/octet-stream"); 
header("Content-Disposition: attachment; filename={$_webset['site_name']}.url;"); 
echo $Shortcut;
exit();
?>
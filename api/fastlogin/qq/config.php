<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @config.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
/**
 * 快捷登模块配置
 */
$modules['qq']['tag']    = 'qq';//文件标示
/* ido图标 */
$modules['qq']['ico']    = 'static/images/connect_qq_logo.png';
/* 名称 */
$modules['qq']['name']    = 'QQ登陆';
/* 描述 */
$modules['qq']['desc']    = 'QQ登陆';
/*作者*/
$modules['qq']['author']  = '成都网悦时代';

/* 配置信息 */
$modules['qq']['config']  = array(
    array('name' => 'appid',           	'lan'=>'appid',			'type' => 'text',   'value' => ''),
    array('name' => 'appkey',        	'lan'=>'appkey',		'type' => 'text',   'value' => ''),
	array('name' => 'scope',	     	'lan'=>'授权api接口',		'type' => 'hidden',   'value' => 'get_info'),
	array('name' => 'synchronous',      'lan'=>'同步用户名',		'type' => 'checkbox','value' =>'','default'=>'1','label'=>'同步'),
);
?>
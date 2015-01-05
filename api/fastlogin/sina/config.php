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
$modules['sina']['tag']    = 'sina';//文件标示
/* ido图标 */
$modules['sina']['ico']    = 'static/images/connect_sina_logo.png';
/* 名称 */
$modules['sina']['name']    = '新浪微博';
/* 描述 */
$modules['sina']['desc']    = '新浪微博';
/*作者*/
$modules['sina']['author']  = '成都网悦时代';

/* 配置信息 */
$modules['sina']['config']  = array(
    array('name' => 'appid',           	'lan'=>'appid',			'type' => 'text',   'value' => ''),
    array('name' => 'appkey',        	'lan'=>'appkey',		'type' => 'text',   'value' => ''),
	array('name' => 'synchronous',      'lan'=>'同步用户名',		'type' => 'checkbox','value' =>'','default'=>'1','label'=>'同步'),
);
?>
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
$modules['taobao']['tag']    = 'taobao';//文件标示
/* ido图标 */
$modules['taobao']['ico']    = 'static/images/connect_taobao_logo.png';
/* 名称 */
$modules['taobao']['name']    = '淘宝登陆';
/* 描述 */
$modules['taobao']['desc']    = '淘宝登陆';
/*作者*/
$modules['taobao']['author']  = '成都网悦时代';

/* 配置信息 */
$modules['taobao']['config']  = array(
    array('name' => 'apikey',           'lan'=>'apikey',	'type' => 'text',   'value' => ''),
    array('name' => 'apisecret',        'lan'=>'密钥',		'type' => 'text',   'value' => ''),
    array('name' => 'synchronous',      'lan'=>'同步用户名',		'type' => 'checkbox','value' =>'','default'=>'1','label'=>'同步'),
);

?>
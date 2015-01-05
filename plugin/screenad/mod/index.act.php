<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\plugin\screenad\mod\index.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @index.php
 * =================================================
*/
$screenad=array();
if(!empty($_webset['screenad'])){
	$screenad=unserialize($_webset['screenad']);
}
//判断是否开启
$screenadset=lib_database::get_one('select available from '.tname('plugin').' where identifier=\'screenad\'');
if(empty($screenadset['available'])){
	exit();
}
require tpl_plugin('index.tpl.php');
/* End of file index.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\plugin\screenad\mod\index.php */
<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\plugin\uzsite\admin\mod\cat.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @cat.act.php
 * =================================================
*/
require PATH_PLUGIN.'lib/uzsite.func.php';
$op=request('op');
$op=in_array($op,array('list','add','del'))?$op:'list';
if($op=='add'){
	$cid=request('cid');
}
/* End of file cat.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\plugin\uzsite\admin\mod\cat.act.php */
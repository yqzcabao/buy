<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\mod\merchant\help.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @help.act.php
 * =================================================
*/
$guide_list=get_guide_list();
$gid=request('gid',0);
if(!empty($guide_list) && empty($gid)){
	reset($guide_list);
	$guide=current($guide_list);
}else{
	$guide=$guide_list[$gid];
}
require tpl_extend('help.tpl.php');
/* End of file help.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\mod\merchant\help.act.php */
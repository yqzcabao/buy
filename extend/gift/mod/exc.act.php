<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\gift\mod\exc.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @exc.act.php
 * =================================================
*/
$start = intval(request('start',0));
$result=exclist(array('status=1'),'`start` desc',$start,PAGE);
$exchangelist=array();
if (!empty($result))
{
	$page_url=u(MODNAME,'exc');
	$pages=get_page_number_list($result['total'], $start, PAGE);
	$exchangelist=$result['data'];
}
require tpl_extend('exc.tpl.php');
/* End of file exc.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\gift\mod\exc.act.php */
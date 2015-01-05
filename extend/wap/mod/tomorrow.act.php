<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\wap\mod\tomorrow.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @tomorrow.act.php
 * =================================================
*/
//查询
$start = intval(request('start',0));
$page=empty($start)?1:ceil($start/20)+1;
$where[]='`start`>=\''.strtotime('tomorrow').'\'';
$where[]='channel!='.brandNid();
$result=goodslist($where,'',$start,20);
$goodslist=array();
if (!empty($result))
{
	$num=ceil($result['total']/20);
	$pages=get_page_number_list($result['total'], $start,20);
	$goods=$result['data'];
}
require tpl_extend(WAP_TPL.'/index.tpl.php');
/* End of file tomorrow.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\wap\mod\tomorrow.act.php */
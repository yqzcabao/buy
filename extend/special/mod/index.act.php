<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @author		bank
 * @link		http://www.wangyue.cc
 * @index.act.php
 * =================================================
*/
//专场模板
define('SPECIAL_TPL','double11');
define('SPECIAL_TPL_PATH',PATH_APP.'/template/'.SPECIAL_TPL);

$start = intval(request('start',0));
$result=goodslist(array('status=1','aid<0'),'',$start,30);
$goodslist=array();
if (!empty($result))
{
	$page_url='?mod='.MODNAME.'&ac='.ACTNAME.'&op='.$op.'&'.$result['url'];
	$pages=get_page_number_list($result['total'], $start, 30);
	$goodslist=$result['data'];
}

require tpl_extend(SPECIAL_TPL.'/index.tpl.php');
/* End of file index.act.php */
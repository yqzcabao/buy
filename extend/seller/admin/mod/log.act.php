<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\seller\admin\mod\recharge.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @recharge.act.php
 * =================================================
*/
require PATH_EXTEND.'/lib/common.fun.php';
$ops=array('recharge','withdraw','deposit','unfreeze');
$op=request('op','recharge',$ops);
$status=request('s','all',array('all','audit','succeed'));
//充值纪录
if($op=='recharge'){
	switch ($status){
		case 'all':
			$where[]='type=1';
			break;
		case 'audit':
			$where[]='type=1';
			$where[]='status=0';
			break;
		case 'succeed':
			$where[]='type=1';
			$where[]='status=1';
			break;
	}
	$start = intval(request('start',0));
	$result=get_log_list($where,$start,20);
	$loglist=array();
	if (!empty($result))
	{
		$page_url=$_extend_url.'&pmod=log&op='.$op;
		$pages=get_page_number_list($result['total'], $start,20);
		$loglist=$result['data'];
	}
}
elseif ($op=='withdraw'){
	switch ($status){
		case 'all':
			$where[]='type=3';
			break;
		case 'audit':
			$where[]='type=3';
			$where[]='status=0';
			break;
		case 'succeed':
			$where[]='type=3';
			$where[]='status=1';
			break;
	}
	$start = intval(request('start',0));
	$result=get_log_list($where,$start,20);
	$loglist=array();
	if (!empty($result))
	{
		$page_url=$_extend_url.'&pmod=log&op='.$op;
		$pages=get_page_number_list($result['total'], $start,20);
		$loglist=$result['data'];
	}
}
elseif ($op=='deposit'){
	$status=request('s','paid',array('paid','unfreeze'));
	switch ($status){
		case 'paid':
			$where[]='type=4';
			break;
		case 'unfreeze':
			$where[]='type=5';
			break;
	}
	$start = intval(request('start',0));
	$result=get_log_list($where,$start,20);
	$loglist=array();
	if (!empty($result))
	{
		$page_url=$_extend_url.'&pmod=log&op='.$op;
		$pages=get_page_number_list($result['total'], $start,20);
		$loglist=$result['data'];
	}
}
/* End of file recharge.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\seller\admin\mod\recharge.act.php */
<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\mod\merchant\account.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @account.act.php
 * =================================================
*/
$ops=array('index','withdraw','unfreeze','logrecharge','logwithdraw','deposit');
$op=request('op','index',$ops);

//提现
if ($op=='withdraw'){
	if(submitcheck('withdraw')){
		$amount=floatval(request('amount',0));
		if($amount<=0){
			extend_message('0','系统提示','金额错误',-1);	
		}
		//判断余额是否足够
		$money=check_seller_fileds($user['uid'],'money');
		if($money<$amount){
			extend_message('0','系统提示','余额不足',-1);	
		}
		//冻结提现
		withdraw_freeze($amount);
		header('location:'.u(MODNAME,'callback',array('op'=>'wdsuccess')));
		exit();
	}
}
//解冻
elseif ($op=='unfreeze'){
	//判断用户是否缴纳了保证金
	if(submitcheck('unfreeze')){
		deposit_unfreeze();
		extend_message('0','系统提示','解冻成功',u(MODNAME,ACTNAME,array('op'=>'deposit')));	
	}
}
//消费记录
elseif ($op=='index'){
	$start = intval(request('start',0));
	$result=get_log_list(array('`type`=2','uid='.$user['uid']),$start,20);
	$loglist=array();
	if (!empty($result))
	{
		$page_url=u(MODNAME,ACTNAME,array('op'=>$op));
		$pages=get_page_number_list($result['total'], $start,20);
		$loglist=$result['data'];
	}
}
//充值记录
elseif($op=='logrecharge'){
	$start = intval(request('start',0));
	$result=get_log_list(array('`type`=1','uid='.$user['uid']),$start,20);
	$loglist=array();
	if (!empty($result))
	{
		$page_url=u(MODNAME,ACTNAME,array('op'=>$op));
		$pages=get_page_number_list($result['total'], $start,20);
		$loglist=$result['data'];
	}
}
//提现记录
elseif ($op=='logwithdraw'){
	$start = intval(request('start',0));
	$result=get_log_list(array('`type`=3','uid='.$user['uid']),$start,20);
	$loglist=array();
	if (!empty($result))
	{
		$page_url=u(MODNAME,ACTNAME,array('op'=>$op));
		$pages=get_page_number_list($result['total'], $start,20);
		$loglist=$result['data'];
	}
}
//保证金记录
elseif ($op=='deposit'){
	$start = intval(request('start',0));
	$result=get_log_list(array('(`type`=4 OR `type`=5)','uid='.$user['uid']),$start,20);
	$loglist=array();
	if (!empty($result))
	{
		$page_url=u(MODNAME,ACTNAME,array('op'=>$op));
		$pages=get_page_number_list($result['total'], $start,20);
		$loglist=$result['data'];
	}
}
require tpl_extend('funds.tpl.php');
/* End of file account.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\mod\merchant\account.act.php */
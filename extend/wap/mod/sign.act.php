<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\wap\mod\sign.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @sign.act.php
 * =================================================
*/
$hash=request('hash','');
if (formhash()==$hash){
	//判断是否已经签到
	if($user['lastsign']<strtotime('today')){
		//获取当天签到所得积分
		$integral=sign();
	}
	header('location:'.u(MODNAME,'sign'));
	exit();
}
$weekarray=array("日","一","二","三","四","五","六");
//签到记录
$beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
$endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
$query=lib_database::rquery('select * from '.tname('users_changelog').' where type=\'sign\' and addtime>='.$beginThismonth.' and addtime<='.$endThismonth.' and uid='.$user['uid']);
while ($value=lib_database::fetch_one()){
	$sigin_log[date('j',$value['addtime'])]=$value;
}
require tpl_extend(WAP_TPL.'/sign.tpl.php');
/* End of file sign.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\wap\mod\sign.act.php */
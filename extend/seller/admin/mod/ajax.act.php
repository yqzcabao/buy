<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\seller\admin\mod\ajax.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @ajax.act.php
 * =================================================
*/
require PATH_EXTEND.'/lib/common.fun.php';
$op=request('op');
$jsonp_callback=request('callback','');
switch ($op){
	case 'recharge_audit':
		$money=request('money',0);
		$trade_no=request('trade_no','');
		$lid=request('lid',0);
		if(empty($lid) || empty($trade_no) || floatval($money)==0){
			echo $jsonp_callback.'({"code":-1,"msg":"操作失败"})';
			exit();
		}
		$changelog=check_trade_no($lid,$trade_no);
		if(empty($changelog)){
			echo $jsonp_callback.'({"code":-1,"msg":"操作失败"})';
			exit();
		}
		recharge_audit($trade_no,$money,$changelog['uid']);
		echo $jsonp_callback.'({"trade_no":"'.$trade_no.'","code":0,"msg":"审核成功"})';
		break;
	case 'withdraw_audit':
		$money=request('money',0);
		$serialno=request('serialno','');
		$trade_no=request('trade_no','');
		if(empty($trade_no) || empty($serialno) || floatval($money)>0){
			echo $jsonp_callback.'({"code":-1,"msg":"操作失败"})';
			exit();
		}
		$withdrawlog=check_serialno($serialno);
		if(empty($withdrawlog) || $withdrawlog['money']!=$money){
			echo $jsonp_callback.'({"code":-1,"msg":"操作失败"})';
			exit();
		}
		withdraw_audit($serialno,$trade_no,$withdrawlog['money'],$withdrawlog['uid']);
		echo $jsonp_callback.'({"serialno":"'.$serialno.'","trade_no":"'.$trade_no.'","code":0,"msg":"审核成功"})';
		break;
	default:
		echo $jsonp_callback.'({"code":-1,"msg":"操作失败"})';
}
exit();
/* End of file ajax.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\seller\admin\mod\ajax.act.php */
<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\seller\mod\recharge.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @recharge.act.php
 * =================================================
*/
require PATH_API.'/pay.php';
if(submitcheck('recharge')){
	$gateway=request('gateway','');//充值方式
	$amount=request('amount',0);//充值金额
	$trade_num=request('trade_num','');//支付宝交易号
	if($amount>1000000){
		extend_message(-1,'系统提示','充值金额过大',-1);
	}
	//验证
	if(!in_array($gateway,array('alipay','audit'))){
		extend_message(-1,'系统提示','请选择正确的充值方式',-1);
	}
	$extend_seller_minrecharge=floatval($_webset['extend_seller_minrecharge'])<0?0.01:floatval($_webset['extend_seller_minrecharge']);
	if($extend_seller_minrecharge>floatval($amount)){
		extend_message(-1,'系统提示','充值金额至少为'.$extend_seller_minrecharge.'元',-1);
	}
	if($gateway=='audit'){
		if(empty($trade_num)){
			extend_message(-1,'系统提示','请填写交易号',-1);
		}
		//验证交易号是否已经存在
		if(check_trade_no($trade_num,$user['uid'])){
			extend_message(-1,'系统提示','此交易号的充值申请已经提交过了',-1);
		}
		recharge_log($amount,$gateway,$trade_num);
		extend_message(0,'系统提示','充值提交成功，等待审核',u(MODNAME,'funds',array('op'=>'log-recharge')));
	}else{
		//验证是否配置了支付宝
		if($_webset['extend_seller_apirecharge']!=1 || empty($_webset['extend_seller_apiID']) || empty($_webset['extend_seller_apikey'])  || empty($_webset['extend_seller_apialipay'])){
			exit("网站未设置支付宝支付方式或者设置错误，请联系管理员");
		}
		$serialno=recharge_log($amount,$gateway);
		$callbackurl=u(MODNAME,'callback',array('op'=>'recharge'));
		$url=creat_pay($_webset['site_name']."商家账户充值",$amount,$serialno,$callbackurl);
		header("location:".$url);
		exit();
	}
}
require tpl_extend('recharge.tpl.php');
/* End of file recharge.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\seller\mod\recharge.act.php */
<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @pay.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
require_once(PATH_API."/alipay/alipay.config.php");
require_once(PATH_API."/alipay/lib/alipay_submit.class.php");
require_once(PATH_API."/alipay/lib/alipay_notify.class.php");

function creat_pay($subject,$total_fee,$order,$url='',$body='',$show_url=''){
	global $alipay_config,$_webset,$_ip;
	$alipay_config['partner']=$_webset['extend_seller_apiID'];
	$alipay_config['key']=$_webset['extend_seller_apikey'];
	$alipay_config['seller_email']=$_webset['extend_seller_apialipay'];
	if(empty($subject) || empty($total_fee) || empty($order)){
		return false;
	}
	$parameter = array(
	"service" => "create_direct_pay_by_user",
	"partner" => trim($alipay_config['partner']),
	"payment_type"	=> "1",//支付类型
	"notify_url"	=> $url.'&inajax=1',//服务器异步通知页面路径
	"return_url"	=> $url,//页面跳转同步通知页面路径
	"seller_email"	=> trim($alipay_config['seller_email']),
	"out_trade_no"	=> $order,//商户订单号
	"subject"	=> $subject,//订单名称
	"total_fee"	=> $total_fee,//付款金额
	"body"	=> $body,//订单描述
	"show_url"	=> $show_url,//商品展示地址
	"anti_phishing_key"	=> '',//防钓鱼时间戳
	"exter_invoke_ip"	=> $_ip,//客户端的IP地址
	"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
	);
	//建立请求
	$alipaySubmit = new AlipaySubmit($alipay_config);
	$url = $alipaySubmit->buildRequestForm($parameter/*,"get", "确认"*/);
	return $url;
}
//回掉处理
function verify_result(){
	global $alipay_config,$_webset,$_isajax;
	$alipay_config['partner']=$_webset['extend_seller_apiID'];
	$alipay_config['key']=$_webset['extend_seller_apikey'];
	$alipay_config['seller_email']=$_webset['extend_seller_apialipay'];
	$alipayNotify = new AlipayNotify($alipay_config);
	if($_isajax){
		//去掉无用参数
		unset(lib_request::$posts['inajax'],lib_request::$posts['mod'],lib_request::$posts['op'],lib_request::$posts['ac']);
		$verify_result = $alipayNotify->verifyNotify();
		if($verify_result){
			$trade_status=lib_request::$posts['trade_status'];
			if($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
				return true;
			}
		}
		return false;
	}else{
		//去掉无用参数
		unset(lib_request::$gets['inajax'],lib_request::$gets['mod'],lib_request::$gets['op'],lib_request::$gets['ac']);
		$verify_result = $alipayNotify->verifyReturn();//同步处理
		if($verify_result) {//验证成功
			$trade_status=lib_request::$gets['trade_status'];
			if($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
				return true;
			}
		}
		return false;
	}
}
?>
<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\seller\mod\callback.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @callback.act.php
 * =================================================
*/
//回调
$ops=array('appaly','recharge','success','wdsuccess','deposit','email_signed','forget','fgcall','email_signed','register');
$op=request('op','',$ops);
//报名
if($op=='appaly'){
	if(empty($user['uid'])){
		extend_message(-1,'系统提示','请登录',u(MODNAME,ACTNAME,array('gourl'=>base64_encode(get_cururl()))));
	}
	$type=request('type','',array('goods','album','special','try','exchange'));
	$id=intval(request('id',0));
	if(empty($type) || empty($id)){
		extend_message(0,'系统提示','操作错误！');
	}
	$tid=0;
	//查询报名详细
	if($type=='goods' || $type=='album' || $type=='special'){
		$goods=getgood($id);
		$type=='goods' && $tid=$goods['channel'];
		($type=='album' || $type=='special') && $tid=abs($goods['aid']);
	}elseif ($type=='try'){
		$goods=gettry($id);
	}elseif ($type=='exchange'){
		$goods=getexc($id);
	}
	if(empty($goods) || $goods['uid']!=$user['uid']){
		extend_message(0,'系统提示','操作错误！');
	}
	if($goods['status']==1){
		extend_message(0,'系统提示','宝贝已经上架!');
	}
	if($goods['status']==-1){
		extend_message(0,'系统提示','宝贝已经被拒绝!');
	}
	//是否已经付款
	if(!empty($goods['pay_serialno'])){
		extend_message(0,'系统提示','已经付款成功!');
	}
	$money=check_seller_fileds($user['uid'],'money');
	$activity=select_activity($type,$tid);
}
//充值支付宝回调
elseif($op=='recharge'){
	require PATH_API.'/pay.php';
	//交易完成
	if(verify_result()){
		//商户订单号
		$serialno = request('out_trade_no','');
		//支付宝交易号
		$trade_no = request('trade_no','');
		//买家
		$buyer_email=request('buyer_email','');
		//金额
		$total_fee=request('total_fee',0);
		$log=check_order(array('serialno'=>$serialno,'trade_no'=>$trade_no,'total_fee'=>$total_fee));
		if(!empty($log)){
			$log['serialno']=$serialno;
			$log['trade_no']=$trade_no;
			$log['account']=$buyer_email;
			//修改交易状态
			recharge_log_callback($log);
		}
		if(!empty(lib_request::$posts)){
			echo "success";
			exit();
		}
	}
	//没有成功的情况
	else{
		if(!empty($inajax)){
			echo "fail";
			exit();
		}
	}
	header("location:".u(MODNAME,ACTNAME,array('op'=>'success','no'=>$serialno)));
	exit();
}
//支付成功
elseif ($op=='success'){
	$no=request('no','');
	if(empty($user['uid'])){
		header('location:'.u(MODNAME,ACTNAME,array('gourl'=>base64_encode(get_cururl()))));
		exit();
	}
	$log=get_order($no);
}
//保证金缴纳
elseif ($op=='deposit'){
	if(empty($user['uid'])){
		extend_message(-1,'系统提示','请登录',u(MODNAME,ACTNAME,array('gourl'=>base64_encode(get_cururl()))));
	}
	if(floatval($user['margin'])>0){
		extend_message(0,'系统提示','您已经缴纳了保证金',-1);
	}
	$money=check_seller_fileds($user['uid'],'money');
	$deposit=$user['site']==1?floatval($_webset['extend_seller_tbdeposit']):floatval($_webset['extend_seller_tmdeposit']);
	if(submitcheck('pay_deposit')){
		if($deposit<=$money){
			//付款开始
			if(pay_deposit($deposit,$money)){
				extend_message(0,'系统提示','缴纳成功！',u(MODNAME,'funds',array('op'=>'deposit')));
			}
			extend_message(0,'系统提示','操作失败！');
		}else{
			extend_message(0,'系统提示','您的账户余额不足',-1);
		}
	}
}
//提现申请成功
elseif ($op=='wdsuccess'){
	if(empty($user['uid'])){
		extend_message(-1,'系统提示','请登录',u(MODNAME,ACTNAME,array('gourl'=>base64_encode(get_cururl()))));
	}
}
elseif ($op=='forget'){
	$email=request('email','');
	if(empty($email) && !lib_validate::email($email)){
		extend_message('-1','系统提示','操作错误');
	}
}elseif ($op=='fgcall'){
	if(submitcheck('fgcall')){
		$password=request('password','');
		$uid=intval(request('uid',0));
		updateuser(array('userpwd'=>$password,'uid'=>$uid));
		extend_message('0','系统提示','修改成功',u(MODNAME,'login'));
	}else{
		$code=request('code');
		if(empty($code)){
			extend_message('-1','系统提示','操作超时',u(MODNAME,'forget'));
		}
		$activatinglog=activatinglog($code);
		if(empty($activatinglog)){
			message('-1','系统提示','操作超时',u(MODNAME,'forget'));
		}
		if((!empty($_webset['base_forgetactivate']) && $activatinglog['addtime']<$_timestamp-$_webset['base_forgetactivate'])){
			message('-1','系统提示','操作超时',u(MODNAME,'forget'));
		}
		if($activatinglog['type']!='forget'){
			message('-1','系统提示','操作错误',u('index','forget'));
		}
		//判断用户
		$userinfo=check_account_exist($activatinglog['email']);
		if(empty($userinfo)){
			message('-1','系统提示','操作错误',u('index','forget'));
		}
	}
}
//绑定邮箱
elseif ($op=='email_signed'){
	//注册邮件验证
	$email=request('email','');
	if(!empty($email)){
		preg_match('/.*?\@(.*+)/',$email,$domain);
		$maildomain='http://mail.'.$domain[1];
		//判断类型
		$activatinglog=activatinglog($email);
		if(empty($activatinglog)){
			extend_message(0,'系统提示','操作错误',-1);
		}
	}
}
//邮箱绑定计划
elseif ($op=='register'){
	//查询记录
	$code=request('code');
	if(empty($code)){
		message('-1','系统提示','操作超时',u(MODNAME,'index'));
	}
	$activatinglog=activatinglog($code);
	if(empty($activatinglog)){
		message('-1','系统提示','操作超时',u(MODNAME,'index'));
	}
	if((!empty($_webset['base_registeractivate']) && (!empty($_webset['base_registeractivate']) && $activatinglog['addtime']<$_timestamp-$_webset['base_registeractivate']))){
		message('-1','系统提示','操作超时',u(MODNAME,'index'));
	}
	if($activatinglog['type']!=$op){
		message('-1','系统提示','操作错误',u(MODNAME,'index'));
	}
	register_email($activatinglog['email'],$activatinglog['uid']);
}
require tpl_extend('callback.tpl.php');
/* End of file callback.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\seller\mod\callback.act.php */
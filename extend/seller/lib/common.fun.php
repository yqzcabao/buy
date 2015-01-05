<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\template\default\seller\lib\common.fun.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @common.fun.php
 * =================================================
*/
function save_guide($guide){
	global $_timestamp;
	$guide['addtime']=$_timestamp;
	if(!empty($guide['gid'])){
		$gid=$guide['gid'];
		unset($guide['gid']);
		lib_database::update('seller_guide',$guide,'gid='.$gid);
	}else{
		lib_database::insert('seller_guide',array_keys($guide),$guide);
	}
}
/**
 * 指南向西
 *
 */
function get_guide($gid){
	return lib_database::get_one('select * from '.tname('seller_guide').' where gid='.$gid);
}
/**
 * 获取帮助
 *
 */
function get_guide_list(){
	$guide_list=array();
	lib_database::query('select * from '.tname('seller_guide').' order by `sort` asc');
	while ($val=lib_database::fetch_one()){
		$guide_list[$val['gid']]=$val;
	}
	return $guide_list;
}
/**
 * 保存活动
 *
 * @param unknown_type $activity
 */
function save_activity($activity){
	if(!empty($activity['aid'])){
		$aid=$activity['aid'];
		unset($activity['aid']);
		lib_database::update('seller_activity',$activity,'aid='.$aid);
		return $aid;
	}else{
		lib_database::insert('seller_activity',array_keys($activity),$activity);
		return lib_database::insert_id();
	}
}
function select_activity($type,$tid=0){
	$activity=lib_database::get_one('select * from '.tname('seller_activity').' where `type`=\''.$type.'\' and `tid`='.$tid);
	if($activity['type']=='special'){
		//专场信息
		$activity['special']=lib_database::get_one('select * from '.tname('special').' where sid='.$activity['tid']);
		//展位信息
		lib_database::rquery('select * from '.tname('special_position').' where sid='.$activity['tid'].' order by pid ASC');
		$num=$remain=0;
		while ($position=lib_database::fetch_one()){
			$num+=intval($position['num']);
			$remain+=intval($position['remain']);
			$activity['special_position'][$position['pid']]=$position;
		}
		$activity['special']['num']=$num;
		$activity['special']['remain']=$remain;
		$activity['special']['book']=$num-$remain;
	}else{
		if($activity['pay']==1){
			$activity['paydetail']=unserialize($activity['paydetail']);
		}
	}
	return $activity;
}
/**
 * 获取活动列表
 *
 * @return unknown
 */
function get_activity(){
	$activity_list=array();
	lib_database::query('select * from '.tname('seller_activity').' order by `sort` asc');
	while ($val=lib_database::fetch_one()){
		if($val['pay']==1){
			$val['paydetail']=unserialize($val['paydetail']);
		}
		$activity_list[$val['aid']]=$val;
	}
	return $activity_list;
}
/**
 * 获取活动详细
 *
 * @param unknown_type $aid
 */
function get_activity_info($aid){
	$activity=lib_database::get_one('select * from '.tname('seller_activity').' where aid='.$aid);
	//如果是专场
	if($activity['type']=='special'){
		//专场信息
		$activity['special']=lib_database::get_one('select * from '.tname('special').' where sid='.$activity['tid']);
		//展位信息
		lib_database::rquery('select * from '.tname('special_position').' where sid='.$activity['tid'].' order by pid ASC');
		$num=$remain=0;
		while ($position=lib_database::fetch_one()){
			$num+=intval($position['num']);
			$remain+=intval($position['remain']);
			$activity['special_position'][$position['pid']]=$position;
		}
		$activity['special']['num']=$num;
		$activity['special']['remain']=$remain;
		$activity['special']['book']=$num-$remain;
	}else{
		if($activity['pay']==1){
			$activity['paydetail']=unserialize($activity['paydetail']);
		}
	}
	return $activity;
}
/**
 * 保存商家基本信息
 *
 */
function save_seller($seller){
	$uid=$seller['uid'];
	if(empty($uid)){
		return false;
	}
	unset($seller['uid']);
	if(empty($seller)){
		return false;
	}
	$seller_main=$seller_fileds=array();
	foreach ($seller as $key=>$value){
		if(in_array($key,array('user_name' ,'userpwd' ,'email' ,'mobile' ,'apps' ,'groups' ,'sta' ,'regtime' ,'regip' ,'logintime' ,'loginip'))){
			$seller_main[$key]=	$value;
		}
		if(in_array($key,array('alipay','wangwang' ,'shop' ,'contact' ,'qq' ,'introduce'))){
			$seller_fileds[$key]=$value;
		}
	}
	if(!empty($seller_main)){
		lib_database::update('users',$seller_main,'uid='.$uid);
	}
	if(!empty($seller_fileds)){
		lib_database::update('users_seller_fields',$seller_fileds,'uid='.$uid);
	}
	lib_database::update('users_seller_session',array_merge($seller_main,$seller_fileds),'uid='.$uid);
	return true;
}
/**
 * 获取报名活动类型
 *
 */
function get_apply_type(){
	global $_nav;
	$apply_type=array();
	//导航类的【宝贝】
	foreach ($_nav as $key=>$value){
		if($value['mod']=='goods'){
			$apply_type['goods_'.$value['id']]=$value['name'];
		}
	}
	//试用和积分兑换
	$apply_type['try_0']='免费试用';
	$apply_type['exchange_0']='积分兑换';
	//专题
	try {
		lib_database::query('select * from '.tname('album'));
		while ($val=lib_database::fetch_one()){
			$apply_type['album_'.$val['aid']]='专题**'.$val['title'];
		}
	}catch ( Exception $e ){}
	//专场
	try {
		lib_database::query('select * from '.tname('special'));
		while ($val=lib_database::fetch_one()){
			$apply_type['special_'.$val['sid']]='专场**'.$val['title'];
		}
	}catch ( Exception $e ){}
	return $apply_type;
}
/**
 * 专题列表
 *
 * @return unknown
 */
function get_album(){
	$album_list=array();
	lib_database::query('select * from '.tname('album'));
	while ($val=lib_database::fetch_one()){
		$val['group']=unserialize($val['group']);
		$album_list[$val['aid']]=$val;
	}
	return $album_list;
}
/**
 * 专场列表
 *
 * @return unknown
 */
function get_special(){
	$special_list=array();
	lib_database::query('select * from '.tname('special'));
	while ($val=lib_database::fetch_one()){
		$special_list[$val['sid']]=$val;
	}
	return $special_list;
}

/**
 * 展位信息
 *
 */
function get_special_position(){
	$special_position=array();
	//展位信息
	lib_database::rquery('select * from '.tname('special_position').' order by pid ASC');
	while ($position=lib_database::fetch_one()){
		$num+=intval($position['num']);
		$remain+=intval($position['remain']);
		$special_position[$position['pid']]=$position;
	}
	return $special_position;
}
/**
 * 频道列表
 *
 */
function get_channel(){
	global $_nav;
	$channel=array();
	//导航类的【宝贝】
	foreach ($_nav as $key=>$value){
		if($value['mod']=='goods'){
			$channel[$value['id']]=$value['name'];
		}
	}
	return $channel;
}
/**
 * 判断是否此类型报名已存在
 *
 */
function check_type_hade($type){
	$type=explode('_',$type);
	return lib_database::get_rows_num('seller_activity','type=\''.$type[0].'\' and tid='.$type[1]);
}
/**
 * 充值订单
 *
 * @param unknown_type $amount
 * @param unknown_type $gateway
 * @param unknown_type $trade_num
 */
function recharge_log($amount,$gateway,$trade_num=''){
	global $_method,$_logtype,$_timestamp,$user;
	$serialno=serialNO();
	$log=array('uid'=>$user['uid'],'user_name'=>$user['user_name'],'money'=>$amount,'method'=>$_method[$gateway],'type'=>$_logtype['recharge'],'addtime'=>$_timestamp,'status'=>0,'serialno'=>$serialno);
	if($gateway=='audit'){
		$log['trade_no']=$trade_num;
	}
	lib_database::insert('seller_changelog',array_keys($log),$log);
	return $serialno;
}
/*充值订单处理*/
function recharge_log_callback($log){
	global $_timestamp;
	//修改用户资金
	lib_database::wquery('update '.tname('users_seller_session').' set `money`=`money`+'.$log['money'].' where uid='.$log['uid']);
	lib_database::wquery('update '.tname('users_seller_fields').' set `money`=`money`+'.$log['money'].' where uid='.$log['uid']);
	$isok = mysql_affected_rows();
	if($isok){
		lib_database::update('seller_changelog',array('trade_no'=>$log['trade_no'],'status'=>1,'account'=>$log['account'],'succeed'=>$_timestamp),'serialno=\''.$log['serialno'].'\' and status=0');
	}
}
/**
 * 充值审核
 *
 */
function recharge_audit($trade_no,$money,$uid){
	global $_timestamp;
	$setarr['succeed']=$_timestamp;
	$setarr['money']=$money;
	$setarr['status']=1;
	lib_database::wquery('update '.tname('users_seller_session').' set `money`=`money`+'.$money.' where uid='.$uid);
	lib_database::wquery('update '.tname('users_seller_fields').' set `money`=`money`+'.$money.' where uid='.$uid);
	$isok = mysql_affected_rows();
	if($isok){
		lib_database::update('seller_changelog',$setarr,'trade_no=\''.$trade_no.'\' and uid='.$uid);
	}
}
/**
 * 手动充值交易号验证
 *
 */
function check_trade_no($lid,$trade_no,$uid=''){
	$wherestr='lid='.$lid.' and trade_no=\''.$trade_no.'\' and type=1 and method=2';
	if(!empty($uid)){
		$wherestr.=' AND uid='.$uid;
	}
	return lib_database::get_one('select * from '.tname('seller_changelog').' where '.$wherestr);
}
/**
 * 提现验证
 *
 */
function check_serialno($serialno){
	return lib_database::get_one('select * from '.tname('seller_changelog').' where serialno=\''.$serialno.'\'');
}
/**
 * 提现
 *
 * @param unknown_type $trade_no
 * @param unknown_type $money
 * @param unknown_type $uid
 */
function withdraw_audit($serialno,$trade_no,$money,$uid){
	global $_timestamp;
	$setarr['succeed']=$_timestamp;
	$setarr['status']=1;
	$setarr['trade_no']=$trade_no;
	$money=abs($money);
	lib_database::wquery('update '.tname('users_seller_session').' set `withdraw`=`withdraw`-'.$money.' where uid='.$uid.' and `withdraw`>='.$money);
	lib_database::wquery('update '.tname('users_seller_fields').' set `withdraw`=`withdraw`-'.$money.' where uid='.$uid.' and `withdraw`>='.$money);
	$isok = mysql_affected_rows();
	if($isok){
		lib_database::update('seller_changelog',$setarr,'serialno=\''.$serialno.'\' and uid='.$uid);
	}
}
/*购买广告订单*/
function pay_money_log($title,$pay_id,$money){
	global $_logtype,$_timestamp,$user;
	$serialno=serialNO();
	$log=array('uid'=>$user['uid'],'user_name'=>$user['user_name'],'money'=>$money,'method'=>$pay_id,'type'=>$_logtype['spend'],'addtime'=>$_timestamp,'status'=>1,'account'=>$title,'serialno'=>$serialno);
	//处理用户金钱
	lib_database::wquery('update '.tname('users_seller_session').' set `money`=`money`+'.$money.' where uid='.$user['uid']);
	lib_database::wquery('update '.tname('users_seller_fields').' set `money`=`money`+'.$money.' where uid='.$user['uid']);
	$isok = mysql_affected_rows();
	if($isok){
		lib_database::insert('seller_changelog',array_keys($log),$log);
	}
	return $serialno;
}
/**
 * 交纳保证金
 *
 */
function pay_deposit($deposit,$money){
	global $user,$_timestamp,$_logtype;
	lib_database::wquery('update '.tname('users_seller_session').' set `money`=`money`-'.$deposit.',`margin`='.$deposit.',`paidtime`='.$_timestamp.' where uid='.$user['uid'].' and `money`>='.$deposit);
	lib_database::wquery('update '.tname('users_seller_fields').' set `money`=`money`-'.$deposit.',`margin`='.$deposit.',`paidtime`='.$_timestamp.' where uid='.$user['uid'].'  and `money`>='.$deposit);
	$isok = mysql_affected_rows();
	if($isok){
		//生成记录
		$serialno=serialNO();
		$log=array('uid'=>$user['uid'],'user_name'=>$user['user_name'],'money'=>-$deposit,'method'=>2,'type'=>$_logtype['deposit'],'addtime'=>$_timestamp,'status'=>1,'account'=>'交纳保证金'.$deposit.'元','serialno'=>$serialno);
		lib_database::insert('seller_changelog',array_keys($log),$log);
		return true;
	}
	return false;
}
/**
 * 验证订单
 *
 */
function check_order($log){
	return lib_database::get_one('select * from '.tname('seller_changelog').' where status=0 and serialno=\''.$log['serialno'].'\' and money='.$log['total_fee']);
}
function get_order($serialno){
	global $user;
	return lib_database::get_one('select * from '.tname('seller_changelog').' where serialno=\''.$serialno.'\' and uid='.$user['uid']);
}
/**
 * 流水号生成
 *
 */
function serialNO(){
	$year_code = array('A','B','C','D','E','F','G','H','I','J');
	$order_sn = $year_code[intval(date('Y'))-2014].
	strtoupper(dechex(date('m'))).date('d').
	substr(time(),-5).substr(microtime(),2,5).sprintf('%02d',rand(0,99));
	return $order_sn;
}
/**
 * 获取记录
 *
 */
function get_log_list($where,$start,$pagenum=20){
	//组合条件
	$intkeys=array();
	$strkeys=array();
	$randkeys=array();
	$likekeys=array('serialno'=>'keyword','trade_no'=>'keyword','user_name'=>'keyword');
	$search=getwheres($intkeys,$strkeys,$randkeys,$likekeys);
	//处理条件
	!empty($search['wherearr']['serialno'])?$wherestr[]=$search['wherearr']['serialno']:'';
	!empty($search['wherearr']['trade_no'])?$wherestr[]=$search['wherearr']['trade_no']:'';
	!empty($search['wherearr']['user_name'])?$wherestr[]=$search['wherearr']['user_name']:'';
	isset($wherestr)?$where[]='('.implode(' OR ',$wherestr).')':'';
	unset($wherestr);
	$wherestr=!empty($where)?implode(' AND ',$where):'1';
	$query = lib_database::rquery('select * from '.tname('seller_changelog').' where '.$wherestr.' order by `addtime` DESC limit '.$start.','.$pagenum);
	$log_list=array();
	while ($rt = lib_database::fetch_one())
	{
		$data[]=$rt;
	}
	$output = array();
	$total = lib_database::rquery('SELECT COUNT(*) AS rows from '.tname('seller_changelog').' where '.$wherestr);
	$total = lib_database::fetch_one();
	$output['total'] = $total['rows'];
	$output['data'] = $data;
	return $output;
}
/**
 * 格式化显示数字
 *
 */
function money_show($amount,$falst,$middle,$last){
	$amount=number_format($amount,2,'.','');
	$amount=str_replace('.',$middle,$amount);
	return $falst.$amount.$last;
}
/**
 * 验证余额
 *
 */
function check_seller_fileds($uid,$filed){
	$fileds=lib_database::get_one('select '.$filed.' from '.tname('users_seller_fields').' where uid='.$uid);
	return $fileds[$filed];
}
/**
 * 提现冻结
 *
 * @param unknown_type $money
 */
function withdraw_freeze($money){
	global $_timestamp,$user,$_method,$_logtype;
	//生成提现纪录
	$log=array('status'=>0,'money'=>-$money,'uid'=>$user['uid'],'user_name'=>$user['user_name'],'account'=>$user['alipay'],'addtime'=>$_timestamp,'serialno'=>serialNO(),'type'=>$_logtype['withdraw'],'method'=>$_method['alipay']);
	lib_database::wquery('update '.tname('users_seller_session').' set `money`=`money`-'.$money.',`withdraw`=`withdraw`+'.$money.' where uid='.$user['uid'].' and money>='.$money);
	lib_database::wquery('update '.tname('users_seller_fields').' set `money`=`money`-'.$money.',`withdraw`=`withdraw`+'.$money.' where uid='.$user['uid'].' and money>='.$money);
	$isok = mysql_affected_rows();
	if($isok){
		lib_database::insert('seller_changelog',array_keys($log),$log);
		return true;
	}
	return false;
}
/**
 * 报名添加修改宝贝
 *
 */
function appay_goods($goods,$type){
	$id=$goods['id'];
	if(!empty($id)){
		unset($goods['id']);
		//编辑
		if($type=='goods' || $type=='album' || $type=='special'){
			lib_database::update('goods',$goods,'id='.$id);
		}elseif ($type=='try'){
			lib_database::update('try',$goods,'id='.$id);
		}elseif ($type=='exchange'){
			lib_database::update('exchange',$goods,'id='.$id);
		}
		return $id;
	}else{
		//添加
		if($type=='goods' || $type=='album' || $type=='special'){
			lib_database::insert('goods',array_keys($goods),$goods);
		}elseif ($type=='try'){
			lib_database::insert('try',array_keys($goods),$goods);
		}elseif ($type=='exchange'){
			lib_database::insert('exchange',array_keys($goods),$goods);
		}
		return lib_database::insert_id();
	}
}


/**
 * 获取支付流水号码
 *
 */
function get_pay_serialno($id,$type){
	if($type=='goods' || $type=='album' || $type=='special'){
		$pay_serialno=lib_database::get_one('select pay_serialno from '.tname('goods').' where id='.$id);
	}elseif ($type=='try'){
		$pay_serialno=lib_database::get_one('select pay_serialno from '.tname('try').' where id='.$id);
	}elseif ($type=='exchange'){
		$pay_serialno=lib_database::get_one('select pay_serialno from '.tname('exchange').' where id='.$id);
	}
	if (isset($pay_serialno['pay_serialno'])){
		return $pay_serialno['pay_serialno'];
	}
	return false;
}
/**
 * 验证商品状态
 *
 */
function check_goods_status($num_iid,$aid){
	global $_timestamp;
	$activity=get_activity_info($aid);
	if(empty($activity)){
		message('-1','操作提示','操作错误');
	}
	if($activity['type']=='goods' || $activity['type']=='album' || $activity['type']=='special'){
		$goodsstatus=getiidgood($num_iid);
		if(empty($goodsstatus)){
			message('0','报名提示','可以报名','',array('formhash'=>formhash(),'num_iid'=>$num_iid));
		}else{
			if($goodsstatus['status']==0){
				message('-1','报名提示','宝贝已经报名等待审核中...');
			}elseif ($goodsstatus['status']==-1){
				message('-1','报名提示','宝贝已经被拒绝');
			}elseif ($goodsstatus['status']==1){
				//判断是否正在进行活动
				if($goodsstatus['end']<$_timestamp){
					message('-1','报名提示','宝贝已审核通过,活动展示已结束');
				}elseif ($goodsstatus['start']>$_timestamp){
					message('-1','报名提示','宝贝已审核通过，等待活动开始');
				}elseif ($goodsstatus['end']>$_timestamp && $goodsstatus['start']<$_timestamp){
					message('-1','报名提示','宝贝已审核通过，活动展示中');
				}
			}else{
				message('-1','报名提示','操作错误');
			}
		}
	}elseif ($activity['type']=='try'){
		$trystatus=tryiidinfo($num_iid);
		if(empty($trystatus)){
			message('0','试用报名提示','可以报名','',array('formhash'=>formhash(),'num_iid'=>$num_iid));
		}else{
			if($trystatus['status']==0){
				message('-1','试用报名提示','宝贝已经报名等待审核中...');
			}elseif ($trystatus['status']==-1){
				message('-1','试用报名提示','宝贝已经被拒绝...');
			}elseif ($trystatus['status']==1){
				//判断是否正在进行活动
				if($trystatus['end']<$_timestamp){
					message('-1','试用报名提示','宝贝已审核通过,活动展示已结束');
				}elseif ($trystatus['start']>$_timestamp){
					message('-1','试用报名提示','宝贝已审核通过，等待活动开始');
				}elseif ($trystatus['end']>$_timestamp && $trystatus['start']<$_timestamp){
					message('-1','试用报名提示','宝贝已审核通过，活动进行中');
				}
			}else{
				message('-1','试用报名提示','操作错误');
			}
		}
	}elseif ($activity['type']=='exchange'){
		$excstatus=exciidinfo($num_iid);
		if(empty($excstatus)){
			message('0','兑换报名提示','可以报名','',array('formhash'=>formhash(),'num_iid'=>$num_iid));
		}else{
			if($excstatus['status']==0){
				message('-1','兑换报名提示','宝贝已经报名等待审核中...');
			}elseif ($trystatus['status']==-1){
				message('-1','兑换报名提示','宝贝已经被拒绝...');
			}elseif ($trystatus['status']==1){
				//判断是否正在进行活动
				if($trystatus['end']<$_timestamp){
					message('-1','兑换报名提示','宝贝已审核通过,活动展示已结束');
				}elseif ($trystatus['start']>$_timestamp){
					message('-1','兑换报名提示','宝贝已审核通过，等待活动开始');
				}elseif ($trystatus['end']>$_timestamp && $trystatus['start']<$_timestamp){
					message('-1','兑换报名提示','宝贝已审核通过，活动进行中');
				}
			}else{
				message('-1','兑换报名提示','操作错误');
			}
		}
	}
}
/**/
function get_status_num($type,$where){
	global $_timestamp;
	!empty($where)?$wherestr='('.implode(' AND ',$where).')':'';
	if($type=='goods'){
		$query='select count(*) as `all`,
				sum(if(`status`=0 and (`pay_type`=0 OR (`pay_type`=1 AND `pay_serialno` IS NOT NULL)),1,0)) as audit,
				sum(if(`status`=-1,1,0)) as pass,
				sum(if(`status`=1 and `start`>'.$_timestamp.',1,0)) as listing,
				sum(if(`status`=1 and `end`>'.$_timestamp.' and `start`<'.$_timestamp.',1,0)) as online,
				sum(if(`status`=1 and `end`<'.$_timestamp.',1,0)) as over,
				sum(if(`status`=0 and `pay_type`=1 and `pay_serialno` IS NULL,1,0)) as nonpay 
			from '.tname('goods').' where '.$wherestr;
	}elseif ($type=='try'){
		$query='select count(*) as `all`,
				sum(if(`status`=0 and (`pay_type`=0 OR (`pay_type`=1 AND `pay_serialno` IS NOT NULL)),1,0)) as audit,
				sum(if(`status`=-1,1,0)) as pass,
				sum(if(`status`=1 and `start`>'.$_timestamp.',1,0)) as listing,
				sum(if(`status`=1 and `end`>'.$_timestamp.' and `start`<'.$_timestamp.',1,0)) as online,
				sum(if(`status`=1 and `end`<'.$_timestamp.',1,0)) as over,
				sum(if(`status`=0 and `pay_type`=1 and `pay_serialno` IS NULL,1,0)) as nonpay  
			from '.tname('try').' where '.$wherestr;
	}elseif ($type=='exchange'){
		$query='select count(*) as `all`,
				sum(if(`status`=0 and (`pay_type`=0 OR (`pay_type`=1 AND `pay_serialno` IS NOT NULL)),1,0)) as audit,
				sum(if(`status`=-1,1,0)) as pass,
				sum(if(`status`=1 and `start`>'.$_timestamp.',1,0)) as listing,
				sum(if(`status`=1 and `end`>'.$_timestamp.' and `start`<'.$_timestamp.',1,0)) as online,
				sum(if(`status`=1 and `end`<'.$_timestamp.',1,0)) as over, 
				sum(if(`status`=0 and `pay_type`=1 and `pay_serialno` IS NULL,1,0)) as nonpay  
			from '.tname('exchange').' where '.$wherestr;
	}
	$query = lib_database::rquery($query);
	return lib_database::fetch_one();
}
/**
 * 保证金解冻
 *
 */
function deposit_unfreeze(){
	global $user,$_webset,$_timestamp,$_logtype;
	$serialno=serialNO();
	$log=array('uid'=>$user['uid'],'user_name'=>$user['user_name'],'money'=>$user['margin'],'method'=>2,'type'=>$_logtype['unfreeze'],'addtime'=>$_timestamp,'status'=>1,'serialno'=>$serialno,'account'=>'保证金解冻');
	lib_database::wquery('update '.tname('users_seller_fields').' set `money`=`money`+`margin`,`margin`=0 where uid='.$user['uid'].' and `margin`>0 and paidtime<'.($_timestamp-$_webset['extend_seller_freeze']*24*3600));
	lib_database::wquery('update '.tname('users_seller_session').' set `money`=`money`+`margin`,`margin`=0 where uid='.$user['uid'].' and `margin`>0 and paidtime<'.($_timestamp-$_webset['extend_seller_freeze']*24*3600));
	$isok = mysql_affected_rows();
	if($isok){
		lib_database::insert('seller_changelog',array_keys($log),$log);
		return true;
	}
	return false;
}

//修改用户信息
function up_seller_user($userinfo){
	global $access;
	$uid=$userinfo['uid'];
	unset($userinfo['uid']);
	//修改密码
	if(!empty($userinfo['userpwd'])){
		$userpwd=$access->_get_encodepwd($userinfo['userpwd']);
		unset($userinfo['userpwd']);
		lib_database::update('users',array('userpwd'=>$userpwd),'uid=\''.$uid.'\'');
	}
	//若要修改用户名判断是否已经存在
	if(!empty($userinfo['user_name'])){
		if(check_account_exist($userinfo['user_name'],'user_name',$uid,'seller')){
			throw new Exception('用户名已经存在！');
			return false;
		}
	}
	//判断邮箱
	if(!empty($userinfo['email'])){
		if(check_account_exist($userinfo['email'],'email',$uid,'seller')){
			throw new Exception('邮箱已经存在！');
			return false;
		}
	}
	//判断手机
	if(!empty($userinfo['mobile'])){
		if(check_account_exist($userinfo['mobile'],'mobile',$uid,'seller')){
			throw new Exception('手机已经存在！');
			return false;
		}
	}
	//修改表
	$user_main=$users_fields=array();
	foreach ($userinfo as $key=>$value){
		if(in_array($key,array('user_name','email','mobile','apps','groups','sta','regtime','regip','logintime','loginip'))){
			$user_main[$key]=$value;
		}elseif (in_array($key,array('uid' ,'site' ,'money' ,'margin' ,'paidtime' ,'withdraw' ,'alipay' ,'wangwang' ,'shop' ,'contact' ,'qq' ,'introduce'))){
			$users_fields[$key]=$value;
		}
	}
	!empty($user_main) && lib_database::update('users',$user_main,'uid=\''.$uid.'\'');
	!empty($users_fields) && lib_database::update('users_seller_fields',$users_fields,'uid=\''.$uid.'\'');
	$users_fields=array_merge($users_fields,$user_main);
	lib_database::update('users_seller_session',$users_fields,'uid=\''.$uid.'\'');
}
/**
 * 删除宝贝
 *
 */
function del_goods($id){
	lib_database::delete('goods','id='.$id);
}
/**
 * 删除试用
 *
 */
function del_try($id){
	lib_database::delete('try','id='.$id);
}
/**
 * 删除积分兑换
 *
 */
function del_exc($id){
	lib_database::delete('exchange','id='.$id);
}
//邮件绑定
function send_seller_register_email($email,$uid,$data){
	global $_webset,$_timestamp;
	$data['site_name']=$_webset['site_name'];
	$data['time']=date('Y-m-d H:i:s',$_timestamp);
	$data['email']=$email;
	//判断有没有开启
	$email_tpl=unserialize($_webset['email_tpl_register']);
	if($_webset['email_open']==1){
		if(empty($data['url'])){
			$code=creat_code();
			$data['url']=u('seller','callback',array('op'=>'register','code'=>$code));
		}else{
			$code=$data['code'];
			unset($data['code']);
		}
		//判断有没有存在
		$hadesend=lib_database::get_one('select * from '.tname('activating').' where type=\'register\' and email=\''.$email.'\' and uid='.$uid);
		//保存激活记录
		if(!empty($hadesend)){
			lib_database::update('activating',array('code'=>$code,'addtime'=>$_timestamp,'uid'=>$uid),'type=\'register\' and email=\''.$email.'\'');
		}else{
			lib_database::insert('activating',array('email','uid','code','addtime','type'),array($email,$uid,$code,$_timestamp,'register'));
		}
		//邮件模板处理
		$tpl=get_email_tpl('register',$data);
		send_email($email,$data['site_name'].$email_tpl['title'],$tpl);
	}else{
		register_email($email,$uid);
	}
	return true;
}
/* End of file common.fun.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\template\default\seller\lib\common.fun.php */
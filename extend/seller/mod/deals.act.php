<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\seller\mod\deals.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @deals.act.php
 * =================================================
*/
//付款
if(submitcheck('pay_money')){
	$type=request('type','',array('goods','album','special','try','exchange'));
	$id=request('id',0);
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
	//价格变动
	$activity=select_activity($type,$tid);
	if($activity['type']=='special'){
		//判断是否出售
		if($activity['special_position'][$goods['pay_id']]['remain']<=0){
			extend_message(0,'系统提示','展位已经不能购买!');
		}
		if($activity['special_position'][$goods['pay_id']]['price']!=$goods['pay_money']){
			extend_message(0,'系统提示','活动价格发生变化请重新报名!');
		}
	}else{
		if($goods['pay_money']!=$activity['paydetail']['money'][$goods['pay_id']]){
			extend_message(0,'系统提示','活动价格发生变化请重新报名!');
		}
	}
	//余额否足够
	$money=check_seller_fileds($user['uid'],'money');
	if($money<$goods['pay_money']){
		header('location:'.u(MODNAME,'callback',array('op'=>'appaly','type'=>$type,'id'=>$id)));
	}
	if($activity['type']=='special'){
		$title='['.$activity['special_position'][$goods['pay_id']]['name'].'-'.$activity['special_position'][$goods['pay_id']]['price'].']'.$goods['title'];
	}else{
		$title='['.$activity['paydetail']['title'][$goods['pay_id']].'-'.$activity['paydetail']['money'][$goods['pay_id']].']'.$goods['title'];
	}

	$pay_id=$goods['pay_id'];
	$pay_money=$goods['pay_money'];
	$serialno=pay_money_log($title,$pay_id,-abs($pay_money));
	//修改商品订单
	appay_goods(array('id'=>$goods['id'],'pay_serialno'=>$serialno),$activity['type']);
	//如果
	if($activity['type']=='special'){
		lib_database::wquery('update '.tname('special_position').' set `remain`=`remain`-1 where `remain`>0 and `sid`='.$tid.' and `pid`='.$goods['pay_id']);
	}
	extend_message(0,'系统提示','支付成功',u(MODNAME,'manage',array('op'=>$type,'s'=>'audit')));
}elseif(submitcheck('applyform')){
	$deal=request('deal',array());
	if(empty($deal)){
		extend_message(0,'系统提示','操作错误',-1);
	}
	$aid=request('aid',0);
	//查询报名类型
	if(empty($aid)){
		extend_message(0,'系统提示','活动不存在',-1);
	}
	$activity=get_activity_info($aid);
	if(empty($activity)){
		extend_message(0,'系统提示','活动不存在',-1);
	}
	if(empty($deal['title'])){extend_message(0,'系统提示','请填写宝贝标题',-1);}////验证名字
	if(empty($deal['promotion_price'])){extend_message(0,'系统提示','请填写活动价格',-1);}//验证价格
	if($deal['promotion_price']>$deal['price']){extend_message(0,'系统提示','活动价格不能大于原价',-1);}
	if(empty($deal['pic'])){extend_message(0,'系统提示','请上传图片',-1);}////图片验证
	//验证隐藏数据
	if(empty($deal['nick']) || empty($deal['seller_id']) || empty($deal['num_iid']) || empty($deal['price']) || !in_array($deal['site'],array('taobao','tmall')) || empty($deal['taopic'])){
		extend_message(0,'系统提示','操作错误,请重新获取宝贝信息',-1);
	}
	//格式化数据
	$goods=array();
	$goods['status']=0;
	if($activity['type']=='goods' || $activity['type']=='album' || $activity['type']=='special'){
		if(empty($deal['cat'])){extend_message(0,'系统提示','请选择宝贝分类',-1);}////验证分类
		if($activity['type']=='goods'){$goods['channel']=$activity['tid'];}
		if ($activity['type']=='album'){$goods['aid']=$activity['tid'];}
		if ($activity['type']=='special'){
			if(empty($deal['channel'])){extend_message(0,'系统提示','请选择频道',-1);}
			$goods['channel']=$deal['channel'];
			$goods['aid']=-$activity['tid'];
		}
		$goods['title']=$deal['title'];
		$goods['cat']=intval($deal['cat']);
		$goods['price']=floatval($deal['price']);
		$goods['promotion_price']=floatval($deal['promotion_price']);
		$goods['discount']=sprintf("%.2f",$deal['promotion_price']/$deal['price']*10);
		$goods['volume']=intval($deal['volume']);
		$goods['nick']=trim($deal['nick']);
		$goods['seller_id']=trim($deal['seller_id']);
		$goods['site']=$deal['site'];
		$goods['num_iid']=$deal['num_iid'];
		$goods['ispost']=intval($deal['ispost']);
		$goods['ispaigai']=$goods['isvip']=-1;
		intval($deal['privilege'])==1 && $goods['ispaigai']=1;
		intval($deal['privilege'])==2 && $goods['isvip']=1;
		$goods['uid']=$user['uid'];
		$goods['addtime']=$_timestamp;
		$goods['remark']=$deal['remark'];
		$goods['pic']=$deal['pic'];
		$goods['taopic']=$deal['taopic'];
		$goods['status']=0;
	}
	//免费试用报名
	elseif ($activity['type']=='try' || $activity['type']=='exchange'){
		$num=intval($deal['num']);
		if(empty($num)){extend_message(0,'系统提示','请填写提供数量',-1);}
		$goods['title']=$deal['title'];
		$goods['price']=floatval($deal['price']);
		$goods['promotion_price']=floatval($deal['promotion_price']);
		$goods['nick']=trim($deal['nick']);
		$goods['site']=$deal['site'];
		$goods['num_iid']=$deal['num_iid'];
		$goods['uid']=$user['uid'];
		$goods['addtime']=$_timestamp;
		$goods['remark']=$deal['remark'];
		$goods['pic']=$deal['pic'];
		$goods['num']=$num;
	}
	if($activity['type']=='special'){
		$pay_type=1;
		$pay_id=$deal['pay_id'];
		if(!isset($activity['special_position'][$pay_id])){
			extend_message(0,'系统提示','操作错误',-1);
		}
		if(empty($deal['id']) && $activity['special_position'][$pay_id]['remain']<=0){
			extend_message(0,'系统提示','此展位已经被购买',-1);
		}
		$pay_money=$activity['special_position'][$pay_id]['price'];
	}else{
		$pay_money=$pay_id=0;
		//付费方式
		if(empty($deal['pay_type']) || $deal['pay_type']=='free'){
			$pay_type='free';
		}else{
			list($pay_type,$pay_id)=explode('_',$deal['pay_type']);
		}
		if($pay_type=='free' && !$activity['free']){
			extend_message(0,'系统提示','操作错误',-1);
		}
		if($pay_type=='pay'){
			if(!$activity['pay'] || !isset($activity['paydetail']['title'][$pay_id])){
				extend_message(0,'系统提示','操作错误',-1);
			}else{
				$pay_money=$activity['paydetail']['money'][$pay_id];
			}
		}
	}
	$pay_type=$pay_type=='free'?0:1;
	$goods['pay_type']=$pay_type;
	$goods['pay_id']=$pay_id;
	$goods['pay_money']=$pay_money;
	$goods['id']=intval($deal['id']);
	//判断是否未付费
	$pay_serialno='';
	if(!empty($goods['id'])){
		$pay_serialno=get_pay_serialno($goods['id'],$activity['type']);
		if($pay_serialno){
			unset($goods['status']);
		}
	}
	//提交报名
	$id=appay_goods($goods,$activity['type']);
	if($pay_type==1 && !$pay_serialno){
		header('location:'.u(MODNAME,'callback',array('op'=>'appaly','type'=>$activity['type'],'id'=>$id)));
		exit();
	}
	extend_message(0,'系统提示','报名成功',u(MODNAME,'manage',array('op'=>$activity['type'])));
}else{
	$aid=request('aid',0);
	$id=intval(request('id',0));
	$type=request('type','',array('goods','album','special','try','exchange'));
	if(empty($aid) && (empty($id) || empty($type))){
		extend_message(0,'系统提示','活动不存在',u(MODNAME,ACTNAME));
	}
	if(!empty($aid)){
		$activity=get_activity_info($aid);
		if(empty($activity)){
			extend_message(0,'系统提示','活动不存在',u(MODNAME,ACTNAME));
		}
	}else{
		if($type=='goods'){
			$goods=getgood($id);
			$tid=$goods['channel'];
			if($goods['aid']>0){
				$type='album';
				$tid=$goods['aid'];
			}elseif ($goods['aid']<0){
				$type='special';
				$tid=abs($goods['aid']);
			}
		}elseif ($type=='try'){
			$goods=gettry($id);
		}elseif ($type=='exchange'){
			$goods=getexc($id);
		}
		if(empty($goods)){
			extend_message(0,'系统提示','活动不存在',u(MODNAME,ACTNAME));
		}
		$activity=select_activity($type,$tid);
	}
	//专场
	if ($activity['type']=='special'){
		$apply_type=get_apply_type();
	}
	//系统分类
	$catlist=getgoodscat();
}
require tpl_extend('deals.tpl.php');
/* End of file deals.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\seller\mod\deals.act.php */
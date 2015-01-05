<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @apply.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
$apply=request('apply',array());
//判断有没有登陆
if(empty($user['uid'])){
	header("location:../".u('user','login',array('gourl'=>urlencode(get_cururl()))));
}
if(!empty($apply)){
	$apply['uid']=$user['uid'];
	if(!isset($_id_nav[$apply['channel']])){
		message('-1','报名提示','操作错误',"-1");
	}
	if(!in_array($_id_nav[$apply['channel']]['mod'],array('goods','try','exchange'))){
		message('-1','报名提示','操作错误');
	}
	//被加入黑名单
	$checkblack=checkblack($apply['nick']);
	if(!empty($checkblack)){
		message('0','报名提示','您已被加入黑名单，原因"'.$checkblack['reason'].'"','-');
	}
	$type=request('type');
	if($type=='goods'){
		//查询宝贝状态
		if(!empty($apply['id'])){
			goodAdd($apply);
			message('0','报名提示','修改成功',u('business','list',array('nid'=>$apply['channel'])));
		}else{
			$goodsstatus=getiidgood($apply['num_iid']);
		}
		if(empty($goodsstatus)){
			//开始报名
			$apply['addtime']=$_timestamp;
			$apply['status']=0;
			goodAdd($apply);
			message('0','报名提示','报名成功，等待审核',u('business','list',array('nid'=>$apply['channel'])));
		}else{
			if($goodsstatus['status']==0){
				message('-1','报名提示','宝贝已经报名等待审核中...','-1');
			}elseif ($goodsstatus['status']==-1){
				message('-1','报名提示','宝贝已经被拒绝...','-1');
			}elseif ($goodsstatus['status']==1){
				//判断是否正在进行活动
				if($goodsstatus['end']<$_timestamp){
					message('-1','报名提示','宝贝已审核通过,活动展示已结束','-1');
				}elseif ($goodsstatus['start']>$_timestamp){
					message('-1','报名提示','宝贝已审核通过，等待活动开始','-1');
				}elseif ($goodsstatus['end']>$_timestamp && $goodsstatus['start']<$_timestamp){
					message('-1','报名提示','宝贝已审核通过，活动展示中','-1');
				}
			}
		}
	}
	//报名试用
	elseif ($type=='try'){
		if(!empty($apply['id'])){
			$channel=$apply['channel'];
			unset($apply['channel']);
			tryadd($apply);
			message('0','操作提示','修改成功',u('business','list',array('nid'=>$channel)));
		}else{
			$trystatus=tryiidinfo($apply['num_iid']);
		}
		if(empty($trystatus)){
			//开始报名
			$apply['addtime']=$_timestamp;
			$apply['status']=0;
			$channel=$apply['channel'];
			unset($apply['channel']);
			tryadd($apply);
			message('0','报名提示','报名成功，等待审核',u('business','list',array('nid'=>$channel)));
		}else{
			if($trystatus['status']==0){
				message('-1','报名提示','宝贝已经报名等待审核中...','-1');
			}elseif ($trystatus['status']==-1){
				message('-1','报名提示','宝贝已经被拒绝...','-1');
			}elseif ($trystatus['status']==1){
				//判断是否正在进行活动
				if($trystatus['end']<$_timestamp){
					message('-1','报名提示','宝贝已审核通过,活动展示已结束','-1');
				}elseif ($trystatus['start']>$_timestamp){
					message('-1','报名提示','宝贝已审核通过，等待活动开始','-1');
				}elseif ($trystatus['end']>$_timestamp && $trystatus['start']<$_timestamp){
					message('-1','报名提示','宝贝已审核通过，活动展示中','-1');
				}
			}
		}
	}
	//报名积分兑换
	elseif ($type=='exchange'){
		if(!empty($apply['id'])){
			$channel=$apply['channel'];
			unset($apply['channel']);
			excadd($apply);
			message('0','操作提示','修改成功',u('business','list',array('nid'=>$channel)));
		}else{
			$excstatus=exciidinfo($apply['num_iid']);
		}
		if(empty($excstatus)){
			//开始报名
			$apply['addtime']=$_timestamp;
			$apply['status']=0;
			$channel=$apply['channel'];
			unset($apply['channel']);
			excadd($apply);
			message('0','报名提示','报名成功，等待审核',u('business','list',array('nid'=>$channel)));
		}else{
			if($excstatus['status']==0){
				message('-1','报名提示','宝贝已经报名等待审核中...','-1');
			}elseif ($excstatus['status']==-1){
				message('-1','报名提示','宝贝已经被拒绝...','-1');
			}elseif ($excstatus['status']==1){
				//判断是否正在进行活动
				if($excstatus['end']<$_timestamp){
					message('-1','报名提示','宝贝已审核通过,活动展示已结束','-1');
				}elseif ($excstatus['start']>$_timestamp){
					message('-1','报名提示','宝贝已审核通过，等待活动开始','-1');
				}elseif ($excstatus['end']>$_timestamp && $excstatus['start']<$_timestamp){
					message('-1','报名提示','宝贝已审核通过，活动展示中','-1');
				}
			}
		}
		exit();
	}
}
//编辑
$id=request('id');
if(!empty($id)){
	$type=request('type');
	if($type=='goods'){
		$good=getgood($id);
		$nid=$good['channel'];
		if(empty($good) || $good['uid']!=$user['uid']){
			message('-1','系统提示','操作错误',-1);
		}
	}elseif ($type=='exchange'){
		$good=getexc($id);
		$nid=$_nav[$type.'/index']['id'];
		if(empty($good) || $good['uid']!=$user['uid']){
			message('-1','系统提示','操作错误',-1);
		}
	}elseif ($type=='try'){
		$good=gettry($id);
		$nid=$_nav[$type.'/index']['id'];
		if(empty($good) || $good['uid']!=$user['uid']){
			message('-1','系统提示','操作错误',-1);
		}
	}
}else{
	//报名的类型
	$nid=request('nid',0);
	$type=$_id_nav[$nid]['mod'];
	$typename=$_id_nav[$nid]['name'];
	if(!isset($_id_nav[$nid])){
		message('-1','报名提示','操作错误');
	}
}
if(!in_array($type,array('goods','try','exchange'))){
	message('-1','报名提示','操作错误');
}
//宝贝分类
$catlist=getgoodscat();

?>
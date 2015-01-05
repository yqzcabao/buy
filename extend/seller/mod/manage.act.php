<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\mod\seller\manage.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @manage.act.php
 * =================================================
*/
$ops=array('goods','try','exchange');
$op=request('op','goods',$ops);
$status_arr=array('all','audit','listing','online','over','pass','nonpay');
$status=request('s','all',$status_arr);
//状态判断
switch ($status){
	case 'all':
		$where[]='a.`uid`='.$user['uid'];
		break;
	case 'audit':
		$where[]='a.`status`=0';
		$where[]='(a.`pay_type`=0 OR (a.`pay_type`=1 AND a.`pay_serialno` IS NOT NULL))';
		$where[]='uid='.$user['uid'];
		break;
	case 'listing':
		$where[]='a.`status`=1';
		$where[]='a.`uid`='.$user['uid'];
		$where[]='a.`start`>'.$_timestamp;
		break;
	case 'online':
		$where[]='a.`status`=1';
		$where[]='a.`uid`='.$user['uid'];
		$where[]='a.`start`<'.$_timestamp.' AND a.`end`>'.$_timestamp;
		break;
	case 'over':
		$where[]='a.`status`=1';
		$where[]='a.`uid`='.$user['uid'];
		$where[]='a.`end`<'.$_timestamp;
		break;
	case 'pass':
		$where[]='a.`status`=-1';
		$where[]='a.`uid`='.$user['uid'];
		break;
	case 'nonpay':
		$where[]='a.`status`=0';
		$where[]='a.`pay_type`=1';
		$where[]='a.`pay_serialno` IS NULL';
		$where[]='a.`uid`='.$user['uid'];
		break;
}
$num_arr=get_status_num($op,array('`uid`='.$user['uid']));
if($op=='goods'){
	$activity_list=get_activity();
	$start = intval(request('start',0));
	//搜索条件==============
	$aidstr=request('aid','');
	if(!empty($aidstr)){
		$aidarr=explode('_',$aidstr);
		if($aidarr[0]=='goods'){
			$where[]='a.`channel`='.$aidarr[1];
		}elseif ($aidarr[0]=='album'){
			$where[]='a.`aid`='.$aidarr[1];
		}
	}
	//搜索id
	$num_iid=request('num_iid','');
	if(!empty($num_iid)){
		$where[]='a.`num_iid`=\''.$num_iid.'\'';
	}
	//搜索end================
	$result=goodslist($where,'a.`addtime` DESC',$start,PAGE,true);
	$goodslist=array();
	if (!empty($result))
	{
		$page_url=u(MODNAME,ACTNAME,array('op'=>$op)).'&'.$result['url'];
		$pages=get_page_number_list($result['total'], $start, PAGE);
		$goodslist=$result['data'];
	}
	$catlist=getgoodscat();
	//频道列表
	$channel_list=get_channel();
	//专题列表
	$album_list=get_album();
	//专场列表
	$special_list=get_special();
	//专场展位信息
	$special_position=get_special_position();
}
elseif ($op=='try'){
	$start = intval(request('start',0));
	$result=trylist($where,'a.`addtime` DESC',$start,PAGE,true);
	$trylist=array();
	if (!empty($result))
	{
		$page_url=u(MODNAME,ACTNAME,array('op'=>$op)).'&'.$result['url'];
		$pages=get_page_number_list($result['total'], $start, PAGE);
		$trylist=$result['data'];
	}
}elseif ($op=='exchange'){
	$start = intval(request('start',0));
	$result=exclist($where,'a.`addtime` DESC',$start,PAGE,true);
	$exclist=array();
	if (!empty($result))
	{
		$page_url=u(MODNAME,ACTNAME,array('op'=>$op)).'&'.$result['url'];
		$pages=get_page_number_list($result['total'], $start, PAGE);
		$exclist=$result['data'];
	}
}
require tpl_extend('manage.tpl.php');
/* End of file manage.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\mod\seller\manage.act.php */
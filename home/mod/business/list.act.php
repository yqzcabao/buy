<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @list.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}

$nid=request('nid',0);
if(empty($nid)){
	foreach ($_id_nav as $key=>$value){
		if($value['mod']=='goods'){
			$nid=$value['id'];
			break;
		}
	}
}
//报名产品
$type=$_id_nav[$nid]['mod'];
//$where=array('uid='.$user['uid']);
$op=request('op');
switch ($op){
	case 'wait':
		$where[]='a.`status`=0';
		break;
	case 'willline':
		$where[]='a.`status`=1 and a.`start`>'.$_timestamp;
		break;
	case 'online':
		$where[]='a.`status`=1 and a.`start`<'.$_timestamp.' and a.`end`>'.$_timestamp;
		break;
	case 'end':
		$where[]='a.`status`=1 and a.`end`<'.$_timestamp;
		break;
	case 'pass':
		$where[]='a.`status`=-1';
		break;		
}
//产品
$start = intval(request('start',0));
$where[]='a.`uid`='.$user['uid'];
if($type=='goods'){
	$catlist=getgoodscat();
	//处理频道
	$where[]='a.`channel`=\''.$nid.'\'';
	$result=goodslist($where,'a.`addtime` DESC',$start,30,true);
}elseif($type=='try'){
	$result=trylist($where,'a.`addtime` DESC',$start,30,true);
}elseif($type=='exchange'){
	$result=exclist($where,'a.`addtime` DESC',$start,30,true);
}
$goods=array();
if (!empty($result))
{
	$result['urls']['nid']=$nid;
	$result['urls']['op']=$op;
	$page_url=u('business','list',$result['urls']);
	$pages=get_page_number_list($result['total'], $start,30);
	$goods=$result['data'];
}
?>
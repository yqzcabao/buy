<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @center.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
$op=request('op');
$op=in_array($op,array('all','plus','reduce'))?$op:'all';
//积分记录
switch ($op){
	case 'all':
		$where[]='uid='.$user['uid'];
		break;
	case 'plus':
		$where[]='uid='.$user['uid'].' AND integ>0';
		break;
	case 'reduce':
		$where[]='uid='.$user['uid'].' AND integ<0';
		break;
	default:
		$where[]='uid='.$user['uid'];
		break;
}
$start = intval(request('start',0));
$result=changeloglist($where,'`addtime` desc',$start,30,false);
$log=array();
if (!empty($result))
{
	$page_url=u('user','center',array('op'=>$op));
	$pages=get_page_number_list($result['total'], $start, 30);
	$log=$result['data'];
}
?>
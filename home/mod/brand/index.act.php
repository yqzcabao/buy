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
$nid=brandNid();
//品牌团列表
$brandlist=brandlist(array('start<='.$_timestamp,'end>'.$_timestamp),'`sort` DESC,`addtime` DESC',0,16);
//获取品牌产品
$query=lib_database::rquery('select * from '.tname('goods').' where channel='.$nid.' and start<'.$_timestamp.' and end>'.$_timestamp.' ORDER BY `sort` desc,`start` DESC');
$brandgood=array();
while ($rt = lib_database::fetch_one())
{
	$brandgood['bid_'.$rt['cat']]['num']+=1;
	$brandgood['bid_'.$rt['cat']]['bid']=$rt['cat'];
	if($brandgood['bid_'.$rt['cat']]['num']<=3){
		$brandgood['bid_'.$rt['cat']]['goods'][] = $rt;
	}
}
?>
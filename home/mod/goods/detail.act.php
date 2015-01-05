<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @detail.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
$iid=request('iid');
$gid=request('gid');
if(!empty($iid)){
	$good=getiidgood($iid);
}elseif (!empty($gid)){
	$good=getgood($gid);
}
if(empty($iid) && empty($gid)){
	message('-1','提示','商品不存在');
}
if(empty($good)){
	message('-1','提示','商品不存在');
}
//确定商品tag
$_navtag=$_id_nav[$good['channel']]['tag'];
//宝贝分类
$catlist=getgoodscat();
$good['catname']=$catlist['cid_'.$good['cat']]['title'];
//销量
if(empty($good['volume'])){
	$taokegood=get_taoke($good['num_iid']);
	$good['volume']=$taokegood['volume'];
	if(!empty($good['volume'])){
		goodAdd(array('volume'=>$good['volume'],'id'=>$good['id']));
	}
}
//你可能喜欢的宝贝
function youlikegood($cat,$id=0){
	global $_timestamp,$_webset;
	$query = lib_database::rquery('select * from '.tname('goods').' where id!=\''.$id.'\' and status=1 and cat=\''.$cat.'\' and end>'.$_timestamp.' LIMIT 0,6');
	$data=array();
	while ($rt = lib_database::fetch_one())
	{
		$data[] = $rt;
	}
	return $data;
}
?>
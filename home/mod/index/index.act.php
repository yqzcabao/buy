<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @index.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
//今日优惠
function index_goods($sort,$start,$num=PAGE){
	global $_timestamp,$_webset;
	//品牌团id
	$nid=brandNid();
	$goodsort=goodssort($sort);
	$where[]='status=1';
	$where[]='channel!='.$nid;
	//判断是否显示过期商品
	if($_webset['base_showover']!=1){
		$where[]='end>'.$_timestamp;
	}
	//是否显示明日预告
	if($_webset['base_tomorrow']!=1){
		$where[]='start<'.strtotime('tomorrow');
	}
	$result=goodslist($where,$goodsort,$start,$num);
	$goodslist=array();
	if (!empty($result))
	{
		if(in_array($sort,array('new','hot'))){
			$result['urls']['sort']=$sort;
		}
		$page_url=u('index','index',$result['urls']);
		$pages=get_page_number_list($result['total'], $start,$num);
		$goodslist=$result['data'];
		return array('pages'=>$pages,'page_url'=>$page_url,'data'=>$goodslist);
	}
	return array();
}
//友情链接
function footerlink(){
	return system::getlink();
}
?>
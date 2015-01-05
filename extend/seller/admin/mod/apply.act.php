<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\seller\admin\mod\goods.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @goods.act.php
 * =================================================
*/
require PATH_EXTEND.'/lib/common.fun.php';
$ops=array('goods','album','special','try','exchange','goodsedit');
$op=request('op','goods',$ops);
$do=request('do','');
$status=intval(request('status','0',array(0,-1,1)));
if($op=='goods' || $op=='album' || $op=='special'){
	if($do=='edit'){
		$id=request('id','');
		if(!empty($id)){
			$good=getgood($id);
		}
	}else{
		$start = intval(request('start',0));
		$where=array('a.`status`='.$status);
		if($op=='album'){
			$where[]='a.`aid`>0';
		}elseif($op=='special'){
			$where[]='a.`aid`<0';
		}else{
			$where[]='a.`aid`=0';
		}
		$where[]='a.`uid`!=0';
		$result=goodslist($where,'a.`addtime` ASC',$start,30,true);
		$goodslist=array();
		if (!empty($result))
		{
			$page_url=$_extend_url.'&pmod=apply&op='.$op.'&'.$result['url'];
			$pages=get_page_number_list($result['total'], $start, 30);
			$goodslist=$result['data'];
		}
	}
}elseif ($op=='try'){
	if($do=='edit'){
		$id=request('id','');
		if(!empty($id)){
			$try=gettry($id);
		}
	}else{
		$start = intval(request('start',0));
		$where=array('a.`status`='.$status,'uid!=0');
		$result=trylist($where,'a.`addtime` ASC',$start,30,true);
		$trylist=array();
		if (!empty($result))
		{
			$page_url=$_extend_url.'&pmod=apply&op='.$op.'&'.$result['url'];
			$pages=get_page_number_list($result['total'], $start, 30);
			$trylist=$result['data'];
		}
	}
}elseif ($op=='exchange'){
	if($do=='edit'){
		$id=request('id','');
		if(!empty($id)){
			$exc=getexc($id);
		}
	}else{
		$start = intval(request('start',0));
		$where=array('a.`status`='.$status,'uid!=0');
		$result=exclist($where,'a.`addtime` ASC',$start,30,true);
		$exclist=array();
		if (!empty($result))
		{
			$page_url=$_extend_url.'&pmod=apply&op='.$op.'&'.$result['url'];
			$pages=get_page_number_list($result['total'], $start, 30);
			$exclist=$result['data'];
		}
	}
}
/* End of file goods.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\seller\admin\mod\goods.act.php */
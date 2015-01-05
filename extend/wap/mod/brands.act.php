<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\wap\mod\brands.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @brands.act.php
 * =================================================
*/
$bid=request('bid',0);
$nid=brandNid();
//品牌折扣
if(!empty($bid)){
	$brand=getbrand($bid);
	if(empty($brand)){
		header("location:".u('wap','brand'));
		exit();
	}
	$query=lib_database::rquery('select * from '.tname('goods').' where channel=\''.$nid.'\' and cat=\''.$bid.'\'');
	while ($rt = lib_database::fetch_one())
	{
		$brandgood[] = $rt;
	}
}else{
	if($_isajax){
		$bid=request('bid',0);
		$idstr=request('idstr');
		$brandgood=array();
		if(!empty($bid)){
			$today=strtotime('today');
			$where='channel=\''.$nid.'\' and cat='.$bid;
			if(!empty($idstr)){
				$idsarr=explode(',',$idstr);
				foreach ($idsarr as $id){
					$where.=' and id!='.$id;
				}
			}
			//$idstr
			$query=lib_database::rquery('select * from '.tname('goods').' where '.$where.' order by `start` DESC');
			while ($rt = lib_database::fetch_one())
			{
				$rt['url_format']=u('index','jump',array('iid'=>$rt['num_iid']));
				$rt['pic']=get_img($rt['pic'],'290');
				if($rt['start']>$today){
					$rt['is_new']=1;
				}else{
					$rt['is_new']=0;
				}
				$brandgood[] = $rt;
			}
		}
		echo json_encode(array('goods'=>$brandgood,'num'=>count($brandgood)));
		exit();
	}else{
		$brandlist=brandlist(array('start<='.$_timestamp,'end>'.$_timestamp),'`sort` DESC,`addtime` DESC',0,16);
		//循环查询品牌
		$query=lib_database::rquery('select * from '.tname('goods').' where channel=\''.$nid.'\' and start<'.$_timestamp.' and end>'.$_timestamp.' ORDER BY `start` DESC');
		while ($rt = lib_database::fetch_one())
		{
			$brandgood['bid_'.$rt['cat']]['num']+=1;
			$brandgood['bid_'.$rt['cat']]['bid']=$rt['cat'];
			$brandgood['bid_'.$rt['cat']]['brand']=$rt['brand'];
			//折扣
			if($brandgood['bid_'.$rt['cat']]['num']<=3){
				$brandgood['bid_'.$rt['cat']]['goods'][] = $rt;
			}
		}
	}
}
require tpl_extend(WAP_TPL.'/brands.tpl.php');
/* End of file brands.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\wap\mod\brands.act.php */
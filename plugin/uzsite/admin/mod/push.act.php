<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\plugin\uzsite\admin\mod\push.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @push.act.php
 * =================================================
*/
require PATH_PLUGIN.'lib/uzsite.func.php';
$ops=array('list','sign');
$op=request('op','list',$ops);
//宝贝列表
if($op=='list'){
	$start = intval(request('start',0));
	$result=pushgoodslist(array('a.status=1','a.start>='.strtotime('today'),'a.channel!='.brandNid()),'',$start,30);
	$goodslist=array();
	if (!empty($result))
	{
		$page_url=$_plugin_url.'&pmod=push&'.$result['url'];
		$pages=get_page_number_list($result['total'], $start, 30);
		$goodslist=$result['data'];
	}
	if($_isajax){
		jsonp(json_encode(array('goods'=>$goodslist,'total'=>$result['total'])));
	}
}
elseif($op=='sign'){
	$num_iid=request('num_iid',0);
	$status=intval(request('status',0));
	if(!empty($num_iid)){
		lib_database::wquery("replace into ".tname('plugin_uzsite_gpush').' VALUES (\''.$num_iid.'\','.$_timestamp.','.$status.')');
	}
	exit();
}
/* End of file push.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\plugin\uzsite\admin\mod\push.act.php */
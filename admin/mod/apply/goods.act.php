<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		D:\website\taobaoke\jiu2\admin\mod\apply\goods.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @goods.act.php
 * =================================================
*/
$ops=array('list','refuse');
$op=request('op','list',$ops);
//宝贝列表
if($op=='list'){
	$start = intval(request('start',0));
	$result=goodslist(array('status=0'),'`start` ASC',$start,30);
	$goodslist=array();
	if (!empty($result))
	{
		$page_url='?mod=goods&ac='.request('ac').'&op=list&'.$result['url'];
		$pages=get_page_number_list($result['total'], $start, 30);
		$goodslist=$result['data'];
	}
}
//拒绝的
elseif ($op=='refuse'){
	$start = intval(request('start',0));
	$result=goodslist(array('a.`status`=-1'),'a.`addtime` ASC',$start,30,true);
	$goodslist=array();
	if (!empty($result))
	{
		$page_url='?mod=goods&ac='.request('ac').'&op=refuse&'.$result['url'];
		$pages=get_page_number_list($result['total'], $start, 30);
		$goodslist=$result['data'];
	}
}
/* End of file goods.act.php */
/* Location: D:\website\taobaoke\jiu2\admin\mod\apply\goods.act.php */
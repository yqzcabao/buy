<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @fav.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
$start = intval(request('start',0));
$result=goodsfavlist(array('a.`uid`='.$user['uid']),'a.`addtime` DESC',$start,30);
$favlist=array();
if (!empty($result))
{
	$page_url=u('user','fav');
	$pages=get_page_number_list($result['total'], $start,30);
	$favlist=$result['data'];
}
?>
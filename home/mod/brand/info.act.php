<?php
/* -------------------------------------------------
* @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
* @使用；不允许对程序代码以任何形式任何目的的再发布。
* @info.act.php
* =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
$bid=request('bid',0);
if(empty($bid)){
	show_message('系统提示','操作错误',-1);
}
$nid=brandNid();
$brand=getbrand($bid);
lib_database::rquery('select * from '.tname('goods').' where channel='.$nid.' and cat=\''.$bid.'\' order by `sort` desc limit 0,50');
while ($rt = lib_database::fetch_one())
{
	$goodslist[] = $rt;
}
?>
<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		D:\website\taobaoke\jiu2\admin\mod\user\exclog.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @exclog.act.php
 * =================================================
*/
$ops=array('apply','ship','show');
$op=request('op','apply',$ops);

$start = intval(request('start',0));
$where[]='a.idtype=\'exchange\'';
$sort='a.`addtime` ASC';
if($op=='apply'){
	$where[]='a.status=0';
}elseif ($op=='ship'){
	$where[]='(a.status=1 or a.status=2)';
}elseif ($op=='show'){
	$where[]='(a.status=2 or a.status=3)';
}
$result=applylog($where,$sort,$start,30,false);
$trylist=array();
if (!empty($result))
{
	$page_url='?mod='.MODNAME.'&ac='.ACTNAME.'&op='.$op.'&'.$result['url'];
	$pages=get_page_number_list($result['total'], $start, 30);
	$applylog=$result['data'];
}
/* End of file exclog.act.php */
/* Location: D:\website\taobaoke\jiu2\admin\mod\user\exclog.act.php */
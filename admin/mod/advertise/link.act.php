<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		D:\website\taobaoke\jiu2\admin\mod\advertise\link.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @link.act.php
 * =================================================
*/
$ops=array('linkList','linkAdd');
$op=request('op','linkList',$ops);
$active[$op]='class="active"';

$link=request('link',array());
if(!empty($link)){
	system::linkset($link);
	show_message('友情链接','友情链接设置成功','?mod='.MODNAME.'&ac='.ACTNAME);
}
$id=request('id');
if(!empty($id)){
	$link=system::getlink();
	$link=$link[$id];
}
/* End of file link.act.php */
/* Location: D:\website\taobaoke\jiu2\admin\mod\advertise\link.act.php */
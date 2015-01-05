<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		D:\website\taobaoke\jiu2\admin\mod\seting\tpl.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @tpl.act.php
 * =================================================
*/
$ops=array('mytpl','tplset');
$op=request('op','mytpl');
//我的模板
$tpls=getTpl();
if(submitcheck('tplset')){
	$tpl=request('tpl');
	system::webset($tpl,true);
	show_message('操作成功','设置成功','?mod='.MODNAME.'&ac='.ACTNAME.'&op='.$op);
}
if ($op=='tplset'){
	$tpl=$tpls[$_webset['site_tpl']];
	//扩展模板设置项目
	$extend_tpl_set=get_extend_tpl_set();
}
/* End of file tpl.act.php */
/* Location: D:\website\taobaoke\jiu2\admin\mod\seting\tpl.act.php */
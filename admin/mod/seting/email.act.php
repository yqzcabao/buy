<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		D:\website\taobaoke\jiu2\admin\mod\seting\email.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @email.act.php
 * =================================================
*/
$ops=array('set','tpl');
$op=request('op','set',$ops);
if(submitcheck('emailset')){
	$email=request('email',array());
	system::webset($email);
	show_message('操作成功','设置成功','-1');
}
if($op=='tpl'){
	$tpl=request('email_tpl');
	$data=request($tpl);
	if(!empty($tpl) && !empty($data)){
		system::webset(array($tpl=>serialize($data)));
		show_message("操作成功",'模板设置成功','?mod='.MODNAME.'&ac='.ACTNAME.'&op=tpl&email_tpl='.$tpl);
	}
	$email_tpl=unserialize($_webset['email_tpl']);
	if(empty($tpl)){
		$bar = each($email_tpl);
		$tpl=$bar[0];
	}
	$tpl_value=unserialize($_webset[$tpl]);
	$tpl_value['variablearr']=explode(',',$tpl_value['variable']);
	foreach ($tpl_value['variablearr'] as $key=>$value){
		$tpl_value['variablearr'][$key]=explode('-',$value);
	}
}
/* End of file email.act.php */
/* Location: D:\website\taobaoke\jiu2\admin\mod\seting\email.act.php */
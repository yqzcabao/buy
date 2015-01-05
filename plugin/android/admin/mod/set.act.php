<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @author		bank
 * @link		http://www.wangyue.cc
 * @set.act.php
 * =================================================
*/
if(submitcheck('androidset')){
	$android=request('android',array());
	foreach ($android as $key=>$value){
		$android[$key]=trim($value);
	}
	system::webset($android,true);
	show_message('操作成功','设置成功','-1');
}
/* End of file set.act.php */
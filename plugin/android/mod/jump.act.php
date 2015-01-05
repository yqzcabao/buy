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
 * @jump.act.php
 * =================================================
*/
/*宝贝ID*/
$iid=request('iid',0);
if(empty($iid)){
	header('location:'.u('index','index'));
	exit();
}
$jump_url=goodUrl($iid);
$good_taoke=get_taoke($iid);
if(empty($good_taoke)){
	$jump_url='http://item.taobao.com/item.htm?id='.$iid;
}else{
	$jump_url=$good_taoke['click_url'];
	setUrl(array('iid'=>$iid,'urls'=>$jump_url));
}
header("location:".$jump_url);
exit();
/* End of file jump.act.php */
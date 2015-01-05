<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\wap\mod\jump.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @jump.act.php
 * =================================================
*/
$iid=request('iid',0);
if(empty($iid)){
	header('location:'.u('index','index'));
	exit();
}
$jump_url=goodUrl($iid);
if(empty($jump_url) || (!empty($jump_url) && 0<strpos( $jump_url, '&b=danpin_zhutu_up1'))){
	$rf=u(MODNAME,'jump',array('iid'=>$iid));
	$good_taoke=get_taoke($iid,$rf);
	if(empty($good_taoke)){
		$jump_url='http://item.taobao.com/item.htm?id='.$iid;
	}else{
		$jump_url=$good_taoke['click_url'];		
		setUrl(array('iid'=>$iid,'urls'=>$jump_url));
	}
}
header("location:".$jump_url);
exit();
/* End of file jump.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\wap\mod\jump.act.php */
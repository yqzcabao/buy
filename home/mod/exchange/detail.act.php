<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @detail.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}

$id=intval(request('id',0));
if(empty($id)){
	message('-1','提示',"兑换不存在",u('exchange','index'));
}

$exchange=getexc($id);
if(empty($exchange)){
	message('-1','提示',"兑换不存在",u('exchange','index'));
}
?>
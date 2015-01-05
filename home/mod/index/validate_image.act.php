<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @validate_image.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
$validate_image_config  =  array(
	'font_size'=>intval(request('f',18)),
	'img_height'=>intval(request('h',36)),
	'img_width'=>intval(request('w',100)),
	'use_boder'=>true,
	'filter_type'=>intval(request('t', 0))
);
if($validate_image_config['font_size']>30){
	$validate_image_config['font_size']=18;
}
if($validate_image_config['img_height']>50){
	$validate_image_config['img_height']=36;
}
if($validate_image_config['img_width']>200){
	$validate_image_config['img_width']=100;
}
echo_validate_image( $validate_image_config );

?>
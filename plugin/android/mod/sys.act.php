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
 * @sys.act.php
 * =================================================
*/
$ops=array('seting','recapp','ad','feed','dofeed','update');
$op=request('op','',$ops);

/*系统设置*/
if($op=='seting'){
	sys_seting();
}
/*推荐app*/
elseif ($op=='recapp'){
	get_sys_recapp();
}
/*广告api*/
elseif ($op=='ad'){
	get_sys_ad();
}
/*意见反馈列表*/
elseif ($op=='feed'){
	get_sys_feed();
}
/*意见反馈*/
elseif ($op=='dofeed'){
	get_sys_dofeed();
}
/*系统更新*/
elseif ($op=='update'){
	app_up();
}
exit();
/* End of file sys.act.php */
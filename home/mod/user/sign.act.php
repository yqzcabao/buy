<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @sign.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
if(empty($user['uid'])){
	message('-1','签到提示',"请登录",u('user','login'));
}
//判断是否已经签到
if($user['lastsign']>strtotime('today')){
	message('-1','签到提示',"今日已经签到",u('user','login'));
}
//获取当天签到所得积分
$integral=sign();
$integral['tomorrowsign']=getintegral("tomorrow");
message('0','签到提示',"签到成功积分+".$integral['integral'],u('user','login'),$integral);

?>
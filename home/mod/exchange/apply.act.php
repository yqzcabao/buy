<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @apply.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
$op=request('op');
if($op=='success'){
	message('0','申请提示','兑换申请成功，等待...',u('exchange','index'));
}
$successurl=u('exchange','apply',array('op'=>'success'));
//判断是那一部分
$id=intval(request('id',0));
if(empty($id)){
	message('-1','提示',"兑换不存在",u('exchange','index'));
}
//判断是否登录
if(empty($user['uid'])){
	message('-1','提示',"请登录",u('user','login',array('gourl'=>urlencode(get_cururl()))));
}
//判断是否设置了昵称
if(empty($user['user_name'])){
	message('-1','提示',"请设置昵称",u('user','base',array('gourl'=>urlencode(get_cururl()))));
}
//判断积分是否足够
$exchangeinfo=getexc($id);
if($user['integral']<$exchangeinfo['needintegral']){
	message('-1','提示','您当前'.INTEGRAL.'不足'.$exchangeinfo['needintegral'].INTEGRAL.'，赚取足够的'.INTEGRAL.'再来参加活动吧！您可以去看看','-1');
}
//判断有无未晒单记录
if($_webset['exchange_showinfo']==0){
	if(check_nosun('exchange')){
		message('-1','提示',"请您先把之前兑换晒单，再申请新的兑换",u('exchange','detail',array('id'=>$id)));
	}
}
$title=$exchangeinfo['title'];
$type='exchange';
//判断有没有填写地址
$address=useraddress($user['uid']);

?>
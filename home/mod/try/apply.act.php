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
	message('0','申请提示','试用申请成功，等待...',u('try','index'));
}
$successurl=u('try','apply',array('op'=>'success'));
//判断是那一部分
$id=intval(request('id',0));
if(empty($id)){
	message('-1','提示',"试用不存在",u('try','index'));
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
$tryinfo=tryinfo($id);
if($user['integral']<$tryinfo['needintegral']){
	message('-1','提示','您当前'.INTEGRAL.'不足'.$tryinfo['needintegral'].INTEGRAL.'，赚取足够的'.INTEGRAL.'再来参加活动吧！您可以去看看','-1');
}
//判断有无未晒单记录
if($_webset['try_showinfo']==0){
	if(check_nosun()){
		message('-1','提示',"请您先把之前试用申请晒单，再申请新的试用",u('try','detail',array('id'=>$id)));
	}
}
$title=$tryinfo['title'];
$type='try';
//判断有没有填写地址
$address=useraddress($user['uid']);

?>
<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\gift\lib\common.fun.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @common.fun.php
 * =================================================
*/
//积分兑换
function exc_apply($exc){
	global $user,$_timestamp;
	lib_database::wquery('update '.tname('exchange').' set `apply`=`apply`+1 where `id`='.$exc['id'].' and `num`>`apply` and `start`<'.$_timestamp.' and `end`>'.$_timestamp.' and needintegral<='.$user['integral']);
	$isok = mysql_affected_rows();
	if($isok){
		lib_database::wquery('update '.tname('users_home_session').' set `integral`=`integral`-'.$exc['needintegral'].' where `uid`='.$user['uid']);
		lib_database::wquery('update '.tname('users_home_fields').' set `integral`=`integral`-'.$exc['needintegral'].' where `uid`='.$user['uid']);
		//记录积分变化
		changelog(array('uid'=>$user['uid'],'integ'=>-abs($exc['needintegral']),'type'=>'exchange','exp'=>'兑换礼品['.$exc['title'].']'));
		$title=$exc['title'].$exc['remark'];
		applylogto(array('cid'=>'','id'=>$exc['id'],'idtype'=>'exchange','title'=>$title,'uid'=>$user['uid'],'user_name'=>$user['user_name'],'integration'=>$exc['needintegral'],'addtime'=>$_timestamp,'status'=>0));
		return true;
	}else{
		return false;
	}
}

/* End of file common.fun.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\gift\lib\common.fun.php */
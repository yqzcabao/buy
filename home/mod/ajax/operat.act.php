<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @operat.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
$op=request('op');
$jsonp_callback=request('callback','');

switch ($op){
	case 'status':
		break;
	case 'gather':
		gather();
		break;
	case 'brandgather':
		brandgather();
		break;
	//评论
	case 'comment':
		comment();
		break;
	//收藏
	case 'goodsfav':
		goodsfav();
		break;
	//图片上传
	case 'ajaxfile':
		ajaxfile();
		break;
	//晒单上传
	case 'ajaxsunpic':
		ajaxsunpic();
		break;
	//删除晒单图片
	case 'delsunpic':
		delsunpic();
		break;
	//设置头像
	case 'setavatar':
		setavatar();
		break;
	case 'delfav':
		delfav();
		break;
	case 'delgiftlog':
		delgiftlog();
		break;
	//举报
	case 'report':
		report();
		break;
	//抢光了
	case 'over':
		goodsover();
		break;
	default:
		echo $jsonp_callback.'({"code":-1,"msg":"操作失败"})';
}
exit();

?>
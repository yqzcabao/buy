<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\plugin\qzone\mod\ajax.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @ajax.act.php
 * =================================================
*/
$op=request('op');
$jsonp_callback=request('callback','');
switch ($op){
	//签到
	case 'sign':
		if(empty($user['uid'])){
			echo json_encode(array('code'=>-2,'msg'=>'请登录'));
			exit();
		}
		//判断是否已经签到
		if($user['lastsign']>strtotime('today')){
			echo json_encode(array('code'=>-3,'msg'=>'今日已经签到'));
			exit();
		}
		//获取当天签到所得积分
		$integral=qzone_sign();
		echo json_encode(array('code'=>0,'msg'=>'签到成功','integral'=>$integral['integral'],'user_integral'=>$user['integral']+$integral['integral']));
		break;
		//是否添加到主面板
	case 'hadeaddwidget':
		if(empty($user['uid'])){
			echo json_encode(array('code'=>-2,'msg'=>'请登录'));
		}
		//检测
		$addwidget=check_add_widget($sdk, $openid, $openkey, $platform);
		if($addwidget['ret']==0){
			if($addwidget['in_applist']==1){
				if(empty($user['addwidget'])){
					lib_database::update('users_qzone_fields',array('addwidget'=>1),'uid='.$user['uid']);
					lib_database::update('users_qzone_session',array('addwidget'=>1),'uid='.$user['uid']);
					//添加积分
					$reward_qzone_add_widget=intval($_webset['reward_qzone_add_widget']);
					if(!empty($reward_qzone_add_widget)){
						lib_database::wquery('updete '.tname('users_qzone_fields').' set `sign`=`sign`+'.$reward_qzone_add_widget.' where uid='.$user['uid']);
						lib_database::wquery('updete '.tname('users_qzone_session').' set `sign`=`sign`+'.$reward_qzone_add_widget.' where uid='.$user['uid']);
					}
				}
				echo json_encode(array('code'=>0));
			}else{
				echo json_encode(array('code'=>-1,'msg'=>$addwidget['msg']));
			}
		}else{
			echo json_encode(array('code'=>-1,'msg'=>$addwidget['msg']));
		}
		break;
}
exit();
/* End of file ajax.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\plugin\qzone\mod\ajax.act.php */
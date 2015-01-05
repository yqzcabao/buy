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
 * @admin.fun.php
 * =================================================
*/
require PATH_PLUGIN.'lib/list.fun.php';
/*****************系统推送消息****************************************************************************/
function push($content,$title='',$type=2,$url=''){
	global $_webset,$_timestamp;
	//参数
	$data=array('sendno'=>$_timestamp,'app_key'=>$_webset['android_push_appkey'],'receiver_type'=>4,'receiver_value'=>'');
	//加密处理
	$input =$data['sendno'].$data['receiver_type'] . $data['receiver_value'] . $_webset['android_push_secret'];
	$data['verification_code'] = md5($input);
	//其他参数
	//１、通知 ２、自定义消息（只有 Android 支持）
	$data['msg_type']=$type;
	//消息内容
	$data['msg_content']='{"n_title":"'.$title.'","n_content":"'.$content.'", "n_extras":{"type":"'.$type.'", "url":"'.$url.'"}}';
	//$data['send_description']='描述一下测试';
	$data['platform']='android';
	$data['apns_production']=1;
	//离线时间
	$data['time_to_live']=3600*24*3;
	//post提交
	$returndata=curl('http://api.jpush.cn:8800/v2/push',$data);
	//处理返回
	$returndata=json_decode($returndata,true);
	if($returndata['errcode']==200){
		return true;
	}else{
		return $returndata['errmsg'];
	}
}
/*****************后台数据添加****************************************************************************/
function add_nav($nav){
	if(!empty($nav['nid'])){
		$nid=intval($nav['nid']);
		unset($nav['nid']);
		lib_database::update('android_nav',$nav,'nid='.$nid);
	}else{
		lib_database::insert('android_nav',array_keys($nav),$nav);
	}
	del_cache('plugin','android_nav');
}
//频道详细
function get_nav_info($nid){
	$nav=lib_database::get_one('select `nid`,`title`,`type`,`img`,`imghover`,`home`,`nav`,`nid`,`sort` from '.tname('android_nav').' where nid='.$nid);
	!empty($nav) && $nav['nav']=explode('|',$nav['nav']);
	return $nav;
}
//删除频道
function nav_del($nid){
	if(!is_array($nid)){
		$nid[]=$nid;
	}
	if(!empty($nid) && is_array($nid)){
		foreach ($nid as $nav){
			lib_database::delete('android_nav','nid='.$nav);
		}
	}
	del_cache('plugin','android_nav');
}
/*****************************安卓广告设置*********************************/
function android_ad_add($ad){
	if(!empty($ad['aid'])){
		$aid=intval($ad['aid']);
		unset($ad['aid']);
		lib_database::update('android_ad',$ad,'aid='.$aid);
	}else{
		lib_database::insert('android_ad',array_keys($ad),$ad);
	}
	del_cache('plugin','android_ad');
}
//删除广告
function android_ad_del($aid){
	if(!is_array($aid)){
		$aid[]=$aid;
	}
	if(!empty($aid) && is_array($aid)){
		foreach ($aid as $ad){
			lib_database::delete('android_ad','aid='.$ad);
		}
	}
	del_cache('plugin','android_ad');
}
/*****************************推荐app*********************************/
function android_app_add($app){
	if(!empty($app['aid'])){
		$aid=intval($app['aid']);
		unset($app['aid']);
		lib_database::update('android_app',$app,'aid='.$aid);
	}else{
		lib_database::insert('android_app',array_keys($app),$app);
	}
	del_cache('plugin','android_app');
}
//删除广告
function android_app_del($aid){
	if(!is_array($aid)){
		$aid[]=$aid;
	}
	if(!empty($aid) && is_array($aid)){
		foreach ($aid as $ad){
			lib_database::delete('android_app','aid='.$ad);
		}
	}
	del_cache('plugin','android_app');
}
/* End of file admin.fun.php */
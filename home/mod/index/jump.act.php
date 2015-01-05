<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @jump.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
//参数
$iid=request('iid',0);
$op=request('op','');
$click_url=request('click_url');
//爱淘宝
if(empty($iid)){
	header('location:'.u('index','index'));
	exit();
}
preg_match('/pid:\s+\"(.*?)\"/',$_webset['taoke_dianjin'],$pid);
$pid=$pid[1];
$pgid=md5($iid);
//固定设置
$taoke_jumptype=intval($_webset['taoke_jump']);
//判断是否猎豹浏览器
if(strpos($_SERVER['HTTP_USER_AGENT'], 'LBBROWSER')){
	$taoke_jumptype=0;
}
//获取直接跳转地址
if($op=='redirect' && $_isajax ){
	//获取并保存
	$code=0;
	//调用信息
	if($taoke_jumptype==1){
		$jump_url=get_ai_tao($click_url);
	}else{
		$jump_url=$click_url;
	}
	if(!empty($jump_url)){
		//处理链接
		$jump_url=str_replace( "&amp;", "&", $jump_url );
		//保存地址
		setUrl(array('iid'=>$iid,'urls'=>$jump_url));
		if($taoke_jumptype==1){$code=1;}
	}
	echo json_encode(array('code'=>$code));
	exit();
}else{
	$jump_url=goodUrl($iid);
	if(!empty($jump_url) && (($taoke_jumptype==1 && 0<strpos( $jump_url, '&b=danpin_zhutu_up1')) || ($taoke_jumptype!=1 && false==strpos( $jump_url, '&b=danpin_zhutu_up1')))){
		go_ai_taobao($jump_url);
	}else{
		if($taoke_jumptype==1 && false==strpos( $jump_url, '&b=danpin_zhutu_up1') && 0<strpos( $jump_url, 'redirect.simba.taobao.com')){
			$jump_url=get_ai_tao($jump_url);
			if(!empty($jump_url)){
				//处理链接
				$jump_url=str_replace( "&amp;", "&", $jump_url );
				//保存地址
				setUrl(array('iid'=>$iid,'urls'=>$jump_url));
			}
			go_ai_taobao($jump_url);
		}
	}
}
?>
<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\album\lib\common.fun.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @common.fun.php
 * =================================================
*/
function save_album($album){
	global $_timestamp;
	$album['addtime']=$_timestamp;
	$album['group']=serialize($album['group']);
	if(!empty($album['aid'])){
		$aid=$album['aid'];
		unset($album['aid']);
		lib_database::update('album',$album,'aid='.$aid);
	}else{
		lib_database::insert('album',array_keys($album),$album);
	}
	//删除缓存
	del_cache('album','index');
}

/**
 * 专题列表
 *
 */
function get_album(){
	$album_list=array();
	lib_database::query('select * from '.tname('album'));
	while ($val=lib_database::fetch_one()){
		$val['group']=unserialize($val['group']);
		$album_list[$val['aid']]=$val;
	}
	return $album_list;
}


function get_album_info($aid){
	$album=lib_database::get_one('select * from '.tname('album').' where aid='.$aid);
	$album['group']=unserialize($album['group']);
	return $album;
}
/**
 * 获取模板列表
 *
 */
function get_album_tpl(){
	$path=substr(dirname(__FILE__), 0, -3);
	$tpl=array();
	//读取模板
	$tpl_arr=getDir($path.'template/');
	foreach ($tpl_arr as $k=>$val){
		require $path.'/template/'.$val.'/config.tpl';
	}
	return $tpl;
}
/**
 * 获取专题宝贝
 *
 */
function get_album_goods($aid){
	global $tpl;//模板配置
	$data=array();
	$query = lib_database::rquery('select * from '.tname('goods').' where aid='.$aid.' order by `sort` DESC');
	while ($rt = lib_database::fetch_one())
	{
		if($tpl[ALBUM_TPL]['group']){
			$rt['gid']=intval($rt['gid']);
			$data[$rt['gid']][] = $rt;
		}else{
			$data[] = $rt;
		}
	}
	return $data;
}
/**
 * 首页显示的专题
 *
 * @return unknown
 */
function get_index_album(){
	$data=array();
	$data=get_cache('album','index');
	if(empty($data)){
		$query = lib_database::rquery('select * from '.tname('album').' where index_show=1');
		while ($rt = lib_database::fetch_one())
		{
			$data['album'][] = $rt;
		}
		$data['num']=count($data['album']);
		set_cache('album','index',$data);
	}
	return $data;
}
/* End of file common.fun.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\album\lib\common.fun.php */
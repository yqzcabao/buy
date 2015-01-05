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
 * @list.fun.php
 * =================================================
*/
//频道列表
function get_nav_add(){
	$nav=get_cache('plugin','android_nav');
	if(empty($nav)){
		lib_database::rquery('select `nid`,`title`,`type`,`img`,`imghover`,`home`,`nav`,`nid`,`sort` from '.tname('android_nav').' order by `sort` DESC');
		while ($value=lib_database::fetch_one()){
			$value['nav']=explode('|',$value['nav']);
			$nav[$value['nid']]=$value;
		}
		set_cache('plugin','android_nav',$nav);
	}
	return $nav;
}
//安卓广告列表
function get_android_ad(){
	$ad=get_cache('plugin','android_ad');
	if(empty($ad)){
		lib_database::rquery('select `aid`,`title`,`img`,`href`,`sort` from '.tname('android_ad').' order by `sort` DESC');
		while ($value=lib_database::fetch_one()){
			$ad[]=$value;
		}
		set_cache('plugin','android_ad',$ad);
	}
	return $ad;
}
///推荐APP
function get_android_app(){
	$app=get_cache('plugin','android_app');
	if(empty($app)){
		lib_database::rquery('select `aid`,`title`,`intro`,`img`,`href`,`sort` from '.tname('android_app').' order by `sort` DESC');
		while ($value=lib_database::fetch_one()){
			$app[]=$value;
		}
		set_cache('plugin','android_app',$app);
	}
	return $app;
}
/* End of file list.fun.php */
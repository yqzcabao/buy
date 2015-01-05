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
 * @common.fun.php
 * =================================================
*/
/**
 * 保存设置专场
 *
 * @param unknown_type $special
 */
function save_special($special){
	global $_timestamp;
	$special['addtime']=$_timestamp;
	if(!empty($special['endtime'])){
		$special['endtime']=strtotime($special['endtime']);
	}
	//添加展位
	$position=explode("\n",$special['position']);
	$_data=$tag='';
	$sid='$sid';
	foreach ($position as $key=>$val){
		if(!empty($val)){
			$val=explode('|',$val);
			//验证
			if(empty($val[0]) || floatval($val[1])<0){
				return false;
			}
			if(intval($val[2])<=0){
				continue;
			}
			array_unshift($val,$key);
			$val[3]=abs($val[3]);
			$val[4]=abs(isset($val[4])?$val[4]:$val[3]);
			$val[5]=$sid;
			$_data .=$tag."('".$val[0]."','".$val[1]."', '".$val[2]."', '".$val[3]."', '".$val[4]."', '$sid')";
			$tag=',';
		}
	}
	unset($special['position']);
	if(!empty($special['sid'])){
		$sid=$special['sid'];
		unset($special['sid']);
		lib_database::update('special',$special,'sid='.$sid);
		lib_database::delete('special_position','sid='.$sid);
	}else{
		lib_database::insert('special',array_keys($special),$special);
		$sid=lib_database::insert_id();
	}
	$_fields= '`pid`,`name`,`price`,`num`,`remain`,`sid`';
	lib_database::wquery('insert into '.tname('special_position').'('.$_fields.') VALUES '.str_replace('$sid',$sid,$_data));
	return true;
}
/**
 * 专场列表
 *
 * @return unknown
 */
function get_special(){
	$special_list=array();
	lib_database::query('select * from '.tname('special'));
	while ($val=lib_database::fetch_one()){
		$special_list[$val['sid']]=$val;
	}
	return $special_list;
}

/**
 * 获取专场详细
 *
 * @param unknown_type $sid
 * @return unknown
 */
function get_special_info($sid){
	$special=lib_database::get_one('select * from '.tname('special').' where sid='.$sid);
	lib_database::rquery('select * from '.tname('special_position').' where sid='.$sid.' order by pid ASC');
	while ($position=lib_database::fetch_one()){
		$special['position'][$position['pid']]=$position;
	}
	return $special;
}

/**
 * 展位信息
 *
 */
function get_special_position(){
	$special_position=array();
	//展位信息
	lib_database::rquery('select * from '.tname('special_position'));
	while ($position=lib_database::fetch_one()){
		$num+=intval($position['num']);
		$remain+=intval($position['remain']);
		$special_position[$position['pid']]=$position;
	}
	return $special_position;
}
/* End of file common.fun.php */
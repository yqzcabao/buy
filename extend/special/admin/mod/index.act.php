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
 * @index.act.php
 * =================================================
*/
require PATH_EXTEND.'/lib/common.fun.php';
$ops=array('list','add');
$op=request('op','list',$ops);
if($op=='list'){
	$special_list=get_special();
}elseif ($op=='add'){
	if(submitcheck('specialadd')){
		$special=request('special',array());
		if(empty($special['title'])){
			show_message('添加失败','请填写专场名称',-1);
		}
		if(empty($special['endtime'])){
			show_message('添加失败','请填写结束时间',-1);
		}
		if(save_special($special)){
			show_message('添加成功','专场添加成功',$_extend_url.'&pmod=index');
		}else{
			show_message('添加失败','请检查展位格式',-1);
		}
	}else{
		$special=array();
		$sid=intval(request('sid',0));
		if(!empty($sid)){
			$special=get_special_info($sid);
		}
	}
}
/* End of file index.act.php */
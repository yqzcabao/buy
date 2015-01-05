<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\admin\mod\merchant\help.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @help.act.php
 * =================================================
*/
require PATH_EXTEND.'/lib/common.fun.php';
$ops=array('list','add');
$op=request('op','list',$ops);
//报名指南
if($op=='list'){
	$guide_list=get_guide_list();
}
//添加指南
elseif ($op=='add'){
	if(submitcheck('guide_form')){
		$guide=request('guide',array());
		if(empty($guide['title'])){
			show_message('添加失败','请填写文章标题',-1);
		}
		if(!empty($guide)){
			save_guide($guide);
			show_message('添加成功','文章添加成功',$_extend_url.'&pmod=help');
		}
	}else{
		$gid=request('gid',0);
		$guide=get_guide($gid);
	}
}

/* End of file help.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\admin\mod\merchant\help.act.php */
<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\album\admin\mod\index.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @index.act.php
 * =================================================
*/
require PATH_EXTEND.'/lib/common.fun.php';
$ops=array('list','add');
$op=request('op','list',$ops);
if($op=='list'){
	$album_list=get_album();
}elseif ($op=='add'){
	if(submitcheck('albumadd')){
		$album=request('album',array());
		if(empty($album['title'])){
			show_message('添加失败','请填写标题',-1);
		}
		if(empty($album['tpl'])){
			show_message('添加失败','请选择模板',-1);
		}
		if(!empty($album)){
			save_album($album);
			show_message('添加成功','专题添加成功',$_extend_url.'&pmod=index');
		}
	}else{
		$album=array();
		$aid=intval(request('aid',0));
		if(!empty($aid)){
			$album=get_album_info($aid);
		}
		//模板列表
		$tpl=get_album_tpl();
	}
}
/* End of file index.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\album\admin\mod\index.act.php */
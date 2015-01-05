<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		D:\website\taobaoke\jiu2\admin\mod\data\goodsgather.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @goodsgather.act.php
 * =================================================
*/
$ops=array('list','addtask','do');
$op=request('op','list',$ops);

//导航频道
$goodnav=navList();
//系统分类
$catlist=getgoodscat();
if($op=='list'){
	$tasklist=tasklist();
}elseif ($op=='addtask'){
	//添加采集规则
	$task=request('task');
	if(!empty($task)){
		addgather($task);
		show_message('操作成功','添加规则成功','?mod='.MODNAME.'&ac='.ACTNAME);
	}else{
		$tid=request('tid');
		$task=array();
		if(!empty($tid)){
			$task=gettask($tid);
			$task=$task[0];
		}
	}
}
//采集
elseif ($op=='do'){
	$tid=request('tid');
	$task=gettask($tid);
}
/* End of file goodsgather.act.php */
/* Location: D:\website\taobaoke\jiu2\admin\mod\data\goodsgather.act.php */
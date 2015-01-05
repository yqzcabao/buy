<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\admin\mod\seller\activity.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @activity.act.php
 * =================================================
*/
require PATH_EXTEND.'/lib/common.fun.php';
$ops=array('list','add');
$op=request('op','list',$ops);
//活动
$apply_type=get_apply_type();
if($op=='list'){
	$activity_list=get_activity();
}elseif ($op=='add'){
	if(submitcheck('activityadd')){
		$activity=request('activity',array());
		//判断此类型是否已存在
		$type=$activity['type'];
		if(check_type_hade($type) && empty($activity['aid'])){
			show_message('系统提示','活动类型的活动已经存在',-1);
		}
		list($activity['type'], $activity['tid']) =explode('_',$type);
		//处理付费
		$activity['pay']=intval($activity['pay']);
		$activity['free']=intval($activity['free']);
		if($activity['pay']==1){
			$activity['paydetail']=serialize($activity['paydetail']);
		}else{
			unset($activity['paydetail']);
		}
		$aid=save_activity($activity);
		show_message('系统提示','活动保存成功',$_extend_url.'&pmod=activity&op=add&aid='.$aid);
	}else{
		$activity=array();
		$aid=intval(request('aid',0));
		if(!empty($aid)){
			$activity=get_activity_info($aid);
		}
	}
}
/* End of file activity.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\admin\mod\seller\activity.act.php */
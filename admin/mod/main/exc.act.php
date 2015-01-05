<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		D:\website\taobaoke\jiu2\admin\mod\main\exc.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @exc.act.php
 * =================================================
*/
$ops=array('set','list','add');
$op=request('op','list',$ops);
//兑换设置
if($op=='set'){
	if(submitcheck('excset')){
		$exc=request('exc',array());
		system::webset($exc);
		show_message('操作成功','设置成功','-1');
	}
}
//试用
elseif ($op=='list'){
	$start = intval(request('start',0));
	$result=exclist(array('status=1'),'`start` ASC',$start,30);
	$trylist=array();
	if (!empty($result))
	{
		$page_url='?mod=exchange&ac='.request('ac').'&'.$result['url'];
		$pages=get_page_number_list($result['total'], $start, 30);
		$exclist=$result['data'];
	}
}
//试用添加
elseif ($op=='add'){
	$exc=request('exc',array());
	$id=request('id','');
	if(!empty($exc)){
		if(empty($exc['title'])){
			show_message('系统提示','请填写兑换名称',-1);
		}
		/*
		if(empty($exc['num_iid'])){
			show_message('系统提示','请填写宝贝ID',-1);
		}
		*/
		if(empty($exc['pic'])){
			show_message('系统提示','请上传宝贝图片',-1);
		}
		if(empty($exc['price'])){
			show_message('系统提示','请填写宝贝价格',-1);
		}
		if(empty($exc['num'])){
			show_message('系统提示','请填写提供兑换的数量',-1);
		}
		if(empty($exc['needintegral'])){
			show_message('系统提示','请填写提供兑换所需积分',-1);
		}		
		//处理时间，验证时间
		$exc['start']=strtotime($exc['start']);
		$exc['end']=strtotime($exc['end']);
		if($exc['end']<=$exc['start'] || $exc['end']<$_timestamp){
			show_message('操作错误','活动时间有误',"-1");
		}
		//判断有没有
		if(!empty($exc['num_iid']) && excCheck($exc['num_iid']) && empty($exc['id'])){
			show_message('操作失败','宝贝已经存在',"-1");
		}
		$exc['status']=1;
		//保存
		excadd($exc);
		$gourl=request('gourl','?mod=main&ac=exc');
		show_message('操作成功','操作成功',$gourl);
	}
	if(!empty($id)){
		$exc=getexc($id);
	}
}
/* End of file exc.act.php */
/* Location: D:\website\taobaoke\jiu2\admin\mod\main\exc.act.php */
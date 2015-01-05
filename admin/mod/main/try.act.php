<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		D:\website\taobaoke\jiu2\admin\mod\main\try.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @try.act.php
 * =================================================
*/
$ops=array('set','list','add');
$op=request('op','list',$ops);
//试用设置
if($op=='set'){
	if(submitcheck('tryset')){
		$try=request('try',array());
		system::webset($try);
		show_message('操作成功','设置成功','-1');
	}
}
//试用
elseif ($op=='list'){
	$start = intval(request('start',0));
	$result=trylist(array('status=1'),'`start` ASC',$start,30);
	$trylist=array();
	if (!empty($result))
	{
		$page_url='?mod=try&ac='.request('ac').'&'.$result['url'];
		$pages=get_page_number_list($result['total'], $start, 30);
		$trylist=$result['data'];
	}
}
//试用添加
elseif ($op=='add'){
	$try=request('try',array());
	$id=request('id','');
	if(!empty($try)){
		if(empty($try['title'])){
			show_message('系统提示','请填写试用名称',-1);
		}
		if(empty($try['num_iid'])){
			show_message('系统提示','请填写宝贝ID',-1);
		}
		if(empty($try['pic'])){
			show_message('系统提示','请上传宝贝图片',-1);
		}
		if(empty($try['price'])){
			show_message('系统提示','请填写宝贝价格',-1);
		}
		if(empty($try['num'])){
			show_message('系统提示','请填写提供试用的数量',-1);
		}
		if(intval($try['needintegral'])<0){
			show_message('系统提示','试用所需积分必须大于0',-1);
		}		
		//处理时间，验证时间
		$try['start']=strtotime($try['start']);
		$try['end']=strtotime($try['end']);
		if($try['end']<=$try['start']){
			show_message('操作错误','活动时间有误',"-1");
		}
		//判断有没有
		if(tryCheck($try['num_iid']) && empty($try['id'])){
			show_message('操作失败','宝贝已经存在',"-1");
		}
		//保存
		$try['status']=1;
		tryadd($try);
		$gourl=request('gourl','?mod=main&ac=try');
		show_message('操作成功','操作成功',$gourl);
	}
	if(!empty($id)){
		$try=gettry($id);
	}
}
/* End of file try.act.php */
/* Location: D:\website\taobaoke\jiu2\admin\mod\main\try.act.php */
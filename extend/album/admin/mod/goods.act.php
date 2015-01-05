<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\album\admin\mod\goods.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @goods.act.php
 * =================================================
*/
require PATH_EXTEND.'/lib/common.fun.php';
$ops=array('add','over','list');
$op=request('op','list',$ops);
//宝贝分类
$catlist=getgoodscat();
//专题
$album_list=get_album();
//商品列表
if($op=='list'){
	$start = intval(request('start',0));
	$result=goodslist(array('status=1','aid!=0'),'',$start,30);
	$goodslist=array();
	if (!empty($result))
	{
		$page_url='?mod='.MODNAME.'&ac='.ACTNAME.'&op='.$op.'&'.$result['url'];
		$pages=get_page_number_list($result['total'], $start, 30);
		$goodslist=$result['data'];
	}
}
//添加代码
elseif ($op=='add'){
	$good=request('good',array());
	$id=request('id','');
	if(!empty($good)){
		if(empty($good['title'])){
			show_message('系统提示','请填写宝贝名称',-1);
		}
		if(empty($good['num_iid'])){
			show_message('系统提示','请填写宝贝ID',-1);
		}
		if(empty($good['pic']) && empty($good['taopic'])){
			show_message('系统提示','请上传宝贝图片',-1);
		}
		if(empty($good['pic']) && !empty($good['taopic'])){
			$good['pic']=$good['taopic'];
		}
		if(empty($good['price'])){
			show_message('系统提示','请填写宝贝价格',-1);
		}
		if(empty($good['promotion_price'])){
			show_message('系统提示','请填写宝贝促销价格',-1);
		}
		if(empty($good['nick'])){
			show_message('系统提示','请填写买家昵称',-1);
		}
		//处理时间，验证时间
		$good['start']=strtotime($good['start']);
		$good['end']=strtotime($good['end']);
		if($good['end']<=$good['start']){
			show_message('系统提示','活动时间有误',"-1");
		}
		//判断有没有
		if(goodCheck($good['num_iid']) && empty($good['id'])){
			show_message('系统提示','宝贝已经存在',"-1");
		}
		//计算折扣
		$good['discount']=sprintf("%.2f",$good['promotion_price']/$good['price'])*10;
		//保存
		$good['status']=1;
		goodAdd($good);
		//删除专题缓存
		del_cache('album','index');
		show_message('操作成功','操作成功',$_extend_url.'&pmod=goods');
	}
	if(!empty($id)){
		$good=getgood($id);
	}
}
/* End of file goods.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\album\admin\mod\goods.act.php */
<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		D:\website\taobaoke\jiu2\admin\mod\advertise\slides.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @slides.act.php
 * =================================================
*/
$ops=array('list','sAdd');
$op=request('op','list',$ops);

if($op=='sAdd'){
	if(submitcheck('slidesAdd')){
		$slides=request('slides',array());
		if(!empty($slides)){
			$slides['start']=strtotime($slides['start']);
			$slides['end']=strtotime($slides['end']);
			$slides['type']=1;
			system::adset($slides);
			show_message('首页幻灯','广告添加成功','?mod='.MODNAME.'&ac='.ACTNAME);
		}
	}else{
		$id=request('id');
		if(!empty($id)){
			$slides=$_ad['ad_1'][$id];
		}
	}
}
/* End of file slides.act.php */
/* Location: D:\website\taobaoke\jiu2\admin\mod\advertise\slides.act.php */
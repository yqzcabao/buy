<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		D:\website\taobaoke\jiu2\admin\mod\seting\nav.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @nav.act.php
 * =================================================
*/
$ops=array('navlist','navadd');
$op=request('op','navlist',$ops);
//导航列表
if($op=='navlist'){
	
}
elseif ($op=='navadd'){
	if(submitcheck('navadd')){
		$nav=request('nav',array());
		if(!empty($nav)){
			if(!empty($nav['url'])){
				if(empty($nav['name'])){
					show_message('操作失败','请填写导航名称',-1);
				}
			}elseif(empty($nav['name']) || empty($nav['mod']) || empty($nav['ac']) || empty($nav['tag'])){
				show_message('操作失败','导航名，模型，行为，短标示不能为空','-1');
			}
			system::navset($nav);
			show_message('操作成功','导航添加成功','?mod='.MODNAME.'&ac='.ACTNAME);
		}
	}else{
		$id=request('id');
		$nav=$_nav[$id];
	}
}
/* End of file nav.act.php */
/* Location: D:\website\taobaoke\jiu2\admin\mod\seting\nav.act.php */
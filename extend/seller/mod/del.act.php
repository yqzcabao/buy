<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\seller\mod\del.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @del.act.php
 * =================================================
*/
//删除处理
$type=request('type','',array('goods','album','try','exchange'));
$id=request('id',0);
if(empty($type) || empty($id)){
	extend_message(0,'系统提示','操作错误！');
}
if($type=='goods' || $type=='album'){
	del_goods($id);
	extend_message(0,'系统提示','删除成功！',u(MODNAME,'manage',array('op'=>$type)));
}
//删除试用
elseif ($type=='try'){
	del_try($id);
	extend_message(0,'系统提示','删除成功！',u(MODNAME,'manage',array('op'=>$type)));
}
elseif ($type=='exchange'){
	del_exc($id);
	extend_message(0,'系统提示','删除成功！',u(MODNAME,'manage',array('op'=>$type)));
}

/* End of file del.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\seller\mod\del.act.php */
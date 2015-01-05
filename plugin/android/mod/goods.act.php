<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @author		bank
 * @link		http://www.wangyue.cc
 * @goods.act.php
 * =================================================
*/
$ops=array('cat','channel','list','detail');
$op=request('op','',$ops);

if($op=='cat'){
	get_app_cat();
}
/*频道*/
elseif ($op=='channel'){
	get_app_channel();
}
/*宝贝列表*/
elseif ($op=='list'){
	get_app_goods();
}
/*宝贝详细页*/
elseif ($op=='detail'){
	get_goods_detail();
}
/* End of file goods.act.php */
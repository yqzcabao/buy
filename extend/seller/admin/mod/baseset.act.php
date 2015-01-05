<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\admin\mod\merchant\baseset.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @baseset.act.php
 * =================================================
*/
if(submitcheck('baseset')){
	$base=request('base',array());
	$base['extend_seller_auditrecharge']=intval($base['extend_seller_auditrecharge']);
	$base['extend_seller_apirecharge']=intval($base['extend_seller_apirecharge']);
	if(empty($base['extend_seller_auditrecharge']) && empty($base['extend_seller_apirecharge'])){
		show_message('操作成功','审核充值和支付宝充值请至少启用一种','-1');
	}
	system::webset($base,true);
	show_message('操作成功','设置成功','-1');
}
/* End of file baseset.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\admin\mod\merchant\baseset.act.php */
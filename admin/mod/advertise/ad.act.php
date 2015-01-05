<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		D:\website\taobaoke\jiu2\admin\mod\advertise\ad.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @ad.act.php
 * =================================================
*/
$ops=array('adList','adAdd');
$op=request('op','adList',$ops);
if ($op=='adAdd'){
	if(submitcheck('addad')){
		$ad=request('ad',array());
		if(!empty($ad)){
			$ad['start']=strtotime($ad['start']);
			$ad['end']=strtotime($ad['end']);
			system::adset($ad);
			show_message('广告管理','广告添加成功','?mod='.MODNAME.'&ac='.ACTNAME);
		}
	}else{
		$id=request('id');
		if(!empty($id)){
			$ad=$_ad['ad_0'][$id];
		}
	}
}
/* End of file ad.act.php */
/* Location: D:\website\taobaoke\jiu2\admin\mod\advertise\ad.act.php */
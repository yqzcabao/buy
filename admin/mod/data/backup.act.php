<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		D:\website\taobaoke\jiu2\admin\mod\data\backup.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @backup.act.php
 * =================================================
*/
$ops=array('list','regain','optimiza');
$op=request('op','list',$ops);
//备份
if($op=='list'){
	$step=request('step','1');
	if ($step==2){
		require PATH_LIBRARY.'/comm/lib_dbbackup.php';
		$dbbackup = new dbbackup ($GLOBALS['config']['db_host']['master'],$GLOBALS['config']['db_user'], $GLOBALS['config']['db_pass'],$GLOBALS['config']['db_name'],$GLOBALS['config']['db_charset']);
	}
//数据恢复
}elseif ($op=='regain'){
	$step=request('step','1');
	$backup=getbackup();
	if ($step==2){
		require PATH_LIBRARY.'/comm/lib_dbbackup.php';
		$dbbackup = new dbbackup ($GLOBALS['config']['db_host']['master'],$GLOBALS['config']['db_user'], $GLOBALS['config']['db_pass'],$GLOBALS['config']['db_name'],$GLOBALS['config']['db_charset']);
		$idkey=request('idkey');
		if(!empty($idkey)){
			foreach ($backup[$idkey] as $val){
				$backuparr[]=PATH_DATA.'/backup/'.$val;
			}
		}
	}
//优化
}elseif ($op=='optimiza'){
	$optimizetables=request('optimizetables',array());
	//修复
	if(!empty($optimizetables)){
		optimizet($optimizetables);
		show_message("数据库修复","数据库修复成功","-1");
	}
	$silentlist=getyablestatus();
}
/* End of file backup.act.php */
/* Location: D:\website\taobaoke\jiu2\admin\mod\data\backup.act.php */
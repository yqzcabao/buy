<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\admin\mod\plugin\myself.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @myself.act.php
 * =================================================
*/
$ops=array('list','enable','disable','config','upgrade','delete','import','download');
$op=request('op','list',$ops);

if($op=='list'){
	lib_database::rquery('select * from '.tname('plugin'));
	$plugins=lib_database::fetch_all();
	//检测是否又升级debug
	$pluginlist=array();
	foreach ($plugins as $key=>$plugin){ 
		$plugins[]=$plugin['identifier'];
		$plugin['modules']=dunserialize($plugin['modules']);
		//验证盗版debug
		$submenuitem=array();
		// 插件变量debug
		//后台菜单显示
		if(is_array($plugin['modules'])) {
			foreach($plugin['modules'] as $k => $module) {
				if($module['type'] == 3) {
					$submenuitem[$module['displayorder']] = $module;
				}
			}
		}
		$order = $plugin['available'] ? 'open' : 'close';
		$pluginlist[$order][$plugin['pluginid']]=$plugin;
	}
	ksort($pluginlist);
	//未安装应用
	$plugindir=PATH_ROOT.'plugin';
	$pluginsdir=dir($plugindir);
	$newplugin=array();
	while ($entry=$pluginsdir->read()){
		if(!in_array($entry, array('.', '..')) && is_dir($plugindir.'/'.$entry) && !in_array($entry, $plugins)) {
			$entrydir = PATH_ROOT.'plugin/'.$entry;
			$d = dir($entrydir);
			$filemtime = filemtime($entrydir);
			$entrytitle = $entry;
			$entryversion = $entrycopyright = $importtxt = '';
			if(file_exists($entrydir.'/plugin_'.$entry.'.xml')) {
				$importtxt = @implode('', file($entrydir.'/plugin_'.$entry.'.xml'));
			}
			if($importtxt) {
				$pluginarray = getimportdata($importtxt,'XuanYu! Plugin', 0, 1);
				if(!empty($pluginarray['plugin']['name'])) {
					$entrytitle = dhtmlspecialchars($pluginarray['plugin']['name']);
					$entryversion = dhtmlspecialchars($pluginarray['plugin']['version']);
					$entrycopyright = dhtmlspecialchars($pluginarray['plugin']['copyright']);
					$newplugin[]=array('name'=>$entrytitle,'version'=>$entryversion,'copyright'=>$entrycopyright,'identifier'=>$entry);
				}
			}
		}
	}
}
//启用
elseif ($op=='enable'){
	$pid=intval(request('pid',0));
	lib_database::update('plugin',array('available'=>1),'pluginid='.$pid);
	show_message('系统提示','插件已经开启','?mod='.MODNAME.'&ac='.ACTNAME);
}
//关闭
elseif ($op=='disable'){
	$pid=intval(request('pid',0));
	lib_database::update('plugin',array('available'=>0),'pluginid='.$pid);
	show_message('系统提示','插件关闭成功','?mod='.MODNAME.'&ac='.ACTNAME);
}
/* End of file myself.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\admin\mod\plugin\myself.act.php */
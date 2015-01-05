<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @info.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
$id=request('id');
$cid=request('cid');
if(empty($id) && !empty($cid)){
	$helparticle=gethelp();
	reset($helparticle[$cid]);
	$article=current($helparticle[$cid]);
}else{
	$article=getarticle($id);
}
if(empty($article)){
	message('-1','操作错误','文章不存在',u(MODNAME,'index'));
}else{
	//文章简单内容
	$article['summary']=utf8_substr(str_replace(array("\n","\t","\s"),"",strip_tags($article['content'])),100);
}
?>
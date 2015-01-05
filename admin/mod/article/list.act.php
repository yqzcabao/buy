<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @list.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
$npa=array("文章管理","文章列表","文章列表");

$op=request('op','list');
$active[$op]='class="active"';
if($op=='articleAdd'){
	$article=request('article',array());
	$id=request('id',0);
	if(!empty($article)){
		//添加文章
		articleAdd($article);
		show_message('操作成功','文章添加成功','?mod='.MODNAME.'&ac='.ACTNAME);
	}
	if(!empty($id)){
		$article=getarticle($id);
	}
}
$catlist=getarticlecat();
$start = intval(request('start',0));
$result=articleList(array(),'`addtime` DESC',$start,30);
$articlelist=array();
if (!empty($result))
{
	$page_url='?mod='.MODNAME.'&ac='.ACTNAME.'&op='.$op.'&'.$result['url'];
	$pages=get_page_number_list($result['total'], $start, 30);
	$articlelist=$result['data'];
}

?>
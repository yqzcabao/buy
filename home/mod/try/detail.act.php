<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @item.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
$id=intval(request('id',0));
if(empty($id)){
	message('-1','提示',"试用不存在",u('try','index'));
}

$try=tryinfo($id);
if(empty($try)){
	message('-1','提示',"试用不存在",u('try','index'));
}

//热门试用
function hottry($id){
	return lib_database::select('try','*','id!=\''.$id.'\' order by apply desc limit 0,4');
}
//谁获取了试用
function whogettry($id,$num=20){
	$query = lib_database::rquery('select uid,user_name from '.tname('applylog').' where id=\''.$id.'\' and status>1 and idtype=\'try\' order by addtime desc limit 0,'.$num);
	while ($rt = lib_database::fetch_one())
	{
		$data[] = $rt;
	}
	return $data;
}
?>
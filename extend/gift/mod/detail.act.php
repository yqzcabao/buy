<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\gift\mod\detail.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @detail.act.php
 * =================================================
*/
$id=intval(request('id',0));
if(empty($id)){
	message('-1','提示',"兑换不存在",u(MODNAME,'index'));
}
$exchange=getexc($id);
if(empty($exchange)){
	message('-1','提示',"兑换不存在",u(MODNAME,'index'));
}
//兑换记录
$commentresult=commentlist($exchange['id'],'exchange');
$commentlist=array();
if (!empty($commentresult))
{
	$page_url=u('goods','detail',$commentresult['urls']);
	$pages=get_page_number_list($commentresult['total'], request('start',0),CPAGE);
	$commentlist=$commentresult['data'];
}
require tpl_extend('detail.tpl.php');
/* End of file detail.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\gift\mod\detail.act.php */
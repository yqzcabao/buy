<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\wap\mod\agreement.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @agreement.act.php
 * =================================================
*/
$article='';
if(!empty($_webset['base_agreement'])){
	$article=getarticle($_webset['base_agreement']);
	$article=$article['content'];
}
require tpl_extend(WAP_TPL.'/agreement.tpl.php');
/* End of file agreement.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\wap\mod\agreement.act.php */
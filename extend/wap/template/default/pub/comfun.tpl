<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\wap\template\default2\pub\comfun.tpl
 * @author		bank
 * @link		http://www.wangyue.cc
 * @comfun.tpl
 * =================================================
*/
function printCal($y,$m,$existData)
{
	$t=strtotime($y."-".$m."-1");
	if(!$t)
	return -1;
	$d=date("t",$t); //当月有多少天
	$w=date("w",$t); //当月的第一天是周几
	$n=ceil(($d+$w)/7);   //当月共跨越多少周
	$html.='<li class="first"><span class="fl"><i>日</i></span><span class="fl"><i>一</i></span><span class="fl"><i>二</i></span><span class="fl"><i>三</i></span><span class="fl"><i>四</i></span><span class="fl"><i>五</i></span><span class="fl"><i>六</i></span></li>';
	$day=1;
	for($i=1;$i<=$n*7;$i++)
	{
		if($i%7==1)
		$html.="<li>";
		if($i>$w && $day<=$d)
		{
			if($existData[$day])
			$html.="<span class='fl cur'><i>{$day}<var>已签</var></i></span>";
			else
			$html.= "<span class='fl'><i>{$day}</i></span>";
			$day++;
		}
		else
		$html.= "<span class='fl'><i>&nbsp;</i></span>";
		if($i%7==0)
		$html.="</li>";
	}
	return $html;
}
/* End of file comfun.tpl */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\wap\template\default2\pub\comfun.tpl */
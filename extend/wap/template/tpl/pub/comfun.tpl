<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\wap\template\default\comfun.tpl
 * @author		bank
 * @link		http://www.wangyue.cc
 * @comfun.tpl
 * =================================================
*/
function show_cat_table(){
	$html='<div class="i2_cagd" style="border-top:1px solid #ddd;display:none"><div class="i2_cagdd"><ul>';
	//分类
	$catlist=getgoodscat();
	$cst_new[]=array('title'=>'全部','id'=>0);
	foreach ($catlist as $key=>$value){
		$cst_new[]=array('title'=>$value['title'],'id'=>$value['id']);
	}
	$num=4*ceil(count($catlist)/4);
	for($i=0;$i<$num;$i++){
		if(($i+1)%5==0){
			$html.='</ul></div><div class="i2_cagdd"><ul>';
		}
		if(isset($cst_new[$i])){
			$html.='<li><a href="'.u(MODNAME,'index',array('cat'=>$cst_new[$i]['id'])).'"><i class="i2_icon cat'.$cst_new[$i]['id'].'"></i><span>'.$cst_new[$i]['title'].'</span></a></li>';
		}else{
			$html.='<li style="border-right: none"></li>';
		}
		
	}
	$html.='</ul></div></div>';
	return $html;
}
function show_sign($y,$m,$existData){
	$t=strtotime($y."-".$m."-1");
	if(!$t)
	return -1;
	$d=date("t",$t); //当月有多少天
	$w=date("w",$t); //当月的第一天是周几
	$n=ceil(($d+$w)/7);   //当月共跨越多少周
	$html.='<li><span><i>日</i></span><span><i>一</i></span><span><i>二</i></span><span><i>三</i></span><span><i>四</i></span><span><i>五</i></span><span><i>六</i></span></li>';
	$day=1;
	for($i=1;$i<=$n*7;$i++)
	{
		if($i%7==1)
		$html.="<li>";
		if($i>$w && $day<=$d)
		{
			if($existData[$day])
			$html.='<span class="benyue cur"><i>'.$day.'<var>已签</var></i></span>';
			else
			$html.= '<span class="benyue"><i>'.$day.'</i></span>';
			$day++;
		}
		else
		$html.= "<span><i>&nbsp;</i></span>";
		if($i%7==0)
		$html.="</li>";
	}
	return $html;
}
/* End of file comfun.tpl */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\wap\template\default\comfun.tpl */
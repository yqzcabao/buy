<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @function_view.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}


/**
 * 显示input radio
 *
 */
function showRadio($name,$arr,$def=0,$id="",$class='',$other=""){
	$html=$checked='';
	foreach ($arr as $key=>$value){
		$idstr='';
		if($def==$key){
			$checked='checked';
		}
		!empty($id) && $idstr=$id.$key;
		$html.='<input type="radio" name="'.$name.'" value="'.$key.'" '.$checked.' class="'.$class.'" id="'.$idstr.'" '.$other.'><label for="'.$idstr.'">'.$value.'</label>';
		$checked='';
	}
	return $html;
}


/**
 * 显示复选框
 *
 */
function showCheckbox($name,$arr,$def=0,$id="",$class='',$other=""){
	$html=$checked='';
	foreach ($arr as $key=>$value){
		$idstr='';
		if($def==$key){
			$checked='checked';
		}
		!empty($id) && $idstr=$id.$key;
		$html.='<input type="checkbox" name="'.$name.'" value="'.$key.'" '.$checked.' class="'.$class.'" id="'.$idstr.'" '.$other.'><label for="'.$idstr.'">'.$value.'</label>';
		$checked='';
	}
	return $html;
}

/**
 * 显示select
 *
 */
function showSelect($name,$arr,$def=0,$class=''){
	$html=$selected='';
	$html='<select class="'.$class.'" name="'.$name.'">';
	foreach ($arr as $key=>$value){
		if($def==$key){
			$selected='selected';
		}
		$html.='<option value="'.$key.'" '.$selected.' >'.$value;
		$selected='';
	}
	$html.='</select>';
	return $html;
}

//获取文件目录列表,该方法返回数组
function getDir($dir) {
	$dirArray[]=NULL;
	if (false != ($handle = opendir ( $dir ))) {
		$i=0;
		while ( false !== ($file = readdir ( $handle )) ) {
			//去掉"“.”、“..”以及带“.xxx”后缀的文件
			if ($file != "." && $file != ".."&&!strpos($file,".")) {
				$dirArray[$i]=$file;
				$i++;
			}
		}
		//关闭句柄
		closedir ( $handle );
	}
	return $dirArray;
}
//获取文件列表
function getFile($dir) {
	$fileArray[]=NULL;
	if (false != ($handle = opendir ( $dir ))) {
		$i=0;
		while ( false !== ($file = readdir ( $handle )) ) {
			//去掉"“.”、“..”以及带“.xxx”后缀的文件
			if ($file != "." && $file != ".."&&strpos($file,".")) {
				$fileArray[$i]=$file;
				if($i==100){
					break;
				}
				$i++;
			}
		}
		//关闭句柄
		closedir ( $handle );
	}
	return $fileArray;
}
/**
 * 系统当前模板列表
 *
 */
function getTpl(){
	//读取模板
	$tplarr=getDir(PATH_ROOT.'/home/template/');
	foreach ($tplarr as $k=>$val){
		$tpl[$val]['name']=$val;
	}
	return $tpl;
}
function get_extend_tpl_set(){
	//读取模板
	$extendarr=getDir(PATH_ROOT.'/extend/');
	$extend_tpl_set=array();
	foreach ($extendarr as $k=>$val){
		if(file_exists(PATH_ROOT.'/extend/'.$val.'/config/_set')){
			$extend_tpl_set[$val]=PATH_ROOT.'/extend/'.$val.'/config/_set';
		}
	}
	return $extend_tpl_set;
}
//显示宝贝链接
function gogood($iid,$goto=''){
	global $_webset;
	if(empty($iid)){
		return 'href="javascript:void(0);"';
	}
	if(is_bool($goto)){
		if($goto){
			return 'href="'.u('index','jump',array('iid'=>$iid)).'"  target="_blank"';
		}else{
			return 'href="'.u('goods','detail',array('iid'=>$iid)).'"  target="_blank"';
		}
	}else{
		if($_webset['taoke_showinfo']!=1 ){
			return 'href="'.u('index','jump',array('iid'=>$iid)).'"  target="_blank"';
		}else{
			return 'href="'.u('goods','detail',array('iid'=>$iid)).'"  target="_blank"';
		}
	}
}
//显示广告
function A($id){
	global $_timestamp;
	$arr=system::getad();
	if(isset($arr['ad_0'][$id])){
		$arr=$arr['ad_0'][$id];
		$style='style="';
		if(empty($arr['start']) || ($arr['start']<$_timestamp && $arr['end']>$_timestamp)){
			if(!empty($arr['content'])){
				return $arr['content'];
			}
			if($arr['width']>0){
				$style.='width:'.$arr['width'].'px;';
			}
			if($arr['height']>0){
				$style.='height:'.$arr['height'].'px;';
			}
			if($arr['top']>0){$style.='margin-top:'.$arr['top'].'px;';}else{$style.='margin-top:auto;';}
			if($arr['bottom']>0){$style.='margin-bottom:'.$arr['bottom'].'px;';}else{$style.='margin-bottom:auto;';}
			if($arr['left']>0){$style.='margin-left:'.$arr['left'].'px;';}else{$style.='margin-left:auto;';}
			if($arr['right']>0){$style.='margin-right:'.$arr['right'].'px;';}else{$style.='margin-right:auto;';}
			$style.='"';
			if(isset($arr['ad_content'])){
				$c=$arr['ad_content'];
			}
			else{
				$c='<a href="'.$arr['url'].'" target="_blank"><img src="'.$arr['pic'].'" /></a>';
			}
			return "<div ".$style." id='ad".$id."'>".$c."</div>";
		}
	}
	return;
}

//关闭
function close(){
	global $_webset;
	if(MODNAME!='index' && ACTNAME!='validate_image'){
		$site_closed_reason=empty($_webset['site_closed_reason'])?"网站已经关闭":$_webset['site_closed_reason'];
		$site_name=empty($_webset['site_name'])?"成都网悦时代科技有限公司":$_webset['site_name'];
		echo <<<EOT
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>{$site_name}网站关闭提示</title>
			<style type="text/css">
				body{ width:100%; padding:0px; margin:0px;}
				.content{ width:438px; margin:90px auto;}
				.content_c{ display:block; width:438px; height:355px; background:url(../static/images/bg.png) no-repeat; text-align:center; position:relative}
				.content_c a{ position:absolute; top:185px; left:190px; color:#530470;text-align:center; text-decoration:underline; font-family:"微软雅黑";}
				.not_authorize{margin-left:170px; margin-top:160px;  font-family:"微软雅黑"; float:left; color:#1a1a1a}
				.footer{ width:980px; margin:0 auto; margin-top:300px;}
				.footer_c{ text-align:center}
			</style>
			</head>
			<body>
				<div class="content">
					<div class="content_c">
						<h4 class="not_authorize">{$site_closed_reason}</h4>
						<a href="javascript:;" class="authorize">请耐心等待</a>
					</div>
				</div>
				<div class="footer">
					<div class="footer_c">
						Powered - by {$site_name}
					</div>
				</div>
			</body>
			</html>
EOT;
		exit();
}
}
//用户中心等用户名
function user_name(){
	global $user;
	return empty($user['user_name'])?'设置昵称':$user['user_name'];
}
function user_center_url(){
	global $user;
	return empty($user['user_name'])?u('user','base'):u('user','center');
}
//评论用户名
function show_user_name($username,$email){
	return !empty($username)?$username:half_replace($email);
}
function half_replace($str){
	preg_match("/(.*)@.*/",$str,$subpatterns);
	$c = strlen($subpatterns[1])/2;
	return preg_replace('|(?<=.{'.(ceil($c/2)).'})(.{'.floor($c).'}).*?|',str_pad('',floor($c),'*'),$str,1);
}

function timediff($begin_time,$end_time)
{
	if($begin_time < $end_time){
		$starttime = $begin_time;
		$endtime = $end_time;
	}
	else{
		$starttime = $end_time;
		$endtime = $begin_time;
	}
	$timediff = $endtime-$starttime;
	$days = intval($timediff/86400);
	$remain = $timediff%86400;
	$hours = intval($remain/3600);
	$remain = $remain%3600;
	$mins = intval($remain/60);
	$secs = $remain%60;
	$res = array("day" => $days,"hour" => $hours,"min" => $mins,"sec" => $secs);
	return $res;
}
/**
 * 去掉小数后无用的零
 *
 * @param unknown_type $floatnum
 * @return unknown
 */
function trim_last0($floatnum){
	//if(is_float($floatnum)){
		$floatnum=sprintf("%.1f",substr(sprintf("%.2f", $floatnum), 0, -1));
		$floatnum=strval($floatnum);
		return floatval($floatnum);
	//}
	//trim_last0
	return $floatnum;
}
/**
 * 判断设备
 *
 * @return unknown
 */
function isMobile() {
	$regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";
	$regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";
	$regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";
	$regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";
	$regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";
	$regex_match.=")/i";
	return isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']) or preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']));
}
?>
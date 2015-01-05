<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\plugin\uzsite\admin\mod\goods.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @goods.act.php
 * =================================================
*/
require PATH_PLUGIN.'lib/uzsite.func.php';
$ops=array('list','edit','add','del','page','img');
$op=request('op','list',$ops);
//分页计算
if($op=='page'){	
	$num=request('num');
	$size=request('size');
	$page=request('page');
	$start=abs($size*($page-1));
	//总页数
	$allpage=ceil($size/$num);
	$page_url=$_plugin_url.'&pmod=goods&op=list';
	//参数
	$cat=request('cat',0);
	if(!empty($cat)){
		$page_url.='&cat='.$cat;
	}
	$channel=request('channel',0);
	if(!empty($channel)){
		$page_url.='&channel='.$channel;
	}
	$keyword=request('keyword','');
	if(!empty($keyword)){
		$page_url.='&keyword='.$keyword;
	}	
	$pages=get_page_number_list($num, $start,$size);
	$html='';
	if(isset($pages) && !empty($pages)){
		if($pages['prev']>-1){
			$html.='<a href="'.$page_url.'&page='.($page-1).'">&laquo; 上一页</a>';
		}else{
			$html.='<span class="nextprev">&laquo; 上一页</span>';
		}
		foreach ($pages as $k=>$v){
			if($k != 'prev' && $k != 'next'){
				if($k == 'omitf' || $k == 'omita'){
					$html.='<span>…</span>';
				}else{
					if($v > -1){
						$html.='<a href="'.$page_url.'&page='.$k.'">'.$k.'</a>';
					}else{
						$html.='<span class="current">'.$k.'</span>';
					}
				}
			}
		}
		if($pages['next'] > -1){
			$html.='<a href="'.$page_url.'&page='.($page+1).'">下一页 &raquo;</a>';
		}else{
			$html.='<span class="nextprev">下一页 &raquo;</span>';
		}
	}
	jsonp(json_encode(array('html'=>$html)));
}
//删除分类
elseif ($op=='del'){
	$id=request('id');
	if(uz_goods_del($id)){
		show_message('操作成功','数据删除成功',$_plugin_url.'&pmod=goods');
	}else{
		show_message('操作成功','数据删除失败',$_plugin_url.'&pmod=goods');
	}
}elseif($op=='list'){
	$page=request('page',1);
	$cat=request('cat',0);
	$channel=request('channel',0);
	$keyword=request('keyword','');
}elseif ($op=='edit'){
	$id=request('id',0);
}
elseif ($op=='add'){
	//默认时间
	$start=date('Y-m-d');
	$end=date('Y-m-d',strtotime('+'.$_webset['base_showday'].' days'));
}elseif ($op=='img'){
		$picname = lib_request::$files['uzpic']['name'];
		$picsize = lib_request::$files['uzpic']['size'];
		if ($picname != "") {
			if ($picsize > 1024000) {
				echo json_encode(array('code'=>'-1','title'=>'图片上传','msg'=>'图片大小不能超过1M'));
				exit();
			}
			$type = get_extension($picname);
			if ($type != "gif" && $type != "jpg" && $type != "jpeg" && $type != "png") {
				echo json_encode(array('code'=>'-1','title'=>'图片上传','msg'=>'图片格式不对！'));
				exit();
			}
			$rand = rand(100, 999);
			$pics = date("YmdHis") . $rand . '.'.$type;
			//上传路径
			$dir=date('/Y/m/d/H/');
			$pic_path=PATH_UPLOAD.$dir;
			$pic_url=$pic_path.$pics;
			if(!file_exists(PATH_ROOT.$pic_path)){
				creatFolder(PATH_ROOT.$pic_path);
			}
			$pic_path = PATH_ROOT.$pic_url;
			move_uploaded_file(lib_request::$files['uzpic']['tmp_name'], $pic_path);
		}
		$arr = array(
						'name'=>$picname,
						'pic'=>$pic_url,
						'size'=>$picsize
						);
		//上传至u站
		$argva =array('token' => '1','hash' => uzsecretkey(),'m'=>'img','t'=>$_timestamp,'isfile'=>1);
		$returndata=postdata($_webset['uz_site'].'/d/get',$argva,PATH_ROOT.$pic_url);
		preg_match('/jsonp\((.*?)\)/',$returndata,$jsonp);
		if(!empty($jsonp[1])){
			$json=str_replace("\\\"","\"",$jsonp[1]);
			echo $json;
			exit();
		}
		echo '{"sucess":false,"errorMsg":"上传失败"}';
		exit();
}
/* End of file goods.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\plugin\uzsite\admin\mod\goods.act.php */
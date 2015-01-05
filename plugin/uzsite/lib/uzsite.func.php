<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @uzsite.func.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
//宝贝列表
function pushgoodslist($wherestr=array(),$order='',$start=0, $num=PAGE){
	global $_timestamp,$_webset;
	$wherestr[]='b.num_iid is null';
	//组合条件
	$intkeys=array('channel'=>'channel','cat'=>'cat','ispost'=>'ispost','isrec'=>'isrec','ispaigai'=>'ispaigai','issteal'=>'issteal','isvip'=>'isvip','status'=>'status');
	$strkeys=array();
	$randkeys=array();
	$likekeys=array('title'=>'keyword','num_iid'=>'keyword','nick'=>'keyword');
	$search=getwheres($intkeys,$strkeys,$randkeys,$likekeys,'a.');
	//处理条件
	!empty($search['wherearr']['channel'])?$where[]=$search['wherearr']['channel']:'';
	!empty($search['wherearr']['cat'])?$where[]=$search['wherearr']['cat']:'';
	!empty($search['wherearr']['ispost'])?$where[]=$search['wherearr']['ispost']:'';
	!empty($search['wherearr']['isrec'])?$where[]=$search['wherearr']['isrec']:'';
	!empty($search['wherearr']['ispaigai'])?$where[]=$search['wherearr']['ispaigai']:'';
	!empty($search['wherearr']['issteal'])?$where[]=$search['wherearr']['issteal']:'';
	!empty($search['wherearr']['isvip'])?$where[]=$search['wherearr']['isvip']:'';
	//状态比较特殊
	$type=request('type',0);
	if(!empty($type)){
		if($type==1){//进行中的
			$where[]='start<'.$_timestamp.' and end>'.$_timestamp;
		}elseif ($type==-1){//已结束的
			$where[]='end<'.$_timestamp;
		}elseif ($type==2){
			$where[]='start>'.$_timestamp;
		}
	}
	!empty($where)?$wherestr[]='('.implode(' AND ',$where).')':'';
	unset($where);
	isset($search['wherearr']['title'])?$where[]=$search['wherearr']['title']:'';
	isset($search['wherearr']['num_iid'])?$where[]=$search['wherearr']['num_iid']:'';
	isset($search['wherearr']['nick'])?$where[]=$search['wherearr']['nick']:'';
	isset($where)?$wherestr[]='('.implode(' OR ',$where).')':'';
	unset($where);
	$countwhere=$wherestr=!empty($wherestr)?implode(' AND ',$wherestr):'1';
	$base_order=preg_replace("/(start|promotion_price|discount|volume)_(desc|asc)/",'`$1` $2',$_webset['base_order']);
	$base_order=!empty($base_order)?$base_order:'';
	$order=empty($order)?'a.`sort` desc,day desc,a.`isrec`<>1,'.$base_order:$order;
	$wherestr .=' ORDER BY '.$order;
	if ($start > -1 && $num > 0)
	{
		$wherestr .= " LIMIT {$start}, {$num}";
	}
	$data=array();
	$query = lib_database::rquery('select a.*,FROM_UNIXTIME(a.`start`,"%Y%m%d") as day from '.tname('goods').' as a left join '.tname('plugin_uzsite_gpush').' as b on a.num_iid=b.num_iid where '.$wherestr);
	while ($rt = lib_database::fetch_one())
	{
		if(empty($_webset['site_tpl_mode']) || $_webset['site_tpl_mode']==1){
			$pic=$rt['pic'];
		}elseif ($_webset['site_tpl_mode']==2){
			$pic=$rt['taopic'];
		}
		$rt['pic']=!empty($pic)?$pic:$rt['pic'];
		$data[] = $rt;
	}
	$output = array();
	$total = lib_database::rquery('SELECT COUNT(*) AS rows from '.tname('goods').' as a left join '.tname('plugin_uzsite_gpush').' as b on a.num_iid=b.num_iid where '.$countwhere);
	$total = lib_database::fetch_one();
	$output['total'] = $total['rows'];
	$output['data'] = $data;
	//分页url
	$urls=array();
	foreach ($search['urls'] as $key=>$value){
		$url=explode('=',$value);
		$urls[$url[0]]=$url[1];
	}
	$output['urls'] = $urls;
	$output['url']=implode('&',$search['urls']);
	$output['url']=!empty($output['url'])?'&'.$output['url']:"";
	return $output;
}
function postdata($posturl,$data=array(),$file=''){
	$url = parse_url($posturl);
	$boundary = "---------------------------".substr(md5(rand(0,32000)),0,10);
	$boundary_2 = "--$boundary";
	$content = $encoded = "";
	if($data){
		while (list($k,$v) = each($data)){
			$encoded .= $boundary_2."\r\nContent-Disposition: form-data; name=\"".rawurlencode($k)."\"\r\n\r\n";
			$encoded .= rawurlencode($v)."\r\n";
		}
	}
	if($file){
		$ext=strrchr($file,".");
		$type = "image/jpeg";
		switch($ext){
			case '.gif': $type = "image/gif";
			break;
			case '.jpg': $type = "image/jpeg";
			break;
			case '.png': $type = "image/png";
			break;
		}
		$encoded .= $boundary_2."\r\nContent-Disposition: form-data; name=\"file\"; filename=\"$file\"\r\nContent-Type: $type\r\n\r\n";
		$content = join("", file($file));
		$encoded.=$content."\r\n";
	}
	$encoded .= "\r\n".$boundary_2."--\r\n\r\n";
	$length = strlen($encoded);
	$fp = fsockopen($url['host'],80);
	if(!$fp) return "Failed to open socket to $url[host]";
	fputs($fp, "POST $url[path] HTTP/1.0\r\n");
	fputs($fp, "Host: $url[host]\r\n");
	fputs($fp, "Content-type: multipart/form-data; boundary=$boundary\r\n");
	fputs($fp, "Content-length: ".$length."\r\n");
	fputs($fp, "Connection: close\r\n\r\n");
	fputs($fp, $encoded);

	$line = fgets($fp,1024);
	if (!eregi("^HTTP/1\.. 200", $line)) return null;
	$results = "";
	$inheader = 1;
	while(!feof($fp)){
		$line = fgets($fp,1024);
//		$resp_str .=$line;
		if($inheader && ($line == "\r\n" || $line == "\r\r\n")){
			$inheader = 0;
		}elseif(!$inheader){
			$results .= $line;
		}
	}
	fclose($fp);
	return $results;
}
function uzsecretkey(){
	global $_webset;
	return md5(md5($_webset['uz_secretkey'].date('Ymd')));
}
?>
<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @common.func.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
//添加文章
function articleAdd($article){
	global $_timestamp;
	if(!empty($article['id'])){
		$ishade=lib_database::get_one('select id from '.tname('article').' where id='.$article['id']);
		if(!empty($ishade)){
			lib_database::update('article',$article,'id='.$article['id']);
			return true;
		}
	}
	$article['addtime']=$_timestamp;
	lib_database::insert('article',array_keys($article),$article);
	return true;
}
//文章列表
function articleList($wherestr=array(),$order='`addtime` DESC',$start=0, $num=20){
	global $_timestamp;
	//组合条件
	$intkeys=array('cid'=>'cid');
	$strkeys=array();
	$randkeys=array();
	$likekeys=array('title'=>'keyword','content'=>'keyword');
	$search=getwheres($intkeys,$strkeys,$randkeys,$likekeys);

	//处理条件
	!empty($search['wherearr']['cid'])?$where[]=$search['wherearr']['cid']:'';
	!empty($where)?$wherestr[]='('.implode(' AND ',$where).')':'';
	unset($where);
	isset($search['wherearr']['title'])?$where[]=$search['wherearr']['title']:'';
	isset($search['wherearr']['content'])?$where[]=$search['wherearr']['content']:'';
	isset($where)?$wherestr[]='('.implode(' OR ',$where).')':'';
	unset($where);
	$countwhere=$wherestr=!empty($wherestr)?implode(' AND ',$wherestr):'1';
	$wherestr .=' ORDER BY '.$order;
	if ($start > -1 && $num > 0)
	{
		$wherestr .= " LIMIT {$start}, {$num}";
	}
	$data=array();
	$query = lib_database::rquery('select * from '.tname('article').' where '.$wherestr);
	while ($rt = lib_database::fetch_one())
	{
		$data[] = $rt;
	}
	$output = array();
	$total = lib_database::rquery('SELECT COUNT(*) AS rows from '.tname('article').' where '.$countwhere);
	$total = lib_database::fetch_one();
	$output['total'] = $total['rows'];
	$output['data'] = $data;
	//分页url
	$output['url']=implode('&',$search['urls']);
	$output['url']=!empty($output['url'])?'&'.$output['url']:"";
	return $output;
}
function goodCheck($num_iid){
	return lib_database::get_rows_num("goods","num_iid=".$num_iid);
}
//改变宝贝的一些状态
function upgoodstatus($id,$field){
	lib_database::wquery('update '.tname('goods').' set `'.$field.'`=if('.$field.'=1,"-1","1") where id='.$id);
}
//改变排序
function upsort($id,$sort,$type){
	if($type=='goods'){
		lib_database::wquery('update '.tname('goods').' set `sort`='.$sort.' where id='.$id);
	}elseif($type=='cat'){
		lib_database::wquery('update '.tname('type').' set `sort`='.$sort.' where id='.$id);
		//清理缓存
		del_cache('goods','cat');
		del_cache('article','cat');
	}
}
/*数据备份相关*/
function getTables(){
	$query = lib_database::rquery('Show Tables');
	while ($value=lib_database::fetch_one($query,MYSQL_NUM)){
		//记录数
		$tablelist[]=$value[0];
	}
	return $tablelist;
}
function tryCheck($num_iid){
	return lib_database::get_rows_num("try","num_iid=".$num_iid);
}
//积分兑换
function excCheck($num_iid){
	return lib_database::get_rows_num("exchange","num_iid=".$num_iid);
}
//用户列表
function userlist($wherestr=array(),$order='a.`regtime` DESC',$start=0, $num=20,$apps=''){
	global $_timestamp;
	if(empty($apps)){
		$apps=APPNAME;
	}
	//组合条件
	$likekeys=array('user_name'=>'keyword','email'=>'keyword');
	$likekeysb=array('name'=>'keyword');
	$search=getwheres(array(),array(),array(),$likekeys,'a.');
	$searchb=getwheres(array(),array(),array(),$likekeysb,'b.');
	isset($search['wherearr']['user_name'])?$where[]=$search['wherearr']['user_name']:'';
	isset($search['wherearr']['email'])?$where[]=$search['wherearr']['email']:'';
	isset($where)?$wherestr[]='('.implode(' OR ',$where).')':'';
	unset($where);
	$countwhere=$wherestr=!empty($wherestr)?implode(' AND ',$wherestr):'1';
	$wherestr .=' ORDER BY '.$order;
	if ($start > -1 && $num > 0)
	{
		$wherestr .= " LIMIT {$start}, {$num}";
	}
	$data=array();
	$query = 'select b.*,a.*,c.api,if(a.user_name is not null,a.user_name,if(a.email is not null,a.email,c.name)) as uname from '.tname('users').' as a left join '.tname('users_'.$apps.'_fields').' as b on a.uid=b.uid left join '.tname('users_token').' as c on a.uid=c.uid where '.$wherestr;
	$query = lib_database::rquery($query);
	while ($rt = lib_database::fetch_one())
	{
		$data[] = $rt;
	}
	$output = array();
	$total = lib_database::rquery('select COUNT(a.uid) AS rows from '.tname('users').' as a where '.$countwhere);
	$total = lib_database::fetch_one();
	$output['total'] = $total['rows'];
	$output['data'] = $data;
	//分页url
	$output['url']=implode('&',$search['urls']);
	$output['url']=!empty($output['url'])?'&'.$output['url']:"";
	return $output;
}
//用户列表
function managerlist($wherestr=array(),$order='`regtime` DESC',$start=0, $num=20,$apps=''){
	global $_timestamp;
	if(empty($apps)){
		$apps=APPNAME;
	}
	//组合条件
	$likekeys=array('user_name'=>'keyword','email'=>'keyword');
	$likekeysb=array('name'=>'keyword');
	$search=getwheres(array(),array(),array(),$likekeys);
	isset($search['wherearr']['user_name'])?$where[]=$search['wherearr']['user_name']:'';
	isset($search['wherearr']['email'])?$where[]=$search['wherearr']['email']:'';
	isset($where)?$wherestr[]='('.implode(' OR ',$where).')':'';
	unset($where);
	$countwhere=$wherestr=!empty($wherestr)?implode(' AND ',$wherestr):'1';
	$wherestr .=' ORDER BY '.$order;
	if ($start > -1 && $num > 0)
	{
		$wherestr .= " LIMIT {$start}, {$num}";
	}
	$data=array();
	$query = 'select a.* from '.tname('users').' as a where '.$wherestr;
	$query = lib_database::rquery($query);
	while ($rt = lib_database::fetch_one())
	{
		$data[] = $rt;
	}
	$output = array();
	$total = lib_database::rquery('select COUNT(a.uid) AS rows from '.tname('users').' as a where '.$countwhere);
	$total = lib_database::fetch_one();
	$output['total'] = $total['rows'];
	$output['data'] = $data;
	//分页url
	$output['url']=implode('&',$search['urls']);
	$output['url']=!empty($output['url'])?'&'.$output['url']:"";
	return $output;
}
/*数据库碎片查询*/
function getyablestatus($where=''){
	$query = lib_database::rquery('SHOW TABLE STATUS '.$where);
	$silent=array();
	while ($table=lib_database::fetch_one($query)){
		$version=lib_database::get_version();
		$tabletype = $version > '4.1' ? 'Engine' : 'Type';
		$table['tabletype']=$tabletype;
		if($table['Data_free'] && $table[$tabletype] == 'MyISAM') {
			$silent[]=$table;
		}
	}
	return $silent;
}
/*修复*/
function optimizet($optimizetables){
	$query = lib_database::rquery('SHOW TABLE STATUS');
	while($table = lib_database::fetch_one($query)) {
		if(is_array($optimizetables) && in_array($table['Name'],$optimizetables)) {
			lib_database::query("OPTIMIZE TABLE ".$table[Name]);
		}
	}
}
//删除备份
function delbackup($key_v){
	$backarr=getFile(PATH_DATA.'/backup/');
	foreach ($backarr as $k=>$val){
		$key=explode('_v',$val);
		$backup[$key[0]][]=$val;
	}
	if(isset($backup[$key_v])){
		foreach ($backup[$key_v] as $k=>$value){
			unlink(PATH_DATA.'/backup/'.$value);
		}
	}
	return jsonp(json_encode(array('key'=>$key_v)));
}
//宝贝的nav
function navList(){
	global $_nav;
	$goodnav=array();
	foreach ($_nav as $key=>$value){
		if($value['mod']=='goods'){
			$goodnav[$value['id']]=$value;
		}
	}
	return $goodnav;
}
//黑名单列表
function blacklist($wherestr=array(),$order='`addtime` DESC',$start=0, $num=20){
	//组合条件
	$likekeys=array('nick'=>'keyword','reason'=>'keyword');
	$search=getwheres(array(),array(),array(),$likekeys);
	isset($search['wherearr']['nick'])?$where[]=$search['wherearr']['nick']:'';
	isset($search['wherearr']['reason'])?$where[]=$search['wherearr']['reason']:'';
	isset($where)?$wherestr[]='('.implode(' OR ',$where).')':'';
	unset($where);
	$countwhere=$wherestr=!empty($wherestr)?implode(' AND ',$wherestr):'1';
	$wherestr .=' ORDER BY '.$order;
	if ($start > -1 && $num > 0)
	{
		$wherestr .= " LIMIT {$start}, {$num}";
	}
	$data=array();
	lib_database::rquery('select * from '.tname('blacklist').' where '.$wherestr);
	while ($rt = lib_database::fetch_one())
	{
		$data[]=$rt;
	}
	$output = array();
	lib_database::rquery('SELECT COUNT(*) AS rows from '.tname('blacklist').' where '.$countwhere);
	$total = lib_database::fetch_one();
	$output['total'] = $total['rows'];
	$output['data'] = $data;
	//分页url
	$output['url']=implode('&',$search['urls']);
	$output['url']=!empty($output['url'])?'&'.$output['url']:"";
	return $output;
}
//添加黑名单
function addblack($black){
	global $_timestamp;
	$black['addtime']=$_timestamp;
	lib_database::insert('blacklist',array_keys($black),$black);
}
//获取黑名单
function getblack($nick){
	return checkblack($nick);
}
//举报列表
function reportlist($wherestr=array(),$order='`addtime` DESC',$start=0, $num=PAGE){
	global $_timestamp,$_webset;
	//组合条件
	$intkeys=array();
	$strkeys=array();
	$randkeys=array();
	$likekeys=array('good'=>'keyword','report'=>'keyword');
	$search=getwheres($intkeys,$strkeys,$randkeys,$likekeys);
	//处理条件
	!empty($search['wherearr']['good'])?$where[]=$search['wherearr']['good']:'';
	!empty($search['wherearr']['report'])?$where[]=$search['wherearr']['report']:'';
	!empty($where)?$wherestr[]='('.implode(' OR ',$where).')':'';
	unset($where);
	$countwhere=$wherestr=!empty($wherestr)?implode(' AND ',$wherestr):'1';
	$wherestr .=' ORDER BY '.$order;
	if ($start > -1 && $num > 0)
	{
		$wherestr .= " LIMIT {$start}, {$num}";
	}
	$data=array();
	$query = lib_database::rquery('select * from '.tname('goods_report').' where '.$wherestr);
	while ($rt = lib_database::fetch_one())
	{
		$data[] = $rt;
	}
	$output = array();
	$total = lib_database::rquery('SELECT COUNT(*) AS rows from '.tname('goods_report').' where '.$countwhere);
	$total = lib_database::fetch_one();
	$output['total'] = $total['rows'];
	$output['data'] = $data;
	//分页url
	$output['urls'] = $search['urls'];
	$output['url']=implode('&',$search['urls']);
	$output['url']=!empty($output['url'])?'&'.$output['url']:"";
	return $output;
}
//审核排期
function audit($data,$type){
	$id=$data['id'];
	unset($data['id']);
	$data['status']=1;
	lib_database::update($type,$data,'id='.$id);
	//删除掉可能存在的拒绝理由
	lib_database::delete('refuse','id='.$id.' and idtype=\''.$type.'\'');
}
//拒绝处理
function refuse($data,$type){
	global $_timestamp;
	lib_database::update($type,array('status'=>-1),'id='.$data['id']);
	lib_database::insert('refuse',array('id','idtype','refuse','addtime'),array($data['id'],$type,$data['refuse'],$_timestamp));
}
//大小
function num_bitunit($num){
	$bitunit=array(' B',' KB',' MB',' GB');
	for($key=0;$key<count($bitunit);$key++){
		if($num>=pow(2,10*$key)-1){ //1023B 会显示为 1KB
			$num_bitunit_str=(ceil($num/pow(2,10*$key)*100)/100)." $bitunit[$key]";
		}
	}
	return $num_bitunit_str;
}
//获取备份
function getbackup(){
	$backarr=getFile(PATH_DATA.'/backup/');
	$backup=array();
	foreach ($backarr as $k=>$val){
		if(!empty($val)){
			$key=explode('_v',$val);
			$backup[$key[0]][]=$val;
		}
	}
	return $backup;
}
//淘宝对应分类
function addcatgather($cat){
	lib_database::wquery('replace into '.tname('type_gather').'(`cid`,`boutiquecat`) VALUES(\''.$cat['cid'].'\',\''.$cat['boutiquecat'].'\')');
}
//添加采集规则
function addgather($task){
	if(!empty($task['rule'])){
		$task['rule']=serialize($task['rule']);
	}
	if(!empty($task['tid'])){
		lib_database::update('task',$task,'tid='.$task['tid']);
	}else{
		lib_database::insert('task',array_keys($task),$task);
	}
	del_cache('task','task');
}
//采集规则列表
function tasklist(){
	$tasks=get_cache('task','task');
	if(empty($tasks)){
		$query=lib_database::rquery('select * from '.tname('task'));
		while ($value=lib_database::fetch_one($query)){
			$value['rule']=unserialize($value['rule']);
			$tasks[$value['tid']]=$value;
		}
		set_cache('task','task',$tasks,0);
	}
	return $tasks;
}
function gettask($tid){
	lib_database::rquery('select * from '.tname('task').' where tid in('.$tid.')');
	while ($rt = lib_database::fetch_one())
	{
		$rt['rule']=unserialize($rt['rule']);
		$task[] = $rt;
	}
	//	$task=lib_database::get_one('select * from '.tname('task').' where tid in('.$tid.')');
	//	$task['rule']=unserialize($task['rule']);
	return $task;
}
//获取申请记录
function get_apply_log($aid,$type){
	return lib_database::get_one('select * from '.tname('applylog').' where aid='.$aid.' AND idtype=\''.$type.'\'');
}
//派发
function payment(){
	$jsonp_callback=request('callback','');
	$aid=request('aid');
	$type=request('type');
	if(empty($aid) || empty($type)){
		echo $jsonp_callback.'({"code":-1,"msg":"<p>派发操作错误，请重试</p>"})';
		exit();
	}
	if(!empty($aid)){
		//获取申请记录
		$apply=get_apply_log($aid,$type);
		if(empty($apply)){
			echo $jsonp_callback.'({"code":-2,"msg":"<p>申请记录不存在</p>"})';
			exit();
		}
		//修改派发人数
		lib_database::update('applylog',array('status'=>1),'aid='.$aid);
		if(intval($apply['status'])==0){
			if($apply['idtype']=='try'){
				lib_database::query('update '.tname('try').' set `payment`=`payment`+1 where id='.$apply['id']);
			}
			if($apply['idtype']=='exchange'){
				lib_database::query('update '.tname('try').' set `apply`=`apply`+1 where id='.$apply['id']);
			}
			echo $jsonp_callback.'({"code":0,"msg":"<p>处理成功，尽快发货</p>","aid":'.$aid.'})';
			exit();
		}
	}
	echo $jsonp_callback.'({"code":-3,"msg":"<p>派发操作错误，请重试</p>"})';
	exit();
}
//发货
function ship(){
	$jsonp_callback=request('callback','');
	$aid=request('aid');
	$type=request('type');
	$payment=request('payment');
	if((empty($aid) || empty($type)) && empty($payment)){
		echo $jsonp_callback.'({"code":-2,"msg":"<p>派发操作错误，请重试</p>"})';
		exit();
	}
	//派发表单
	if(!empty($aid)){
		//获取申请记录
		$apply=get_apply_log($aid,$type);
		if(empty($apply)){
			echo $jsonp_callback.'({"code":-2,"msg":"<p>申请记录不存在</p>"})';
			exit();
		}
		if($apply['status']==1){
			//获取用户地址
			$useraddre=useraddress($apply['uid']);
			$html='<form id=\"ship_form\" method=\"POST\" action=\"?mod=ajax&ac=operat&op=ship&type='.$type.'\"><p><b> 收 货 人 :</b>&nbsp;&nbsp;'.$useraddre['truename'].'</p><p><b>电　　话:</b>&nbsp;&nbsp;'.$useraddre['mobile'].'</p><p><b>用户地址:</b>&nbsp;&nbsp;'.$useraddre['province'].','.$useraddre['city'].','.$useraddre['county'].'&nbsp;&nbsp;'.$useraddre['addr'].'</p><p><b>邮　　编:</b>&nbsp;&nbsp;'.$useraddre['postcode'].'</p><p><b>快递单号:</b>&nbsp;&nbsp;<input type=\"text\" name=\"payment[order]\" class=\"textinput w60\" value=\"'.$apply['order'].'\"  /></p><input type=\"hidden\" name=\"payment[aid]\" value=\"'.$aid.'\"/><input type=\"hidden\" name=\"payment[status]\" value=\"'.$apply['status'].'\"/></form>';
			echo $jsonp_callback.'({"code":-2,"msg":"'.$html.'"})';
			exit();
		}else{
			echo $jsonp_callback.'({"code":-2,"msg":"操作错误"})';
			exit();
		}
	}
	//派发
	if(!empty($payment)){
		if(empty($payment['order'])){
			show_message('派发失败','请填写快递单号',-1);
			exit();
		}
		//修改记录状态
		if(intval($payment['status'])==1){
			lib_database::update('applylog',array('status'=>2,'order'=>$payment['order']),'aid='.$payment['aid']);
		}
		if($type=='try'){
			$ac='trylog';
		}elseif ($type==''){
			$ac='exclog';
		}
		show_message('派发成功', '派发成功', '?mod=user&ac='.$ac.'&op=ship');
	}
}
//拒绝
function applyrefuse(){
	$jsonp_callback=request('callback','');
	$aid=request('aid');
	$type=request('type');
	if(!empty($aid)){
		//获取申请记录
		$apply=get_apply_log($aid,$type);
		if(empty($apply)){
			echo $jsonp_callback.'({"code":-2,"msg":"<p>申请记录不存在</p>"})';
			exit();
		}
		if(intval($apply['status'])==0){
			lib_database::update('applylog',array('status'=>-1),'aid='.$aid.' and idtype=\''.$type.'\'');
			echo $jsonp_callback.'({"code":0,"msg":"<p>拒绝成功</p>","data":"'.$aid.'"})';
			exit();
		}
	}
	echo $jsonp_callback.'({"code":-2,"msg":"操作错误"})';
	exit();
}
//添加修改管理员
function manager($user){
	global $access,$_webset;
	//检测用户名合法性
	if( !lib_validate::email($user['email']) )
	{
		throw new Exception('邮箱格式不正确！');
		return -2;
	}
	$loginpwd=$user['userpwd'];
	//验证密码
	if(preg_match('/[^\x00-\x80]+/',$user['userpwd']) || strlen($user['userpwd'])<6 || strlen($user['userpwd'])>16){
		throw new Exception('密码格式不合法！');
		return -4;
	}else{
		$user['userpwd']=$access->_get_encodepwd($user['userpwd']);
	}
	//保存用户
	$user['sta']=1;
	//用户组
	if(!empty($user['uid'])){
		lib_database::update('users',$user,'uid='.$user['uid']);
	}else{
		$user['groups']='admin-admin';
		$user['apps']='admin';
		//判断用户是否存在
		$ishade=lib_database::get_one('select count(*) as ishade from '.tname('users').' where user_name=\''.$user['user_name'].'\' OR email=\''.$user['email'].'\'');
		if(!empty($ishade['ishade'])){
			throw new Exception('此用户名或邮箱已存在！');
			return -5;
		}
		lib_database::insert('users',array_keys($user),$user);
	}
	return true;
}
//获取管理员信息
function getmanager($uid){
	return lib_database::get_one('select * from '.tname('users').' where uid='.$uid);
}
//添加敏感词
function sensitive($sensitive){
	$sensitive = <<<EOT
<?php
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
return '$sensitive';
?>
EOT;
	file_put_contents(FILTER_WORD, $sensitive);
}

function getcenter(){
	global $_timestamp;
	$num=array();
	//宝贝报名
	$num['goods_apply']=lib_database::get_rows_num('goods','status=0');
	//试用报名
	$num['try_apply']=lib_database::get_rows_num('try','status=0');
	//兑换报名
	$num['try_exchange']=lib_database::get_rows_num('exchange','status=0');

	//评论审核
	$num['comment_audit']=lib_database::get_rows_num('comment','status=0 and idtype=\'goods\'');
	//试用申请debug
	$num['try_audit']=lib_database::get_rows_num('applylog','idtype=\'try\'');
	//礼品兑换debug
	$num['exchange_audit']=lib_database::get_rows_num('comment','idtype=\'exchange\'');

	//会员数量
	$num['user']=lib_database::get_rows_num('users','apps=\'home\'');
	//今日注册
	$num['today_user']=lib_database::get_rows_num('users','regtime>'.strtotime('today').' and regtime<'.strtotime('tomorrow'));
	//今日签到
	$num['today_sign']=lib_database::get_rows_num('users_home_fields','lastsign>'.strtotime('today').' and lastsign<'.strtotime('tomorrow'));
	//用户评论
	$num['comment']=lib_database::get_rows_num('comment','status=1');
	//试用晒单
	$sql = 'SELECT count(*) AS total FROM '.tname('comment').' as a LEFT JOIN '.tname('applylog').' as b ON a.id=b.aid WHERE a.idtype=\'sun\' and b.idtype=\'try\' and b.status=3';
	$result = lib_database::rquery($sql);
	$tmp = lib_database::fetch_one();
	$num['try_sun']=(empty($tmp)) ? false : $tmp['total'];
	//兑换晒单:
	$sql = 'SELECT count(*) AS total FROM '.tname('comment').' as a LEFT JOIN '.tname('applylog').' as b ON a.id=b.aid WHERE a.idtype=\'sun\' and b.idtype=\'exchange\' and b.status=3';
	$result = lib_database::rquery($sql);
	$tmp = lib_database::fetch_one();
	$num['exchange_sun']=(empty($tmp)) ? false : $tmp['total'];

	//宝贝数量
	$num['goods_num']=lib_database::get_rows_num('goods','status=1');
	//今日上新
	$num['today_goods_num']=lib_database::get_rows_num('goods','status=1 and start>='.strtotime('today').' and start<'.strtotime('tomorrow'));
	//抢光了
	$num['issteal_goods_num']=lib_database::get_rows_num('goods','issteal=1');
	//过期宝贝
	$num['over_goods_num']=lib_database::get_rows_num('goods','status=1 and end<'.strtotime('today'));
	//未开始宝贝
	$num['nostart_goods_num']=lib_database::get_rows_num('goods','start>'.$_timestamp);
	return jsonp(json_encode($num));
}
//精品采集对应分类
function boutiquecidtocat(){
	$getcatboutique=system::getcatgather();
	$boutiquecat=array();
	if(is_array($getcatboutique) && !empty($getcatboutique)){
		foreach ($getcatboutique as $key=>$value){
			$v_boutiquecat=array_flip(unserialize($value['boutiquecat']));
			foreach ($v_boutiquecat as $k=>$val){
				$boutiquecat[$k]=$key;
			}
		}
	}
	return json_encode($boutiquecat);
}
//审核评论
function commonaudit($cid){
	lib_database::update('comment',array('status'=>1),'cid='.$cid);
}
//检测图片是否为本地
function check_img($url){
	preg_match("/^(http:\/\/).*?/",$url,$server);
	if(empty($server[1])){
		return true;
	}
	return false;
}
//=================================================================
function dunserialize($data) { 
	if(($ret = unserialize($data)) === false) { 
		$ret = unserialize(stripslashes($data)); 
	} 
	return $ret; 
}
function getimportdata($data,$name = '', $addslashes = 0, $ignoreerror = 0) {
	require_once './lib/func/xml.func.php';
	$xmldata = xml2array($data);
	if(!is_array($xmldata) || !$xmldata) {
		if(!$ignoreerror) {
			show_message('系统提示','数据无法识别，请返回。',-1);
		} else {
			return array();
		}
	} else {
		if($name && $name != $xmldata['Title']) {
			if(!$ignoreerror) {
				show_message('系统提示','数据类型错误，请返回',-1);
			} else {
				return array();
			}
		}
		$data = exportarray($xmldata['Data'], 0);
	}
	if($addslashes) {
		$data = daddslashes($data, 1);
	}
	return $data;
}
function exportarray($array, $method) {
	$tmp = $array;
	if($method) {
		foreach($array as $k => $v) {
			if(is_array($v)) {
				$tmp[$k] = exportarray($v, 1);
			} else {
				$uv = unserialize($v);
				if($uv && is_array($uv)) {
					$tmp['__'.$k] = exportarray($uv, 1);
					unset($tmp[$k]);
				} else {
					$tmp[$k] = $v;
				}
			}
		}
	} else {
		foreach($array as $k => $v) {
			if(is_array($v)) {
				if(substr($k, 0, 2) == '__') {
					$tmp[substr($k, 2)] = serialize(exportarray($v, 0));
					unset($tmp[$k]);
				} else {
					$tmp[$k] = exportarray($v, 0);
				}
			} else {
				$tmp[$k] = $v;
			}
		}
	}
	return $tmp;
}
function dhtmlspecialchars($string, $flags = null) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = dhtmlspecialchars($val, $flags);
		}
	} else {
		if($flags === null) {
			$string = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string);
			if(strpos($string, '&amp;#') !== false) {
				$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4}));)/', '&\\1', $string);
			}
		} else {
			if(PHP_VERSION < '5.4.0') {
				$string = htmlspecialchars($string, $flags);
			} else {
				$string = htmlspecialchars($string, $flags, 'UTF-8');
			}
		}
	}
	return $string;
}
?>
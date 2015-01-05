<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @author		bank
 * @link		http://www.wangyue.cc
 * @common.fun.php
 * =================================================
*/
require PATH_APP.'/lib/list.fun.php';

function data_callback($data=array()){
	show_app_msg(true,'',$data);
}
function show_app_msg($err,$errorMsg,$data=array()){
	$data=array('err'=>$err,'errorMsg'=>$errorMsg,'data'=>$data);
	echo json_encode($data);
	exit();
}
/*获取应用操作系统*/
function get_app_os(){
	return request('os','android');
}
/*获取当前版本*/
function get_app_versions(){
	return request('v','0');
}
/**
 * app安全性检测
 *
 */
function check_safety(){
	global $_webset;
	$forms=lib_request::$forms;
	ksort($forms);
	if(empty($forms['hash'])){
		show_app_msg(false,'hash不存在');
	}
	$hash=$forms['hash'];
	unset($forms['hash'],$forms['mod'],$forms['ac'],$forms['op']);//debug
	$forms_str='';
	foreach ($forms as $key=>$value){
		$forms_str.='&'.$key.'='.$value;
	}
	$forms_str=trim($forms_str,'&');

	$data_hash=md5(md5($forms_str).$_webset['android_secretkey']);
	if($hash!=$data_hash){
		show_app_msg(false,'hash error');
	}
}
/*系统设置*/
function sys_seting(){
	global $_webset;
	$seting=array(
	'statistics'=>$_webset['android_statistics'],//统计代码
	'updatetime'=>!empty($_webset['android_updatetime'])?$_webset['android_updatetime']:'16',//明日预告更新时间
	'goodsbg'=>$_webset['site_url'].'/'.$_webset['android_goodsbg'],//产品加载图片
	'logo'=>$_webset['site_url'].'/'.$_webset['android_logo'],//app顶部logo
	'bgtext'=>$_webset['android_bgtext'],
	'albut'=>$_webset['site_url'].'/?mod=android&ac=about',
	'help'=>$_webset['site_url'].'/?mod=android&ac=about',
	//推送
	'push_appkey'=>$_webset['android_push_appkey'],
	'push_secret'=>$_webset['android_push_secret'],
	);
	data_callback($seting);
}
/*推荐app*/
function get_sys_recapp(){
	global $_webset;
	$app=get_android_app();
	foreach ($app as $key=>$value){
		$array[]=array('img'=>$_webset['site_url'].'/'.$value['img'],'title'=>$value['title'],'intro'=>$value['intro'],'url'=>$value['href']);
	}
	data_callback($array);
}
/*首页幻灯广告*/
function get_sys_ad(){
	global $_webset;
	$ad=get_android_ad();
	foreach ($ad as $key=>$value){
		$array[]=array('img'=>$_webset['site_url'].'/'.$value['img'],'title'=>$value['title'],'intro'=>$value['title'],'url'=>$value['href']);
	}
	data_callback($array);
}
/*获取用户的意见反馈*/
function get_sys_feed(){
	$uid=request('uid',0);
	$id=request('id',0);
	if(empty($id)){
		show_app_msg(false,'操作错误',array());
	}
	$array=array(
	array('content'=>'这个产品很好','addtime'=>'2014-8-19','type'=>'1'),
	array('content'=>'谢谢你的支持，我们会努力的','addtime'=>'2014-8-20','type'=>'2'),
	);
	data_callback($array);
}
/**
 * 提交意见反馈
 *
 */
function get_sys_dofeed(){
	$uid=request('uid',0);
	$id=request('id',0);
	$conten=request('conten','');
	if(empty($id) && empty($conten)){
		show_app_msg(false,'操作错误',array());
	}
	data_callback(array());
}
//检测是否有更新
function app_up(){
	global $_webset,$_versions;
	//无新版本
	if($_versions>=$_webset['android_versions']){
		$arr=array('needup'=>false,'msg'=>'您的是最新版本','newv'=>$_webset['android_versions']);
	}else{
		//有更新
		$arr=array('needup'=>true,'msg'=>$_webset['android_upgrade'],'newv'=>$_webset['android_versions'],'url'=>$_webset['android_versions']);
	}
	data_callback($arr);
}
/**用户接口相关**********************************/
/**
 * 快捷登录处理
 *
 */
function user_fast_login(){
	global $_timestamp;
	$api=request('api');
	$token=request('token');
	$username=request('username');
	$apiuid=request('apiuid');
	$data=request('data');
	if(empty($api) || empty($token) || empty($username) || empty($apiuid)){
		show_app_msg(false,'数据错误,请重新登录');
	}
	$hash=md5(md5($apiuid).md5($api));
	//快捷登录
	$uid=user_connect($api,$username,$token,$apiuid,$hash);
	$user=get_user_info('a.`uid`='.$uid,APPNAME);
	$user['user_name']=empty($user['user_name'])?"未设置昵称":$user['user_name'];
	//用户头像
	$user['avatar']=avatar($user['uid'],'big');
	data_callback($user);
}
/**
 * 用户登录
 *
 */
function app_user_login(){
	global $_webset;
	$uname=request('uname','');
	$pwd=request('pwd','');

	if(empty($uname)){
		show_app_msg(false,'请填写用户名');
	}
	if(empty($pwd)){
		show_app_msg(false,'请填写密码');
	}
	$ftype = 'user_name';
	if( lib_validate::email($uname) )
	{
		$ftype = 'email';
	}elseif (lib_validate::mobile($uname)){
		$ftype = 'mobile';
	}
	$user=user_app_login($uname,$pwd,$ftype);
	if(empty($user)){
		show_app_msg(false,'用户名或密码错误');
	}
	$user['user_name']=empty($user['user_name'])?"未设置昵称":$user['user_name'];
	//用户头像
	$user['avatar']=$_webset['site_url'].'/'.avatar($user['uid'],'big');
	//收藏数量
	data_callback($user);
}
/**
 * 用户注册
 *
 */
function app_user_register(){
	$username=request('uname','');
	$email=request('email','');
	$password=request('pwd','');
	$repassword=request('repwd','');
	if(empty($username)){
		show_app_msg(false,'请填写用户名');
	}
	if(empty($email)){
		show_app_msg(false,'请填写邮箱');
	}
	if(empty($password) || empty($repassword) || $password!=$repassword){
		show_app_msg(false,'确认密码错误');
	}
	//注册用户
	$register=array();
	//检测邮箱是否正确
	if( !lib_validate::email($email))
	{
		show_app_msg(false,'邮箱格式不正确！');
	}
	//验证用户名是否合法
	if( !lib_validate::user_name($username))
	{
		show_app_msg(false,'昵称格式不正确(4-20个字符)！');
	}
	//验证密码
	if(preg_match('/[^\x00-\x80]+/',$password) || strlen($password)<6 || strlen($password)>16){
		show_app_msg(false,'密码格式不合法6-16个字符！');
	}
	//验证邮箱是否被使用
	if(check_account_exist($email,'email')){
		show_app_msg(false,'该邮箱已被用过啦！');
	}
	//用户名是否被占用
	if(check_account_exist($username,'user_name')){
		show_app_msg(false,'昵称被占用啦！');
	}
	$user['user_name']= $username;
	$user['email']= $email;
	$user['userpwd']=lib_access::_get_encodepwd($password);
	$user['uid']=save_user($user);
	unset($user['userpwd']);
	data_callback($user);
}
/**
 * app用户忘记密码
 * 
 */
function app_user_forget(){
	$email=request('email');
	if(empty($email)){
		show_app_msg(false,'请填写邮箱');
	}
	show_app_msg(true,'找回密码邮件已经发送，请去邮箱查收');
}
/**
 * 获取用户收藏
 *
 */
function app_user_fav(){
	global $_timestamp;
	$uid=request('uid');
	$type=request('type',0);
	$page=request('page',1);
	$data=app_user_fav_goode($uid,$type,$page);
	data_callback($data);
}

/**
 * 检测是否已收藏
 *
 * @param unknown_type $gid
 * @param unknown_type $uid
 */
function check_faved($gid,$uid){
	return lib_database::get_rows_num('users_fav','gid='.$gid.' and uid='.$uid);
}
/**
 * 删除收藏
 *
 */
function del_user_fav($gid,$uid){
	lib_database::delete('users_fav','gid='.$gid.' and uid='.$uid);
}
/**
 * 收藏
 *
 */
function app_user_dofav(){
	global $_timestamp;
	$gid=request('id',0);
	$uid=request('uid',0);
	if(empty($gid) || empty($uid)){
		show_app_msg(false,'操作错误');
	}
	if(check_faved($gid,$uid)){
		//取消收藏
		del_user_fav($gid,$uid);
		show_app_msg(true,'取消成功');
	}
	lib_database::wquery('insert ignore into '.tname('users_fav').' (`uid`,`gid`,`addtime`) VALUES (\''.$uid.'\',\''.$gid.'\',\''.$_timestamp.'\')');
	show_app_msg(true,'收藏成功');
}
/**
 * 用户签到
 *
 */
function app_user_sign(){
	global $_webset,$_timestamp;
	$uid=request('uid',0);
	$type=request('type',0);
	if(empty($uid)){
		show_app_msg(false,'请先登录');
	}
	//当天是否已签到
	$signed=false;
	//连续签到天数
	$signday=1;
	//获取用户签到信息
	$user=get_user_info('a.`uid`='.$uid,APPNAME);
	//已经签过到
	if($user['lastsign']>strtotime('today')){
		$signed=true;
		$today_sign=user_sign($uid,$user['sign'],0);
	}elseif($user['lastsign']>strtotime('yesterday')){
		$signday=$user['sign']+1;
		$today_sign=user_sign($uid,$signday,2);
	}else{
		//没有连续签到
		$today_sign=user_sign($uid,$signday,2);
	}
	//下次签可获取的积分======================================================================
	$next_sign=user_sign($uid,$signday+1,0);
	//处理返回数据===========================================================================
	$sign=array('integral'=>$user['integral'],
	'hadesing'=>$signed,
	'add'=>$today_sign,
	'next'=>$next_sign,
	'times'=>$signday
	);
	//type=0签到|不等于1是查询状态
	if($type==0){
		if($signed){
			show_app_msg(false,'今天已经签过到,明天签到+'.$next_sign,$sign);
		}else{
			show_app_msg(true,'签到成功+'.$today_sign,$sign);
		}
	}else{
		show_app_msg(true,'',$sign);
	}
}
/**
 * 用户任务其任务状态
 *
 */
function app_user_task(){
	global $_timestamp,$_webset,$config;
	$uid=request('uid',0);
	//获取用户信息
	$user=get_user_info('a.`uid`='.$uid,APPNAME);
	//生成一个token
	$token=passport_encrypt($user['user_name'].' '.$uid,$config['authkey']);
	//任务列表
	$task[]=array('img'=>$_webset['site_url'].'/'.PATH_APP.'/static/images/task/task_userinfo.png','title'=>'完善注册信息','integral'=>'+'.$_webset['reward_user_perfect'].INTEGRAL,'des'=>'完善账号的注册资料。','status'=>empty($user['perfect'])?0:1,'url'=>$_webset['site_url'].'/?mod=android&ac=task&op=fields&token='.urlencode($token));
	if(1==$_webset['email_open'] && !empty($_webset['reward_auth_email'])){
		$task[]=array('img'=>$_webset['site_url'].'/'.PATH_APP.'/static/images/task/task_checkemail.png','title'=>'验证电子邮件','integral'=>'+'.$_webset['reward_auth_email'].INTEGRAL,'des'=>'通过邮件完成电子邮箱的验证。','status'=>empty($user['sta'])?0:1,'url'=>$_webset['site_url'].'/?mod=android&ac=task&op=email&token='.urlencode($token)); 
	}
	//array('img'=>$_webset['site_url'].'/'.PATH_APP.'/static/images/task/task_checkphone.png','title'=>'验证手机号','integral'=>"+50",'des'=>'通过短信完成手机号的验证。','status'=>$user['mobile_check'],'url'=>'http://user.coubei.com/?mod=apptask&ac=phone&token='.urlencode($token)),
	data_callback($task);
}
/*产品相关*************************************************************/
/**
 * 获取分类列表
 *
 * @return unknown
 */
function get_app_cat(){
	global $_webset;
	//调用分类列表
	$cat=getgoodscat();
	$array=array();
	$array[]=array('cname'=>'全部','cid'=>array("0"),'img'=>$_webset['site_url'].'/'.PATH_APP.'/static/images/cat/cat_0.png','imghover'=>$_webset['site_url'].'/'.PATH_APP.'/static/images/cat/cat_0.png','sort'=>0);
	foreach ($cat as $key=>$value){
		$array[]=array('cname'=>$value['title'],'cid'=>array($value['id']),'img'=>$_webset['site_url'].'/'.PATH_APP.'/static/images/cat/cat_'.$value['id'].'.png','imghover'=>$_webset['site_url'].'/'.PATH_APP.'/static/images/cat/cat_'.$value['id'].'_s.png','sort'=>$value['sort']);
	}
	data_callback($array);
}
/**
 * 获取系统频道配置
 *
 */
function get_app_channel(){
	global $_webset;
	$nav=get_nav_add();
	$app_channel=array();
	$i=1;
	foreach ($nav as $key=>$value){
		$app_channel[$i]=array('title'=>$value['title'],'nid'=>$value['nid'],'type'=>$value['type'],'img'=>$_webset['site_url'].'/'.$value['img'],'imghover'=>$_webset['site_url'].'/'.$value['imghover'],'sort'=>$value['sort'],'home'=>!empty($value['home'])?true:false);
		$i++;
	}
	data_callback($app_channel);
}
/**
 * APP商品列表
 *
 */
function get_app_goods(){
	global $_timestamp,$_webset;
	//获取系统频道
	$nav=get_nav_add();
	$_webset['android_pagenum']=!empty($_webset['android_pagenum'])?$_webset['android_pagenum']:30;
	$data=array();
	$nid=intval(request('nid',0));//频道
	$cid=intval(request('cid',0));//分类
	$aid=intval(request('aid',0));//专题
	$keyword=request('keyword','');//关键词
	$page=request('page',1);//分页
	//品牌折扣
	if (!empty($nid) && 'brands'==$nav[$nid]['type']){
		//品牌折扣
		$query=lib_database::rquery('select `id`,`title`,`channel`,`cat`,`price`,`promotion_price`,`discount`,`volume`,`nick`,`seller_id`,`site`,`num_iid`,`pic`,`taopic`,`taopicl`,`sort`,`ispost`,`isvip`,`isrec`,`issite`,`uid`,`ispaigai`,`issteal`,`addtime`,`start`,`end`,`remark`,`fav`,`status`,`pay_type`,`pay_id`,`pay_money`,`pay_serialno`,`aid`,`gid` from '.tname('goods').' where `channel`='.brandNid().' AND end>'.$_timestamp.' ORDER BY `start` DESC');
		$brands=$brand=array();
		while ($rt = lib_database::fetch_one())
		{
			if(!empty($rt['cat']) && !isset($brand[$rt['cat']])){
				$brand[$rt['cat']]=lib_database::get_one('select * from '.tname('brand').' where bid='.$rt['cat']);
			}
			$brands[$rt['cat']]['num']+=1;
			$brands[$rt['cat']]['title']=$brand[$rt['cat']]['brand'];
			$brands[$rt['cat']]['pic']=$brand[$rt['cat']]['pic'];
			$brands[$rt['cat']]['preferential']=$brand[$rt['cat']]['preferential'];
			$brands[$rt['cat']]['logo']=$brand[$rt['cat']]['logo'];
			$brands[$rt['cat']]['bid']=$rt['cat'];
			//折扣
			$good['id']=$rt['id'];
			$good['title']=$rt['title'];
			$good['discount']=sprintf("%.2f",$rt['promotion_price']/$rt['price'])*10;
			$good['promotion_price']=preg_replace('/(\.0)+$/i','',number_format($rt['promotion_price'],1));
			$good['price']=preg_replace('/(\.0)+$/i','',number_format($rt['price'],1));
			$good['site']=$rt['site'];
			$good['num_iid']=$rt['num_iid'];
			$good['channel']='';//修改成名字
			$good['volume']=$rt['volume'];
			$good['nick']=$rt['nick'];
			$good['pic']=(!empty($rt['pic'])?$rt['pic']:$rt['taopic']).'_310x310.jpg';
			$good['start']=$rt['start'];
			$good['end']=$rt['end'];
			$good['remark']=$rt['remark'];
			$good['fav']=intval($rt['fav']);
			if($good['start']>$_timestamp){
				$good['status']=2;
				$good['buttxt']=$_webset['android_nostartbtn_txt'];
			}elseif ($good['end']>$_timestamp){
				$good['status']=1;
				$good['buttxt']=$_webset['android_buybtn_txt'];
			}else{
				$good['status']=3;
				$good['buttxt']=$_webset['android_overbtn_txt'];
			}
			$good['click_url']=app_goods_go($rt['num_iid']);
			$brands[$rt['cat']]['goods'][] = $good;
		}
		foreach ($brands as $key=>$value){
			$data[]=array('num'=>$value['num'],'title'=>$value['title'],'pic'=>$value['pic'],'preferential'=>$value['preferential'],'logo'=>$value['logo'],'bid'=>$value['bid'],'goods'=>$value['goods']);
		}
	}else{
		//组合条件
		$where=array();
		!empty($keyword) && $where[]="(`title` LIKE BINARY '%{$keyword}%' OR `nick` LIKE BINARY '%{$keyword}%')";
		!empty($cid) && $where[]='`cat`='.$cid;
		//所有产品频道
		if ('tomorrow'==$nav[$nid]['type']){
			$where[]='`start`>='.strtotime('tomorrow');
		}else{
			$where[]='`start`<'.strtotime('tomorrow');
			if ('goods'==$nav[$nid]['type'] && !empty($nav[$nid]['nav'])){
				foreach ($nav[$nid]['nav'] as $nav_id){
					!empty($nav_id) && $where_nav[]='`channel`='.$nav_id;
				}
				!empty($where_nav) && $where[]='('.implode(' OR ',$where_nav).')';
			}
		}
		$data=app_goods($where,'',$page,$_webset['android_pagenum']);
	}
	data_callback($data);
}
/*宝贝详细*/
function get_goods_detail(){
	global $_timestamp,$_webset;
	$id=request('id',0);
	$uid=request('uid',0);
	$goods=get_goods_appby_id($id);
	if(!empty($goods)){
		$goods['isfav']=false;
		if(!empty($uid) && check_faved($id,$uid)){
			$goods['isfav']=true;
		}
		$goods['share_url']=$goods['click_url'];
		$goods['share_title']=$_webset['android_sharetxt'];
	}
	data_callback($goods);
}
/*app宝贝调用*/
function app_goods($where,$sort,$page,$limit=20){
	global $_timestamp,$_webset;
	$start=$limit*($page-1);
	$countwhere=$wherestr=!empty($where)?implode(' AND ',$where):'1';

	$base_order=preg_replace("/(start|promotion_price|discount|volume)_(desc|asc)/",'`$1` $2',$_webset['base_order']);
	$base_order=!empty($base_order)?$base_order:'';
	$order=empty($order)?'`sort` desc,day desc,isrec<>1,'.$base_order:$order;
	$wherestr .=' ORDER BY '.$order;
	if ($start > -1 && $limit > 0)
	{
		$wherestr .= " LIMIT {$start}, {$limit}";
	}
	$query = lib_database::rquery('select `id`,`title`,`channel`,`cat`,`price`,`promotion_price`,`discount`,`volume`,`nick`,`seller_id`,`site`,`num_iid`,`pic`,`taopic`,`taopicl`,`sort`,`ispost`,`isvip`,`isrec`,`issite`,`uid`,`ispaigai`,`issteal`,`addtime`,`start`,`end`,`remark`,`fav`,`status`,`pay_type`,`pay_id`,`pay_money`,`pay_serialno`,`aid`,`gid`,FROM_UNIXTIME(`start`,"%Y%m%d") as day from '.tname('goods').' where '.$wherestr);
	$data=array();
	while ($rt = lib_database::fetch_one($query))
	{
		$rt['discount']=sprintf("%.2f",$rt['promotion_price']/$rt['price'])*10;
		$rt['promotion_price']=preg_replace('/(\.0)+$/i','',number_format($rt['promotion_price'],1));
		$rt['price']=preg_replace('/(\.0)+$/i','',number_format($rt['price'],1));
		//特别处理一下pic
		$rt['pic']=$rt['pic'].'_310x310.jpg';
		unset($rt['taobao_pic']);
		if($rt['start']>$_timestamp){
			$rt['status']=2;
			$rt['buttxt']=$_webset['android_nostartbtn_txt'];
		}elseif ($rt['end']>$_timestamp){
			$rt['status']=1;
			$rt['buttxt']=$_webset['android_buybtn_txt'];
		}else{
			$rt['status']=3;
			$rt['buttxt']=$_webset['android_overbtn_txt'];
		}
		//'fav'=>1
		$rt['click_url']=app_goods_go($rt['num_iid']);
		$data[] = $rt;
	}
	$output = array();
	$total = lib_database::rquery('SELECT COUNT(*) AS rows from '.tname('goods').' where '.$countwhere);
	$total = lib_database::fetch_one();
	$output['num'] = $total['rows'];
	$output['goods'] = $data;
	$output['pagenum']=ceil($total['rows']/$limit);
	$output['page']=$page;
	return $output;
}
/*宝贝详细*/
function get_goods_appby_id($id){
	global $_webset;
	$goods=lib_database::get_one('select `id`,`title`,`channel`,`cat`,`price`,`promotion_price`,`discount`,`volume`,`nick`,`seller_id`,`site`,`num_iid`,`pic`,`taopic`,`taopicl`,`sort`,`ispost`,`isvip`,`isrec`,`issite`,`uid`,`ispaigai`,`issteal`,`addtime`,`start`,`end`,`remark`,`fav`,`status`,`pay_type`,`pay_id`,`pay_money`,`pay_serialno`,`aid`,`gid` from '.tname('goods').' where id='.$id);
	if(!empty($goods)){
		$goods['discount']=sprintf("%.2f",$goods['promotion_price']/$goods['price'])*10;
		$goods['promotion_price']=preg_replace('/(\.0)+$/i','',number_format($goods['promotion_price'],1));
		$goods['price']=preg_replace('/(\.0)+$/i','',number_format($goods['price'],1));
		//特别处理一下pic
		$goods['pic']=$goods['pic'].'_310x310.jpg';
		//
		$goods['remark']='';
		$goods['fav']=0;
		unset($goods['taobao_pic']);
		if($goods['start']>$_timestamp){
			$goods['status']=2;
			$goods['buttxt']=$_webset['android_nostartbtn_txt'];
		}elseif ($rt['end']>$_timestamp){
			$goods['status']=1;
			$goods['buttxt']=$_webset['android_buybtn_txt'];
		}else{
			$goods['status']=3;
			$goods['buttxt']=$_webset['android_overbtn_txt'];
		}
		//'fav'=>1
		$goods['click_url']=app_goods_go($goods['num_iid']);
		return $goods;
	}else{
		show_app_msg(false,'操作错误,数据不存在',array());
	}
}
/*用户快捷登录操作*/
function user_connect($api,$username,$token,$apiuid,$hash,$synchronous=0){
	global $_timestamp;
	//判断是否绑定
	$row=lib_database::get_one('select * from '.tname('users').'_token where hash=\''.$hash.'\' and apps=\''.APPNAME.'\'');
	$uid=$row['uid'];
	if(empty($uid)){
		//记录数据
		$user_name='';
		if(!empty($synchronous)){
			//验证用户名是否存在
			if(lib_validate::user_name($username)){
				//验证是否被占用
				if(!check_account_exist($username,'user_name')){
					$user_name=$username;
				}
			}
		}
		$uid=save_user(array('user_name'=>$user_name));
		$users_fields['uid']=$uid;
		lib_database::insert('users_'.APPNAME.'_fields',array_keys($users_fields),$users_fields);
		//token
		if(!empty($uid)){
			lib_database::insert('users_token',array('uid','apps','name','token','api','apiuid','hash'),array($uid,APPNAME,$username,$token,$api,$apiuid,$hash));
		}
	}else{
		lib_database::update('users_token',array('name'=>$username,'token'=>$token),'uid='.$uid.' and apps=\''.APPNAME.'\' AND api=\''.$api.'\' AND hash=\''.$hash.'\'');
	}
	return $uid;
}
/*app登录*/
function user_app_login($uname,$pwd,$ftype){
	return lib_database::get_one('select * from '.tname('users').' where `'.$ftype.'`=\''.$uname.'\' and `userpwd`=\''.lib_access::_get_encodepwd($pwd).'\'');
}
/*手机签到*/
function user_sign($uid,$signdays,$upsession=0){
	global $_webset,$_timestamp;
	$integral=0;
	if($signdays<$_webset['android_reward_continuous_day']){
		$integral=$_webset['android_reward_sign_day'];
	}elseif ($signdays>=$_webset['android_reward_continuous_day']){
		$series=floor($signdays/$_webset['android_reward_continuous_day']);//连续几个基准
		$integral=$integral+($_webset['android_reward_plus'])*$series;
	}
	$integral=$integral>$_webset['android_reward_daymax']?$_webset['android_reward_daymax']:$integral;
	if($upsession!=0){
		lib_database::wquery('update '.tname('users_'.APPNAME.'_fields').' set `sign`=\''.$signdays.'\',`integral`=`integral`+'.$integral.',`lastsign`='.$_timestamp.' where `uid`='.$uid);
		changelog(array('uid'=>$uid,'integ'=>$signdays,'type'=>'sign','exp'=>date('Y-m-d',$_timestamp).'手机签到','addtime'=>$_timestamp));
	}
	if($upsession==2){
		lib_database::wquery('update '.tname('users_'.APPNAME.'_session').' set `sign`=\''.$signdays.'\',`integral`=`integral`+'.$integral.',`lastsign`='.$_timestamp.' where `uid`='.$uid);
	}
	return $integral;
}
/**
 * app获取用户收藏
 * 
 * $type 0全部|1开枪提醒|2抢购中
 * 
 */
function app_user_fav_goode($uid,$type=0,$page=1,$limitnum=10){
	global $_timestamp,$_webset;
	$wherestr='a.`uid`='.$uid;
	switch ($type){
		case '1':
			$wherestr.=' and b.`start`>'.$_timestamp;
			break;
		case '2':
			$wherestr.=' and b.`start`<'.$_timestamp.' and b.`end`>'.$_timestamp;
			break;
	}
	$start=($page-1)*$limitnum;
	$query=lib_database::rquery('select SQL_CALC_FOUND_ROWS b.`id`,b.`title`,b.`channel`,b.`cat`,b.`price`,b.`promotion_price`,b.`discount`,b.`volume`,b.`nick`,b.`start`,b.`end`,b.`site`,b.`num_iid`,b.`pic`,b.`taopic`,b.`taopicl`,b.`remark` from '.tname('users_fav').' as a LEFT JOIN '.tname('goods').' as b ON a.gid=b.id WHERE '.$wherestr.' AND b.`title` IS NOT NULL ORDER BY a.`addtime` DESC limit '.$start.','.$limitnum);
	//总页数
	$reset=lib_database::get_one('SELECT FOUND_ROWS() as num');
	$reset['goods']=array();
	while ($rt=lib_database::fetch_one($query)){
		$rt['discount']=sprintf("%.2f",$rt['promotion_price']/$rt['price'])*10;
		$rt['promotion_price']=preg_replace('/(\.0)+$/i','',number_format($rt['promotion_price'],1));
		$rt['price']=preg_replace('/(\.0)+$/i','',number_format($rt['price'],1));
		//特别处理一下pic
		$rt['pic']=(!empty($rt['pic'])?$rt['pic']:$rt['taopic']).'_310x310.jpg';
		$rt['remark']='';
		$rt['fav']=0;
		unset($rt['taobao_pic']);
		if($rt['start']>$_timestamp){
			$rt['status']=2;
			$rt['buttxt']=$_webset['android_nostartbtn_txt'];
		}elseif ($rt['end']>$_timestamp){
			$rt['status']=1;
			$rt['buttxt']=$_webset['android_buybtn_txt'];
		}else{
			$rt['status']=3;
			$rt['buttxt']=$_webset['android_overbtn_txt'];
		}
		$rt['click_url']=app_goods_go($rt['num_iid']);
		$reset['goods'][]=$rt;
	}
	return array('num'=>$reset['num'],'page'=>$page,'pagenum'=>$limitnum,'goods'=>$reset['goods']);
}

/**
* Passport 加密函数
*
* @param string 等待加密的原字串
* @param string 私有密匙(用于解密和加密)
*
* @return string 原字串经过私有密匙加密后的结果
*/
function passport_encrypt($txt, $key) {
	//R 使用随机数加密,密钥放在字符前面
	// 使用随机数发生器产生 0~32000 的值并 MD5()
	srand((double)microtime() * 1000000);
	$encrypt_key = md5(rand(0, 32000));

	// 变量初始化
	$ctr = 0;
	$tmp = '';

	// for 循环，$i 为从 0 开始，到小于 $txt 字串长度的整数
	for($i = 0; $i < strlen($txt); $i++) {
		// 如果 $ctr = $encrypt_key 的长度，则 $ctr 清零
		$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
		// $tmp 字串在末尾增加两位，其第一位内容为 $encrypt_key 的第 $ctr 位，
		// 第二位内容为 $txt 的第 $i 位与 $encrypt_key 的 $ctr 位取异或。然后 $ctr = $ctr + 1
		$tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
	}

	// 返回结果，结果为 passport_key() 函数返回值的 base65 编码结果
	return base64_encode(passport_key($tmp, $key)); //R 真正使用密码加密
}

/**
* Passport 解密函数
*
* @param string 加密后的字串
* @param string 私有密匙(用于解密和加密)
*
* @return string 字串经过私有密匙解密后的结果
*/
function passport_decrypt($txt, $key) {
	// $txt 的结果为加密后的字串经过 base64 解码，然后与私有密匙一起，
	// 经过 passport_key() 函数处理后的返回值
	$txt = passport_key(base64_decode($txt), $key); //R 二次加密就是解密
	// 变量初始化
	$tmp = '';
	// for 循环，$i 为从 0 开始，到小于 $txt 字串长度的整数
	for ($i = 0; $i < strlen($txt); $i++) {
		// $tmp 字串在末尾增加一位，其内容为 $txt 的第 $i 位，
		// 与 $txt 的第 $i + 1 位取异或。然后 $i = $i + 1
		$tmp .= $txt[$i] ^ $txt[++$i];  //解密随机加密;
	}
	// 返回 $tmp 的值作为结果
	return $tmp;
}
/**
* Passport 密匙处理函数
*
* @param string 待加密或待解密的字串
* @param string 私有密匙(用于解密和加密)
*
* @return string 处理后的密匙
*/
function passport_key($txt, $encrypt_key) {

	// 将 $encrypt_key 赋为 $encrypt_key 经 md5() 后的值
	$encrypt_key = md5($encrypt_key);

	// 变量初始化
	$ctr = 0;
	$tmp = '';

	// for 循环，$i 为从 0 开始，到小于 $txt 字串长度的整数
	for($i = 0; $i < strlen($txt); $i++) {
		// 如果 $ctr = $encrypt_key 的长度，则 $ctr 清零
		$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr; //R 轮
		// $tmp 字串在末尾增加一位，其内容为 $txt 的第 $i 位，
		// 与 $encrypt_key 的第 $ctr + 1 位取异或。然后 $ctr = $ctr + 1
		$tmp .= $txt[$i] ^ $encrypt_key[$ctr++]; //R 轮翻异或加密;
	}

	// 返回 $tmp 的值作为结果
	return $tmp;

}

function creat_sms_code(){
	list($usec, $sec) = explode(" ", microtime());
	$time=((float)$usec + (float)$sec);
	$time=$time/100;
	$code=end(explode('.', $time));
	$code=$code<100000?$code+100000:$code;
	return $code;
}
/*APP跳转*/
function app_goods_go($iid){
	global $_webset;
	return $_webset['site_url'].'/?mod=android&ac=jump&iid='.$iid;
}
/* End of file common.fun.php */
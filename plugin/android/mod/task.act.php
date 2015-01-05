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
 * @task.act.php
 * =================================================
*/
$ops=array('fields','email','send','checked');
$op=request('op','',$ops);
$formhash=request('formhash','');
if($op=='fields'){
	if(submitcheck('infosubmit',1)){
		$callback=request('callback','');
		$info=request('info');
		$uid=request('uid',0);
		$token=request('token','');
		$emailcode=request('emailcode','');
		if(empty($uid) || empty($token)){
			$result['info']='操作错误';
		}else{
			//info数组
			$info_table=array('alipay'=>'','qq'=>'','sex'=>-1,'year'=>0,'month'=>0,'day'=>0,'province'=>'','city'=>'','county'=>'');
			foreach ($info_table as $key=>$val){
				$info_table[$key]=isset($info[$key])?$info[$key]:'';
			}
			if(!lib_validate::mobile($info_table['alipay']) && !lib_validate::email($info_table['alipay'])){
				$result['info']='支付宝错误';
			}else{
				$user['uid']=$info_table['uid']=$uid;
				updateuser($info_table);
				//确定是否需要奖励
				reward_user_perfect($info_table);
				$result['info']='保存成功';
			}
		}
		if(!empty($callback)){
			echo $callback.'('.json_encode($result).')';
		}else{
			echo json_encode($result);
		}
		exit();
	}
	$tokenstr=$token=request('token','');
	$set_allow=true;
	if(empty($token)){
		$set_allow=false;
	}else{
		$token=passport_decrypt($token,$config['authkey']);
		list($user_name,$uid)=explode(' ',$token);
		if(empty($user_name) || empty($uid)){
			$set_allow=false;
		}elseif (!check_account_exist($uid,'uid')){
			$set_allow=false;
		}
		$user_field=get_user_info('a.`uid`='.$uid,APPNAME);
	}
}if($op=='email'){
	$tokenstr=$token=request('token','');
	$set_allow=true;
	if(empty($token)){
		$set_allow=false;
	}else{
		$token=passport_decrypt($token,$config['authkey']);
		list($user_name,$uid)=explode(' ',$token);
		if(empty($user_name) || empty($uid)){
			$set_allow=false;
		}elseif (!check_account_exist($uid,'uid')){
			$set_allow=false;
		}
	}
}
//发送绑定激活邮件
elseif ($op=='send'){
	$callback=request('callback','');
	$email=request('email','');
	$uid=request('uid',0);
	if (empty($email) || !lib_validate::email($email)){
		$result['info']='邮箱格式错误';
	}elseif (check_account_exist($email,'email')){
		$result['info']='邮箱已经被绑定';
	}else{
		$code=creat_sms_code();
		//判断有没有存在
		$hadesend=lib_database::get_one('select * from '.tname('activating').' where type=\'bind\' and email=\''.$email.'\' and uid='.$uid);
		//保存激活记录
		if(!empty($hadesend)){
			lib_database::update('activating',array('code'=>$code,'addtime'=>$_timestamp,'uid'=>$uid),'type=\'bind\' and email=\''.$email.'\'');
		}else{
			lib_database::insert('activating',array('email','uid','code','addtime','type'),array($email,$uid,$code,$_timestamp,'bind'));
		}
		$content='您的验证码是:['.$code.']请不要把验证码泄露给其他人.如非本人操作,可不用理会!';
		send_email($email,$_webset['site_name']."APP邮箱激活",$content);
		$result['info']='激活邮件已经发送';
	}
	if(!empty($callback)){
		echo $callback.'('.json_encode($result).')';
	}else{
		echo json_encode($result);
	}
	exit();
}
//验证激活
elseif ($op=='checked'){
	$callback=request('callback','');
	$email=request('email','');
	$uid=request('uid',0);
	$token=request('token','');
	$emailcode=request('emailcode','');
	if(empty($email) || empty($uid) || empty($token)){
		$result['info']='操作错误';
	}elseif (empty($emailcode)){
		$result['info']='请填写正确的验证码';
	}else{
		$activatinglog=activatinglog($emailcode);
		if(empty($activatinglog)){
			$result['info']='验证码超时';
		}
		if((!empty($_webset['base_bindemailactivate']) && (!empty($_webset['base_bindemailactivate']) && $activatinglog['addtime']<$_timestamp-$_webset['base_bindemailactivate']))){
			$result['info']='验证码超时';
		}
		if($activatinglog['type']!='bind'){
			$result['info']='验证码错误';
		}else{
			//验证token
			$token=passport_decrypt($token,$config['authkey']);
			list($token_user_name,$token_uid)=explode(' ',$token);
			if(empty($uid) || $uid!=$token_uid){
				$result['info']='操作错误';
			}else{
				if(empty($email) || !lib_validate::email($email)){
					$result['info']='邮箱格式错误';
				}elseif (check_account_exist($email,'email')){
					$result['info']='邮箱已经被绑定';
				}else{
					reward_auth_email(array('email'=>$email,'sta'=>1,'uid'=>$uid));
					//删除 激活记录
					lib_database::delete('activating','uid=\''.$uid.'\' and email=\''.$email.'\' and type=\'bind\'');
					$result['info']='绑定成功';
				}
			}
		}
	}
	if(!empty($callback)){
		echo $callback.'('.json_encode($result).')';
	}else{
		echo json_encode($result);
	}
	exit();
}
require tpl_plugin('task.tpl.php');
/* End of file task.act.php */
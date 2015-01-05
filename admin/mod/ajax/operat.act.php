<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @goods.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
$op=request('op');
$jsonp_callback=request('callback','');

switch ($op){
	case 'status':
		$id=request('id',0);
		$field=request('field','');
		if(!empty($id) || !empty($field)){
			//改变状态
			upgoodstatus($id,$field);
			//如果正确
			echo $jsonp_callback.'({"field":"'.$field.'","id":"'.$id.'","code":0,"msg":"修改成功"})';
		}else{
			echo $jsonp_callback.'({"code":-1,"msg":"操作失败"})';
		}
		break;
	case 'audit':
		$id=request('id',0);
		$start=request('start');
		$end=request('end');
		$type=request('type');
		if(!empty($id) && !empty($type)){
			if(!empty($start) || !empty($end)){
				//改变状态
				if($type=='try' || $type=='exchange'){
					$needintegral=request('needintegral',0);
					audit(array('id'=>$id,'start'=>strtotime($start),'end'=>strtotime($end),'needintegral'=>$needintegral),$type);
				}else{
					audit(array('id'=>$id,'start'=>strtotime($start),'end'=>strtotime($end)),$type);
				}
				//如果正确
				echo $jsonp_callback.'({"id":"'.$id.'","code":0,"msg":"修改成功"})';
			}else{
				echo $jsonp_callback.'({"code":-2,"msg":"请设置时间"})';
			}
		}else{
			echo $jsonp_callback.'({"code":-1,"msg":"操作失败"})';
		}
		break;
	case 'refuse':
		$id=request('id',0);
		$refuse=request('refuse');
		$type=request('type');
		if(!empty($id) && !empty($type)){
			if(!empty($refuse)){
				//改变状态
				refuse(array('id'=>$id,'refuse'=>$refuse),$type);
				//如果正确
				echo $jsonp_callback.'({"id":"'.$id.'","code":0,"msg":"操作成功"})';
			}else{
				echo $jsonp_callback.'({"code":-2,"msg":"请设置拒绝理由"})';
			}
		}else{
			echo $jsonp_callback.'({"code":-1,"msg":"操作失败"})';
		}
		break;
	case 'testsendmail':
		$email=request('email');
		$_webset['email_open']=$email['email_open'];
		$_webset['email_smtp']=$email['email_smtp'];
		$_webset['email_port']=$email['email_port'];
		$_webset['email_account']=$email['email_account'];
		$_webset['email_password']=$email['email_password'];
		$_webset['email_fromname']=$email['email_fromname'];
		$mail=request('test_email');
		$content=request('test_content');
		if(lib_validate::email($mail)){
			$result=send_email($mail,$content,'您的邮件发送成功');
			if($result){
				echo $jsonp_callback.'({"code":0,"msg":"发送成功"})';
			}else{
				echo $jsonp_callback.'({"code":-1,"msg":"发送失败，请检查设置"})';
			}
		}else{
			echo $jsonp_callback.'({"code":-2,"msg":"邮件格式错误"})';
		}
		break;
	case 'changesort':
		$sort=intval(request('sort'));
		$id=request('id');
		$type=request('type','goods');
		upsort($id,$sort,$type);
		echo $jsonp_callback.'({"code":0,"msg":"操作成功"})';
		break;
	case 'payment':
		payment();
		break;
	case 'ship':
		ship();
		break;
	case 'applyrefuse':
		applyrefuse();
		break;
	case 'center':
		getcenter();
		break;
	case 'delbackup'://删除备份
	$key=request('key');
	delbackup($key);
	default:
		echo $jsonp_callback.'({"code":-1,"msg":"操作失败"})';
}
exit();
?>
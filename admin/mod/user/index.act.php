<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		D:\website\taobaoke\jiu2\admin\mod\user\index.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @index.act.php
 * =================================================
*/
$ops=array('list','adduser','addintegral');
$op=request('op','list',$ops);
if($op=='list'){
	$start = intval(request('start',0));
	$result=userlist(array('a.apps=\'home\''),'`regtime` DESC',$start,30,'home');
	$userlist=array();
	if (!empty($result))
	{
		$page_url='?mod='.MODNAME.'&ac='.ACTNAME.'&'.$result['url'];
		$pages=get_page_number_list($result['total'], $start, 30);
		$userlist=$result['data'];
	}
}
//添加用户
elseif ($op=='adduser'){
	$uid=request('uid',0);

	$user_field=request('user_field',array());

	if(!empty($user_field)){
		$user_field['apps']='home';
		$user_field['groups']='home-home';
		if(empty($user_field['uid'])){
			//判断密码
			if($user_field['reuserpwd']!=$user_field['userpwd'] || empty($user_field['userpwd'])){
				show_message('系统提示','确认密码错误！',-1);
			}
			unset($user_field['reuserpwd']);
			$user_field['regtime']=$_timestamp;
			try {
				register($user_field);
			}
			catch ( Exception $e )
			{
				$errmsg = $e->getMessage();
				show_message('系统提示',$errmsg,-1);
			}
		}else{
			//判断密码
			if($user_field['reuserpwd']!=$user_field['userpwd'] && (!empty($user_field['userpwd']) || !empty($user_field['reuserpwd']))){
				show_message('系统提示','确认密码错误！',-1);
			}
			unset($user_field['reuserpwd']);
			try {
				updateuser($user_field,'home');
			}catch ( Exception $e )
			{
				$errmsg = $e->getMessage();
				show_message('系统提示',$errmsg,-1);
			}
		}
		show_message('系统提示','用户添加/修改成功','?mod='.MODNAME.'&ac='.ACTNAME);
	}
	if(!empty($uid)){
		$user_field=get_user_info('a.uid='.$uid.' and a.apps=\'home\'','home');
		if(!$user_field){
			show_message('系统提示','操作错误,用户不存在',-1);
		}
	}
}
//用户积分
elseif($op=='addintegral'){
    global $_timestamp;
    $userlog='';
    $uid=request('uid',0);
    $user_field=request('user_field',array());
    if(!empty($user_field)){
        if(!empty($user_field['addintegral' ])){
            $add['integral'] = $user_field['addintegral'];
            $integral = intval($user_field['integral']);
            $addintegral = intval($user_field['addintegral']);
            $integ = $addintegral-$integral;
            $addlog = array($user_field['uid'],$integ,'admin','管理员修改',$_timestamp);
            $logtitle =array('uid','integ','type','exp','addtime');

            try{
                lib_database::update('users_home_fields',$add,'uid = \''.$user_field['uid'].'\'');
                lib_database::update('users_home_session',$add,'uid = \''.$user_field['uid'].'\'');
                if(!empty($integ)){
                    lib_database::insert('users_changelog',$logtitle,$addlog);
                }
            }catch (Exception $e){
                $errmsg = $e->getMessage();
                show_message('系统提示',$errmsg,-1);
            }
            show_message('系统提示','用户添加/修改成功','?mod='.MODNAME.'&ac='.ACTNAME);
        }else{
            show_message('系统提示','操作错误,用户不存在',-1);
        }
    }else{
        $userlog = lib_database::select('users_changelog','*','uid = \''.$uid.'\'');
    }
    if(!empty($uid)){
        $user_field=get_user_info('a.uid='.$uid.' and a.apps=\'home\'','home');

        if(!$user_field){
            show_message('系统提示','操作错误,用户不存在',-1);
        }
    }
}
/* End of file index.act.php */
/* Location: D:\website\taobaoke\jiu2\admin\mod\user\index.act.php */
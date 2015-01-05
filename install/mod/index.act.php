<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @index.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
check_install();
$op=request('op','install');
$error=array();
//安装数据库
$posts=lib_request::$posts;
//默认数据
$default=array(
			'dbhost'=>"localhost",
			'dbname'=>'xuanyu',
			'dbuser'=>'root',
			'tablepre'=>TABLEPRE,
			'username'=>'admin',
			'email'=>'admin@admin.com',
			);
if(!empty($posts['submitname'])){
	$dbinfo=$posts['dbinfo'];
	$admininfo=$posts['admininfo'];
	//连接数据库
	if(empty($dbinfo['dbhost'])){
		$dbhosterr=true;
	}
	if(empty($dbinfo['dbname'])){
		$dbnamerr=true;
	}
	//管理员
	if(empty($admininfo['username'])){
		$usernamerr='管理员用户名为空，或者格式错误，请检查';
	}
	if(empty($admininfo['password'])){
		$passworderr=true;
	}
	if($admininfo['password']!=$admininfo['password2'] || empty($admininfo['password2'])){
		$password2err=true;
	}
	if(empty($admininfo['email'])){
		$emailerr='管理员Email为空，或者格式错误，请检查';
	}
	if(strpos($dbinfo['tablepre'], '.') !== false || intval($dbinfo['tablepre']{0})) {
		$tablepreerr=true;
	}
	if(!empty($dbinfo['dbhost']) && empty($dbinfo['forceinstall'])) {
		$dbname_not_exists = check_db($dbinfo['dbhost'], $dbinfo['dbuser'], $dbinfo['dbpw'], $dbinfo['dbname'], $dbinfo['tablepre']);
		if(!$dbname_not_exists) {
			//显示强制安装
			$forceinstallerr='当前数据库当中已经含有同样表前缀的数据表，您可以修改“表名前缀”来避免删除旧的数据，或者选择强制安装。强制安装会删除旧数据，且无法恢复';
		}else{
			if(is_array($dbname_not_exists)){
				$error=$dbname_not_exists;
			}
		}
	}
	if(!isset($dbhosterr) && !isset($dbnamerr) && !isset($usernamerr) && !isset($passworderr) && !isset($password2err) && !isset($emailerr)){
		$link = @mysql_connect($dbinfo['dbhost'], $dbinfo['dbuser'], $dbinfo['dbpw']);
		if(!$link) {
			$errno = mysql_errno($link);
			$error = mysql_error($link);
			if($errno == 1045) {
				$error=array('msg'=>'无法连接数据库，请检查数据库用户名或者密码是否正确','error'=>$error);
			} elseif($errno == 2003) {
				$error=array('msg'=>'无法连接数据库，请检查数据库是否启动，数据库服务器地址是否正确','error'=>$error);
			} else {
				$error=array('msg'=>'数据库连接错误','error'=>$error);
			}
		}
		if(mysql_get_server_info() > '4.1') {
			mysql_query("CREATE DATABASE IF NOT EXISTS `".$dbinfo['dbname']."` DEFAULT CHARACTER SET ".DBCHARSET, $link);
		} else {
			mysql_query("CREATE DATABASE IF NOT EXISTS `".$dbinfo['dbname']."`", $link);
		}
		if(mysql_errno()) {
			$error=array('msg'=>'无法创建新的数据库，请检查数据库名称填写是否正确','error'=>mysql_error());
		}
		mysql_close($link);
	}
	if(strpos($dbinfo['tablepre'], '.') !== false || intval($dbinfo['tablepre']{0})) {
		show_msg('数据表前缀为空，或者格式错误，请检查', $dbinfo['tablepre'], 0);
	}

	if($admininfo['username'] && $admininfo['email'] && $admininfo['password']) {
		if(strlen($admininfo['username']) > 15 || preg_match("/^$|^c:\\con\\con$|　|[,\"\s\t\<\>&]|^Guest/is", $admininfo['username'])) {
			$usernamerr='非法用户名，用户名长度不应当超过 15 个英文字符，且不能包含特殊字符，一般是中文，字母或者数字';
		} elseif(!strstr($admininfo['email'], '@') || $admininfo['email'] != stripslashes($admininfo['email']) || $admininfo['email'] != dhtmlspecialchars($admininfo['email'])) {
			$emailerr='Email 地址错误，此邮件地址已经被使用或者格式无效，请更换为其他地址';
		}
	} else {
		$error=array('msg'=>'管理员信息不完整，请检查管理员账号，密码，邮箱','error'=>'');
	}
	if(empty($error) && empty($dbhosterr) && empty($dbnamerr) && empty($usernamerr) && empty($passworderr) && empty($password2err) && empty($emailerr) && empty($tablepreerr) && empty($forceinstallerr)){
		//正确 开始设置config文件
		$_config['config']['db_host']['master'] = $dbinfo['dbhost'];
		$_config['config']['db_host']['slave'][] = $dbinfo['dbhost'];
		$_config['config']['db_user'] = $dbinfo['dbuser'];
		$_config['config']['db_name'] = $dbinfo['dbname'];
		$_config['config']['db_pass'] = $dbinfo['dbpw'];
		$_config['config']['db_pre'] = $dbinfo['tablepre'];
		//cookie
		$_config['config']['cookie_pre'] = random(7).'#'.random(4);
		$_config['config']['cookie_pwd'] = random(7).'#'.random(4);
		save_config_file(PATH_DATA.'/inc_db.php',$_config);
		//开始安装数据库
		$sql = file_get_contents($sqlfile);
		$sql = str_replace("\r\n", "\n", $sql);
		//数据
		$datasql = file_get_contents($sqldata);
		$datasql = str_replace("\r\n", "\n", $datasql);
		$step='mysql';
	}
	$_config['config']['db_charset']=$GLOBALS['config']['db_charset'];
	$GLOBALS['config']=$_config['config'];
//	$GLOBALS['config']=array_merge($GLOBALS['config'],$_config['config']);
	$default=array(
			'dbhost'=>$dbinfo['dbhost'],
			'dbname'=>$dbinfo['dbname'],
			'dbuser'=>$dbinfo['dbuser'],
			'tablepre'=>$dbinfo['tablepre'],
			'username'=>$admininfo['username'],
			'email'=>$admininfo['email'],
			);
}

?>
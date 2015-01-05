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

function install_err($err){
	if(!defined('INSTALL')){
		define('INSTALL',$err);
	}
}
function check_install(){
	global $lockfile;
	if(file_exists($lockfile)){
		//show_msg('安装锁定，已经安装过了，如果您确定要重新安装，请到服务器上删除<br /> '.str_replace(ROOT_PATH, '', $lockfile),0);
		install_err('已经安装过了');
		return true;
	}else{
		return false;
	}
}

function check_func(){
	global $func_items,$filesock_items;
	foreach($func_items as $item) {
		$status = function_exists($item);
		$fun['name']=$item;
		if($status) {
			$fun['status']=true;
			$fun['support']="支持";
		} else {
			$fun['status']=false;
			$fun['support']='不支持';
			install_err($item.'函数不支持');
		}
		$func_arr[$item]=$fun;
	}
	foreach($filesock_items as $item) {
		$status = function_exists($item);
		$fun['name']=$item;
		if($status) {
			$fun['status']=true;
			$fun['support']="支持";
			$func_arr[$item]=$fun;
			break;
		} else {
			$fun['status']=false;
			$func_str['support']=$item.'不支持';
			install_err($item.'函数不支持');
		}
		$func_arr[$item]=$fun;
	}
	return $func_arr;
}
//判断文件可写权限
function dirfile_check(&$dirfile_items) {
	foreach($dirfile_items as $key => $item) {
		$item_path = $item['path'];
		if($item['type'] == 'dir') {
			if(!dir_writeable(PATH_ROOT.$item_path)) {
				if(is_dir(PATH_ROOT.$item_path)) {
					$dirfile_items[$key]['status'] = 0;
					$dirfile_items[$key]['current'] = '只读';
				} else {
					$dirfile_items[$key]['status'] = -1;
					$dirfile_items[$key]['current'] = '目录不存在';
					install_err($item_path.'目录不存在');
				}
			} else {
				$dirfile_items[$key]['status'] = 1;
				$dirfile_items[$key]['current'] = '可写';
			}
		} else {
			if(file_exists(PATH_ROOT.$item_path)) {
				if(is_writable(PATH_ROOT.$item_path)) {
					$dirfile_items[$key]['status'] = 1;
					$dirfile_items[$key]['current'] = '可写';
				} else {
					$dirfile_items[$key]['status'] = 0;
					$dirfile_items[$key]['current'] = '只读';
					install_err($item_path.'需要可写权限');
				}
			} else {
				if(dir_writeable(dirname(PATH_ROOT.$item_path))) {
					$dirfile_items[$key]['status'] = 1;
					$dirfile_items[$key]['current'] = '可写';
				} else {
					$dirfile_items[$key]['status'] = -1;
					$dirfile_items[$key]['current'] = '文件不存在';
					install_err($item_path.'文件不存在');
				}
			}
		}
	}
}
function dir_writeable($dir) {
	$writeable = 0;
	if(!is_dir($dir)) {
		@mkdir($dir, 0777);
	}
	if(is_dir($dir)) {
		if($fp = @fopen("$dir/test.txt", 'w')) {
			@fclose($fp);
			@unlink("$dir/test.txt");
			$writeable = 1;
		} else {
			$writeable = 0;
		}
	}
	return $writeable;
}

function env_check(&$env_items) {
	foreach($env_items as $key => $item) {
		if($key == 'php') {
			$env_items[$key]['current'] = PHP_VERSION;
		} elseif($key == 'attachmentupload') {
			$env_items[$key]['current'] = @ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'unknow';
		} elseif($key == 'gdversion') {
			$tmp = function_exists('gd_info') ? gd_info() : array();
			$env_items[$key]['current'] = empty($tmp['GD Version']) ? 'noext' : $tmp['GD Version'];
			unset($tmp);
		}elseif($key == 'diskspace') {
			if(function_exists('disk_free_space')) {
				$env_items[$key]['current'] = floor(disk_free_space(PATH_ROOT) / (1024*1024)).'M';
			} else {
				$env_items[$key]['current'] = 'unknow';
			}
		}
		elseif(isset($item['c'])) {
			$env_items[$key]['current'] = constant($item['c']);
		}
		$env_items[$key]['status'] = 1;
		if($item['r'] != '不限制' && strnatcmp($env_items[$key]['current'], $item['r']) < 0) {
			$env_items[$key]['status'] = 0;
			install_err($env_items[$key]['name'].$env_items[$key]['err']);
		}
	}
}

function check_db($dbhost, $dbuser, $dbpw, $dbname, $tablepre) {
	if(!function_exists('mysql_connect')) {
		return array('msg'=>'undefine_func','error'=>'mysql_connect');
	}
	if(!@mysql_connect($dbhost, $dbuser, $dbpw)) {
		$errno = mysql_errno();
		$error = mysql_error();
		if($errno == 1045) {
			return array('msg'=>'无法连接数据库，请检查数据库用户名或者密码是否正确','error'=>$error);
		} elseif($errno == 2003) {
			return array('msg'=>'无法连接数据库，请检查数据库是否启动，数据库服务器地址是否正确','error'=>$error);
		} else {
			return array('msg'=>'数据库连接错误','error'=>$error);
		}
	} else {
		if($query = @mysql_query("SHOW TABLES FROM $dbname")) {
			while($row = mysql_fetch_row($query)) {
				if(preg_match("/^$tablepre/", $row[0])) {
					return false;
				}
			}
		}
	}
	return true;
}

function dhtmlspecialchars($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = dhtmlspecialchars($val);
		}
	} else {
		$string = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string);
		if(strpos($string, '&amp;#') !== false) {
			$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4}));)/', '&\\1', $string);
		}
	}
	return $string;
}

//设置config
function save_config_file($filename, $config) {
	$date = gmdate("Y-m-d H:i:s", time() + 3600 * 8);
	//网站地址
	$url=get_cururl();
	$path=str_replace("install/index.php",'',$url);
	$url=str_replace("/install/index.php",'','http://'.$_SERVER['SERVER_NAME'].$url);
	$content = <<<EOT
<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @inc_config.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
	define('COOKIE_DOMAIN', '{$_SERVER['SERVER_NAME']}'); //正式环境中如果要考虑二级域名问题的应该用 .xxx.com
	define('COOKIE_PATH', '/');
	define('URL', '{$url}');
EOT;
	$content .= getvars(array('GLOBALS' => $config));
	$content .= "\r\n// ".str_pad('  THE END  ', 50, '-', STR_PAD_BOTH)." //\r\n\r\n?>";
	file_put_contents($filename, $content);
}

function random($length) {
	$hash = '';
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
	$max = strlen($chars) - 1;
	PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
	for($i = 0; $i < $length; $i++) {
		$hash .= $chars[mt_rand(0, $max)];
	}
	return $hash;
}

function getvars($data, $type = 'VAR') {
	$evaluate = '';
	foreach($data as $key => $val) {
		if(!preg_match("/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/", $key)) {
			continue;
		}
		if(is_array($val)) {
			$evaluate .= buildarray($val, 0, "\${$key}")."\r\n";
		} else {
			$val = addcslashes($val, '\'\\');
			$evaluate .= $type == 'VAR' ? "\$$key = '$val';\n" : "define('".strtoupper($key)."', '$val');\n";
		}
	}
	return $evaluate;
}
function buildarray($array, $level = 0, $pre = '$_config') {
	static $ks;
	if($level == 0) {
		$ks = array();
		$return = '';
	}
	foreach ($array as $key => $val) {
		if($level == 0) {
			$newline = str_pad('  CONFIG '.strtoupper($key).'  ', 70, '-', STR_PAD_BOTH);
			$return .= "\r\n// $newline //\r\n";
		}
		$ks[$level] = $ks[$level - 1]."['$key']";
		if(is_array($val)) {
			$ks[$level] = $ks[$level - 1]."['$key']";
			$return .= buildarray($val, $level + 1, $pre);
		} else {
			$val =  is_string($val) || strlen($val) > 12 || !preg_match("/^\-?[1-9]\d*$/", $val) ? '\''.addcslashes($val, '\'\\').'\'' : $val;
			$return .= $pre.$ks[$level - 1]."['$key']"." = $val;\r\n";
		}
	}
	return $return;
}
//数据库安装
function show_install() {
?>
<script type="text/javascript">
function showmessage(message) {
	document.getElementById('notice').innerHTML += message + '<br />';
	document.getElementById('notice').scrollTop = 100000000;
}
function initinput() {
	window.location='index.php?op=success';
}
</script>
		<div id="notice"></div>
		<div class="btnbox margintop marginbot">
			<input type="button" name="submit" value="正在安装..." disabled="disabled" id="laststep" onclick="initinput()">
		</div>
<?php
}

function showjsmessage($message) {
	echo '<script type="text/javascript">showmessage(\''.addslashes($message).' \');</script>'."\r\n";
	flush();
	ob_flush();
}

function hade_install(){
	global $lockfile;
	file_put_contents($lockfile, '');
}

function runquery($sql) {
	global $config;
	if(!isset($sql) || empty($sql)) return;
	$sql = str_replace("\r", "\n", str_replace(' '.TABLEPRE, ' '.$config['db_pre'], $sql));
	$sql = str_replace("\r", "\n", str_replace(' `'.TABLEPRE, ' `'.$config['db_pre'], $sql));
	$ret = array();
	$num = 0;
	foreach(explode(";\n", trim($sql)) as $query) {
		$ret[$num] = '';
		$queries = explode("\n", trim($query));
		foreach($queries as $query) {
			$ret[$num] .= (isset($query[0]) && $query[0] == '#') || (isset($query[1]) && isset($query[1]) && $query[0].$query[1] == '--') ? '' : $query;
		}
		$num++;
	}
	unset($sql);
	foreach($ret as $query) {
		$query = trim($query);
		if($query) {
			if(substr($query, 0, 12) == 'CREATE TABLE') {
				$name = preg_replace("/CREATE TABLE ([a-z0-9_]+) .*/is", "\\1", $query);
				showjsmessage('建立数据表 '.$name.' ... 成功');
				lib_database::wquery(createtable($query));
			}else{
				$firstIndex = strpos($query, ' ');
				$sql_type=substr($query,0,$firstIndex);
				switch ($sql_type){
					case 'INSERT'://插入数据
					$name = preg_replace("/INSERT (IGNORE )?INTO ([a-z0-9_]+) .*/is", "\\2", $query);
					lib_database::wquery($query);
					showjsmessage($name.'数据添加 ... 成功');
					break;
					case 'REPLACE':
						$name = preg_replace("/REPLACE INTO ([a-z0-9_]+) .*/is", "\\1", $query);
						lib_database::wquery($query);
						showjsmessage($name.'表添加数据 ... 成功');
						break;
					case 'CREATE':
						$name = preg_replace("/CREATE TABLE (IF NOT EXISTS )?([a-z0-9_]+) .*/is", "\\2", $query);
						lib_database::wquery($query);
						showjsmessage('建立数据表 '.$name.' ... 成功');
						break;
					case 'ALTER':
						preg_match("/ALTER TABLE ([a-z0-9_]+) (ADD|DROP|CHANGE) (UNIQUE |INDEX )?`([a-z0-9_]+)`( `([a-z0-9_]+)` )?( .*)?/is",$query,$pattren);
						$name=$pattren[1];
						if($pattren[2]=='DROP'){//删除字段
							lib_database::rquery('Describe `'.$pattren[1].'` `'.$pattren[4].'`');
							$ishade=lib_database::fetch_one();
							if(!empty($ishade) && empty($pattren[3])){
								lib_database::wquery($query);
								showjsmessage($name.'删除字段'.$pattren[4].' ... 成功');
							}elseif (!empty($ishade) && trim($pattren[3])=='INDEX'){
								//判断是否为索引
								lib_database::rquery('SHOW INDEX FROM `'.$pattren[1].'`');
								while ($index_key=lib_database::fetch_one()){
									if($index_key['Column_name']==$pattren[4]){
										//删除索引
										lib_database::wquery($query);
										showjsmessage($name.'删除索引'.$pattren[4].' ... 成功');
									}
								}
							}
						}elseif ($pattren[2]=='ADD'){//添加字段
							lib_database::rquery('Describe `'.$pattren[1].'` `'.$pattren[4].'`');
							$ishade=lib_database::fetch_one();
							if(empty($ishade) && empty($pattren[3])){
								lib_database::wquery($query);
								showjsmessage($name.'添加字段'.$pattren[4].' ... 成功');
							}
						}elseif ($pattren[2]=='CHANGE'){//调整字段
							if(!empty($pattren[4]) && !empty($pattren[6])){
								if($pattren[4]==$pattren[6]){
									lib_database::rquery('Describe `'.$pattren[1].'` `'.$pattren[4].'`');
									$ishade=lib_database::fetch_one();
									if(!empty($ishade)){
										lib_database::wquery($query);
										showjsmessage($name.'修改字段'.$pattren[4].' ... 成功');
									}
								}else{
									lib_database::rquery('Describe `'.$pattren[1].'` `'.$pattren[6].'`');
									$ishade=lib_database::fetch_one();
									if(empty($ishade)){
										lib_database::wquery($query);
										showjsmessage($name.'修改字段 ... 成功');
									}
								}
							}
						}else{
							lib_database::wquery($query);
						}
						break;
					case 'UPDATE':
						//preg_match("/UPDATE ([a-z0-9_]+) SET (.*) WHERE (.*)/is",$query,$pattren);
						lib_database::wquery($query);
						showjsmessage($pattren[1].'修改字段 ... 成功');
						break;
					default:
						lib_database::wquery($query);
						break;
				}
			}
		}
	}
}
function setbase(){
	global $_config,$_timestamp;
	//设置网址
	$url=get_cururl();
	$url=str_replace("/install/index.php",'',$url);
	runquery("replace into ".$_config['config']['db_pre']."webset  VALUES ('site_url','$url')");
	//版本信息
	runquery("replace into ".$_config['config']['db_pre']."webset  VALUES ('site_version', '".VERSION."')");
	runquery("replace into ".$_config['config']['db_pre']."webset  VALUES ('site_update', '".$_timestamp."')");
}
function createtable($sql) {
	$type = strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU", "\\2", $sql));
	$type = in_array($type, array('MYISAM', 'HEAP', 'MEMORY')) ? $type : 'MYISAM';
	return preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU", "\\1", $sql).
	(mysql_get_server_info() > '4.1' ? " ENGINE=$type DEFAULT CHARSET=".DBCHARSET : " TYPE=$type");
}
function creatmanager(){
	global $_config,$admininfo,$_timestamp,$_ip;
	$admininfo['password']=lib_access::_get_encodepwd($admininfo['password']);
	runquery("replace into ".$_config['config']['db_pre']."users ( `user_name` ,  `userpwd` ,  `email` ,  `apps` ,  `groups` ,  `sta` ,  `regtime` ,  `regip`) VALUES('{$admininfo['username']}','{$admininfo['password']}','{$admininfo['email']}','admin','admin-admin','1','{$_timestamp}','{$_ip}')");
	showjsmessage('管理员添加 ... 成功');
}
function dir_clear($dir,$del=false) {
	showjsmessage('清空目录 '.str_replace(ROOT_PATH, '', $dir));
	//先删除目录下的文件：
	$dh=opendir($dir);
	while ($file=readdir($dh)) {
		if($file!="." && $file!="..") {
			$fullpath=$dir."/".$file;
			if(!is_dir($fullpath)) {
				unlink($fullpath);
			} else {
				dir_clear($fullpath,true);
			}
		}
	}
	closedir($dh);
	//删除当前文件夹：
	if($del && rmdir($dir)) {
		return true;
	} else {
		return false;
	}
}
function show_header(){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>轩宇淘宝客! 安装向导</title>
<link rel="stylesheet" href="static/css/style.css" type="text/css" media="all" />
</head>
<div class="container">
	<div class="header">
		<h1>轩宇淘宝客 安装向导</h1>
		<span>轩宇淘宝客</span>
		<span><a href="http://www.wangyue.cc/software.html" target="_blank" style="font-weight: bolder;">代安装服务</a></span>
	</div>
<?php 
}

function show_footer(){
?>
	<div class="footer">©2001 - 2013 <a href="http://www.wangyue.cc/" target="_blank">成都网悦</a> Inc.&nbsp;<a href="http://www.wangyue.cc/software.html" target="_blank" style="font-weight: bolder;">代安装服务</a></div>
</div>
</body>
</html>
<?php 
}
?>
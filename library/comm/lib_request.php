<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @lib_request.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}

//简化 cls_request::item() 函数
function request($key, $df='',$arr=array())
{
	if(!empty($arr)){
		$item=lib_request::item($key);
		return in_array($item,$arr)?$item:$df;
	}else{
		return lib_request::item($key, $df);
	}
}
class lib_request
{
	//用户的cookie
	public static $cookies = array();

	//把GET、POST的变量合并一块，相当于 _REQUEST
	public static $forms = array();

	//_GET 变量
	public static $gets = array();

	//_POST 变量
	public static $posts = array();

	//用户的请求模式 GET 或 POST
	public static $request_type = 'GET';

	//文件变量
	public static $files = array();

	//严禁保存的文件名
	public static $filter_filename = '/\.(php|pl|sh|js)$/i';

	/**
    * 初始化用户请求
    * 对于 post、get 的数据，会转到 selfforms 数组， 并删除原来数组
    * 对于 cookie 的数据，会转到 cookies 数组，但不删除原来数组
    */
	public static function init()
	{
		//处理post、get
		$formarr = array('p' => $_POST, 'g' => $_GET);
		foreach($formarr as $_k => $_r)
		{
			if( count($_r) > 0 )
			{	
				foreach($_r as $k=>$v)
				{
					$force=0;
					self::$forms[$k] = $v;
					if((defined('APPNAME') && 'admin'==APPNAME) || $k=='mod' || $k=='ac' || $k=='identifier' || $k=='pmod'){
						$force=1;
					}
					self::$forms[$k] = daddslashes(self::$forms[$k],$force);
					if( $_k=='p' )
					{
						self::$posts[$k] = self::$forms[$k];
					} else {
						self::$gets[$k] = self::$forms[$k];
					}
				}
			}
		}
		unset($_POST);
		unset($_GET);
		unset($_REQUEST);

		//默认ac和ct
		self::$forms['mod'] = isset(self::$forms['mod']) ? self::$forms['mod'] : 'index';
		self::$forms['ac'] = isset(self::$forms['ac']) ? self::$forms['ac'] : 'index';

		//处理cookie
		if( count($_COOKIE) > 0 )
		{
			foreach($_COOKIE as $k=>$v)
			{
				if( preg_match('/^config/i', $k) )
				{
					continue;
				}
				self::$cookies[$k] = $v;
			}
		}
		//unset($_POST, $_GET);

		//上传的文件处理
		if( isset($_FILES) && count($_FILES) > 0 )
		{
			self::filter_files($_FILES);
		}

		//global变量
		//self::$forms['_global'] = $GLOBALS;
	}

	/**
    * 把 eval 重命名为 myeval
    */
	public static function myeval( $phpcode )
	{
		return eval( $phpcode );
	}

	/**
    * 获得指定表单值
    */
	public static function item( $formname, $defaultvalue = '' )
	{
		return isset(self::$forms[$formname]) ? self::$forms[$formname] :  $defaultvalue;
	}

	/**
    * 获得指定临时文件名值
    */
	public static function upfile( $formname, $defaultvalue = '' )
	{
		return isset(self::$files[$formname]['tmp_name']) ? self::$files[$formname]['tmp_name'] :  $defaultvalue;
	}

	/**
    * 过滤文件相关
    */
	public static function filter_files( &$files )
	{
		foreach($files as $k=>$v)
		{
			self::$files[$k] = $v;
		}
		unset($_FILES);
	}

	/**
    * 移动上传的文件
    */
	public static function move_upload_file( $formname, $filename, $filetype = '' )
	{
		if( self::is_upload_file( $formname ) )
		{
			if( preg_match(self::$filter_filename, $filename) )
			{
				return false;
			}
			else
			{
				return move_uploaded_file(self::$files[$formname]['tmp_name'], $filename);
			}
		}
	}

	/**
    * 获得文件的扩展名
    */
	public static function get_shortname( $formname )
	{
		$filetype = strtolower(isset(self::$files[$formname]['type']) ? self::$files[$formname]['type'] : '');
		$shortname = '';
		switch($filetype)
		{
			case 'image/jpeg':
				$shortname = 'jpg';
				break;
			case 'image/pjpeg':
				$shortname = 'jpg';
				break;
			case 'image/gif':
				$shortname = 'gif';
				break;
			case 'image/png':
				$shortname = 'png';
				break;
			case 'image/xpng':
				$shortname = 'png';
				break;
			case 'image/wbmp':
				$shortname = 'bmp';
				break;
			default:
				$filename = isset(self::$files[$formname]['name']) ? self::$files[$formname]['name'] : '';
				if( preg_match("/\./", $filename) )
				{
					$fs = explode('.', $filename);
					$shortname = strtolower($fs[ count($fs)-1 ]);
				}
				break;
		}
		return $shortname;
	}

	/**
    * 获得指定文件表单的文件详细信息
    */
	public static function get_file_info( $formname, $item = '' )
	{
		if( !isset( self::$files[$formname]['tmp_name'] ) )
		{
			return false;
		}
		else
		{
			if($item=='')
			{
				return self::$files[$formname];
			}
			else
			{
				return (isset(self::$files[$formname][$item]) ? self::$files[$formname][$item] : '');
			}
		}
	}

	/**
    * 判断是否存在上传的文件
    */
	public static function is_upload_file( $formname )
	{
		if( !isset( self::$files[$formname]['tmp_name'] ) )
		{
			return false;
		}
		else
		{
			return is_uploaded_file( self::$files[$formname]['tmp_name'] );
		}
	}

	/**
     * 检查文件后缀是否为指定值
     *
     * @param  string  $subfix
     * @return boolean
     */
	public static function check_subfix($formname, $subfix = 'csv')
	{
		if( self::get_shortname( $formname ) != $subfix)
		{
			return false;
		}
		return true;
	}

}
$isMagic = get_magic_quotes_gpc();
function daddslashes($string,$force=0) {
	global $isMagic;
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = daddslashes($val,$force);
		}
	} else {
		if(!$force){
			$string = RemoveXSS($string);
		}
		if(!$isMagic){
			$string=addslashes($string);
		}
	}
	return $string;
}
function RemoveXSS($val) {
	// remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
	// this prevents some character re-spacing such as <java\0script>
	// note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
	$val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);

	// straight replacements, the user should never need these since they're normal characters
	// this prevents like <IMG SRC=@avascript:alert('XSS')>
	$search = 'abcdefghijklmnopqrstuvwxyz';
	$search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$search .= '1234567890!@#$%^&*()';
	$search .= '~`";:?+/={}[]-_|\'\\';
	for ($i = 0; $i < strlen($search); $i++) {
		// ;? matches the ;, which is optional
		// 0{0,7} matches any padded zeros, which are optional and go up to 8 chars

		// @ @ search for the hex values
		$val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
		// @ @ 0{0,7} matches '0' zero to seven times
		$val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
	}

	// now the only remaining whitespace attacks are \t, \n, and \r
	$ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', );
	$ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
	$ra = array_merge($ra1, $ra2);

	$found = true; // keep replacing as long as the previous round replaced something
	while ($found == true) {
		$val_before = $val;
		for ($i = 0; $i < sizeof($ra); $i++) {
			$pattern = '/';
			for ($j = 0; $j < strlen($ra[$i]); $j++) {
				if ($j > 0) {
					$pattern .= '(';
					$pattern .= '(&#[xX]0{0,8}([9ab]);)';
					$pattern .= '|';
					$pattern .= '|(&#0{0,8}([9|10|13]);)';
					$pattern .= ')*';
				}
				$pattern .= $ra[$i][$j];
			}
			$pattern .= '/i';
			$replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
			$val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
			if ($val_before == $val) {
				// no replacements were made, so exit the loop
				$found = false;
			}
		}
	}
	return $val;
}
<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\library\comm\lib_access.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @lib_access.php
 * =================================================
*/
/**
 * 权限控件类
 * 权限配置文件为 data/dm_config/inc_accesscontrol_groups.xml
 * @version $Id$
 *
 */
@session_start();
@header('Cache-Control:private');
require PATH_LIBRARY.'/comm/lib_access_cfg.php';
require PATH_LIBRARY.'/comm/lib_validate.php';
class lib_access
{
	public  $app_name = '';                //当前访问的应用池
	public static $cfg_groups = '';         //用户权限配置文件读取的数据
	public  $acc_hand = '';             //session 和 cookie 的前缀
	public  $uid = 0;                       //用户数值id
	public  $fields = array();              //用户信息数组
	public  $user_apps = '';               //用户允许的应用池
	public  $user_groups = '';              //用户隶属的组， 用 app_name1-group1,app_name2-group2 这样分开
	public  $user_purview_mods = '';

	public  $return_url = '';               //手工指定登录后跳转到的url

	public static $accctl = null;          //工厂创建的对象实例

	public static $user_table  = 'users';   //用户主表前缀
	public static $cfg_cache   = 'acc_cfg';  //配置信息缓存（测试表明解释速度已经足够快，因此默认没启用缓存）
	public static $info_cache  = 'accuser';  //用户信息缓存（每次登录时和在修改用户资料的地方会清除）

	/**
     * 构造函数，根据池的初始化检测用户登录信息
     * @parem $app_name
     *
     */
	function __construct($app_name)
	{
		self::$user_table=tname(self::$user_table);
		self::$cfg_groups = lib_access_cfg::get_config();
		$this->acc_hand = $GLOBALS['config']['cookie_pre'];
		if( !isset(self::$cfg_groups['apps'][$app_name]) )
		{
			exit("Setting `{$app_name}` is not Found! ");
		}
		$this->app_name = $app_name;
		//如果用户已经登录，获取用户ID信息
		if(self::$cfg_groups['apps'][$app_name]['auttype']=='session')
		{
			$this->uid = isset($_SESSION[$this->acc_hand.APPNAME.'_uid']) ? $_SESSION[$this->acc_hand.APPNAME.'_uid'] : 0;
		}
		else if(self::$cfg_groups['apps'][$app_name]['auttype']=='cookie')
		{
			$this->uid = ($this->get_cookie(APPNAME.'_uid')=='') ? 0 : intval($this->get_cookie(APPNAME.'_uid'));
		}
		else
		{
			$this->uid = isset($_SESSION[$this->acc_hand.APPNAME.'_uid']) ? $_SESSION[$this->acc_hand.APPNAME.'_uid'] : 0;
			$this->uid = empty($this->uid) ? ($this->get_cookie(APPNAME.'_uid')=='') ? 0 : intval($this->get_cookie(APPNAME.'_uid')) : $this->uid;
		}
		$this->get_userinfos();
		self::$accctl = $this;
	}

	/*
	* 用工厂方法创建对象实例
	* @parem $appname
	* @parem $cp_url
	*
	* @return object
	*/
	public static function factory($appname, $cp_url='')
	{
		if( self::$accctl === null )
		{
			self::$accctl = new lib_access($appname);
			//self::$accctl->set_control_url( $cp_url );
		}
		return self::$accctl;
	}

	/*
	*  获得工厂方法创建的对象实例
	* (主要是方便需要时在控制器中调用)
	*/
	public static function get_instance()
	{
		return self::$accctl;
	}

	/**
    * 设置控制器路由的url
    */
	public function set_control_url( $url )
	{
		self::$cfg_groups['apps'][$this->app_name]['control'] = $url;
	}

	/**
    * 获得控制器路由的url
    */
	public function get_control_url( )
	{
		//来路地址
		$referer=get_cururl();
		if(!empty($referer) && !strpos('http://',$referer)){
			$referer=str_replace('/?','',$referer);
			$referer=explode('&',$referer);
			$mod=$ac='';
			$referer_arr=array();
			foreach ($referer as $val){
				$val=explode('=',$val);
				if($val[0]=='mod'){$mod=$val[1];}
				elseif($val[0]=='ac'){$ac=$val[1];}
				else{
					$referer_arr[$val[0]]=$val[1];
				}
			}
			$referer=u($mod,$ac,$referer_arr);
		}
		preg_match('/\?mod=(.*)&ac=(.*)/',self::$cfg_groups['apps'][$this->app_name]['control'],$patterns);
		if(defined('APPNAME') && APPNAME=='admin'){
			return self::$cfg_groups['apps'][$this->app_name]['control'].'&gourl='.base64_encode($referer);
		}else{
			return u($patterns[1],$patterns[2],array('gourl'=>base64_encode($referer)));
		}
	}

	/**
     * 获取用户具体信息
     *
     * @return array (如果用户尚未登录，则返回 false )
     *
     */
	public function get_userinfos( $cache=false )
	{
		$user_table = self::$user_table;
		if( !empty($this->uid) )
		{
			if(APPNAME=='admin'){
				$query = "Select ut.* From `{$user_table}` ut where ut.uid='{$this->uid}' and ut.apps='".APPNAME."'";
			}else{
				$query = "Select ut.* From `{$user_table}_".APPNAME."_session` ut where ut.uid='{$this->uid}' and ut.apps='".APPNAME."'";
			}
			$formcache = false;
			if( $cache )
			{
				$this->fields = get_cache(self::$info_cache, $this->uid);
				if( empty($this->fields) )
				{
					$this->fields = lib_database::get_one($query);
				} else {
					$formcache = true;
				}
			}
			else
			{
				$this->fields = lib_database::get_one($query);
				if(APPNAME!='admin'){
					//保持激活状态户活动时常
					$query = 'UPDATE `'.$user_table.'_'.APPNAME.'_session` set `lastactivity`=\''.$GLOBALS['_timestamp'].'\' where uid=\''.$this->uid.'\'';
					lib_database::wquery($query);
				}
			}
			if(is_array($this->fields))
			{
				$this->uid = $this->fields['uid'];
				$this->user_apps = $this->fields['apps'];
				$this->user_groups = $this->fields['groups'];
				if(!$formcache ){
					set_cache(self::$info_cache, $this->uid, $this->fields, 1800);
				}
				return $this->fields;
			}
			else
			{
				$this->uid =  0;
			}
		}
		else
		{
			$this->uid =  0;
		}
		return false;
	}

	/**
     * 删除指定用户的缓存
     */
	public function del_cache($uid)
	{
		del_cache(self::$info_cache, $uid);
	}

	/**
      * 检测权限
      * @parem $mod
      * @parem $action
      * @parem backtype 返回类型， 1--是由权限控制程序直接处理
      *                            2--是只返回结果给控制器(结果为：1 正常，0 没登录，-1 没组权限， -2 没应用池权限)
      *
      * @return int  对于没权限的用户会提示或跳转到 ct=login
      *
      */
	public function test_purview($mod, $action, $backtype=false)
	{
		$rs = 0;
		//检测应用池开放权限的模块
		$public_mod = isset(self::$cfg_groups['apps'][$this->app_name]['public'][$mod]) ? self::$cfg_groups['apps'][$this->app_name]['public'][$mod] : array();
		//检测开放控制器和事件
		if( !empty(self::$cfg_groups['apps'][$this->app_name]['public']) &&
		( self::$cfg_groups['apps'][$this->app_name]['public']=='*' || in_array($action, $public_mod) || in_array('*',     $public_mod) )
		)
		{
			$rs = 1;
		}
		//未登录用户
		else if( empty($this->uid) )
		{
			$rs = 0;
		}
		//具体权限检测
		else
		{
			//检测池保护开放控制器和事件（即是登录用户允许访问的所有公共事件）
			$protected_mod = isset(self::$cfg_groups['apps'][$this->app_name]['protected'][$mod]) ? self::$cfg_groups['apps'][$this->app_name]['protected'][$mod] : array();
			if (   !empty(self::$cfg_groups['apps'][$this->app_name]['protected']) &&
			( self::$cfg_groups['apps'][$this->app_name]['protected']=='*' || in_array($action, $protected_mod) || in_array('*',     $protected_mod) )
			)
			{
				$rs = 1;
			}
			else
			{
				//确定是否具有应用池权限
				$apps = explode(',', self::$cfg_groups['apps'][$this->user_apps]['allowapp']);
				$apps[] = $this->user_apps;
				if( !in_array($this->app_name, $apps) )
				{
					$rs = -2;
				}
				//具体权限检查
				else
				{
					//检查是否具有角色私有权限
					/*
					$user_purviews = '';
					$row = lib_database::get_one("Select * From `".self::$user_table."_purview` where `uid`='{$this->uid}' ");
					if( is_array($row) )
					{
					$user_purviews = lib_access_cfg::str_gps(trim($row['purviews']));
					}
					if( empty($user_purviews) )
					{
					*/
					//检测用户在当前池具有的私有权限
					if( empty($this->user_purview_mods) )
					{
						$this->user_purview_mods = $this->_check_purview_mods();
					}
					if( $this->user_purview_mods != '#' )
					{
						$user_purviews = isset($this->user_purview_mods[$this->app_name]) ? $this->user_purview_mods[$this->app_name] : '';
					}
					else
					{
						$user_purviews = '#';
					}
					/*}*/
					//设定单独权限的用户
					if( $user_purviews=='#' )
					{
						$rs = -1;
					}
					else if( $user_purviews=='*' )
					{
						$rs = 1;
					}
					else
					{
						if(    is_array($user_purviews) && isset($user_purviews[$mod]) &&
						( in_array($action, $user_purviews[$mod]) ||  in_array('*', $user_purviews[$mod]) )
						)
						{
							$rs = 1;
						} else {
							$rs = -1;
						}
					}
				}
			}
		}
		//返回检查结果
		if($backtype)
		{
			return $rs;
		}
		//直接处理异常
		else
		{
			//正常状态
			if($rs==1)
			{
				return true;
			}
			//异常状态
			else if($rs==-1)
			{
				@header('Content-Type: text/html; charset=utf-8');
				exit('权限不足, 对不起，你没权限执行本操作！');
			}
			else if($rs==-2)
			{
				$jumpurl = $this->get_control_url();
				header("Location:$jumpurl");
				exit();
			}
			else
			{
				$jumpurl = $this->get_control_url();
				header("Location:$jumpurl");
				exit();
			}
		}
	}

	/**
    * 获得用户允许访问的模块的信息
    *
    * @return bool
    *
    */
	protected function _check_purview_mods()
	{
		$rs = '';
		$userGroups = explode(',', $this->user_groups);
		if( !is_array($userGroups) )
		{
			$rs = '#';
		}
		foreach($userGroups as $userGroup)
		{
			//$userGroup = preg_replace("/[^\w]/", '', $userGroup);
			list($appname, $gp) = explode('-', $userGroup);
			if( isset(self::$cfg_groups['apps'][$appname]['private'][$gp]['allow']) )
			{
				$rs[$appname] = self::$cfg_groups['apps'][$appname]['private'][$gp]['allow'];
			}
		}
		if( !is_array($rs) )
		{
			$rs = '#';
		}
		return $rs;
	}

	/**
    * 注销登录
    */
	public function loginout()
	{
		if(APPNAME!='admin'){
			$fields=self::get_instance()->fields;
			if(!empty($fields['uid'])){
				$user_table = self::$user_table;
				lib_database::wquery('DELETE FROM `'.$user_table.'_'.APPNAME.'_session` WHERE uid='.$fields['uid']);
			}
		}
		$_SESSION['uid'] = '';
		session_destroy();
		$this->_drop_cookie(session_id());
		$this->_drop_cookie('uid');
		return true;
	}

	/**
     * 检测用户登录情况
     * @return int 返回值： 0 无该用户， -1 密码错误 ， 1 登录正常
     */
	public function check_user($account, $loginpwd, $keeptime=86400)
	{
		global $_webset;
		$user_table = self::$user_table;
		//检测用户名合法性
		$ftype = 'user_name';
		if( lib_validate::email($account) )
		{
			$ftype = 'email';
		}
		else if( !lib_validate::user_name($account) )
		{
			//throw new Exception('会员名格式不合法！');
			//return 0;
			return array('cod'=>0,'msg'=>'会员名格式不合法');
		}
		//同一ip使用某帐号连续错误次数检测
		/*
		if( $this->get_login_error24( $account ) )
		{
		//throw new Exception('连续登录失败超过5次，暂时禁止登录！');
		//return -5;
		return array('cod'=>-5,'msg'=>'连续登录失败超过5次，暂时禁止登录！');
		}
		*/
		//读取用户数据
		//$adds = ($this->app_name=='admin' ? " and apps='admin' " : '');
		$adds = " and apps='".($this->app_name)."' ";
		$row = lib_database::get_one( "Select * From `{$user_table}` where `{$ftype}` like '{$account}' $adds ");
		//存在用户数据
		if(is_array($row))
		{
			$row['accounts'] = $account;
			//禁用管理员在前端登录
			/*if( $this->app_name != 'admin' && $row['apps']=='admin')
			{
			//throw new Exception ('此帐号登录受限制！');
			//return -1;
			return array('code'=>-1,'msg'=>'此帐号登录受限制！');
			}else*/
			if( $row['sta']==0 && $_webset['site_activation']==1 && $this->app_name=='home')
			{
				//throw new Exception ('邮箱位激活！<a target="_blank" href="'.u('user','activation',array('op'=>'againactivation','email'=>$row['email'])).'">立即激活</a>');
				//return -2;
				return array('code'=>-2,'msg'=>'邮箱未激活！<a target="_blank" href="'.u('user','activation',array('op'=>'againactivation','email'=>$row['email'])).'">立即激活</a>');
			}
			//密码错误，保存登录记录
			else if( $row['userpwd'] != $this->_get_encodepwd($loginpwd) )
			{
				//$this->save_login_history($row, -1);
				//throw new Exception ('密码错误！');
				//return -1;
				return array('code'=>-1,'msg'=>'密码错误！');
			}
			//正确生成会话信息
			else
			{
				//$this->save_login_history($row, 1);
				$this->_put_logininfo($row, $keeptime);
				//$this->get_userinfos();
				//return 1;
				return array('code'=>1,'msg'=>'');
			}
		}
		//不存在用户数据时不进行任何操作
		else
		{
			//$row['accounts'] = $account;
			//$this->save_login_history($row, -1);
			//throw new Exception ('用户不存在！');
			//return 0;
			return array('code'=>0,'msg'=>'用户不存在！');
		}
	}

	/**
    * 把指定用户保持登录状态
    * @parem $account  帐号
    * @parem $actype   帐号类型(uid user_name email)
    * @parem $keeptime 登录状态保存时间
    * @return bool
    */
	public function keep_user( $account, $actype = 'uid', $keeptime=86400 )
	{
		$user_table = self::$user_table;
		$expr = $actype=='uid' ? '=' : 'like';
		$row = lib_database::get_one( "Select * From `{$user_table}` where `{$actype}` {$expr} '{$account}' " );
		if( !is_array( $row ) )
		{
			//throw new Exception('指定的用户不存在！');
			return false;
		}
		//$this->save_login_history($row, 1);
		$this->_put_logininfo($row, $keeptime);
		$this->uid = $row['uid'];
		$this->get_userinfos();
		return true;
	}


	/**
    * 检测用户24小时内连续输错密码次数是否已经超过
    * @return bool 超过返回true, 正常状态返回false
    */
	public function get_login_error24( $accounts )
	{
		global $_ip;
		$user_table = self::$user_table;
		$error_num = 5;
		$day_starttime =  strtotime("today");
		$hash = md5($accounts.'-'.$_ip);
		$query = "Select SQL_CALC_FOUND_ROWS `loginsta` From `{$user_table}_login_history` where `hash`='{$hash}'
                  And `logintime` > {$day_starttime} order by `logintime` desc limit {$error_num}";
		$rc = lib_database::query( $query );
		$info_row = lib_database::get_one(' SELECT FOUND_ROWS() as dd ');
		if( $info_row['dd'] < $error_num)
		{
			return false;
		}
		while( $row = lib_database::fetch_one($rc) )
		{
			if( $row['loginsta'] > 0 )
			{
				return false;
			}
		}
		return true;
	}

	/**
    * 保存历史登录记录
    */
	public function save_login_history(&$row, $loginsta)
	{
		global $_ip;
		$ltime = time();
		$user_table = self::$user_table;
		if( !isset($row['accounts']) )
		{
			$row['accounts'] = $row['user_name'];
		}
		$hash = md5($row['accounts'].'-'.$_ip);
		$row['uid'] = isset($row['uid']) ? $row['uid'] : 0;

		lib_database::query( "Update `{$user_table}` set `logintime`='{$ltime}', `loginip`='{$_ip}' where `uid` = '{$row['uid']}' " );

		$query = "INSERT INTO `{$user_table}_login_history` (`uid`, `accounts`, `loginip`, `logintime`, `apps`, `loginsta`, `hash`)
                  VALUES('{$row['uid']}', '{$row['accounts']}', '{$_ip}', '{$ltime}', '{$this->app_name}', '{$loginsta}', '{$hash}'); ";

		$q = lib_database::query($query, true);

	}

	/**
    * 保存登录信息
    */
	protected function _put_logininfo(&$row, $keeptime=0)
	{
		global $_ip;
		$user_table = self::$user_table;
		$ltime = time();
		$this->uid = $row['uid'];
		//保存登录用户session
		if(APPNAME!='admin'){
			$user_fields=lib_database::get_one('select b.* from '.$user_table.'_'.APPNAME.'_fields as b WHERE b.uid='.$this->uid);
			if(empty($user_fields)){
				$user_fields=array();
				lib_database::wquery('insert ignore `'.$user_table.'_'.APPNAME.'_fields` (`uid`) VALUES ('.$this->uid.')');
			}
			unset($row['userpwd'],$row['accounts']);
			$user_fields=array_merge($user_fields,$row);
			$user_fields['lastactivity']=$GLOBALS['_timestamp'];//用户活动时常
			$_fields = '`' . implode('`, `', array_keys($user_fields)) . '`';
			$_data = lib_database::format_insert_data($user_fields);
			//修改登陆信息
			lib_database::wquery('update `'.self::$user_table.'` set `logintime`='.$GLOBALS['_timestamp'].',`loginip`=\''.$_ip.'\' where uid='.$this->uid);
			$user_login=lib_database::get_one('select count(*) as islogin from '.$user_table.'_'.APPNAME.'_session as b WHERE uid='.$this->uid);
			//保存seeeion
			if(empty($user_login['islogin'])){
				lib_database::wquery('replace into `'.$user_table.'_'.APPNAME.'_session` ('.$_fields.') VALUES '.$_data);
			}else{
				lib_database::wquery('update `'.$user_table.'_'.APPNAME.'_session` set `lastactivity`=\''.$GLOBALS['_timestamp'].'\' where uid=\''.$this->uid.'\'');
			}
			lib_database::wquery('delete from `'.self::$user_table.'_'.APPNAME.'_session` where lastactivity<'.($GLOBALS['_timestamp']-$GLOBALS['config']['onlinehold']));
		}
		if(self::$cfg_groups['apps'][$this->app_name]['auttype']=='session')
		{
			$_SESSION[$this->acc_hand.APPNAME.'_uid'] = $this->uid;
			$this->_put_cookie(session_id(), session_id(), $keeptime, false);
		}
		$this->_put_cookie(APPNAME.'_uid', $this->uid, $keeptime);
		return $ltime;
	}

	/**
    * 会员密码加密方式接口（默认是 md5）
    */
	public function _get_encodepwd($pwd)
	{
		return md5($pwd);
	}

	/**
     * 保存一个cookie值
     * $key, $value, $keeptime
     */
	protected function _put_cookie($key, $value, $keeptime=0, $encode=true)
	{
		_put_cookie($key, $value, $keeptime=0, $encode=true);
	}

	/**
    * 删除cookie值
    * @parem $key
    */
	protected function _drop_cookie($key, $encode=true)
	{
		_drop_cookie($key, $encode=true);
	}

	/**
    * 获得经过加密对比的cookie值
    * @parem $key
    */
	public function get_cookie($key, $encode=true)
	{
		return get_cookie($key, $encode=true);
	}

	/**
     * 获得用户上次登录时间和ip
     * @return array
     */
	public static function get_login_infos($uid)
	{
		$user_table = self::$user_table;
		lib_database::query("Select `loginip`,`logintime` From `{$user_table}_login_history` where uid='$uid' And loginsta=1 order by `logintime` desc limit 0,2 ");
		$datas = lib_database::fetch_all();
		if( isset($datas[1]) )
		{
			return $datas[1];
		} else {
			return array('loginip'=>'','logintime'=>0);
		}
	}

	/**
     * 获得客户机ip
     * @return string
     */
	public function get_cli_ip()
	{
		global $_ip;
		return $_ip;
	}

	/**
    *  保存管理日志
    *  @parem $user_name 管理员登录id 
    *  @parem $msg 具体消息（如有引号，无需自行转义）
    *  @parem $isalert=false  是否系统警告
    *  @parem $msg_hash 消息的md5值（isalert为true的时候才需要处理）
    *  pub_message::save_log("admin", "测试日志");
    */
	public static function save_log($user_name, $msg, $isalert=false, $msg_hash='')
	{
		$operate_log = PATH_DATA . '/log/user_admin_operate.log';
		$user_table = self::$user_table;
		$isalert = $isalert ? 1 : 0;
		if( $isalert==1 && $msg_hash != '')
		{
			$row = lib_database::get_one("Select * From `{$user_table}_admin_log` where `msg_hash`='{$msg_hash}' And `isread`=0 ");
			if( is_array($row) )
			{
				return true;
			}
		}
		$cur_time = time();
		//文本日志
		$logmsg = "用户：{$user_name} 时间：".date('Y-m-d H:i:s', $cur_time)." ||内容：{$msg} \n----------------------------------------\n";
		$fp = fopen($operate_log, 'a');
		fwrite($fp, $logmsg);
		fclose($fp);
		//数据库记录（可以在后台管理日志的地方查看）
		$msg = addslashes( $msg );
		$iquery = "Insert into `{$user_table}_admin_log`(`user_name`, `operate_msg`, `operate_time`, `isalert`, `msg_hash`, `isread`)
                                    values('{$user_name}', '{$msg}', ". time() .", '{$isalert}', '{$msg_hash}', 0);";
		$rs = lib_database::query($iquery, true);
		return $rs;
	}

	/**
    * 把值里的空白字符去除
    * @parem $atts
    * @parem $key
    * @return string
    */
	private static function _get_trim_atts(&$atts, $key)
	{
		if( !isset($atts[$key]) )
		{
			return '';
		} else {
			return preg_replace("/[ \t\r\n]/", '', $atts[$key]);
		}
	}


	/*
	*快捷登陆
	*/
	public function falselogin($data){
		global $_timestamp;
		//判断是否绑定
		$row=lib_database::get_one('select * from '.self::$user_table.'_token where hash=\''.$data['hash'].'\' and apps=\''.APPNAME.'\'');
		$uid=$row['uid'];
		if(empty($uid)){
			//记录数据
			$user_name='';
			if(!empty($data['synchronous'])){
				//验证用户名是否存在
				if(lib_validate::user_name($data['user_name'])){
					//验证是否被占用
					if(!check_account_exist($data['user_name'],'user_name')){
						$user_name=$data['user_name'];
					}
				}
			}
			$uid=save_user(array('user_name'=>$user_name));
			//token
			if(!empty($uid)){
				lib_database::insert('users_token',array('uid','apps','name','token','api','apiuid','hash'),array($uid,APPNAME,$data['user_name'],$data['token'],$data['api'],$data['apiuid'],$data['hash']));
				$func='hook_'.APPNAME.'_falselogin';
				if(function_exists($func)){
					$func($data);
				}
			}
		}else{
			lib_database::update('users_token',array('name'=>$data['user_name'],'token'=>$data['token']),'uid='.$uid.' and apps=\''.APPNAME.'\' AND api=\''.$data['api'].'\' AND hash=\''.$data['hash'].'\'');
		}
		//登陆
		self::keep_user($uid);
		//$this->_put_logininfo($row, 86400);
		//message(0,'登陆提示','登陆成功！',$url);
		return true;
	}
}
/* End of file lib_access.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\library\comm\lib_access.php */
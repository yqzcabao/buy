<?php
/**
 * 快捷登陆
 */
class fastlogin{
	public $loginobj;
	public $connectconfig;
	public $api;
	public $callback;

	function __construct($api){
		$this->api=$api;
		if(!file_exists(PATH_API.'/fastlogin/'.$api.'/config.php')){
			message('-1','登陆提示','快捷登陆操作错误',u('user','login'));
		}
		require PATH_API.'/fastlogin/'.$api.'/config.php';
		$config=system::getconnect($api);
		//$this->connectconfig = array_merge_multi($modules[$api], $config['config']);
		require PATH_API.'/fastlogin/'.$api.'/'.$api.'.class.php';
		$this->loginobj=new $api($config['config']);
	}

	public function login(){
		if(!empty($this->callback)){
			$this->loginobj->set_callback($this->callback);
		}
		return $this->loginobj->login();
	}

	public function callback(){
		return $this->loginobj->callback();
	}
	
	public function set_callback($url){
		$this->callback=$url;
	}
}
?>
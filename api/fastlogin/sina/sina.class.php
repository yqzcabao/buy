<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @sina.class.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}

require 'saetv2.ex.class.php';

/**
 * 新浪微博快捷登陆
 */
class sina{
	protected $apikey;
	protected $secret;
	protected $auth;
	protected $client;
	protected $token;
	protected $callback;
	protected $synchronous;


	public function __construct($config){
		global $_webset;
		$this->apikey=$config[0]['value'];
		$this->secret=$config[1]['value'];
		$this->synchronous=$config[2]['value'];
		$this->auth = new SaeTOAuthV2($this->apikey,$this->secret);
		$this->callback=$_webset['site_url'].'/?mod=user&ac=fastlogin&op=callback&api=sina';
	}

	/**
	 * 登陆连接
	 *
	 * @return unknown
	 */
	public function login(){
		return $code_url = $this->auth->getAuthorizeURL($this->callback);
	}

	function set_callback($url){
		$this->callback=$url;
	}
	
	/**
	 * 回调处理
	 */
	public function callback(){
		$code=request('code');
		if (isset($code)) {
			$keys = array();
			$keys['code'] = $code;
			$keys['redirect_uri'] = $this->callback;
			try {
				$this->token = $this->auth->getAccessToken( 'code', $keys ) ;
			}catch (Exception $e) {
				$err_msg = $e->getMessage();
				message(-1,'登陆提示',$err_msg,u('user','login'));
			}
		}
		//获取用户信息
		$this->client = new SaeTClientV2($this->apikey,$this->secret, $this->token['access_token'] );
		//$uid_get = $this->client->get_uid();
		$user_message = $this->client->show_user_by_id($this->token['uid']);//根据ID获取用户等基本信息
		if(!empty($user_message)){
			//登陆并保存用户数据
			$data['token']=$this->token['access_token'];
			$data['apiuid']=$user_message['id'];
			$data['api']="sina";
			$data['hash']=md5($data['apiuid'].$data['api']);//这个值必须是唯一的
			$data['user_name']=$user_message['screen_name'];
			//用户头像
			$data['avatar']=$user_message['profile_image_url'];
			//是否同步用户名
			$data['synchronous']=$this->synchronous;
			//完事操作处理回调
			return $data;
		}else{
			message('-1','登陆提示','登陆失败',u('user','login'));
		}
	}
}
?>
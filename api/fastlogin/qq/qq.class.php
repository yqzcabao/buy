<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @qq.class.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
/**
 * qq快捷登陆
 */
class qq{
	protected $appid;
	protected $appkey;
	protected $callback;
	protected $scope;
	protected $synchronous;

	public function __construct($config){
		global $_webset;
		$this->appid=$config[0]['value'];
		$this->appkey=$config[1]['value'];
		$this->scope=$config[2]['value'];
		$this->synchronous=$config[3]['value'];
		$callbackurl=$_webset['site_url'].'/?mod=user&ac=fastlogin&op=callback&api=qq';
		$this->callback=$callbackurl;
	}
	
	
	/**
	 * 登陆连接
	 *
	 * @return unknown
	 */
	public function login(){
		 $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
    	 $login_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=" 
        . $this->appid . "&redirect_uri=" . urlencode($this->callback)
        . "&state=" . $_SESSION['state']
        . "&scope=".$this->scope;
		return $login_url;
	}
	
	
	function set_callback($url){
		$this->callback=$url;
	}
	
	/**
	 * 回调处理
	 *return Array ( [access_token]=> 6200204c6abbdf0487df91d14b202402e80dc4032d8b2c0507035469[username] => bankonly[uid] => 507035469 )
	 */
	public function callback(){
		$state = request('state');
		$code  = request('code');
		if($state == $_SESSION['state']){
			$token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
            . "client_id=" . $this->appid. "&redirect_uri=" . urlencode($this->callback)
            . "&client_secret=" . $this->appkey. "&code=" . $code;
			$response = curl($token_url);
			if (strpos($response, "callback") !== false)
			{
				$lpos = strpos($response, "(");
				$rpos = strrpos($response, ")");
				$response  = substr($response, $lpos + 1, $rpos - $lpos -1);
				$msg = json_decode($response);
				if (isset($msg->error))
				{
				    message('-1','登陆提示','错误信息No.'.$msg->error.';错误'.$msg->error_description,u('user','login'));
					return false;
				}
			}
			$params = array();
			parse_str($response, $token);
			//token
			if(empty($token['access_token'])){
				return false;
				//message($this->login(),'登陆失败，重新登陆');
			}else{
				//登陆并保存用户数据
				$data['token']=$token['access_token'];
				$data['apiuid']=$this->get_openid($token['access_token']);
				$qquser=$this->get_user_info($token['access_token'],$data['apiuid']);
				$data['api']="qq";
				$data['hash']=md5($data['apiuid'].$data['api']);//这个值必须是唯一的
				$data['user_name']=$qquser['user_name'];
				//用户头像
				$data['avatar']=$qquser['avatar'];
				//是否同步用户名
				$data['synchronous']=$this->synchronous;
				//完事操作处理回调
				return $data;
			}
		}else{
			//message('/','状态不匹配，你可能是CSRF攻击受害者.');
			return false;	
		}
	}
	
	
	
	protected function get_openid($access_token)
	{
		$graph_url = "https://graph.qq.com/oauth2.0/me?access_token=" 
			. $access_token;
	
		$str  = curl($graph_url);
		if (strpos($str, "callback") !== false)
		{
			$lpos = strpos($str, "(");
			$rpos = strrpos($str, ")");
			$str  = substr($str, $lpos + 1, $rpos - $lpos -1);
		}
	
		$user = json_decode($str,true);
		if (isset($user['error']))
		{
			//message('/','错误信息No.'.$user['error'].';错误'.$user['error_description']);
			return false;
		}
		return $user['openid'];
	}
	
	
	protected function get_user_info($access_token,$openid)
	{
		$graph_url = 'https://graph.qq.com/user/get_user_info?access_token='.$access_token.'&oauth_consumer_key='.$this->appid.'&openid='.$openid;	
		$str  = curl($graph_url);
		if (strpos($str, "callback") !== false)
		{
			$lpos = strpos($str, "(");
			$rpos = strrpos($str, ")");
			$str  = substr($str, $lpos + 1, $rpos - $lpos -1);
		}
	
		$user = json_decode($str,true);
		if (isset($user['error']))
		{
			//message('/','错误信息No.'.$msg->error.';错误'.$user['error_description']);
			return false;
		}
		return array('user_name'=>$user['nickname'],'avatar'=>$user['figureurl_qq_2']);
	}
}
?>
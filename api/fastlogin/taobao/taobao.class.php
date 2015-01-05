<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @taobao.class.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}

/**
 * 淘宝快捷登陆
 */
class taobao{
	protected $apikey;
	protected $apisecret;
	protected $redirect_uri;
	protected $synchronous;

	public function __construct($config){
		global $_webset;
		$this->apikey=$config[0]['value'];
		$this->apisecret=$config[1]['value'];
		$this->synchronous=$config[2]['value'];
		$callbackurl=$_webset['site_url'].'/?mod=user&ac=fastlogin&op=callback&api=taobao';
		$this->redirect_uri=$callbackurl;
	}

	function set_callback($url){
		$this->redirect_uri=$url;
	}
	/**
	 * 登陆连接
	 *
	 * @return unknown
	 */
	public function login(){
		//沙箱环境
//		return 'https://oauth.tbsandbox.com/authorize?response_type=code&client_id=1021340500&redirect_uri='.urlencode($this->redirect_uri);
		return 'https://oauth.taobao.com/authorize?response_type=code&client_id='.$this->apikey.'&redirect_uri='.urlencode($this->redirect_uri);
	}

	/**
	 * 回调处理
	 */
	public function callback(){
		$code = request('code');
		$err =request('error');
		$error_description=request('error_description');
		if(!empty($err)){
			if($err=='access_denied'){//用户取消登陆
				return false;
				//message('/','返回首页');
			}else{
				//错误重新登陆
				return false;
				//message($this->login(),'操作错误('.$error_description.')，重新登陆');
			}
		}else{
			//请求参数
			$postfields= array(
						'grant_type'     => 'authorization_code',
						'client_id'     => $this->apikey,
						'client_secret' => $this->apisecret,
						'code'          => $code,
						'redirect_uri'  => $this->redirect_uri,
						);
			try
			{
				//沙箱环境
//				$token = json_decode(curl('https://oauth.tbsandbox.com/token',$postfields),true);
				$token = json_decode(curl('https://oauth.taobao.com/token',$postfields),true);
			}
			//捕获异常
			catch(Exception $e)
			{
				return false;
				//message($this->login(),'登陆失败('.$e->getMessage().')，重新登陆');
			}
			if(empty($token['access_token'])){
				return false;
				//message($this->login(),'登陆失败，重新登陆');
			}else{
				//登陆并保存用户数据
				$data['token']=$token['access_token'];
				$data['user_name']=urldecode($token['taobao_user_nick']);
				//用户头像
				//$data['avatar']='http://wwc.taobaocdn.com/avatar/getAvatar.do?userNick='.urlencode(iconv('utf-8','gbk','伤_而已')).'&width=100&height=100&type=sns';
				$data['apiuid']=$token['taobao_user_id'];
				$data['api']="taobao";
				$data['hash']=md5($data['user_name'].$data['api']);//这个值必须是唯一的
			
				//是否同步用户名
				$data['synchronous']=$this->synchronous;
				//完事操作处理回调
				return $data;
			}
		}
	}
}

?>
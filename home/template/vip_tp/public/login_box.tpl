<link href="<?=PATH_TPL;?>/static/css/login_box.css" type="text/css" rel="stylesheet"/>
<div id="dialog_log_qiandao" class="dialog-wrapper" style="display:none;top: 50%;left: 50%;margin-left: -157px;margin-top: -176px;">
<a href="javascript:void(0)" title="关闭窗口" onclick="login_box_close();"><span class="close"></span></a>
<div class="diginfo">
	<div class="qd_login">
	<div class="hc clear" id="ppLogin_qd">
		<?php $otherlogon=system::getconnect(); ?>
		<form action="<?=u('user','');?>" method="POST" onsubmit="return box_login()">
		<h3 class="hwid2">登录<?=$_webset['site_name'];?><a class="reglink" target="_blank" href="<?=u('user','register');?>">立即注册</a></h3>
		<ul>
			<li>
				<input placeholder="邮箱/用户名" id="ddusername_dgpp" name="login[email]" type="text" autocomplete="off">
				<input placeholder="请输入密码" name="login[userpwd]" id="ddpw_1" class="ddpw_1_cls" type="password" autocomplete="off">
			</li>
			<li class="btn"><input type="submit" class="sign" value="立即登录" alt="登 录" title="登 录"></li>
			<li class="ologintip">
				<div class="error" id="pperrmsg"></div>
				<a class="forgetPwd" target="_blank" href="<?=u('user','forget');?>">忘记密码？</a>
				<?php if(!empty($otherlogon)){ ?>
				<span>使用其他账号登录</span>
				<i></i>
				<?php } ?>
			</li>
		</ul>
		</form>
		<div class="sf clear"><div class="sf_content">
			<p>
				<?php foreach ($otherlogon as $key=>$value){ ?>
				<a class="<?=$key;?>" href="<?=u('user','fastlogin',array('api'=>$key));?>">
				<i></i><span><?=$value['name'];?></span>
				</a>
				<?php } ?>
			</p>
		</div></div>
	</div>
	</div>
</div>
</div>
<div class="dialog-overlay" style="display:none;background-color: rgb(0, 0, 0); width: 100%; height: 100%; opacity: 0.5; position: fixed; overflow: hidden; left: 0px; top: 0px; z-index: 999; background-position: initial initial; background-repeat: initial initial;"></div>
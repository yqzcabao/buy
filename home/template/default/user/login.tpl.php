<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/account.css" type="text/css" rel="stylesheet" />
<!--登录-->
	<div class="use_login area">
		<div class="left fl">
			<img src="<?=PATH_TPL;?>/static/images/account/login.png" alt="和小伙伴们一起来<?=$_webset['site_name'];?>吧"/>
		</div>
		<div class="right fr">
			<div class="login_title"><h3>用户登录：</h3></div>
			<div class="userInfo">
			<form action="<?=u('user','');?>" method="POST" onsubmit="return chkLogin()">
				<ul>
					<li class="name">
						<label>账号:</label>
						<input type="text" class="email user_text" name="login[email]" placeholder="邮箱/用户名" />
						<em class="err_box"></em>
					</li>
					<li class="pwd">
						<label>密码:</label>
						<input type="password" class="userpwd user_text" name="login[userpwd]" placeholder="请输入密码" />
					</li>
					<li class="remberPwd">
						<input type="checkbox" name="login[save]" class="checkPwd" checked>记住登录状态
						<a href="<?=u('user','forget');?>">忘记密码？</a>
					</li>
					<li class="loginLi">
						<input type="hidden" name="gourl" value="<?=$gourl;?>"/>
						<input type="submit" class="loginBtn" value="登录" />
					</li>
					<?php $otherlogon=system::getconnect(); ?>
					<?php if(!empty($otherlogon)){ ?>
					<li class="loginfo_other">
						<p>你也可以通过以下方式登录：</p>
						<?php foreach ($otherlogon as $key=>$value){ ?>
							<a href="<?=u('user','fastlogin',array('api'=>$key));?>" class="<?=$key;?> fl"></a>
						<?php } ?>
					</li>
					<?php } ?>
					<li class="line">
						<div class="fl"></div>
					</li>
					
					<li class="notPassLi">
						<span class="notPass fl">还没开通账号？</span>
						<a href="<?=u('user','register');?>" title="立即注册" class="jumoRegist fr">立即注册</a>
					</li>
				</ul>
			</form>	
			</div>
		</div>
	</div>
<!--登录end-->
<script type="text/javascript" src="<?=PATH_TPL;?>/static/js/login.js"></script>
<?php include(PATH_TPL."/footer.tpl.php");?>
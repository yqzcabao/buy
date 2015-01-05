<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/account.css" type="text/css" rel="stylesheet" />

<!--激活-->
	<div class="user_regist area">
		<div class="reigist_type">
			<p class="fl cur">
				<a href="<?=u('user','register');?>" class="ei fl">
					<i class="fl email "></i>
					电子邮箱注册
				</a>
				<sub></sub>
			</p>
		</div>
		<ul class="registInfo">
			<li class="regist_stup">
				<p class="fl">
					<span class="step1">
						<i>1</i>
						<br />
						填写账户信息
					</span>
					<span class="step2">
						<i>2</i>
						<br />
						邮件激活账户
					</span>
					<span class="step3 cur">
						<i>3</i>
						<br />
						注册成功
					</span>
				</p>
			</li>
		</ul>
		<li class="clear"></li>
		<p class="gx">
		<span>
			<em class="ok fl"></em>
			恭喜!您已经成功注册<?=$_webset['site_name'];?>!
		</span>
		请您妥善保管好密码!<br>
		为了您的账户安全，请去安全中心完善其他密保设置！
		</p>
		<input type="button" class="gosafeCenter" value="立即登录" onclick="location.href='<?=u('user','login');?>'">
	</div>
	
<script type="text/javascript" src="<?=PATH_TPL;?>/static/js/register.js"></script>
<script type="text/javascript" src="<?=PATH_TPL;?>/static/js/login.js"></script>
<?php include(PATH_TPL."/footer.tpl.php");?>
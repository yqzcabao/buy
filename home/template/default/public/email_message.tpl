<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/account.css" type="text/css" rel="stylesheet" />
<!--找回密码-->
<div class="area">
	<div class="logImg">
		<a href="?mod=index&ac=index" class="log" title="九块屋"></a>
	</div>
	<div class="user_pwd mauto">
		<h2><span class="findpwd">找回密码</span></h2>
		<p class="fl pwd_p">
			<span class="step1">
				<i>1</i>
				<br />
				填写账户信息
			</span>
			<span class="step2">
				<i>2</i>
				<br />
				验证身份
			</span>
			<span class="step3">
				<i>3</i>
				<br />
				设置新密码
			</span>
			<span class="step4 cur">
				<i>4</i>
				<br />
				完成
			</span>
		</p>
		<div class="clear"></div>
		<span class="findPwd_explanation">
			您的密码已经修改成功，请您牢记新密码
		</span>
		<input type="button" class="login_email" value="立即登录" onclick="window.open('<?=u('user','login');?>')">
</div>
</div>
<script type="text/javascript" src="<?=PATH_TPL;?>/static/js/register.js"></script>
<script type="text/javascript" src="<?=PATH_TPL;?>/static/js/login.js"></script>
<?php include(PATH_TPL."/footer.tpl.php");?>
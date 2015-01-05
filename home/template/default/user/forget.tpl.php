<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/account.css" type="text/css" rel="stylesheet" />

<!--找回密码-->
	<div class="user_pwd area">
		<h2><span class="findpwd">找回密码</span></h2>
		<p class="fl pwd_p">
			<span class="step1 cur">
				<i>1</i>
				<br />
				填写账户信息
			</span>
			<span class="step2">
				<i>2</i>
				<br />
				验证身份
			</span>
			<span class="step3 fo_3">
				<i>3</i>
				<br />
				设置新密码
			</span>
			<span class="step4">
				<i>4</i>
				<br />
				完成
			</span>
		</p>
		<div class="clear"></div>
		<form action="<?=u('user','forget');?>" method="POST" onsubmit="return chkforgetReg();">
		<p class="warning">小提示:忘记账号？试试您的常用邮箱，如果不行请联系客服</p>
		<div class="user_account lidiv">
			<label class="fl">注册邮箱:</label>
			<input type="text" class="account_input text_input fl" name="forget[email]" onblur="blurforgetEmail();" />
			<div class="w warning fr">
				<em class="fl"></em>
				<p class="msg">请正确填写注册或绑定的邮箱</p>
			</div>
		</div>
		<div class="verificationCode lidiv">
			<label class="fl">验证码:</label>
			<input type="text" class="code_input text_input fl" name="forget[verify]" onblur="checkforgetVerify()" />
			<img class="vercodeimg" src="<?=u('index','validate_image');?>" alt="看不清？点击更换" onclick="this.src=this.src+'?'" />
			<a href="javascript:votd(0);" onclick="$('.vercodeimg').attr('src',$('.vercodeimg').attr('src')+'?');" class="refresh_code">换一换</a>
			<div class="w warning fr msg_alert">
				<em class="fl"></em>
				<p class="msg">验证码</p>
			</div>
		</div>
		<div class="clear"></div>
		<input type="submit" value="提交" class="sub_btn" />	
		</form>			
</div>
<!--找回密码end-->
<script type="text/javascript" src="<?=PATH_TPL;?>/static/js/register.js"></script>
<script type="text/javascript" src="<?=PATH_TPL;?>/static/js/login.js"></script>
<?php include(PATH_TPL."/footer.tpl.php");?>

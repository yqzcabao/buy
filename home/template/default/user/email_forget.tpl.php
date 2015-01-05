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
			<span class="step3 cur">
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
		<?php if(!empty($userinfo['userpwd'])){ ?>
		<form action="<?=u('user','forget');?>" method="POST" onsubmit="return chkForgetPwd()">
			<div class="lidiv">
				<label class="fl">重置密码：</label>
				<input type="password" class="pwd_input pwd_text text_input" name="userpwd[userpwd]" onblur="blurPass()" onkeyup="blurPass()" />
				<div class="w wa error fr">
					<em class="fl"></em>
					<p class="msg fl">请正确填写密码</p>
				</div>
			</div>
			<div class="degree_c strong_degree">
				<div class="degree">
					<span class="fl"></span><span class="fl"></span><span class="fl"></span>
				</div>
				<div class="degree_letter">
					<span class="fl">弱</span><span class="fl">中</span><span class="fl">强</span>
				</div>
			</div>
			<div class="lidiv">
				<label class="fl">确认密码:</label>
				<input type="password" class="confirm_input confirm_text text_input" name="userpwd[reuserpwd]" onblur="return blurNPass()" onkeyup="blurNPass()" />
				<div class="w wa fr">
					<em class="fl"></em>
					<p class="msg fl">请正确填写确认密码</p>
				</div>
			</div>
			<input type="hidden" name="userpwd[code]" value="<?=$code;?>">
			<input type="submit" value="提交" class="sub_btn forget" />
	</form>
	<?php }else{ ?>
	<span class="findPwd_explanation">
		你是用的是第三方登陆<a href="javascript:void(0)">立即登录设置密码</a>				
	</span>
	<div class="quickLogin" style="min-height:0">
		<?php foreach ($bind as $key=>$value){ ?>
			<a href="<?=u('user','fastlogin',array('api'=>$key));?>" target="_blank" class="<?=$key;?> fl"></a>
		<?php } ?>
	</div>
	<?php } ?>
</div>
</div>
<script type="text/javascript" src="<?=PATH_TPL;?>/static/js/register.js"></script>
<script type="text/javascript" src="<?=PATH_TPL;?>/static/js/login.js"></script>
<?php include(PATH_TPL."/footer.tpl.php");?>
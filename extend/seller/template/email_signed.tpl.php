<?php require tpl_extend("pub/header.tpl");?>
<link href="<?=PATH_TPL;?>/static/css/account.css" type="text/css" rel="stylesheet" />
<?php if($activatinglog['type']=='forget'){ ?>
<div class="user_pwd area">
		<h2><span class="findpwd">找回密码</span></h2>
		<p class="fl pwd_p">
			<span class="step1">
				<i>1</i>
				<br />
				填写账户信息
			</span>
			<span class="step2 cur">
				<i>2</i>
				<br />
				验证身份
			</span>
			<span class="step3">
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
		<span class="findPwd_explanation">
		我们已将<?=$_webset['site_name'];?>找回密码邮件发送到您的邮箱<br />
		<a href="<?=$maildomain;?>"><?=$email;?></a>中,请在30分钟内收信重置密码
		</span>
		<input type="button" class="login_email" value="立即登录邮箱验证" onclick="window.open('<?=$maildomain;?>')" />
		<div class="email_footer">
			<p class="notReceive">还没收到验证邮件?</p>
			<p class="sendOnce">尝试到广告、垃圾邮件目录里找找看，或者  
				<a href="javascript:void(0)" onclick="againemail('<?=$email;?>','forget');">重新发送<em id="againemail"></em></a> 找回密码邮件
			</p>
		</div>		
</div>
<?php }elseif($activatinglog['type']=='bind'){ ?>
<div class="user_pwd area">
		<h2><span class="findpwd">绑定邮箱</span></h2>
		<p class="fl pwd_p" style="width:300px">
			<span class="step1">
				<i>1</i>
				<br />
				填写邮箱
			</span>
			<span class="step2 cur">
				<i>2</i>
				<br />
				验证身份
			</span>
			<span class="step3" style="right: -10px;">
				<i>3</i>
				<br />
				完成
			</span>
		</p>
		<div class="clear"></div>
		<span class="findPwd_explanation">
		我们已将<?=$_webset['site_name'];?>绑定邮箱的邮件发送到您的邮箱<br />
		<a href="<?=$maildomain;?>"><?=$email;?></a>中,请在30分钟内收信激活绑定
		</span>
		<input type="button" class="login_email" value="立即登录邮箱验证" onclick="window.open('<?=$maildomain;?>')" />
		<div class="email_footer">
			<p class="notReceive">还没收到验证邮件?</p>
			<p class="sendOnce">尝试到广告、垃圾邮件目录里找找看，或者  
				<a href="javascript:void(0)" onclick="againemail('<?=$email;?>','bind');">重新发送<em id="againemail"></em></a> 找回密码邮件
			</p>
		</div>		
</div>
<?php }elseif($activatinglog['type']=='register'){ ?>
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
				<span class="step2 cur">
					<i>2</i>
					<br />
					邮件激活账户
				</span>
				<span class="step3">
					<i>3</i>
					<br />
					注册成功
				</span>
			</p>
		</li>
	</ul>
	<div class="clear"></div>
	<div class="send">
		<p class="sendtoemail">
			验证邮件已经发送至&nbsp;<span><?=$email;?></span>
			<br>
			请在48小时以内登录邮箱验证！
		</p>
		<a href="<?=$maildomain;?>" rel="nofollow" class="loginE" target="_blank">立即登录邮箱验证</a>
	</div>
	
	<div class="step2txt">
	  <h3>还没收到验证邮件?</h3>1.尝试到广告、垃圾邮件目录里找找看，或者&nbsp;
	  <a href="javascript:;" type-data="confirmation_instructions" onclick="againemail('<?=$email;?>','register');">重新发送<em id="againemail"></em></a>&nbsp;激活邮件
	  <br>
	  2.邮箱是否填写正确
	  <br>
	  3.如果始终无法验证成功，请&nbsp;
	  <a href="<?=u('user','register',array('email'=>$email));?>">重新注册</a>
	</div>
</div>
<?php } ?>
<script type="text/javascript" src="<?=PATH_TPL;?>/static/js/register.js"></script>
<?php require tpl_extend("pub/footer.tpl");?>
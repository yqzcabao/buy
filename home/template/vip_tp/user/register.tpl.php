<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/account.css" type="text/css" rel="stylesheet" />
<div class="area" style="background: #fff;">
<!--注册-->
	<div class="user_regist">
		<div class="reigist_type">
			<p class="fl cur">
				<a href="javascript:;" onclick="registtype('regist');" class="ei fl">
					<i class="fl email "></i>
					电子邮箱注册
				</a>
				<sub></sub>
			</p>
			<?php if(!empty($otherlogon)){ ?>
			<p class="fl lose">
				<a href="javascript:;" onclick="registtype('quick');" class="ph fl">
					<i class="fl phone"></i>
					快捷登陆
				</a>
				<sub></sub>
			</p>
			<?php } ?>
		</div>
		<form action="<?=u('user','register');?>" method="POST" onsubmit="return chkReg()">
		<ul class="registInfo">
			<li class="regist_stup">
				<p class="fl">
					<span class="step1 cur">
						<i>1</i>
						<br />
						填写账户信息
					</span>
					<span class="step2">
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
			<li class="clear"></li>
			<li class="email_li mb20 fl">
				<label class="email_label fl">邮箱:</label>
				<input type="text" class="email_text text_input fl" name="reg[email]" onblur="return blurEmail();"/>
				<div class="msg_alert fl">
					<em class="warning fl"></em>
					<span class="msg fl">请正确填写邮箱</span>
				</div>
			</li>
			<li class="resgist_pwd mb20 fl">
				<label class="pwd_label fl">密码:</label>
				<input type="password" class="pwd_text text_input fl" name="reg[userpwd]" onblur="blurPass()" onkeyup="blurPass()"/>
				<div class="msg_alert fl">
					<em class="warning fl"></em>
					<span class="msg fl">请正确填写密码</span>
				</div>
			</li>
			<li class="strong_degree mb20 fl">
				<div class="degree">
					<span class="fl"></span><span class="fl "></span><span class="fl"></span>
				</div>
				<div class="defree_t fl">
					<span class="fl">弱</span><span class="fl">中</span><span class="fl">强</span>
				</div>
			</li>
			<li class="confirm_pwd mb20 fl">
				<label class="confirm_label fl">确认密码:</label>
				<input type="password" class="confirm_text text_input fl" name="reg[reuserpwd]" onblur="blurNPass()" onkeyup="blurNPass()"/>
				<div class="msg_alert fl">
					<em class="warning fl"></em>
					<span class="msg fl">请正确填写确认密码</span>
				</div>
			</li>
			<li class="velocit_code mb20 fl">
				<label class="vercode_label fl">验&nbsp;证&nbsp;码:</label>
				<input type="text" class="vercode_text text_input fl" name="reg[verify]"/>
				<img class="vercodeimg fl" src="<?=u('index','validate_image');?>" alt="看不清？点击更换" onclick="this.src=this.src+'?'" />
				<a href="javascript:void(0);" onclick="$('.vercodeimg').attr('src',$('.vercodeimg').attr('src')+'?');" class="changeVercode fl">换一换</a>
				<div class="msg_alert fl">
					<em class="warning fl"></em>
					<span class="msg fl">请填写验证码</span>
				</div>
			</li>
			<li class="areee mb20 fl">
				<input type="checkbox" class="agreement che fl" checked/>我已经认真阅读并同意<?=$_webset['site_name'];?>
				<a href="<?=u('help','info',array('id'=>$_webset['base_agreement']));?>" title="<?=$_webset['site_name'];?>用户协议" target="_blank" class="fl">《用户注册协议》</a>
				<div class="msg_alert fl">
					<em class="warning fl"></em>
					<span class="msg fl">请确认您已看过并同意
						<a href="<?=u('help','info',array('id'=>$_webset['base_agreement']));?>" title="<?=$_webset['site_name'];?>用户协议">《用户协议》</a>
					</span>
				</div>
			</li>
			<li class="regist_atonce fl">
				<input type="submit" class="regist" name="regist" value="立即注册" />
			</li>
		</ul>
		<!--//快捷登陆-->
		<?php $otherlogon=system::getconnect(); ?>
		<?php if(!empty($otherlogon)){ ?>
		<div class="quickLogin" style="display:none">
			<?php foreach ($otherlogon as $key=>$value){ ?>
				<a href="<?=u('user','fastlogin',array('api'=>$key));?>" target="_blank" class="<?=$key;?> fl"></a>
			<?php } ?>
		</div>
		<?php } ?>
		</form>
	</div>
</div>
<!--注册end-->
<script type="text/javascript" src="<?=PATH_TPL;?>/static/js/register.js"></script>
<?php include(PATH_TPL."/footer.tpl.php");?>
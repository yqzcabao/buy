<form action="<?=u('user','base',array('op'=>$op));?>" method="POST" onsubmit="return setpassword();">
	<?php if(check_set_pwd()){ ?>
   	 <div class="item">
		  <label class="fl">原密码：</label>
		  <input type="password" name="userinfo[userpwd]" class="input_text pwd" onblur="oldpass()">
		  <span></span>
	 </div>
	 <?php } ?>
	 <div class="item">
		  <label class="fl">新密码：</label>
		  <input type="password" name="userinfo[newuserpwd]" class="input_text newpwd" onblur="blurPass()" onkeyup="blurPass()" />
		  <span></span>
	 </div>					 
	 <div class="item">
		  <label class="fl">确认密码：</label>
		  <input type="password" name="userinfo[reuserpwd]" class="input_text conpwd" onblur="blurNPass()" onkeyup="blurNPass()">
		  <span></span>
	 </div>
	 <div class="item">
	 	<label class="fl">&nbsp;</label>
		<input type="submit" value="保存" class="save btn"/>
	 </div>
</form>
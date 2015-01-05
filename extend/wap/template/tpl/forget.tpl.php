<?php require tpl_extend(WAP_TPL.'/pub/header.tpl');?>
<div class="logindd">
<div class="logind">
    <ul>
	    <form action="<?=u(MODNAME,'forget');?>" method="post">
	        <input type="hidden" name="forgetform" value="1">
	    	<input type="hidden" name="formhash" value="<?=formhash();?>">
	        <li><input class="loginname" type="text" value="" name="forget[email]" placeholder="用户名\邮箱"></li>
	        <li>
	        	<input class="yam" type="text " value="" placeholder="验证码" name="forget[verify]"> 
	        	<img id="captcha_img" style="float: left; margin-top: 10px;" width="85" height="40" src="<?=u('index','validate_image',array('h'=>40,'w'=>80));?>" onclick="$('#captcha_img').attr('src',$('#captcha_img').attr('src')+'?');">
				<a class="refresh" onclick="$('#captcha_img').attr('src',$('#captcha_img').attr('src')+'?');" style="margin-top:10px">刷新</a></li>
	        </li>
	        <li>
	        </li><li><input style="background-color: #4dac14; margin-top: 20px;" type="submit" value="找回密码" class="loginbtn1"></li>
	    </form>
    </ul>
</div>
</div>
<?php if(!empty($error)){ ?>
<script> Dialog.show('<?=$error;?>'); </script>
<?php } ?>
<?php require tpl_extend(WAP_TPL.'/pub/footer.tpl');?>
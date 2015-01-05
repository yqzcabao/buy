<?php require tpl_extend(WAP_TPL.'/pub/header.tpl');?>
<div class="logindd">
    <div class="logind">
        <form action="<?=u(MODNAME,'register');?>" method="post" id="formg2">
            <input type="hidden" name="registerform" value="1">
            <input type="hidden" name="formhash" value="<?=formhash();?>">
            <ul>
                <li><input name="reg[email]" class="loginname" type="text" value="<?=$reg['email'];?>" placeholder="邮箱"></li>
                <li><input name="reg[user_name]" class="loginname" type="text" value="<?=$reg['user_name'];?>" placeholder="用户昵称"></li>
                <li><input name="reg[userpwd]" class="loginname" type="password" value="" placeholder="密码（6-16字符）"></li>
                <li><input name="reg[reuserpwd]" class="loginname" type="password" value="" placeholder="确认密码"></li>
                <li> <input type="text" style="width:150px;" class="loginname" name="reg[verify]" id="validcode" placeholder="验证码">
                <img id="captcha_img" width="80" height="42" style="margin-top:20px;" src="<?=u('index','validate_image',array('h'=>42,'w'=>80));?>" onclick="$('#captcha_img').attr('src',$('#captcha_img').attr('src')+'?');">
                <a class="refresh" onclick="$('#captcha_img').attr('src',$('#captcha_img').attr('src')+'?');">刷新</a></li>
                <li style="line-height: 40px;"><span>请阅读并同意</span><a href="<?=u(MODNAME,'agreement');?>">《用户注册协议》</a></li>
                <li><a class="loginbtn1" href="javascript:void(0)" onclick="register();">同意并注册</a></li>
            </ul>
        </form>
    </div>
</div>
<?php if(!empty($error)){ ?>
<script> Dialog.show('<?=$error;?>'); </script>
<?php } ?>
<?php require tpl_extend(WAP_TPL.'/pub/footer.tpl');?>
<?php require tpl_extend(WAP_TPL.'/pub/header.tpl');?>
<section class="login">
<form action="<?=u(MODNAME,'register');?>" method="POST">
	<p>
    	<label>邮箱</label>
        <input class="input_text" name="reg[email]" value="<?=$reg['email'];?>" placeholder="邮箱" type="text" />
    </p>
    <p>
    	<label>用户名</label>
        <input class="input_text" name="reg[user_name]" value="<?=$reg['user_name'];?>" placeholder="用户名" type="text" />
    </p>
	<p>
    	<label>密码</label>
        <input class="input_text" name="reg[userpwd]" placeholder="请输入密码" type="password" />
    </p>
	<p>
    	<label>确认密码</label>
        <input class="input_text" name="reg[reuserpwd]" placeholder="请再次输入密码" type="password" />
    </p>
    <p>
    	<label class="fl">证码:</label>
        <input class="input_text fl" name="reg[verify]" placeholder="请再次输入密码" type="password" style="width: 60px;margin-left: 4px;" />
        <img class="vercodeimg fl" src="<?=u('index','validate_image',array('w'=>60,'h'=>25));?>" alt="看不清？点击更换" style="margin: 0px 5px;" onclick="this.src=this.src+'?'" />
				<a href="javascript:void(0);" onclick="$('.vercodeimg').attr('src',$('.vercodeimg').attr('src')+'?');" class="changeVercode fl">换一换</a>
    </p>
    <?php if(!empty($error)){ ?>
    <span class="tip"><?=$error;?></span>
    <?php } ?>
	<p class="login_p">
        <input class="login_btn regist_btn" type="submit" value="注册" />
    </p>
</form>
</section>
<?php $otherlogon=system::getconnect(); ?>
<?php if(!empty($otherlogon)){ ?>
<section class="other_login">
	<h4>其他方式登录</h4>
	<?php foreach ($otherlogon as $key=>$value){ ?>
    <p>
    	<a href="<?=u('user','fastlogin',array('api'=>$key));?>" class="<?=$key;?>"><i class="fl"></i><?=$value['name'];?></a>
    </p>
    <?php } ?>
</section>
<?php } ?>
<?php require tpl_extend(WAP_TPL.'/pub/footer.tpl');?>
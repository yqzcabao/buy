<?php require tpl_extend(WAP_TPL.'/pub/header.tpl');?>
<section class="login">
<form action="<?=u(MODNAME,'login');?>" method="POST">
	<input type="hidden" name="loginform" value="1">
	<input type="hidden" name="formhash" value="<?=formhash();?>">
	<input type="hidden" name="gourl" value="<?=$gourl;?>">
	<p>
    	<label>用户名</label>
        <input class="user_name input_text" name="login[email]" placeholder="用户名/邮箱" type="text" />
    </p>
	<p>
    	<label>密码</label>
        <input class="password input_text" name="login[userpwd]" placeholder="请输入密码" type="password" />
    </p>
    <?php if(!empty($error)){ ?>
    <span class="tip">用户不存在</span>
    <?php } ?>
	<p class="login_p">
		<input class="login_btn" type="submit" value="登录" />
		<span class="register">
            <a href="<?=u(MODNAME,'register');?>">立即注册</a>
        </span>
	</p>
</form>
</section>
<?php $otherlogon=system::getconnect(); ?>
<?php if(!empty($otherlogon)){ ?>
<section class="other_login">
	<h4>其他方式登录</h4>
	<?php foreach ($otherlogon as $key=>$value){ ?>
    <p>
    	<a href="<?=u(MODNAME,'fastlogin',array('api'=>$key));?>" class="<?=$key;?>"><i class="fl"></i><?=$value['name'];?></a>
    </p>
    <?php } ?>
</section>
<?php } ?>
<?php require tpl_extend(WAP_TPL.'/pub/footer.tpl');?>
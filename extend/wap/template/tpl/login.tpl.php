<?php require tpl_extend(WAP_TPL.'/pub/header.tpl');?>
<?php $otherlogon=system::getconnect(); ?>
<div class="hpz_returntop"><span>登录<?=$_webset['site_name'];?></span></div>
<div class="logindd">
    <div class="logind">
        <form action="<?=u(MODNAME,'login');?>" method="post" id="formg">
        	<input type="hidden" name="loginform" value="1">
        	<input type="hidden" name="formhash" value="<?=formhash();?>">
        	<input type="hidden" name="gourl" value="<?=$gourl;?>">
            <ul>
                <li><input class="loginname" style="margin-top: 5px" value="" name="login[email]" value="<?=$login['email'];?>" type="text" placeholder="用户名\邮箱"></li>
                <li><input class="loginname" style="margin-top: 15px;" value="" type="password" name="login[userpwd]" placeholder="密码"></li>
                <?php if($_webset['site_activation']==1){ ?>
                <li><a class="getpwda" href="<?=u(MODNAME,'forget');?>">忘记密码?</a></li>
                <?php }else{ ?>
                <p style="height:10px"></p>
                <?php } ?>
                <li><a type="submit" class="loginbtn1" href="javascript:void(0)" onclick="login();" style="margin-top: 10px;">登录</a></li>
                <li><a class="loginbtn1" style="background-color: #4dac14; margin-top: 10px;" href="<?=u(MODNAME,'register');?>">注册账号</a></li>
                <?php if(!empty($otherlogon)){ ?>
                <li><span class="mbloginw1">其他账号登录:</span></li>
                <li>
                	<?php foreach ($otherlogon as $key=>$value){ ?>
                    <a href="<?=u(MODNAME,'fastlogin',array('api'=>$key));?>" class="otlogin <?=$key;?>">
                        <i></i><?=$value['name'];?>
                    </a>
                    <?php } ?>
                </li>
                <?php } ?>
            </ul>
        </form>
    </div>
</div>
<?php if(!empty($error)){ ?>
<script> Dialog.show('<?=$error;?>'); </script>
<?php } ?>
<?php require tpl_extend(WAP_TPL.'/pub/footer.tpl');?>
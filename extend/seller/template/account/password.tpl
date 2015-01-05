<h3>修改密码</h3>
<div class="details">
    <?php if($op=='pwdcallback'){ ?>
    <div class="process">
      <p><span>验证身份</span><span class="mid">修改密码</span><span class="on">完成</span></p>
      <p class="bar over"></p>
    </div>
	<div class="msgSuccess">恭喜，您的密码修改成功！</div>
	<?php }else{ ?>
	<div class="process">
      <p><span>验证身份</span><span class="mid on">修改密码</span><span>完成</span></p>
      <p class="bar modify"></p>
    </div>
    <form action="<?=u(MODNAME,'account',array('op'=>'password'));?>" class="buss_form" method="post" onsubmit="return seller_set_pwd();">
      <ul>
      	<?php if(check_set_pwd()){ ?>
      	<li>
          <label for="tb_shop_oldpassword">原密码：</label>
          <input type="password"  name="seller[oldpassword]" id="tb_shop_oldpassword" class="text pwd">
        </li>
      	<?php } ?>
        <li>
          <label for="tb_shop_password">设置新密码：</label>
          <input type="password"  name="seller[password]" id="tb_shop_password" class="text pwd_text" onblur="blurPass()" onkeyup="blurPass()">
          <span class="tip"></span>
        </li>
        <li>
          <label for="tb_shop_password_confirm">确认新密码：</label>
          <input type="password" name="seller[password_confirm]" id="tb_shop_password_confirm" class="text confirm_text" onblur="blurNPass()" onkeyup="blurNPass()">
          <span class="tip"></span>
        </li>
        <li>
          <input type="hidden" name="formhash" value="<?=formhash();?>">
          <input class="btn btn-red" type="submit" name="setpwd" value="修改密码">
        </li>
      </ul>
	</form>
	<?php } ?>
</div>
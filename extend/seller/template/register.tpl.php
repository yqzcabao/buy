<?php require tpl_extend("pub/header.tpl");?>
<div class="acc_control clear">
  <div class="article acc_reg">
    <h1>注册卖家账号</h1>
    <form class="buss_form reg_form" action="<?=u(MODNAME,ACTNAME);?>" method="POST" onsubmit="return seller_register();">
      <ul>
        <li>
          <label for="">邮箱地址：</label>
          <input type="text" name="reg[email]" class="text" id="email" onblur="return blurEmail();">
          <span class="tip"></span>
        </li>
        <li>
          <label for="">设置密码：</label>
          <input type="password" name="reg[userpwd]" class="text pwd_text" onblur="blurPass()" onkeyup="blurPass()">
          <span class="tip"></span>
        </li>
        <li>
          <label for="">确认密码：</label>
          <input type="password" name="reg[reuserpwd]" class="text confirm_text" onblur="blurNPass()" onkeyup="blurNPass()">
          <span class="tip"></span>
        </li>
        <li>
          <input class="checkbox agreement" type="checkbox" checked style="vertical-align: -1px;">
          <a class="contract" target="_blank" href="javascript:void(0);">我已经认真阅读并同意<?=$_webset['site_name'];?>的《卖家注册协议》</a>
          <span class="tip" style="vertical-align: 2px;"></span>
        </li>
        <li>
          <input type="hidden" name="formhash" value="<?=formhash();?>">
          <input type="submit" name="register_form" class="btn btn-red" value="提交" />
        </li>
      </ul>
    </form>
  </div>
  <div class="side">
    <h3>已有账号？</h3>
    <p><a href="<?=u(MODNAME,'login');?>" class="btn">商家登录</a></p>
	<?php $otherlogon=system::getconnect(); ?>
	<?php if(!empty($otherlogon)){ ?>
    <h3>其他登录方式</h3>
    <?php foreach ($otherlogon as $key=>$value){ ?>    
    <p><a href="<?=u('seller','fastlogin',array('api'=>$key));?>" class="btn <?=$key;?> fl"><span><?=$value['name'];?></span></a></p>
    <?php } ?>
    <?php } ?>
  </div>
</div>
<?php require tpl_extend("pub/footer.tpl");?>
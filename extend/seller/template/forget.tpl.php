<?php require tpl_extend("pub/header.tpl");?>
<div class="acc_control clear">
  <div class="article">
    <h1>找回密码</h1>
    <form class="buss_form get_pass" method="POST" action="<?=u(MODNAME,ACTNAME);?>" onsubmit="return forget();">
      <ul>
        <li>
          <label for="">邮箱：</label>
          <input type="text" name="email" class="text" data-placeholder="请输入邮箱">
          <span class="tip"></span>
        </li>
        <li>
          <input type="hidden" name="formhash" value="<?=formhash();?>">
          <input type="hidden" name="forgetform" value="true">
          <button type="submit" class="btn btn-red">提交</button>
        </li>
      </ul>
    </form>
  </div>
  <div class="side">
    <p style="overflow: hidden;">
    	<a href="<?=u(MODNAME,'login');?>" class="btn fl">商家登录</a>
    	<a href="<?=u(MODNAME,'register');?>" class="btn fl">注册商家</a>
    </p>
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
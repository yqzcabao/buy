<?php require tpl_extend("pub/header.tpl");?>
<div class="acc_control clear">
  <div class="article">
    <h1>卖家登录</h1>
    <form class="buss_form log_form" action="<?=u(MODNAME,ACTNAME);?>" method="POST">
      <ul>
        <li>
          <label for="">账号：</label>
          <input type="text" class="text email" name="login[email]" placeholder="邮箱/用户名">
        </li>
        <li>
          <label for="">密码：</label>
          <input type="password" class="text userpwd" name="login[userpwd]" placeholder="请输入密码">
        </li>
        <li>
          <input type="hidden" name="gourl" value="<?=$gourl;?>"/>
          <input type="hidden" name="formhash" value="<?=formhash();?>">
		  <input type="submit" name="login_form" class="btn btn-red" value="登录" />
          <a href="<?=u('seller','forget');?>" target="_blank">忘记密码？</a>
        </li>
        <?php $otherlogon=system::getconnect(); ?>
		<?php if(!empty($otherlogon)){ ?>
		<li>
		  <p>你也可以通过以下方式登录：</p>
		  <?php foreach ($otherlogon as $key=>$value){ ?>
          <a href="<?=u('seller','fastlogin',array('api'=>$key));?>" class="btn <?=$key;?>"><span><?=$value['name'];?></span></a>
          <?php } ?>
        </li>
		<?php } ?>
      </ul>
    </form>
  </div>
  <div class="side">
    <h3>第一次使用？</h3>
    <a href="<?=u(MODNAME,'register');?>" target="_blank" class="btn">免费注册</a>
  </div>
</div>
<?php require tpl_extend("pub/footer.tpl");?>
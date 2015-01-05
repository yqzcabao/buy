<?php require tpl_extend("pub/header.tpl");?>
<div class="area manageAcc">
	<?php require tpl_extend("pub/menus.tpl");?>
	<div class="operation">
	  <?php if($op=='profile' || $op=='profile_edit'){ ?>
	  	<?php require tpl_extend("account/profile.tpl");?>
	  <?php }elseif ($op=='password' || $op=='pwdcallback'){ ?>
	  	<?php require tpl_extend("account/password.tpl");?>
	  <?php }elseif ($op=='bind_mail'){ ?>
	  	<?php require tpl_extend("account/bind_mail.tpl");?>
	  <?php }elseif ($op=='bank_accounts'){ ?>
	  	<?php require tpl_extend("account/bank_accounts.tpl");?>
	  <?php } ?>
    </div>
</div>
<?php require tpl_extend("pub/footer.tpl");?>
<?php require tpl_extend("pub/header.tpl");?>
<?php if ($op=='withdraw'){ ?>
	<?php require tpl_extend("funds/withdraw.tpl");?>
<?php }elseif ($op=='unfreeze'){ ?>
	<?php require tpl_extend("funds/unfreeze.tpl");?>
<?php }else{ ?>
	<?php require tpl_extend("funds/index.tpl");?>
<?php } ?>
<?php require tpl_extend("pub/pages.tpl");?>
<?php require tpl_extend("pub/footer.tpl");?>
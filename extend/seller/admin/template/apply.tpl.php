<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php include(PATH_TPL."/public/timepicker.tpl");?>
<?php if($op=='goods'){ ?>
	<?php include(PATH_EXTEND_TPL."/goods/goods.tpl");?>
<?php }elseif ($op=='album'){ ?>
	<?php include(PATH_EXTEND_TPL."/goods/album.tpl");?>
<?php }elseif ($op=='special'){ ?>
	<?php include(PATH_EXTEND_TPL."/goods/special.tpl");?>
<?php }elseif ($op=='try'){ ?>
	<?php include(PATH_EXTEND_TPL."/goods/try.tpl");?>
<?php }elseif ($op=='exchange'){ ?>
	<?php include(PATH_EXTEND_TPL."/goods/exchange.tpl");?>	
<?php } ?>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
<?php require tpl_extend("pub/header.tpl");?>
	<?php if($activity['type']=='goods' || $activity['type']=='album'){ ?>
		<?php require tpl_extend("deals/goods.tpl");?>
	<?php }elseif ($activity['type']=='try' || $activity['type']=='exchange'){ ?>
		<?php require tpl_extend("deals/gift.tpl");?>
	<?php }elseif ($activity['type']=='special'){ ?>
		<?php require tpl_extend("deals/special.tpl");?>
	<?php } ?>
<?php require tpl_extend("pub/footer.tpl");?>
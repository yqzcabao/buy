<?php show_header();?>
	<!--//第一步-->
	<?php if($op=='install'){ ?>
		<?php include(PATH_TPL."/install.tpl");?>
	<?php }elseif ($op=='step1'){ ?>
		<?php include(PATH_TPL."/install_step1.tpl");?>
	<?php }elseif ($op=='step2'){ ?>
		<?php include(PATH_TPL."/install_step2.tpl");?>
	<?php }elseif ($op=='success'){ ?>
		<?php include(PATH_TPL."/install_success.tpl");?>
	<?php } ?>
<?php show_footer(); ?>
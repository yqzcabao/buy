<?php include(PATH_TPL."/public/header.tpl.php");?>
<script src="<?=PATH_STATIC;?>/js/common.js" type="text/javascript"></script>
<?php if($op=='recharge'){ ?>
<?php include(PATH_EXTEND_TPL."/log/recharge.tpl");?>
<?php }elseif ($op=='withdraw'){ ?>
<?php include(PATH_EXTEND_TPL."/log/withdraw.tpl");?>
<?php }elseif ($op=='deposit'){ ?>
<?php include(PATH_EXTEND_TPL."/log/deposit.tpl");?>
<?php } ?>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
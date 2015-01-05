<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/doaddress.css" rel="stylesheet" />
<?php if(empty($address)){ ?>
<?php include(PATH_TPL."/public/appaly_addr.tpl");?>
<?php }else{ ?>
<?php include(PATH_TPL."/public/appaly_comment.tpl");?>
<?php } ?>
<?php include(PATH_TPL."/footer.tpl.php");?>
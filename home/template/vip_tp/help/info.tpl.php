<?php 
$help=gethelp();
$helpclass=gethelpcat();
include(PATH_TPL."/header.tpl.php");
?>
<link href="<?=PATH_TPL;?>/static/css/helpcenter.css" type="text/css" rel="stylesheet"/>	
<div class="area baockP">
	<?php include(PATH_TPL."/help/left.tpl");?>
	<div class="fr rightb">
		<div class="bp">
			<div class="tit">
				<h2 class="fl"><?=$article['title'];?></h2>
			</div>
			<div class="blockBL">
	            <?=$article['content'];?>
	        </div>
		</div>
	</div>
</div>			
<?php include(PATH_TPL."/footer.tpl.php");?>
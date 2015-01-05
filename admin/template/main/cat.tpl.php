<?php include(PATH_TPL."/public/header.tpl.php");?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=list">栏目管理</a></li>
    <li <?=$active['add'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=add">添加栏目</a></li>       
</ul>
<div class="box-content">
	<?php if($op=='list'){ ?>
		<?php include(PATH_TPL."/type/list.tpl.php");?>
	<?php }elseif($op=='add'){ ?>
		<?php include(PATH_TPL."/type/addtype.tpl.php");?>
	<?php } ?>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
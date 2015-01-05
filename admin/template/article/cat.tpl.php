<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=list">栏目管理</a></li>
    <li <?=$active['add'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=add">添加分类</a></li>       
</ul>
<div class="box-content">
	<?php if(request('op','list')=='list'){ ?>
		<?php include(PATH_TPL."/type/list.tpl.php");?>
	<?php }elseif(request('op')=='add'){ ?>
		<?php include(PATH_TPL."/type/addtype.tpl.php");?>
	<?php } ?>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
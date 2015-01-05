<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['add'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=add">添加试用</a></li>
	<li <?=$active['list'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=list">试用列表</a></li>
	<li <?=$active['set'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=set">试用设置</a></li>
</ul>
<div class="box-content">
   <?php if($op=='set'){ ?>
   		<?php include(PATH_TPL.'/'.MODNAME.'/try/set.tpl.php');?>
   <?php }elseif($op=='list'){ ?>
   		<?php include(PATH_TPL.'/'.MODNAME.'/try/list.tpl.php');?>
   <?php }elseif($op=='add'){ ?>
    	<?php include(PATH_TPL.'/'.MODNAME.'/try/add.tpl.php');?>
   <?php } ?>
</div>    
<?php include(PATH_TPL."/public/footer.tpl.php");?>
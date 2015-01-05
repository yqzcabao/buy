<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['add'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=add">添加兑换</a></li>
   	<li <?=$active['list'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=list">兑换列表</a></li>
	<li <?=$active['set'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=set">兑换设置</a></li>
</ul>
<p class="line"></p>
<div class="box-content">
   <?php if($op=='set'){ ?>
   		<?php include(PATH_TPL.'/'.MODNAME.'/'.ACTNAME.'/set.tpl.php');?>
   <?php }elseif($op=='list'){ ?>
   		<?php include(PATH_TPL.'/'.MODNAME.'/'.ACTNAME.'/list.tpl.php');?>
   <?php }elseif($op=='add'){ ?>
    	<?php include(PATH_TPL.'/'.MODNAME.'/'.ACTNAME.'/add.tpl.php');?>
   <?php } ?>
</div>    
<?php include(PATH_TPL."/public/footer.tpl.php");?>
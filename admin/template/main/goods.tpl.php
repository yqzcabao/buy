<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<?php if($op=='list' || $op=='over' || $op=='add'){ ?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=list">宝贝列表</a></li>
	<li <?=$active['over'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=over">过期宝贝</a></li>
	<li <?=$active['add'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=add">添加宝贝</a></li>
</ul>
<?php }elseif($op=='blist' || $op=='badd'){ ?>
<ul class="nav">
	<ul class="nav">
   		<li <?=$active['blist'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=blist">品牌宝贝</a></li>
   		<li <?=$active['badd'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=badd">添加宝贝</a></li>
   </ul>
</ul>
<?php } ?>
<div class="box-content">
	<?php if($op=='list' || $op=='over'){ ?>
		<?php include(PATH_TPL.'/'.MODNAME.'/goods/list.tpl.php');?>
	<?php }elseif($op=='add'){ ?>
		<?php include(PATH_TPL.'/'.MODNAME.'/goods/add.tpl.php');?>
	<?php }elseif($op=='blist'){ ?>
		<?php include(PATH_TPL.'/'.MODNAME.'/brand/list.tpl.php');?>
	<?php }elseif($op=='badd'){ ?>
		<?php include(PATH_TPL.'/'.MODNAME.'/brand/add.tpl.php');?>
	<?php } ?>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
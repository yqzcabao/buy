<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['set'];?>><a href="<?=$_extend_url;?>&pmod=user&op=set">会员设置</a></li>
	<li <?=$active['task'];?>><a href="<?=$_extend_url;?>&pmod=user&op=task">积分任务</a></li>
	<li <?=$active['connect'];?>><a href="<?=$_extend_url;?>&pmod=user&op=connect">快捷登陆</a></li>
	<?php if($op=='install'){ ?>
	<li <?=$active['install'];?>><a href="<?=$_extend_url;?>&pmod=user&op=install&key=<?=$connectkey;?>">安装/设置</a></li>
	<?php } ?> 
</ul>
<div class="box-content">
	<?php include(PATH_EXTEND_TPL."/user/".$op.".tpl");?>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
<?php require tpl_extend("pub/header.tpl");?>
<div class="area manageAcc">
	<div class="menus">
		<h2>报名指南</h2>
		<ul>
			<?php foreach ($guide_list as $key=>$value){ ?>
			<li <?php if($value['gid']==$guide['gid']){ ?>class="on"<?php } ?>><a href="<?=u(MODNAME,ACTNAME,array('gid'=>$value['gid']));?>" target="_self"><?=$value['title'];?></a></li>
			<?php } ?>
		</ul>
	</div>
	<div class="operation">
		<?=$guide['content'];?>
    </div>
</div>
<?php require tpl_extend("pub/footer.tpl");?>
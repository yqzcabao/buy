<?php require tpl_extend("pub/header.tpl");?>
<div class="topflow">
	<div class="area">
		<div class="fl flow_text FZ_24 C_333 TaL">报名流程</div>
		<div class="fl flow_img png"></div>
		<div class="fl flow_a"><a href="<?=u(MODNAME,'help');?>" target="_blank" class="l_red">详细流程 »</a></div>
	</div>
</div>
<div class="area form_list PT_30">
	<?php foreach ($activity_list as $key=>$value){ ?>
	<div class="single fl">
		<p><?=$value['title'];?></p>
		<span><?=$value['explain'];?></span>
		<a class="entry" target="_blank" href="<?=u(MODNAME,'deals',array('aid'=>$value['aid']));?>">立即报名</a>
		<!--<font></font>-->
	</div>
	<?php } ?>
	<div class="single_1 more fl"></div>
	<div style="clear:both;"></div>
</div>
<?php require tpl_extend("pub/footer.tpl");?>
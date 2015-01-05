<?php $active[ACTNAME]='class="nav_current"';?>
<div id="nav" class="clearfix">
	<ul class="clearfix">
	 	<li><a href="<?=u(MODNAME,'brands');?>" <?=$active['brands'];?>><span>品牌团</span></a></li>
	 	<li><a href="<?=u(MODNAME,'index');?>" <?=$active['index'];?>><span>首页</span></a></li>
	 	<li><a href="<?=u(MODNAME,'tomorrow');?>" <?=$active['tomorrow'];?> ><span>明日预告</span></a></li>
	</ul>
</div>
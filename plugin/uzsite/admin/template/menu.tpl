<script src="<?=PATH_STATIC;?>js/common.js" type="text/javascript"></script>
<?php $active[$pmod]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['set'];?>><a href="<?=$_plugin_url;?>&pmod=set">基本设置</a></li>
	<li <?=$active['nav'];?>><a href="<?=$_plugin_url;?>&pmod=nav">U站导航</a></li>
	<li <?=$active['cat'];?>><a href="<?=$_plugin_url;?>&pmod=cat">U站分类</a></li>
	<li <?=$active['goods'];?>><a href="<?=$_plugin_url;?>&pmod=goods">U站宝贝</a></li>
	<li <?=$active['push'];?>><a href="<?=$_plugin_url;?>&pmod=push">推送产品</a></li>
</ul>
<p class="line"></p>
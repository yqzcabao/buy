<script src="<?=PATH_STATIC;?>js/common.js" type="text/javascript"></script>
<?php $active[$pmod]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['set'];?>><a href="<?=$_plugin_url;?>&pmod=set">基本设置</a></li>
	<li <?=$active['adset'];?>><a href="<?=$_plugin_url;?>&pmod=adset">广告设置</a></li>
</ul>
<p class="line"></p>
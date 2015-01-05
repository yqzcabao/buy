<script src="<?=PATH_STATIC;?>js/common.js" type="text/javascript"></script>
<?php $active[$pmod]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['set'];?>><a href="<?=$_plugin_url;?>&pmod=set">基本设置</a></li>
	<li <?=$active['sys'];?>><a href="<?=$_plugin_url;?>&pmod=sys">系统设置</a></li>
	<li <?=$active['ad'];?>><a href="<?=$_plugin_url;?>&pmod=ad">广告设置</a></li>
	<li <?=$active['recapp'];?>><a href="<?=$_plugin_url;?>&pmod=recapp">推荐App</a></li>
	<li <?=$active['sign'];?>><a href="<?=$_plugin_url;?>&pmod=sign">签到设置</a></li>
	<li <?=$active['channel'];?>><a href="<?=$_plugin_url;?>&pmod=channel">频道设置</a></li>
	<li <?=$active['push'];?>><a href="<?=$_plugin_url;?>&pmod=push">消息推送</a></li>
</ul>
<p class="line"></p>

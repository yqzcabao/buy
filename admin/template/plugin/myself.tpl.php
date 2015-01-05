<?php include(PATH_TPL."/public/header.tpl.php");?>
<div class="box-content">
	<div class="table">
		<?php if(!empty($pluginlist['open'])){ ?>
        <table class="admin-tb"><tbody>
        	<tr>
	        	<th class="text-left" colspan="3">已启用插件</th>
	        </tr>
	        <?php foreach ($pluginlist['open'] as $key=>$value){ ?>
	        <tr class="hover">
	        	<td valign="top" style="width:45px">
	        		<img src="../plugin/<?=$value['identifier'];?>/static/images/plugin_logo.png" align="left">
	        	</td>
	        	<td valign="top">
	        		<span class="bold"><?=$value['name'];?></span>
	        		<span class="sml">(<?=$value['identifier'];?>)</span>
	        		<?php if(!empty($value['help'])){ ?>
	        		<span>| <a href="<?=$value['help'];?>" target="_blank" title="查看教程">查看教程</a></span>
	        		<?php } ?>
					<p><span class="light">作者: <?=$value['copyright'];?> <!--| <a href="" title="在应用中心查看">评分</a>--></span></p>
					<?php if(!empty($value['modules'])){ ?>
					<p>
						<?php foreach ($value['modules'] as $k=>$val){ ?>
						<a href="?mod=<?=MODNAME;?>&ac=do&pmod=<?=$val['name'];?>&identifier=<?=$value['identifier'];?>"><?=$val['menu'];?></a> | 
						<?php } ?>
					</p>
					<?php } ?>
				</td>
				<td align="right" valign="bottom" style="width:160px">
					<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=disable&pid=<?=$value['pluginid'];?>">关闭</a>&nbsp;&nbsp;
					<!--<a href="">更新</a>&nbsp;&nbsp;
					<a href="">卸载</a>&nbsp;&nbsp;-->
				</td>
			</tr>
			 <?php } ?>
        </tbody></table>
        <div class="mt10"></div>
        <?php } ?>
        <?php if(!empty($pluginlist['close'])){ ?>
        <table class="admin-tb"><tbody>
        	<tr>
	        	<th class="text-left" colspan="3">未启用插件</th>
	        </tr>
	        <?php foreach ($pluginlist['close'] as $key=>$value){ ?>
	        <tr class="hover">
	        	<td valign="top" style="width:45px">
	        		<img src="../plugin/<?=$value['identifier'];?>/static/images/plugin_logo.png" align="left">
	        	</td>
	        	<td valign="top">
	        		<span class="bold"><?=$value['name'];?></span>
	        		<span class="sml">(<?=$value['identifier'];?>)</span>
	        		<span>| <a href="http://bbs.wangyue.cc/forum.php?mod=viewthread&tid=15&extra=page%3D1" target="_blank" title="查看教程">查看教程</a></span>
					<p><span class="light">作者: <?=$value['copyright'];?> <!--| <a href="" title="在应用中心查看">评分</a>--></span></p>
					<?php /* if(!empty($value['modules'])){ ?>
					<p>
						<?php foreach ($value['modules'] as $k=>$val){ ?>
						<a href="?mod=<?=MODNAME;?>&ac=do&pmod=<?=$val['name'];?>&identifier=<?=$value['identifier'];?>"><?=$val['menu'];?></a> | 
						<?php } ?>
					</p>
					<?php }*/ ?>
				</td>
				<td align="right" valign="bottom" style="width:160px">
					<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=enable&pid=<?=$value['pluginid'];?>">启用</a>&nbsp;&nbsp;
					<!--<a href="">更新</a>&nbsp;&nbsp;
					<a href="">卸载</a>&nbsp;&nbsp;-->
				</td>
			</tr>
			<?php } ?>
        </tbody></table>
        <div class="mt10"></div>
        <?php } ?>
        <?php if(!empty($newplugin)){ ?>
        <table class="admin-tb"><tbody>
        	<tr>
	        	<th class="text-left" colspan="3">未安装插件</th>
	        </tr>
	        <?php foreach ($newplugin as $key=>$value){ ?>
	        <tr class="hover">
	        	<td valign="top" style="width:45px">
	        		<img src="../plugin/<?=$value['identifier'];?>/static/images/plugin_logo.png" align="left">
	        	</td>
	        	<td valign="top">
	        		<span class="bold"><?=$value['name'];?></span>
	        		<span class="sml">(<?=$value['identifier'];?>)</span>
					<p><span class="light">作者: <?=$value['copyright'];?> <!--| <a href="" title="在应用中心查看">评分</a>--></span></p>
				</td>
				<td align="right" valign="bottom" style="width:160px">
					<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=import&identifier=<?=$value['identifier'];?>">安装</a>&nbsp;&nbsp;
				</td>
			</tr>
			<?php } ?>
        </tbody></table>
        <?php } ?>
    </div>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
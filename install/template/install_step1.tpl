<div class="setup step1" style="margin-top: -123px;">
	<h2>开始安装</h2>
	<p>环境以及文件目录权限检查</p>
</div>
<div class="stepstat">
	<ul>
		<li class="current">检查安装环境</li>
		<li class="unactivated">创建数据库</li>
		<li class="unactivated last">安装</li>
	</ul>
	<div class="stepstatbg stepstat1"></div>
</div>
<div class="main">
<h2 class="title">环境检查</h2>
	<table class="tb" style="margin:20px 0 20px 55px;">
	<tbody>
	<tr>
		<th style="width: 120px;">项目</th>
		<th class="padleft">所需配置</th>
		<th class="padleft">当前服务器</th>
	</tr>
	<?php env_check($env_items); ?>
	<?php foreach ($env_items as $key=>$value){ ?>
	<tr>
		<td><?=$value['name'];?></td>
		<td class="padleft"><?=$value['r'];?></td>
		<td class="<?php if($value['status']==1){?>w<?php }else{ ?>nw<?php } ?> pdleft1"><?=$value['current'];?></td>
	</tr>
	<?php } ?>
	</tbody></table>
	<h2 class="title">目录、文件权限检查</h2>
	<table class="tb" style="margin:20px 0 20px 55px;width:90%;">
	<tbody>
	<tr>
		<th>目录文件</th>
		<th class="padleft">所需状态</th>
		<th class="padleft">当前状态</th>
	</tr>
	<?php dirfile_check($dirfile_items); ?>
	<?php foreach ($dirfile_items as $key=>$value){ ?>
	<tr>
		<td><?=$value['path'];?></td>
		<td class="w pdleft1">可写</td>
		<td class="<?php if($value['status']==1){ ?>w<?php }else{ ?>nw<?php } ?> pdleft1"><?=$value['current'];?></td>
	</tr>
	<?php } ?>
	</tbody>
	</table>
	<h2 class="title">函数依赖性检查</h2>
	<table class="tb" style="margin:20px 0 20px 55px;width:90%;">
	<tbody>
	<tr>
		<th>函数名称</th>
		<th class="padleft">检查结果</th>
	</tr>
	<?php $func_arr=check_func(); ?>
	<?php foreach ($func_arr as $key=>$value){ ?>
	<tr>
		<td><?=$value['name'];?>()</td>
		<td class="<?php if($value['status']){?>w<?php }else{ ?>nw<?php } ?> pdleft1"><?=$value['support'];?></td>
	</tr>
	<?php } ?>
	</tbody></table>
	<form action="index.php" method="post">
		<input type="hidden" name="op" value="step2">
		<div class="btnbox marginbot">
			<input type="button" onclick="history.back();" value="上一步">
			<input type="submit" value="下一步" <?php if(defined('INSTALL')){ ?>disabled<?php } ?>>
			<?php if(defined('INSTALL')){ ?>
			<input type="button" onclick="window.location.reload();" value="重新检测">
			<?php } ?>
		</div>
	</form>
</div>
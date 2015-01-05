<div class="setup step2" style="margin-top: -123px;">
	<h2>安装数据库</h2>
	<p>正在执行数据库安装</p>
</div>
<div class="stepstat">
	<ul>
		<li class="">检查安装环境</li>
		<li class="current">创建数据库</li>
		<li class="unactivated last">安装</li>
	</ul>
	<div class="stepstatbg stepstat1"></div>
</div>

<div class="main">
	<?php if($step=='mysql'){ ?>
		<?php 
			show_install();
			runquery($sql);
			runquery($datasql);
			//创建管理员
			creatmanager();
			//基本设置
			setbase();
			//清理缓存
			dir_clear(PATH_ROOT.'./data/cache');
			dir_clear(PATH_ROOT.'./data/log');
			dir_clear(PATH_ROOT.'./data/session');
			dir_clear(PATH_ROOT.'./data/static/css');
			dir_clear(PATH_ROOT.'./data/static/js');
			//生成安装文件
			hade_install();
		?>
		<script type="text/javascript">
			function setlaststep() {document.getElementById("laststep").disabled=false;window.location='index.php?op=success';}
			setlaststep();
		</script>
		<script type="text/javascript">
			setTimeout(function(){window.location='index.php?op=success'}, 30000);
		</script>
	<?php }else{ ?>
	
	<?php if(!empty($error)){ ?>
	<div class="desc">
		<b><?=$error['msg'];?></b>
		<?php if(!empty($error['error'])){ ?>
		<ul>
			<li><em class="red"><?=$error['error'];?></em></li>
		</ul>
		<br>
		<span class="red">您必须解决以上问题，安装才可以继续</span><br><br>
		<?php } ?>
		<br>
		<input type="button" onclick="history.back()" value="点击返回上一步"><br><br><br>
	</div>
	<?php }else{ ?>
	<form method="post" action="index.php">
		<input type="hidden" name="op" value="step2">
		<div id="form_items_3"><br>
			<div class="desc"><b>填写数据库信息</b></div>
			<table class="tb2"><tbody>
				<tr>
					
					<th class="tbopt <?php if($dbhosterr){ ?>red<?php } ?>" align="left">&nbsp;数据库服务器:</th>
					<td><input type="text" name="dbinfo[dbhost]" value="<?=$default['dbhost'];?>" size="35" class="txt"></td>
					<?php if($dbhosterr){ ?>
					<td class="red">数据库服务器为空，或者格式错误，请检查</td>
					<?php }else{ ?>
					<td>数据库服务器地址, 一般为 localhost</td>
					<?php } ?>
				</tr>
				<tr>
					<th class="tbopt <?php if($dbnamerr){ ?>red<?php } ?>" align="left">&nbsp;数据库名:</th>
					<td><input type="text" name="dbinfo[dbname]" value="<?=$default['dbname'];?>" size="35" class="txt"></td>
					<?php if($dbnamerr){ ?>
					<td class="red">数据库名为空，或者格式错误，请检查</td>
					<?php }else{ ?>
					<td></td>
					<?php } ?>
				</tr>	
				<tr>
					<th class="tbopt" align="left">&nbsp;数据库用户名:</th>
					<td><input type="text" name="dbinfo[dbuser]" value="<?=$default['dbuser'];?>" size="35" class="txt"></td>
					<td></td>
				</tr>
	
				<tr>
					<th class="tbopt" align="left">&nbsp;数据库密码:</th>
					<td><input type="text" name="dbinfo[dbpw]" value="" size="35" class="txt"></td>
					<td></td>
				</tr>
	
				<tr>
					<th class="tbopt <?php if($tablepreerr){ ?>red<?php } ?>" align="left">&nbsp;数据表前缀:</th>
					<td><input type="text" name="dbinfo[tablepre]" value="<?=$default['tablepre'];?>" size="35" class="txt"></td>
					<?php if($tablepreerr){ ?>
					<td class="red">数据表前缀为空，或者格式错误，请检查</td>
					<?php }else{ ?>
					<td>同一数据库运行多个程序时，请修改前缀</td>
					<?php } ?>
				</tr>
				<?php if(!$dbname_not_exists && isset($dbname_not_exists)){ ?>
				<tr>
					<th class="tbopt red" align="left">&nbsp;强制安装:</th>
					<td>
					<label><input type="checkbox" name="dbinfo[forceinstall]" value="1" style="border: 0">我要删除数据，强制安装 !!!</label>
					</td>
					<td>
					<span class="red"><?=$forceinstallerr;?></span></td>
				</tr>
				<?php } ?>
			</tbody></table>
			<div class="desc"><b>填写管理员信息</b></div>
			<table class="tb2"><tbody>
				<tr>
					
					<th class="tbopt <?php if(!empty($usernamerr)){ ?>red<?php } ?>" align="left">&nbsp;管理员账号:</th>
					<td><input type="text" name="admininfo[username]" value="<?=$default['username'];?>" size="35" class="txt"></td>
					<?php if(!empty($usernamerr)){ ?>
					<td class="red"><?=$usernamerr;?></td>
					<?php }else{ ?>
					<td></td>
					<?php } ?>
				</tr>
				<tr>
					<th class="tbopt <?php if($passworderr){ ?>red<?php } ?>" align="left">&nbsp;管理员密码:</th>
					<td><input type="password" name="admininfo[password]" value="" size="35" class="txt"></td>
					<?php if($passworderr){ ?>
					<td class="red">管理员密码为空，请填写</td>
					<?php }else{ ?>
					<td>管理员密码不能为空</td>
					<?php } ?>
				</tr>
	
				<tr>
					<th class="tbopt <?php if($password2err){ ?>red<?php } ?>" align="left">&nbsp;重复密码:</th>
					<td><input type="password" name="admininfo[password2]" value="" size="35" class="txt"></td>
					<?php if($password2err){ ?>
					<td class="red">两次密码不一致，请检查</td>
					<?php }else{ ?>
					<td></td>
					<?php } ?>
				</tr>
	
				<tr>
					<th class="tbopt <?php if(!empty($emailerr)){ ?>red<?php } ?>" align="left">&nbsp;管理员 Email:</th>
					<td><input type="text" name="admininfo[email]" value="<?=$default['email'];?>" size="35" class="txt"></td>
					<?php if(!empty($emailerr)){ ?>
					<td class="red"><?=$emailerr;?></td>
					<?php }else{ ?>
					<td></td>
					<?php } ?>
				</tr>
			</tbody></table>
			</div>
			<table class="tb2"><tbody>
				<tr>
					<th class="tbopt" align="left">&nbsp;</th>
					<td>
						<input type="button" onclick="history.back();" value="上一步">
						<input type="submit" name="submitname" value="下一步" class="btn">
					</td>
					<td></td>
				</tr>
			</tbody></table>
	</form>
	<?php } ?>
	<?php } ?>
</div>
<?php $operation[$op]='class="on"';?>
<div class="menus">
	<h2>账号管理</h2>
	<ul>
		<li <?=$operation['profile'];?><?=$operation['profile_edit'];?>><a href="<?=u(MODNAME,ACTNAME,array('op'=>'profile'));?>" target="_self">商家信息</a></li>
		<li <?=$operation['password'];?><?=$operation['pwdcallback'];?>><a href="<?=u(MODNAME,ACTNAME,array('op'=>'password'));?>" target="_self">修改密码</a></li>
		<li <?=$operation['bind_mail'];?>><a href="<?=u(MODNAME,ACTNAME,array('op'=>'bind_mail'));?>" target="_self">绑定邮箱</a></li>
		<li><a href="<?=u(MODNAME,'funds');?>" target="_self">资金管理</a></li>
	</ul>
</div>
<?php include(PATH_TPL."/user/center/center_header.tpl");?>
<?php $action[$op]='on';?>
<ul class="an_tab_nav">
    <li class="fl <?=$action['index'];?>"><a href="<?=u('user','base',array('op'=>'index'));?>">个人信息</a></li>
    <li class="fl <?=$action['pwd'];?>"><a href="<?=u('user','base',array('op'=>'pwd'));?>">密码设置</a></li>
    <?php if(empty($user['email'])){ ?>
	<li class="fl <?=$action['email'];?>"><a href="<?=u('user','base',array('op'=>'email'));?>">邮件绑定</a></li>
	<?php } ?>
	<li class="fl <?=$action['avatar'];?>"><a href="<?=u('user','base',array('op'=>'avatar'));?>">个人头像</a></li>
	<li class="fl <?=$action['account'];?>"><a href="<?=u('user','base',array('op'=>'account'));?>">关联账号</a></li>
</ul>

<div class="usermain">
	 <?php if($op=='avatar'){ ?>
	 	<?php include(PATH_TPL."/user/center/base_avatar.tpl");?>
	 <?php }elseif($op=='index'){ ?>
	 	<?php include(PATH_TPL."/user/center/base_info.tpl");?>
	 <?php }elseif($op=='pwd'){ ?>
	 	<?php include(PATH_TPL."/user/center/base_pwd.tpl");?>
	 <?php }elseif($op=='account'){ ?>
	 	<?php include(PATH_TPL."/user/center/base_account.tpl");?>
	 <?php }elseif($op=='email'){ ?>
	 	<?php include(PATH_TPL."/user/center/base_email.tpl");?>
	 <?php } ?>
	 </form>
</div>
<?php include(PATH_TPL."/user/center/center_footer.tpl");?>
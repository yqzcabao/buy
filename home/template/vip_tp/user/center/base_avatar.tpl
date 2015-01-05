<!--个人信息和个人头像-->
<div class="profile_info">
	<div class="avatar fl">
		<img alt="<?=$user['user_name'];?>" src="<?=avatar($user['uid'],'small');?>">
		<?php if($op=='index'){ ?>
		<span>
		  <a href="<?=u('user','base',array('op'=>'avatar'));?>">修改头像</a>
		</span>
		<?php } ?>
	</div>
	<div class="bigImg">
		<img alt="<?=$user['user_name'];?>" class="normal" src="<?=avatar($user['uid']);?>">
	</div>
	<div class="filebtn">
	     <input id="fileupload" type="file" class="profile-input" name="avatar" action="<?=u('ajax','operat',array('op'=>'setavatar'));?>"> 
		 <span class="input_file"></span>
	</div>
	<script type="text/javascript">
	ajaxFileUpload("fileupload",'setavatar');
	</script>
	<div class="item">
		<input type="button" onclick="show_msg('保存成功');" value="保存" class="save btn"/>
	</div>
</div>
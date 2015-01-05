<div class="blockBB" id="preview1">
	<?php if(!empty($good)){ ?>
	<img id="imageurl" src="<?=$good['pic'];?>">
	<?php }else{ ?>
	<img id="imageurl" src="<?php if(!empty($goods['pic'])){ ?><?=$goods['pic'];?><?php }else{ ?><?=DEF_GD_LOGO;?><?php } ?>" style="width:<?=$activity['width'];?>px;width:<?=$activity['height'];?>px;">
	<?php } ?>
    <p><em>图片尺寸：<b style="color:red"><?=$activity['width'];?>*<?=$activity['height'];?>px</b>支持jpg/png/gif格式</em></p>
    <p class="img">图片要保证清晰美观，不变形；图片主题突出，不会让用户产生歧义，并且图片上不能出现任何形式的广告、水印</p>			
	<p style="position: relative;cursor: pointer;width: 140px;">
		<input type="hidden" name="deal[pic]" value="<?=$goods['pic'];?>">
		<input type="hidden" name="deal[taopic]" value="<?=$goods['taopic'];?>">
		<span class="input_file"></span>
		<input type="file" value="更换图片" id="changeImg" class="profile-input" action="<?=u('ajax','operat',array('op'=>'ajaxfile','type'=>'goods'));?>" name="image">
		<script type="text/javascript">
		ajaxFileUpload("changeImg",'setapply');
		</script>
    </p>
    <span class="msg hidden picmsg" style="margin-left: 0px;margin-top: 5px;"></span>
</div>
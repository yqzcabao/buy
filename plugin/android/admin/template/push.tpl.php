<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php include(PATH_PLUGIN.'/admin/template/menu.tpl');?>
<div class="box-content">
<form method="post" action="<?=$_plugin_url;?>&pmod=push">
    <table class="table-font"><tbody>
    	<tr>
		    <th class="w120">消息标题：</th>
		    <td>
		    	<input type="text" class="textinput w270" name="msg[title]" value="<?=$msg['title'];?>">
		    	<span class="tip">通知标题。不填则默认使用该应用的名称</span>
		    </td>
		</tr>
		<tr>
		    <th class="w120">消息内容：</th>
		    <td>
		    	<textarea name="msg[content]" class="w360 h80"><?=$msg['content'];?></textarea>
		    	<span class="tip">消息内容</span>
		    </td>
		</tr>
		<tr>
		    <th class="w120">URL：</th>
		    <td>
		    	<input type="text" class="textinput w270" name="msg[url]" value="<?=$msg['url'];?>">
		    	<span class="tip">连接,可不填写</span>
		    </td>
		</tr>
		<tr>
		    <th class="w120">&nbsp;</th>
		    <td><?php if($errmsg!==true){ ?><span class="tip"><?=$errmsg;?></span><?php } ?></td>
		</tr>
    </tbody></table>
<div class="box-footer">
    <div class="box-footer-inner">
    	<input type="hidden" name="formhash" value="<?=formhash();?>">
    	<input type="submit" name="push" value="推送">
    </div>
</div>
</form>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
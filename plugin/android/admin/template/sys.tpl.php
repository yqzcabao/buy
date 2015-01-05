<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php include(PATH_PLUGIN.'/admin/template/menu.tpl');?>
<div class="box-content">
<form method="post" action="<?=$_plugin_url;?>&pmod=sys">
    <p class="line mt10 mb10"></p>
    <table class="table-font"><tbody>
    <tr>
	    <th class="w120">应用版本号：</th>
	    <td>
	    	<input type="text" class="textinput w270" name="android[android_versions]" value="<?=$_webset['android_versions'];?>" >
	    </td>
	</tr>
	<tr>
	    <th class="w120">升级包地址：</th>
	    <td>
	    	<input type="text" class="textinput w270" name="android[android_versions]" value="<?=$_webset['android_versions'];?>" >
	    </td>
	</tr>
	<tr>
	    <th class="w120">升级内容：</th>
	    <td>
	    	<textarea type="text" class="textinput w270" style="height:60px;" name="android[android_upgrade]"><?=$_webset['android_upgrade'];?></textarea>
	    	<span class="tip" style="vertical-align: top;">换行请使用："\n"</span>
	    </td>
	</tr>
	
	</tbody></table>
    <p class="line mt10 mb10"></p>
    <table class="table-font"><tbody>
	<tr>
	    <th>统计代码：</th>
	    <td>
	    	<input type="text" class="textinput w270" name="android[android_statistics]" value="<?=$_webset['android_statistics'];?>">
	    </td>
	</tr>
	<tr>
	    <th class="w120">通信秘钥：</th>
	    <td>
	    	<input type="text" class="textinput w270" name="android[android_secretkey]" value="<?=$_webset['android_secretkey'];?>" >
	    </td>
	</tr>
	</tbody></table>
    <p class="line mt10 mb10"></p>
    <table class="table-font"><tbody>
    	<tr>
		    <th class="w120">极光apikey：</th>
		    <td><input type="text" class="textinput w270" name="android[android_push_appkey]" value="<?=$_webset['android_push_appkey'];?>" ></td>
		</tr>
		<tr>
		    <th class="w120">极光secret：</th>
		    <td><input type="text" class="textinput w270" name="android[android_push_secret]" value="<?=$_webset['android_push_secret'];?>" ></td>
		</tr>
    </tbody></table>
<div class="box-footer">
    <div class="box-footer-inner">
    	<input type="hidden" name="formhash" value="<?=formhash();?>">
    	<input type="submit" name="androidsys" value="保存更改">
    </div>
</div>
</form>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
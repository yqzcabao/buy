<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php include(PATH_PLUGIN.'/admin/template/menu.tpl');?>
<div class="box-content">
<form method="post" action="<?=$_plugin_url;?>&pmod=set">
    <table class="table-font"><tbody>
    	<tr>
		    <th class="w120">应用版本号：</th>
		    <td>
		    	<input type="text" class="textinput w270" name="android[android_versions]" value="<?=$_webset['android_versions'];?>" >
		    </td>
		</tr>
		<tr>
		    <th class="w120">通信秘钥：</th>
		    <td>
		    	<input type="text" class="textinput w270" name="android[android_secretkey]" value="<?=$_webset['android_secretkey'];?>" >
		    </td>
		</tr>
    	<tr>
		    <th class="w120">安卓LOGO：</th>
		    <td>
		    	<input type="text" class="textinput w270" name="android[android_logo]" value="<?=$_webset['android_logo'];?>" >
		    	<input id="fileupload" type="file" name="android_goodsbg" action="../?mod=ajax&ac=operat&op=ajaxfile">
            	<script type="text/javascript">
				ajaxFileUpload("fileupload",'setsite_qzone_bg');
				</script>
		    </td>
		</tr>
    	<tr>
		    <th>统计代码：</th>
		    <td>
		    	<input type="text" class="textinput w270" name="android[android_statistics]" value="<?=$_webset['android_statistics'];?>" placeholder="统计代码">
		    	<span class="tip" style="margin-left:0px">如:百度统计;</span>
		    </td>
		</tr>
		<tr>
		    <th>预告显示：</th>
		    <td>
		    	<select name="android[android_updatetime]">
		    		<?php for ($i=0;$i<=23;$i++){ ?>
		    		<option value="<?=$i;?>" <?php if($i==$_webset['android_updatetime']){ ?>selected<?php } ?>><?=$i;?></option>
		    		<?php } ?>
		    	</select>&nbsp;点
            </td>
		</tr>
		<tr>
		    <th>安卓加载图：</th>
		    <td>
		    	<input type="text" class="textinput w270" name="android[android_goodsbg]" value="<?=$_webset['android_goodsbg'];?>" >
		    	<input id="fileupload" type="file" name="android_goodsbg" action="../?mod=ajax&ac=operat&op=ajaxfile">
            	<script type="text/javascript">
				ajaxFileUpload("fileupload",'setsite_qzone_bg');
				</script>
		    </td>
		</tr>
		<tr>
		    <th>背景文本：</th>
		    <td>
		    	<textarea name="android[android_bgtext]" class="w360 h80"></textarea>
		    </td>
		</tr>
    </tbody></table>
    <p class="line mt10 mb10"></p>
    <table class="table-font"><tbody>
    	<tr>
		    <th class="w120">极光apikey：</th>
		    <td><input type="text" class="textinput w270" name="android[push_appkey]" value="<?=$_webset['push_appkey'];?>" ></td>
		</tr>
		<tr>
		    <th class="w120">极光secret：</th>
		    <td><input type="text" class="textinput w270" name="android[push_secret]" value="<?=$_webset['push_secret'];?>" ></td>
		</tr>
    </tbody></table>
<div class="box-footer">
    <div class="box-footer-inner">
    	<input type="hidden" name="formhash" value="<?=formhash();?>">
    	<input type="submit" name="qzoneset" value="保存更改">
    </div>
</div>
</form>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
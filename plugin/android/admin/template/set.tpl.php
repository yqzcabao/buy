<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php include(PATH_PLUGIN.'/admin/template/menu.tpl');?>
<div class="box-content">
<form method="post" action="<?=$_plugin_url;?>&pmod=set">
	<p class="line mt10 mb10"></p>
    <table class="table-font"><tbody>
    	<tr>
		    <th class="w120">安卓LOGO：</th>
		    <td>
		    	<input type="text" class="textinput w270" name="android[android_logo]" value="<?=$_webset['android_logo'];?>" >
		    	<input id="fileupload" type="file" name="android_logo" action="../?mod=ajax&ac=operat&op=ajaxfile">
            	<script type="text/javascript">
				ajaxFileUpload("fileupload",'setsite_android_logo');
				</script>
		    </td>
		</tr>
		<tr>
		    <th>安卓加载图：</th>
		    <td>
		    	<input type="text" class="textinput w270" name="android[android_goodsbg]" value="<?=$_webset['android_goodsbg'];?>" >
		    	<input id="fileuploada" type="file" name="android_goodsbg" action="../?mod=ajax&ac=operat&op=ajaxfile">
            	<script type="text/javascript">
				ajaxFileUpload("fileuploada",'setsite_android_goodsbg');
				</script>
		    </td>
		</tr>
		<tr>
		    <th>背景文本：</th>
		    <td>
		    	<input type="text" class="textinput w270" name="android[android_bgtext]" value="<?=$_webset['android_bgtext'];?>" >
		    </td>
		</tr>
    </tbody></table>
    <p class="line mt10 mb10"></p>
    <table class="table-font"><tbody>
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
		    <th>每页数量：</th>
		    <td><input type="text" class="textinput w270" name="android[android_pagenum]" value="<?=$_webset['android_pagenum'];?>" ></td>
		</tr>
    	<tr>
		    <th class="w120">抢购按钮：</th>
		    <td><input type="text" class="textinput w270" name="android[android_buybtn_txt]" value="<?=$_webset['android_buybtn_txt'];?>" ></td>
		</tr>
		<tr>
		    <th class="w120">未开始按钮：</th>
		    <td><input type="text" class="textinput w270" name="android[android_nostartbtn_txt]" value="<?=$_webset['android_nostartbtn_txt'];?>" ></td>
		</tr>
		<tr>
		    <th class="w120">结束按钮：</th>
		    <td><input type="text" class="textinput w270" name="android[android_overbtn_txt]" value="<?=$_webset['android_overbtn_txt'];?>" ></td>
		</tr>
    </tbody></table>
    <p class="line mt10 mb10"></p>
    <table class="table-font"><tbody>
		<tr>
		    <th class="w120">分享文字：</th>
		    <td><input type="text" class="textinput w270" name="android[android_sharetxt]" value="<?=$_webset['android_sharetxt'];?>" ></td>
		</tr>
    </tbody></table>
    <p class="line mt10 mb10"></p>
<div class="box-footer">
    <div class="box-footer-inner">
    	<input type="hidden" name="formhash" value="<?=formhash();?>">
    	<input type="submit" name="androidset" value="保存更改">
    </div>
</div>
</form>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
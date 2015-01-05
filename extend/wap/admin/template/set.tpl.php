<?php include(PATH_TPL."/public/header.tpl.php");?>
<!--//START-->
<form method="post" action="<?=$_extend_url;?>&pmod=set">
	<!--//网站设置->基本设置-->
	<div class="box-content">
	<table class="table-font"><tbody>
		<tr>
            <th class="w120">开启手机版：</th>
            <td>
	         	<input type="radio" name="wap[wap_status]" value="1" id="wap_status_1">
	         		<label for="wap_status_1" class="mr10">开启</label>
	         	<input type="radio" name="wap[wap_status]" value="0" id="wap_status_0">
	         		<label for="wap_status_0" class="mr10">关闭</label>
	         	<script type="text/javascript">
	         	$("#wap_status_"+<?=intval($_webset['wap_status']);?>).attr("checked","checked");
	         	</script>
	        </td>
        </tr>
        <tr>
		    <th>二级域名：</th>
		    <td>
		    	<input type="text" class="textinput w270" name="wap[wap_domain]" value="<?=$_webset['wap_domain'];?>" placeholder="如:m.coubei.com">
		    	<span class="tip" style="margin-left:0px">如:m.coubei.com;不填写表示不适用二级域名</span>
		    </td>
		</tr>
        <tr>
		    <th>手机模板：</th>
		    <td>
		    	<select name="wap[wap_tpl]">
		    		<?php foreach ($wap_tpl as $key=>$value){ ?>
		    		<option value="<?=$key;?>" <?php if($_webset['wap_tpl']==$key){ ?>selected<?php } ?>><?=$value;?></option>
		    		<?php } ?>
		    	</select>
		    </td>
		</tr>
		<tr>
		    <th>手机版logo：</th>
		    <td>
		    	<input type="text" class="textinput w270" name="wap[wap_logo]" value="<?=$_webset['wap_logo'];?>">
            	<input id="fileupload" type="file" name="wap_logo" action="../?mod=ajax&ac=operat&op=ajaxfile">
            	<script type="text/javascript">
				ajaxFileUpload("fileupload",'setwap_logo');
				</script>
				<p>
				<span class="tip" style="margin-left:0px">默认模板尺寸110*48, <a href="http://www.wangyue.cc/software.html" class="red" target="_blank">付费制作</a></span>
				</p>
		    </td>
		</tr>
        <tr>
            <th>访问跳转：</th>
            <td>
            	<input type="radio" name="wap[wap_browse]" value="1" id="wap_browse_1">
	         		<label for="wap_browse_1" class="mr10">开启</label>
	         	<input type="radio" name="wap[wap_browse]" value="0" id="wap_browse_0">
	         		<label for="wap_browse_0" class="mr10">关闭</label>
	         	<script type="text/javascript">
	         	$("#wap_browse_"+<?=intval($_webset['wap_browse']);?>).attr("checked","checked");
	         	</script>
	         	<span class="tip">当使用移动设备访问网站时，是否自动跳转到wap页面</span>
	         </td>
        </tr>
	</tbody></table>
	</div>
	<div class="box-footer">
        <div class="box-footer-inner">
        	<input type="hidden" name="formhash" value="<?=formhash();?>">
        	<input type="submit" name="wapset" value="保存更改">
        </div>
    </div>
</form>
<!--//END-->
<?php include(PATH_TPL."/public/footer.tpl.php");?>
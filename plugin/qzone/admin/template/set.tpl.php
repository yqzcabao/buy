<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php include(PATH_PLUGIN.'/admin/template/menu.tpl');?>
<div class="box-content">
<form method="post" action="<?=$_plugin_url;?>&pmod=set">
    <table class="table-font"><tbody>
    	<tr>
		    <th class="w120">二级域名：</th>
		    <td>
		    	<input type="text" class="textinput w270" name="qzone[qzone_domain]" value="<?=$_webset['qzone_domain'];?>" placeholder="如:qzone.coubei.com">
		    	<span class="tip" style="margin-left:0px">如:qzone.coubei.com;</span>
		    </td>
		</tr>
		<tr>
		    <th>安装赠送积分：</th>
		    <td>
            	<input type="text" class="textinput w120" name="qzone[reward_qzone_register]" value="<?=$_webset['reward_qzone_register'];?>">&nbsp;积分
            </td>
		</tr>
		<tr>
		    <th>签到赠总积分：</th>
		     <td>
	            <input type="text" class="textinput w60" name="qzone[reward_qzone_sign_day]" value="<?=$_webset['reward_qzone_sign_day'];?>">&nbsp;积分,
	            连续<input type="text" class="textinput w60" name="qzone[reward_qzone_continuous_day]" value="<?=$_webset['reward_qzone_continuous_day'];?>">天-
	            递增<input type="text" class="textinput w60" name="qzone[reward_qzone_plus]" value="<?=$_webset['reward_qzone_plus'];?>">，
	            每日最多获取<input type="text" class="textinput w60" name="qzone[reward_qzone_daymax]" value="<?=$_webset['reward_qzone_daymax'];?>">&nbsp;积分
	        </td>
		</tr>
		<tr>
		    <th>顶部背景：</th>
		     <td>
	            <input type="text" class="textinput w270" name="qzone[site_qzone_bg]" value="<?=$_webset['site_qzone_bg'];?>">
            	<input id="fileupload" type="file" name="qzone_bg" action="../?mod=ajax&ac=operat&op=ajaxfile">
            	<script type="text/javascript">
				ajaxFileUpload("fileupload",'setsite_qzone_bg');
				</script>
				<p>
				<span class="tip">默认模板尺寸950*113, <a href="http://www.wangyue.cc/software.html" class="red" target="_blank">付费制作</a></span>
				</p>
	        </td>
		</tr>
		<tr>
            <th class="w120">添加到qq面板：</th>
            <td>
	         	<input type="radio" name="qzone[qzone_add_widget]" value="1" id="qzone_add_widget_1">
	         		<label for="qzone_add_widget_1" class="mr10">开启</label>
	         	<input type="radio" name="qzone[qzone_add_widget]" value="0" id="qzone_add_widget_0">
	         		<label for="qzone_add_widget_0" class="mr10">关闭</label>
	         	&nbsp;
	         	奖励:<input type="text" class="textinput w60" name="qzone[reward_qzone_add_widget]" value="<?=$_webset['reward_qzone_add_widget'];?>">积分
	         	<script type="text/javascript">
	         	$("#qzone_add_widget_"+<?=intval($_webset['qzone_add_widget']);?>).attr("checked","checked");
	         	</script>
	        </td>
        </tr>
        <tr>
            <th class="w120">认证空间qq号：</th>
            <td><input type="text" class="textinput w120" name="qzone[qzone_qq]" value="<?=$_webset['qzone_qq'];?>"></td>
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
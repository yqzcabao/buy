<?php include(PATH_TPL."/public/header.tpl.php");?>
<!--//START-->
<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>">
	<!--//网站设置->基本设置-->
	<div class="box-content">
	<table class="table-font"><tbody>
		<tr>
            <th class="w120">网站状态：</th>
            <td>
	         	<input type="radio" name="base[site_status]" value="1" id="site_status_1">
	         		<label for="site_status_1" class="mr10">开启</label>
	         	<input type="radio" name="base[site_status]" value="0" id="site_status_0">
	         		<label for="site_status_0" class="mr10">关闭</label>
	         	<script type="text/javascript">
	         	$("#site_status_"+<?=intval($_webset['site_status']);?>).attr("checked","checked");
	         	</script>
	        </td>
        </tr>
        <tr>
            <th>关闭说明：</th>
            <td><textarea class="w360 h80" name="base[site_closed_reason]"><?=$_webset['site_closed_reason'];?></textarea></td>
        </tr>
        <tr>
            <th>网站地址：</th>
            <td>
            	<input type="text" class="textinput w360" name="base[site_url]" value="<?=$_webset['site_url'];?>">
            	<span class="tip">列如：http://www.wangyue.cc</span>
            </td>
        </tr>   
        <tr>
            <th>网站名字：</th>
            <td>
            	<input type="text" class="textinput w360" name="base[site_name]" value="<?=$_webset['site_name'];?>">
            	<span class="tip">建议在5个字之内</span>
            </td>
        </tr>
        <tr>
            <th>网站标题：</th>
            <td><input type="text" class="textinput w360" name="base[site_title]" value="<?=$_webset['site_title'];?>"></td>
        </tr>
        <tr>
            <th>全局关键词：</th>
            <td><input type="text" class="textinput w360" name="base[site_metakeyword]" value="<?=$_webset['site_metakeyword'];?>"></td>
        </tr>
        <tr>
            <th>网站描述：</th>
            <td><textarea class="w360 h80" name="base[site_metadescrip]"><?=$_webset['site_metadescrip'];?></textarea></td>
        </tr>
		<tr>
		    <th>logo：</th>
		    <td>
		    	<input type="text" class="textinput w270" name="base[site_logo]" value="<?=$_webset['site_logo'];?>">
            	<input id="fileupload" type="file" name="linkpic" action="../?mod=ajax&ac=operat&op=ajaxfile">
            	<script type="text/javascript">
				ajaxFileUpload("fileupload",'setsite_logo');
				</script>
				<p>
				<span class="tip">默认模板尺寸243*47, <a href="http://www.wangyue.cc/software.html" class="red" target="_blank">付费制作</a></span>
				</p>
		    </td>
		</tr>   
        <tr>
            <th>ICP备案信息：</th>
            <td><input type="text" class="textinput w360" name="base[site_icp]" value="<?=$_webset['site_icp'];?>"></td>
        </tr>
        <tr>
            <th>版权信息：</th>
            <td><input type="text" class="textinput w360" name="base[site_copyright]" value="<?=$_webset['site_copyright'];?>"></td>
        </tr>
        <tr>
            <th style="vertical-align:top;">统计代码<br/>其他html/js代码：</th>
            <td>
            	<textarea class="w360 h80 fl" name="base[site_footer]"><?=$_webset['site_footer'];?></textarea>
            	<span class="tip fl lh80">统计代码： 建议使用 CNZZ,51la，百度等！</span>            	
            </td>
        </tr>                
	</tbody></table>
	<div class="box-footer">
        <div class="box-footer-inner">
        	<input type="hidden" name="formhash" value="<?=formhash();?>">
        	<input type="submit" name="baseset" value="保存更改">
        </div>
    </div>
	</div>
</form>
<!--//END-->
<?php include(PATH_TPL."/public/footer.tpl.php");?>
<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php include(PATH_PLUGIN.'/admin/template/menu.tpl');?>
<div class="box-content">
<form method="post" action="<?=$_plugin_url;?>&pmod=set">
    <table class="table-font"><tbody>
        <tr>
            <th class="w70">位置1：</th>
            <td>
            	<p><input type="text" placeholder="广告标题" class="textinput w360" name="screenad[1][title]" value="<?=$screenad[1]['title'];?>"></p>
            	<p style="margin-top:5px;"><input type="text" placeholder="广告链接" class="textinput w360" name="screenad[1][url]" value="<?=$screenad[1]['url'];?>"></p>
            	<p style="margin-top:5px;">
            		<input type="text" class="textinput w270" name="screenad[1][pic]" value="<?=$screenad[1]['pic'];?>">
	            	<input id="fileupload1" type="file" name="pic1" action="../?mod=ajax&ac=operat&op=ajaxfile">
	            	<script type="text/javascript">
					ajaxFileUpload("fileupload1",'setsite_pic1');
					</script>
            	</p>
            	<p><span class="tip" style="margin-left: 0px;">默认尺寸245*341, <a href="http://www.wangyue.cc/software.html" class="red" target="_blank">付费制作</a></span></p>
            </td>
        </tr>
        <tr>
            <th>位置2：</th>
            <td>
            	<p><input type="text" placeholder="广告标题" class="textinput w360" name="screenad[2][title]" value="<?=$screenad[2]['title'];?>"></p>
            	<p style="margin-top:5px;"><input type="text" placeholder="广告链接" class="textinput w360" name="screenad[2][url]" value="<?=$screenad[2]['url'];?>"></p>
            	<p style="margin-top:5px;">
            		<input type="text" class="textinput w270" name="screenad[2][pic]" value="<?=$screenad[2]['pic'];?>">
	            	<input id="fileupload2" type="file" name="pic2" action="../?mod=ajax&ac=operat&op=ajaxfile">
	            	<script type="text/javascript">
					ajaxFileUpload("fileupload2",'setsite_pic2');
					</script>
            	</p>
            	<p><span class="tip" style="margin-left: 0px;">默认尺寸245*341</span></p>
            </td>
        </tr>
        <tr>
            <th>位置3：</th>
            <td>
            	<p><input type="text" placeholder="广告标题" class="textinput w360" name="screenad[3][title]" value="<?=$screenad[3]['title'];?>"></p>
            	<p style="margin-top:5px;"><input type="text" placeholder="广告链接" class="textinput w360" name="screenad[3][url]" value="<?=$screenad[3]['url'];?>"></p>
            	<p style="margin-top:5px;">
            		<input type="text" class="textinput w270" name="screenad[3][pic]" value="<?=$screenad[3]['pic'];?>">
	            	<input id="fileupload3" type="file" name="pic3" action="../?mod=ajax&ac=operat&op=ajaxfile">
	            	<script type="text/javascript">
					ajaxFileUpload("fileupload3",'setsite_pic3');
					</script>
            	</p>
            	<p><span class="tip" style="margin-left: 0px;">默认尺寸245*170</span></p>
            </td>
        </tr>
        <tr>
            <th>位置4：</th>
            <td>
            	<p><input type="text" placeholder="广告标题" class="textinput w360" name="screenad[4][title]" value="<?=$screenad[4]['title'];?>"></p>
            	<p style="margin-top:5px;"><input type="text" placeholder="广告链接" class="textinput w360" name="screenad[4][url]" value="<?=$screenad[4]['url'];?>"></p>
            	<p style="margin-top:5px;">
            		<input type="text" class="textinput w270" name="screenad[4][pic]" value="<?=$screenad[4]['pic'];?>">
	            	<input id="fileupload4" type="file" name="pic4" action="../?mod=ajax&ac=operat&op=ajaxfile">
	            	<script type="text/javascript">
					ajaxFileUpload("fileupload4",'setsite_pic4');
					</script>
            	</p>
            	<p><span class="tip" style="margin-left: 0px;">默认尺寸245*170</span></p>
            </td>
        </tr>
        <tr>
            <th>位置5：</th>
            <td>
            	<p><input type="text" placeholder="广告标题" class="textinput w360" name="screenad[5][title]" value="<?=$screenad[5]['title'];?>"></p>
            	<p style="margin-top:5px;"><input type="text" placeholder="广告链接" class="textinput w360" name="screenad[5][url]" value="<?=$screenad[5]['url'];?>"></p>
            	<p style="margin-top:5px;">
            		<input type="text" class="textinput w270" name="screenad[5][pic]" value="<?=$screenad[5]['pic'];?>">
	            	<input id="fileupload5" type="file" name="pic5" action="../?mod=ajax&ac=operat&op=ajaxfile">
	            	<script type="text/javascript">
					ajaxFileUpload("fileupload5",'setsite_pic5');
					</script>
            	</p>
            	<p><span class="tip" style="margin-left: 0px;">默认尺寸245*170</span></p>
            </td>
        </tr>
        <tr>
            <th>位置6：</th>
            <td>
            	<p><input type="text" placeholder="广告标题" class="textinput w360" name="screenad[6][title]" value="<?=$screenad[6]['title'];?>"></p>
            	<p style="margin-top:5px;"><input type="text" placeholder="广告链接" class="textinput w360" name="screenad[6][url]" value="<?=$screenad[6]['url'];?>"></p>
            	<p style="margin-top:5px;">
            		<input type="text" class="textinput w270" name="screenad[6][pic]" value="<?=$screenad[6]['pic'];?>">
	            	<input id="fileupload6" type="file" name="pic6" action="../?mod=ajax&ac=operat&op=ajaxfile">
	            	<script type="text/javascript">
					ajaxFileUpload("fileupload6",'setsite_pic6');
					</script>
            	</p>
            	<p><span class="tip" style="margin-left: 0px;">默认尺寸245*170</span></p>
            </td>
        </tr>
    </tbody></table>
<div class="box-footer">
    <div class="box-footer-inner">
    	<input type="hidden" name="formhash" value="<?=formhash();?>">
    	<input type="submit" name="screenadset" value="保存更改">
    </div>
</div>
</form>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
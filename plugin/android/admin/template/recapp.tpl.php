<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php include(PATH_PLUGIN.'/admin/template/menu.tpl');?>
<div class="box-content">
<form method="POST" action="<?=$_plugin_url;?>&pmod=recapp&op=appdel" onsubmit="return confirmdel();">
	<div class="table">
		<table class="admin-tb"><tbody>
		    <tr>
		    	<th width="10" class="text-center">
		    		<input type="checkbox" name="all" class="allbox"  onclick="checkAll($(this),$('.checkbox'));">
		    	</th>
		    	<th width="100">图标</th>
		        <th width="200">APP标题</th>
		        <th width="200">app简介</th>
		        <th width="100">下载连接</th>
		    	<th width="100">排序</th>
		        <th width="161">操作</th>
		    </tr>
		    <?php foreach ($app as $key=>$value){ ?>
			<tr>
		        <td class="text-center">
		        	<input type="checkbox" name="aid[]" value="<?=$value['aid'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
		        </td>
		        <td class="text-center">
		        	<a href="<?=$value['href'];?>" target="_blank"><img src=".<?=$value['img'];?>" style="width:50px;margin:5px auto"></a>
		        </td>
		        <td class="text-center"><?=$value['title'];?></td>
		        <td class="text-center"><?=$value['intro'];?></td>
		        <td class="text-center"><?=$value['href'];?></td>
		        <td class="text-center"><?=$value['sort'];?></td>
		        <td class="text-center">
		        	[<a href="javascript:void(0);" onclick='edit_android_app(<?=json_encode($value);?>);'>修改</a>]
		        </td>
		    </tr>
		    <?php } ?>  
		</tbody></table>
	</div>
	<div class="box-footer">
	    <div class="box-footer-inner">
	        <input type="submit" value="删除">&nbsp;&nbsp;
	        <input type="button" name="appadd" id="appadd" value="添加">
	    </div>
	</div>
</form>
<script type="text/javascript">
function appplane(){
	/*
	<form action="<?=$_plugin_url;?>&pmod=recapp&op=appadd" id="add_app">
	<table class="table-font"><tbody>
	<tr>
		<th class="w60">应用标题：</th>
		<td><input type="text" class="textinput w270" name="app[title]"></td>
	</tr>
	<tr>
		<th class="w60">应用简介：</th>
		<td><input type="text" class="textinput w270" name="app[intro]"></td>
	</tr>
	<tr>
		<th class="w60">应用图标：</th>
		<td>
		<input type="text" class="textinput w270 fl" name="app[img]">
		<input id="fileupload" type="file" name="setsite_android_app_img" action="../?mod=ajax&ac=operat&op=ajaxfile">
		</td>
	</tr>
	<tr>
		<th class="w60">下载链接：</th>
		<td><input type="text" class="textinput w270" name="app[href]"></td>
	</tr>
	<tr>
		<th class="w60">排序：</th>
		<td>
			<input type="text" class="textinput w70" name="app[sort]">
			<input type="hidden" name="app[aid]" value="0">
		</td>
	</tr>
	<tr id="add_msg" style="display:none"><th class="w60">&nbsp;</th><td colspan="2"><span class="red"></span></td></tr>
	</tbody></table>
	</form>
	*/
}
</script>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
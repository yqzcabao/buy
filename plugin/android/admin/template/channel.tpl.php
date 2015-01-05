<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php include(PATH_PLUGIN.'/admin/template/menu.tpl');?>
<div class="box-content">
<form method="POST" action="<?=$_plugin_url;?>&pmod=channel&op=navdel" onsubmit="return confirmdel();">
	<div class="table">
		<table class="admin-tb"><tbody>
		    <tr>
		    	<th width="10" class="text-center">
		    		<input type="checkbox" name="all" class="allbox"  onclick="checkAll($(this),$('.checkbox'));">
		    	</th>
		    	<th width="100">图标</th>
		        <th width="200">频道名称</th>
		        <th width="100">频道类型</th>
		        <th width="100">频道数据</th>
		    	<th width="100">是否主页</th>
		    	<th width="100">排序</th>
		        <th width="161">操作</th>
		    </tr>
		    <?php foreach ($nav as $key=>$value){ ?>
			<tr>
		        <td class="text-center">
		        	<input type="checkbox" name="nid[]" value="<?=$value['nid'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
		        </td>
		        <td class="text-center"><a href="javascript:void(0);" style="width:38px;height:38px;display: block;background: url('.<?=$value['img'];?>');margin: 5px auto;"></a></td>
		        <td class="text-center"><?=$value['title'];?></td>
		        <td class="text-center">
		        	<?php if($value['type']=='goods'){ ?>商品列表
		        	<?php }elseif ($value['type']=='tomorrow'){ ?>明日预告
		        	<?php }elseif ($value['type']=='brands'){ ?>品牌折扣
		        	<?php }elseif ($value['type']=='user'){ ?>用户中心<?php } ?>
		        </td>
		        <td class="text-center">
		        	<?php if($value['type']=='goods'){ ?>
		        	<?php foreach ($_nav as $key=>$val){ ?>
		        		<?=in_array($val['id'],$value['nav'])?$val['name'].'&nbsp;':'';?>
		        	<?php } ?>
		        	<?php }else{ ?>
		        	--
		        	<?php } ?>
		        </td>
		        <td class="text-center"><?php if(!empty($value['home'])){ ?>是<?php }else{ ?>否<?php } ?></td>
		        <td class="text-center"><?=$value['sort'];?></td>
		        <td class="text-center">
		        	[<a href="javascript:void(0);" onclick='edit_nav(<?=json_encode($value);?>);'>修改</a>]
		        </td>
		    </tr>
		    <?php } ?>  
		</tbody></table>
	</div>
	<div class="box-footer">
	    <div class="box-footer-inner">
	        <input type="submit" value="删除">&nbsp;&nbsp;
	        <input type="button" name="navadd" id="navadd" value="添加">
	    </div>
	</div>
</form>
<script type="text/javascript">
function plane(){
	/*
	<form action="<?=$_plugin_url;?>&pmod=channel&op=navadd" id="add_nav">
	<table class="table-font"><tbody>
	<tr>
	<th class="w60">频道名称：</th>
	<td>
	<input type="text" class="textinput w270" name="nav[title]">
	<span class="tip">建议5个字之内</span>
	</td>
	</tr>
	<tr>
	<th>类型：</th>
	<td>
	<select name="nav[type]">
	<option value="goods">商品列表</option>
	<option value="tomorrow">明日预告</option>
	<option value="brands">品牌折扣</option>
	<option value="user">用户中心</option>
	</select>
	<input type="checkbox" name="nav[home]" value="1" style="margin-left: 50px;"><label>是否主页</label>
	</td>
	</tr>
	<tr class="nav_data" style="display:none">
	<th class="w60">频道数据：</th>
	<td>
	<?php foreach ($_nav as $key=>$value){ ?>
	<?php if('goods'==$value['mod']){ ?>
	<span style="display: inline-block;width: 80px;">
	<input type="checkbox" name="nav[navstr][]" id="navstr_<?=$value['id'];?>" value="<?=$value['id'];?>">
	<label for=""><?=$value['name'];?></label>
	</span>
	<?php } ?>
	<?php } ?>
	</td>
	</tr>
	<tr>
	<th class="w60">频道图标：</th>
	<td>
	<input type="text" class="textinput w70 fl" name="nav[img]">
	<input id="fileupload" type="file" name="android_nav_img" action="../?mod=ajax&ac=operat&op=ajaxfile">
	</td>
	</tr>
	<tr>
	<th class="w60">选中图标：</th>
	<td>
	<input type="text" class="textinput w70 fl" name="nav[imghover]">
	<input id="fileuploada" type="file" name="android_nav_imghover" action="../?mod=ajax&ac=operat&op=ajaxfile">
	</td>
	</tr>
	<tr>
	<th>排序：</th>
	<td>
	<input type="text" class="textinput w70" name="nav[sort]">
	<input type="hidden" name="nav[nid]" value="0">
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
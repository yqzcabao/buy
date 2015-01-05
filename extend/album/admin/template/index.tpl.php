<?php include(PATH_TPL."/public/header.tpl.php");?>
<script src="<?=PATH_STATIC;?>/js/common.js" type="text/javascript"></script>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="<?=$_extend_url;?>&pmod=index&op=list">专题管理</a></li>
	<li <?=$active['add'];?>><a href="<?=$_extend_url;?>&pmod=index&op=add">添加专题</a></li>           
</ul>
<div class="box-content">
<?php if($op=='list'){ ?>
	<form method="POST" action="<?=$_extend_url;?>&pmod=del" onsubmit="return confirmdel();">
	<div class="table">
        <table class="admin-tb"><tbody>
        <tr>
        	<th width="10" class="text-center">
        		<input type="checkbox" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
        	</th>
            <th width="200">专题名称</th>
        	<th width="30" class="text-center">模板</th>
        	<th width="150" class="text-center">推广地址</th>
        	<th width="150" class="text-center">添加时间</th>
            <th width="100" class="text-center">操作</th>
        </tr>
        <?php foreach ($album_list as $key=>$value){ ?>
        <tr id="data_<?=$value['id'];?>">
        	<td class="text-center">
        		<input type="checkbox" name="id[]" value="<?=$value['aid'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
        	</td>
            <td><?=$value['title'];?></td>
        	<td class="text-center"><?=$value['tplname'];?></td>
        	<td width="150" class="text-center">
        		<a href="<?=u('album','index',array('aid'=>$value['aid']));?>" target="_blank"><?=u('album','index',array('aid'=>$value['aid']));?></a></td>
        	<td class="text-center"><?=date('Y-m-d H:i:s',$value['addtime']);?></td>
        	<td class="text-center">
            	[<a href="<?=$_extend_url;?>&pmod=index&op=add&aid=<?=$value['aid'];?>">修改</a>]
            </td>
        </tr>
        <?php } ?>
        </tbody></table>
	</div>
	<div class="box-footer">
		<!--//分页-->
		<?php include(PATH_TPL."/public/pages.tpl");?>
	    <div class="box-footer-inner">
	    	<input type="hidden" name="op" value="album">
			<input type="hidden" name="gomod" value="index">
			<input type="hidden" name="goop" value="<?=$op;?>">
	        <input type="submit" value="删除">
	    </div>
	</div>
	</form>
<?php }else{ ?>
	<!--//START-->
	<form method="post" action="<?=$_extend_url;?>&pmod=index&op=add">
		<!--//网站设置->基本设置-->
		<div class="box-content">
		<table class="table-font"><tbody>
	        <tr>
	            <th class="w120">专题名称：</th>
	            <td><input type="text" class="textinput w360" name="album[title]" value="<?=$album['title'];?>"></td>
	        </tr>
	        <tr>
	            <th class="w120">专题简介：</th>
	            <td><input type="text" class="textinput w360" name="album[brief]" value="<?=$album['brief'];?>"></td>
	        </tr>
	        
	        <tr class="line mt5 mb5"><td colspan="2"></td></tr>
	        <tr>
	            <th>专题模板：</th>
	            <td>
	            	<select name="album[tpl]" onchange="select_tpl(this);">
	            		<option value="">请选择</option>
	            		<?php foreach ($tpl as $key=>$value){ ?>
	            		<option value="<?=$value['mark'];?>" tpl-name="<?=$value['name'];?>" tpl-group="<?=$value['group'];?>" <?php if($value['mark']==$album['tpl']){ ?>selected<?php } ?>><?=$value['name'];?></option>
	            		<?php } ?>
	            	</select>
	            </td>
	        </tr>
	        <tr style="<?php if(empty($album['group'])){ ?>display:none<?php } ?>">
	            <th>专题分组：</th>
	            <td>
	            <div id="group">
	            <?php if(!empty($album['group'])){ ?>
	            <?php foreach ($album['group'] as $k=>$val){ ?>
	            	<p style="margin-bottom: 5px;">
	            	<input type="text" class="textinput" name="album[group][]" value="<?=$val;?>" placeholder="专题分组">
	            	<?php if($k!=0){ ?>
	            	<a href="javascript:void(0);" class="tip" onclick="del_group(this);">-删除</a>
	            	<?php } ?>
	            	</p>
	            <?php } ?>
	            <a href="javascript:void(0);" class="tip add_group" style="margin-left:0px" onclick="add_group();">+添加分组</a>
	            <?php } ?>
	            </div></td>
	        </tr>
	        <tr class="line mt5 mb5"><td colspan="2"></td></tr>
	        <tr>
	            <th class="w120">是否首页显示：</th>
	            <td>
	            	<input type="radio" name="album[index_show]" id="index_show_1" value="1"><label for="index_show_1">显示</label>&nbsp;
	            	<input type="radio" name="album[index_show]" id="index_show_0" value="0"><label for="index_show_0">不显示</label>&nbsp;
	            	<script type="text/javascript">
		         	$("#index_show_"+<?=intval($album['index_show']);?>).attr("checked","checked");
		         	</script>
	            </td>
	        </tr>
	        <tr>
	            <th class="w120">专题封面：</th>
	            <td>
	            	<input type="text" class="textinput w270" name="album[cover]" value="<?=$album['cover'];?>">
	            	<input id="fileupload" type="file" name="cover" action="../?mod=ajax&ac=operat&op=ajaxfile">
	            	<script type="text/javascript">
					ajaxFileUpload("fileupload",'set_album_cover');
					</script>
				</td>
	        </tr>
	        <tr class="line mt5 mb5"><td colspan="2"></td></tr>
	        <tr>
	            <th class="w120">专题标题(seo)：</th>
	            <td><input type="text" class="textinput w360" name="album[album_title]" value="<?=$album['album_title'];?>"></td>
	        </tr>
	        <tr>
	            <th class="w120">专题关键词(seo)：</th>
	            <td><input type="text" class="textinput w360" name="album[album_metakeyword]" value="<?=$album['album_metakeyword'];?>"></td>
	        </tr>
	        <tr>
	            <th class="w120">专题描述(seo)：</th>
	            <td><textarea class="w360 h80" name="album[album_metadescrip]"><?=$album['album_metadescrip'];?></textarea></td>
	        </tr>
		</tbody></table>
		<div class="box-footer">
	        <div class="box-footer-inner">
	        	<input type="hidden" name="album[tplname]" value="<?=$album['tplname'];?>">
	        	<input type="hidden" name="album[aid]" value="<?=$album['aid'];?>">
	        	<input type="hidden" name="formhash" value="<?=formhash();?>">
	        	<input type="submit" name="albumadd" value="保存更改">
	        </div>
	    </div>
		</div>
	</form>
<?php } ?>
</div>	
<?php include(PATH_TPL."/public/footer.tpl.php");?>
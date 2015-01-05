<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php include(PATH_PLUGIN.'/admin/template/menu.tpl');?>
<div class="box-content">
   <?php if($op=='list'){ ?>
      <form method="POST" onsubmit="return delnav();">
      <div class="table">
        <table class="admin-tb">
        <tbody>
        <tr>
        	<th width="10" class="text-center">
        		<input type="checkbox" name="all" class="allbox"  onclick="checkAll($(this),$('.checkbox'));">
        	</th>
            <th width="200">导航名称</th>
            <th width="100">目标</th>
        	<th width="100">是否隐藏</th>
        	<th width="100">排序</th>
            <th width="161">操作</th>
        </tr>
        </tbody></table>
        <div id="show">
	    	<img src="static/images/loading.gif">
	    </div>
    	</div>
    	<div class="box-footer">
	        <div class="box-footer-inner">
	        	<input type="submit" value="删除">&nbsp;&nbsp;
	            <input type="button" onclick="location.href='<?=$_plugin_url;?>&pmod=nav&op=add'" value="添加导航"></a>&nbsp;&nbsp;
	        </div>
	    </div>
    </form>
	<?php }elseif($op=='add'){ ?>
	<?php 
	//导航频道
	$goodnav=navList();
	?>
	<form method="post" onsubmit="return submitnav(this);">
        <table class="table-font"><tbody>
            <tr>
                <th class="w120">U站导航：</th>
                <td><input type="text" class="textinput w270" name="name" value=""></td>
            </tr>
            <tr>
                <th class="w120">对应网站：</th>
                <td>
                	<select name="channel">
	            	<?php foreach ($goodnav as $key=>$value){ ?>
	                	<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
	                <?php } ?>
	                </select>
                </td>
            </tr>
            <tr>
                <th>自定义链接：</th>
                <td>
                	<input type="text" class="textinput w270" name="url" value="">
                </td>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <td><?=showCheckbox("target",array('1'=>'是否在新窗口打开'),0,'target','');?></td>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <td><?=showCheckbox("hide",array('1'=>'是否隐藏'),0,'hide','');?></td>
            </tr>
            <tr>
                <th>排序：</th>
                <td>
                	<input type="text" class="textinput w70" name="sort" value="">
                </td>
            </tr>
        </tbody></table>
	    <div class="box-footer">
	        <div class="box-footer-inner">
	        	<input type="hidden" name="id" value="">
	        	<input type="submit" value="添加">
	        </div>
	    </div>
    </form>
    <?php } ?>
</div>
<script type="text/javascript">
<?php if($op=='list'){ ?>
//调用u站设置的导航
$(function(){
	//开始调用
	ajaxOperating('<?=$_webset['uz_site'];?>/d/get?m=nav&op=list&hash=<?=uzsecretkey();?>',{},'GET','jsonp','jsonp');
})
function delnav(){
	var idstr=tag='';
	$("input[name='id[]']:checked").each(function(){
		idstr+=tag+$(this).val();
		tag=',';
	})
	ajaxOperating('<?=$_webset['uz_site'];?>/d/get?m=nav&op=del&hash=<?=uzsecretkey();?>',{'idstr':idstr},'GET','jsonp','jsonp');
	return false;
}
function jsonp(json){
	if(json.op=='list'){
		var html='<table class="admin-tb"><tbody>';
		//展示列表
		for(var i in json.nav){
			var nav=json.nav[i];
			html+='<tr id="id_'+nav.id+'">';
			html+='<td width="10" class="text-center"><input type="checkbox" name="id[]" value="'+nav.id+'" class="checkbox" onclick="checkoption($(\'.allbox\'));"></td>';
	        html+='<td width="200" class="text-center">'+nav.name+'</td>';
	        if(nav.target==1){
	        	html+='<td width="100" class="text-center">新窗口</td>';
	        }else{
	        	html+='<td width="100" class="text-center">--</td>';
	        }
	        if(nav.hide==1){
	       		html+='<td width="100" class="text-center">是</td>';
	        }else{
	        	html+='<td width="100" class="text-center">否</td>';
	        }
	        html+='<td width="100" class="text-center">'+nav.sort+'</td>';
	        html+='<td width="161" class="text-center">[<a href="<?=$_plugin_url;?>&pmod=nav&op=add&id='+nav.id+'">修改</a>]</td>';
	        html+='</tr>';
		}
		html+='</tbody></table>';
		$("#show").html(html);
	}
	//删除
	else if(json.op=='del'){
		if(json.sucess){
			var id=json.idstr.split(",");
			for(var i in id){
				$("#id_"+id[i]).remove();
			}
		}
		show_box("系统提示","删除成功");
	}
	return false;
}
<?php }elseif($op=='add'){ ?>
	<?php if(!empty($id)){ ?>
	var id=<?=$id;?>;
	//获取导航信息
	ajaxOperating('<?=$_webset['uz_site'];?>/d/get?m=nav&op=get&hash=<?=uzsecretkey();?>',{'nid':id},'GET','jsonp','jsonp');
	<?php } ?>
	function submitnav(obj){
		var data=requestParamToJson($(obj).serializeArray());
		//判断
		if(!data.name){
			console.log("请设置导航名称")
			return false;
		}
		if(!data.target){data.target=0;}
		if(!data.hide){data.hide=0;}
		if(!data.sort){data.sort=0;}
		ajaxOperating('<?=$_webset['uz_site'];?>/d/get?m=nav&op=set&hash=<?=uzsecretkey();?>',data,'GET','jsonp','jsonp');
		return false;
	}
	function jsonp(json){
		if(json.op=='get'){
			var nav=json.nav;
			$("input[name='name']").val(nav.name);
			$("select[name='channel'] option[value='"+nav.channel+"']").attr("selected",true);
			if(!nav.url){$("input[name='url']").val(nav.url);}
			$("input[name='target'][value='"+nav.target+"']").attr("checked",true);
			$("input[name='hide'][value='"+nav.hide+"']").attr("checked",true);
			$("input[name='sort']").val(nav.sort);
			$("input[name='id']").val(nav.id);
		}
		else if(json.op=='set'){
			show_box("系统提示","添加成功");
			location.href='<?=$_plugin_url;?>&pmod=nav';
		}
		return false;
	}
<?php } ?>
</script>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
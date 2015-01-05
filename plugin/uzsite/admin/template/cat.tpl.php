<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $sourcescatlist=getgoodscat(); ?>
<?php include(PATH_PLUGIN.'/admin/template/menu.tpl');?>
<div class="box-content">
<?php if($op=='list'){ ?>
  <form method="POST" onsubmit="return delcat();">
  <div class="table">
    <table class="admin-tb"><tbody>
    <tr>
    	<th width="10" class="text-center">
    		<input type="checkbox" name="all" class="allbox"  onclick="checkAll($(this),$('.checkbox'));">
    	</th>
        <th width="200">u站名称</th>
    	<th width="200">对应系统分类</th>
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
            <input type="button" onclick="location.href='<?=$_plugin_url;?>&pmod=cat&op=add'" value="添加分类"></a>&nbsp;&nbsp;
	    </div>
	</div>
</form>
<?php }elseif($op=='add'){ ?>
<form method="post" onsubmit="return submitcat(this);">
    <table class="table-font">
        <tbody><tr>
            <th class="w120">U站分类：</th>
            <td><input type="text" class="textinput w270" name="cname"></td>
        </tr>
        <tr>
            <th>分类排序：</th>
            <td><input type="text" class="textinput" name="sort"></td>
        </tr>
        <tr>
        	<th style="vertical-align: top;">
            	对应网站分类:
            </th>
            <td>
            	<ul style="width: 300px;border: 1px #D8D8D8 solid;padding: 10px 20px;overflow-y: auto;float:left;">
            	<?php foreach ($sourcescatlist as $key=>$value){ ?>
            		<li>
            		<input name="sources[]" type="checkbox" value="<?=$value['id'];?>" id="cat_<?=$value['id'];?>" style="vertical-align: -2px;margin-right: 2px;">
            		<label for="cat_<?=$value['id'];?>"><?=$value['title'];?></label></li>
            	<?php } ?>
            	</ul>
            </td>
        </tr>
    </tbody></table>
	<div class="box-footer">
	    <div class="box-footer-inner">
	    	<input type="hidden" name="cid">
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
	ajaxOperating('<?=$_webset['uz_site'];?>/d/get?m=cat&op=list&hash=<?=uzsecretkey();?>',{},'GET','jsonp','jsonp');
})
function delcat(){
	var idstr=tag='';
	$("input[name='id[]']:checked").each(function(){
		idstr+=tag+$(this).val();
		tag=',';
	})
	ajaxOperating('<?=$_webset['uz_site'];?>/d/get?m=cat&op=del&hash=<?=uzsecretkey();?>',{'idstr':idstr},'GET','jsonp','jsonp');
	return false;
}
var sources=<?=json_encode($sourcescatlist);?>;
function jsonp(json){
	if(json.op=='list'){
		var html='<table class="admin-tb"><tbody>';
		//展示列表
		for(var i in json.cat){
			var cat=json.cat[i];
			html+='<tr id="id_'+cat.cid+'">';
			html+='<td width="10" class="text-center"><input type="checkbox" name="id[]" value="'+cat.cid+'" class="checkbox" onclick="checkoption($(\'.allbox\'));"></td>';
			html+='<td width="200" class="text-center">'+cat.cname+'</td>';
			//对应分类展示
			var scat=tag='';
			if(cat.sources && sources){
				var scid=cat.sources.split(",");
				for(var i in scid){
					if(sources['cid_'+scid[i]]){
						scat+=tag+sources['cid_'+scid[i]].title;
						tag=',';
					}
				}
			}
			html+='<td width="200" class="text-center">'+scat+'</td>';
			html+='<td width="100" class="text-center">'+cat.sort+'</td>';
			html+='<td width="160" class="text-center">[<a href="<?=$_plugin_url;?>&pmod=cat&op=add&cid='+cat.cid+'">修改</a>]</td>';
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
var id='<?=$cid;?>';
//获取导航信息
ajaxOperating('<?=$_webset['uz_site'];?>/d/get?m=cat&op=list&hash=<?=uzsecretkey();?>',{},'GET','jsonp','jsonp');
function submitcat(obj){
	var data=requestParamToJson($(obj).serializeArray());
	//判断
	if(!data.cname){
		show_box("系统提示","请设置分类名称")
		return false;
	}
	//数据源对应
	var sourcesstr=tag='';
	data.sources='';
	$("input[name='sources[]']:checked").each(function(i){
		data.sources+=tag+$(this).val();
		tag=',';
	})
	if(!data.sort){data.sort=0;}
	ajaxOperating('<?=$_webset['uz_site'];?>/d/get?m=cat&op=set&hash=<?=uzsecretkey();?>',data,'GET','jsonp','jsonp');
	return false;
}
function jsonp(json){
	if(json.op=='list'){
		//处理已选中的分类
		var sourcesstr=catarr=new Array();
		for(var i in json.cat){
			if(i!=id && json.cat[i].sources){
				sourcesstr[i]=json.cat[i].sources;
			}
		}
		if(sourcesstr){
			sourcesstr=sourcesstr.join(",");
			sourcesstr=sourcesstr.split(",");
		}
		//设置复选框
		for(var i in sourcesstr){
			$("input[name='sources[]'][value='"+sourcesstr[i]+"']").attr("disabled",true).removeAttr("checked").css('border','none');
		}
		//当前对应的
		if(id){
			var cat=json.cat[id];
			$("input[name='cname']").val(cat.cname);
			$("input[name='sort']").val(cat.sort);
			$("input[name='cid']").val(cat.cid);
			if(cat.sources){
				var catarr=cat.sources.split(",");
			}
			for(var i in catarr){
				if(cat.sources==catarr[i]){
					$("input[name='sources[]'][value='"+catarr[i]+"']").attr("checked",true).removeAttr("disabled");
				}
			}
		}
	}
	else if(json.op=='set'){
		show_box("系统提示","添加成功");
		location.href='<?=$_plugin_url;?>&pmod=cat';
	}
	return false;
}
<?php } ?>
</script>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
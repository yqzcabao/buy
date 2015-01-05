//选择模板
function select_tpl(obj){
	var tplname=$(obj).find("option:selected").attr("tpl-name");
	$("input[name='album[tplname]']").val(tplname);
	var tplgroup=$(obj).find("option:selected").attr("tpl-group");
	//创建分类
	if(tplgroup==1){
		$("#group").html('<p style="margin-bottom: 5px;"><input type="text" class="textinput" name="album[group][]" value="" placeholder="专题分组"></p><a href="javascript:void(0);" class="tip add_group" style="margin-left:0px" onclick="add_group();">+添加分组</a>').parents("tr").show();
	}else{
		$("#group").html('').parents("tr").hide();
	}
}
//添加分组
function add_group(){
	if($("#group p").length>=10){
		return false;
	}
	$("#group").find(".add_group").before('<p style="margin-bottom: 5px;"><input type="text" class="textinput" name="album[group][]" value="" placeholder="专题分组"><a href="javascript:void(0);" class="tip" onclick="del_group(this);">-删除</a></p>')
}
//删除分组
function del_group(obj){
	$(obj).parent().remove();
}
//上传封面
function set_album_cover(json){
	var filename=$("#fileupload").attr("name");
	$("input[name='album[cover]']").val(json[filename].pic);
}
//后台使用
function choice_album(obj){
	var tplname=$(obj).find("option:selected").attr("tpl-name");
	var group=$(obj).find("option:selected").attr("group");
	if(group!='null'){
		group=eval("("+group+")");
		//显示分组
		var html='';
		for(var i in group){
			html+='<option value="'+i+'">'+group[i]+'</option>';
		}
		$("#goodgid").html('<select name="good[gid]">'+html+'</select>').parents("tr").show();
	}else{
		$("#goodgid").html('').parents("tr").hide();
	}
}
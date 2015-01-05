$(function(){
	/*频道*/
	$("#navadd").click(function(){
		show_box("系统提示",get_plane_html(plane),add_android_nav,function(){},500);
		show_data($("select[name='nav[type]']").val());
		//频道类型变化
		$("select[name='nav[type]']").on("change",function(){
			var select=$(this).val();
			show_data(select);
		});
		//上传
		ajaxFileUpload("fileupload",'setsite_android_nav_img');
		ajaxFileUpload("fileuploada",'setsite_android_nav_imghover');
	})
	/*广告*/
	$("#adadd").click(function(){
		show_box("频道设置",get_plane_html(adplane),add_android_ad,function(){},400);
		//上传
		ajaxFileUpload("fileupload",'setsite_android_ad_img');
	})
	/*推荐app*/
	$("#appadd").click(function(){
		show_box("推荐app",get_plane_html(appplane),add_android_app,function(){},400);
		//上传
		ajaxFileUpload("fileupload",'setsite_android_app_img');
	})
})
//编辑
function edit_nav(data){
	show_box("频道设置",get_plane_html(plane),add_android_nav,function(){},500);
	show_data(data.type);
	//数据
	if(data.nav){
		for(var i in data.nav){
			$("#navstr_"+data.nav[i]).attr("checked",true);
		}
	}
	$("select[name='nav[type]'] option").removeAttr("selected");
	$("select[name='nav[type]'] option[value='"+data.type+"']").attr("selected",true);
	$("input[name='nav[title]']").val(data.title);
	$("input[name='nav[img]']").val(data.img);
	$("input[name='nav[imghover]']").val(data.imghover);
	$("input[name='nav[sort]']").val(data.sort);
	$("input[name='nav[nid]']").val(data.nid)
	if(1==data.home){
		$("input[name='nav[home]']").attr("checked",true);
	}
	//频道类型变化
	$("select[name='nav[type]']").on("change",function(){
		var select=$(this).val();
		show_data(select);
	});
	//上传
	ajaxFileUpload("fileupload",'setsite_android_nav_img');
	ajaxFileUpload("fileuploada",'setsite_android_nav_imghover');
}
//获取模板
function get_plane_html(plane){
	var r=/\/\*([\S\s]*?)\*\//m,
	plane=r.exec(plane.toString());
	return plane&&plane[1]||plane;
}
function add_android_nav(){
	//获取数据
	var title=$("input[name='nav[title]']").val();
	if(title==''){
		$("#add_msg").show().find("span").html("请填写频道名称");
		return false;
	}
	var type=$("select[name='nav[type]']").val();
	if(type=='goods' && $("input[name='nav[navstr][]']:checked").length==0){
		$("#add_msg").show().find("span").html("请选择数据");
		return false;
	}
	//图标
	var img=$("input[name='nav[img]']").val();
	if(img==''){
		$("#add_msg").show().find("span").html("请上传频道图标");
		return false;
	}
	var imghover=$("input[name='nav[imghover]']").val();
	if(imghover==''){
		$("#add_msg").show().find("span").html("请上传频道选中后图标");
		return false;
	}
	var sort=parseInt($("input[name='nav[sort]']").val());
	var home=$("input[name='nav[home]']:checked").length?1:0;
	//频道数据
	var navstr=tag='';
	$("input[name='nav[navstr][]']:checked").each(function(){
		navstr+=tag+$(this).val();
		tag='|';
	})
	//ID
	var nid=parseInt($("input[name='nav[nid]']").val());
	//提交数据
	ajaxOperating($("#add_nav").attr("action"),{'title':title,'type':type,'home':home,'navstr':navstr,"img":img,"imghover":imghover,"sort":sort,"nid":nid},'GET','jsonp','addnav_callback');
	return false;
}
function addnav_callback(){
	location.reload();
}
function show_data(type){
	$("input[name='nav[navstr][]']").removeAttr("checked");
	if(type=='goods'){
		$(".nav_data").show();
	}else{
		$(".nav_data").hide();
	}
}
/*提交广告数据*/
function add_android_ad(){
	//获取数据
	var title=$("input[name='ad[title]']").val();
	if(title==''){
		$("#add_msg").show().find("span").html("请填写广告名称");
		return false;
	}
	//图标
	var img=$("input[name='ad[img]']").val();
	if(img==''){
		$("#add_msg").show().find("span").html("请上传广告图");
		return false;
	}
	var href=$("input[name='ad[href]']").val();
	if(href==''){
		$("#add_msg").show().find("span").html("请填写连接");
		return false;
	}
	var sort=parseInt($("input[name='ad[sort]']").val());
	//ID
	var aid=parseInt($("input[name='ad[aid]']").val());
	//提交数据
	ajaxOperating($("#add_ad").attr("action"),{'title':title,'href':href,"img":img,"sort":sort,"aid":aid},'GET','jsonp','addad_callback');
	return false;
}
//编辑
function edit_android_ad(data){
	show_box("广告设置",get_plane_html(adplane),add_android_ad,function(){},500);
	//数据
	$("input[name='ad[title]']").val(data.title);
	$("input[name='ad[img]']").val(data.img);
	$("input[name='ad[href]']").val(data.href);
	$("input[name='ad[sort]']").val(data.sort);
	$("input[name='ad[aid]']").val(data.aid)
	//上传
	ajaxFileUpload("fileupload",'setsite_android_ad_img');
}
function addad_callback(json){
	location.reload();
}
/*推荐app*/
function add_android_app(){
	//获取数据
	var title=$("input[name='app[title]']").val();
	if(title==''){
		$("#add_msg").show().find("span").html("请填写APP名称");
		return false;
	}
	//请填写简介
	var intro=$("input[name='app[intro]']").val();
	if(intro==''){
		$("#add_msg").show().find("span").html("请填写APP简介");
		return false;
	}
	//图标
	var img=$("input[name='app[img]']").val();
	if(img==''){
		$("#add_msg").show().find("span").html("请上传app图标");
		return false;
	}
	var href=$("input[name='app[href]']").val();
	if(href==''){
		$("#add_msg").show().find("span").html("请填写下载连接");
		return false;
	}
	var sort=parseInt($("input[name='app[sort]']").val());
	//ID
	var aid=parseInt($("input[name='app[aid]']").val());
	//提交数据
	ajaxOperating($("#add_app").attr("action"),{'title':title,"intro":intro,'href':href,"img":img,"sort":sort,"aid":aid},'GET','jsonp','addapp_callback');
	return false;
}
//编辑
function edit_android_app(data){
	show_box("推荐APP",get_plane_html(appplane),add_android_app,function(){},500);
	//数据
	$("input[name='app[title]']").val(data.title);
	$("input[name='app[intro]']").val(data.intro);
	$("input[name='app[img]']").val(data.img);
	$("input[name='app[href]']").val(data.href);
	$("input[name='app[sort]']").val(data.sort);
	$("input[name='app[aid]']").val(data.aid)
	//上传
	ajaxFileUpload("fileupload",'setsite_android_app_img');
}
function addapp_callback(){
	location.reload();
}
/*****************************************************************/
//上传频道图标
function setsite_android_nav_img(json){
	var filename=$("#fileupload").attr("name");
	$("input[name='nav[img]']").val(json[filename].pic);
}
function setsite_android_nav_imghover(json){
	var filename=$("#fileuploada").attr("name");
	$("input[name='nav[imghover]']").val(json[filename].pic);
}
/*上传广告*/
function setsite_android_ad_img(json){
	var filename=$("#fileupload").attr("name");
	$("input[name='ad[img]']").val(json[filename].pic);
}
/*上传app图标*/
function setsite_android_app_img(json){
	var filename=$("#fileupload").attr("name");
	$("input[name='app[img]']").val(json[filename].pic);
}
//设置logo
function setsite_android_logo(json){
	var filename=$("#fileupload").attr("name");
	$("input[name='android[android_logo]']").val(json[filename].pic);
}
function setsite_android_goodsbg(json){
	var filename=$("#fileuploada").attr("name");
	$("input[name='android[android_goodsbg]']").val(json[filename].pic);
}
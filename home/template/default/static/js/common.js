$(function(){
	if(location.hash!=''){
		var reg = /^\#([A-Za-z0-9]+)$/;
		var usertag = location.hash.match(reg);
		if(usertag!=null){
			if(usertag!=null){
				$.cookie("usertag",usertag[1],{expires: 365,path: '/'});
			}
		}
	}
	$(".deal").hover(
		function() {
			$(this).children("h5").removeClass("hidden");
			$(this).children("h6").removeClass("hidden");
			$(this).addClass("on");
		},
		function() {
			$(this).children("h5").addClass("hidden");
			$(this).children("h6").addClass("hidden");
			$(this).removeClass("on");
		}
	)
	//选项卡
	$(".tb-tabbar li").click(function(){
		$(".tb-tabbar li").removeClass("selected");
		$(this).addClass("selected");
		var index=$(".tb-tabbar li").index($(this));
		$(".displayIF").hide();
		$(".displayIF").eq(index).show();
	})
	//开始签到
	$(".singin").click(function(){
		ajaxOperating('?mod=user&ac=sign','','GET','jsonp','sign');
	})
})
//签到
function sign(json){
	if(json.code==-1){
		login_box();
	}else{
		show_msg(json.msg);
	}
	return false;
}
//收藏
function goodsfav(id){
	ajaxOperating('?mod=ajax&ac=operat&op=goodsfav',{'id':id},'POST','jsonp',"hadefav");
}
function hadefav(json){
	if(json.code==-13){
		location.href=json.gourl;
	}
	show_msg(json.msg)
}
//保存地址
function address(obj){
	var callback=arguments[1];
	if(callback!='undefined'){
		ajaxOperating('?mod=user&ac=address',obj.serialize(),'POST','jsonp',callback);
	}else{
		ajaxOperating('?mod=user&ac=address',obj.serialize(),'POST','jsonp');
	}
	return false;
}
//试用地址
function tryaddress(json){
	if(json.code==0){
		//下一步
		location.reload();
	}else{
		show_msg(json.msg);
		return false;
	}
}
//试用兑换地址
function exchangeaddress(json){
	tryaddress(json)
}
/*用户评论*/
function addcomment(id,idtype,textarea,callback){
	var authorid=arguments[4];
	var author=arguments[5];
	var message=textarea.val();
	//判断评论是否为空
	var messagelength=message.replace(/(\[.*?\])/g, "");
	if(messagelength.length<1){
		show_msg('内容不能为空');
		return false;
	}
	//当前地址
	var gourl=get_url();
	ajaxOperating('?mod=ajax&ac=operat&op=comment',{'comment[id]':id,'comment[idtype]':idtype,'comment[message]':message,'gourl':gourl},'POST','jsonp',callback);
}

//宝贝评论
function goodscomment(json){
	if(json.code=='-13'){
		location.href=json.gourl;
	}else{
		//清空
		$("#comment").val('');
		//动态添加
		var comment='<li><span class="w1"><a href="javascript:void(0);"><img src="'+json.data.avatar+'"></a></span><span class="w3"><a href="javascript:void(0);">'+json.data.user_name+'</a><i>刚刚</i></span><span class="comment_c fl"><em class="comment_message">'+json.data.message+'</em></span></li>'
		$("#rlist").html(comment+$("#rlist").html());
		show_msg(json.msg);
	}
	return false;
}
//试用申请评论
function trycomment(json){
	if(json.code=='-13'){
		location.href=json.gourl;
	}else if(json.code==0){
		//成功
		location.href=$("input[name='successurl']").val();
	}else{
		show_msg(json.msg);
	}
	return false;
}
//兑换申请评论
function exchangecomment(json){
	if(json.code=='-13'){
		location.href=json.gourl;
	}else if(json.code==0){
		//成功
		location.href=$("input[name='successurl']").val();
	}else{
		show_msg(json.msg);
	}
	return false;
}
function get_url(){
	return location.pathname+location.search;
}
//举报
var report_gid=0;
var report_goods='';
//举报
function setreport(){
	var thisvalue=$(".selectClass").val();
	if(thisvalue=='-1'){
		$(".reportother").show();
	}else{
		$(".reportother").hide();
	}
}
//举报提交
function formreport(){
	var thisvalue=$(".selectClass").val();
	var reasons='';
	if(thisvalue==''){
		return false;
	}else if(thisvalue==-1){
		var reasons=$("#otherReasons").val();
		var otherReasonslength=reasons.replace(/(\[.*?\])/g, "");
		if(otherReasonslength.length<1){
			return false;
		}
	}else{
		reasons=thisvalue;
	}
	var gourl=get_url();
	ajaxOperating('?mod=ajax&ac=operat&op=report',{'report[gid]':report_gid,'report[report]':reasons,'report[good]':report_goods,'gourl':gourl},'POST','jsonp','reportreturn');
	return false;
}
function reportreturn(json){
	if(json.code==0){
		show_msg("举报成功，我们会尽快处理");
	}else if(json.code==-3){
		//未登录
		location.href=json.gourl;
	}
	return false;
}
/*网站收藏代码*/
function addfavorite(a, title, url) {
	url = url || a.href;
	title = title || a.title;
	try{ // IE
		window.external.addFavorite(url, title);
	} catch(e) {
		try{ // Firefox
			window.sidebar.addPanel(title, url, "");
		} catch(e) {
			if (/Opera/.test(window.navigator.userAgent)) { // Opera
				a.rel = "sidebar";
				a.href = url;
				return true;
			}
			show_msg('加入收藏失败，请使用 Ctrl+D 进行添加');
		}
	}
	return false;
}
//全选
function checkAll(cheobj,opobj){
	var checked=cheobj.prop('checked');
	opobj.prop('checked',checked);
}
//全选的option操作
function checkoption(cheobj){
	cheobj.prop('checked',false);
}
//确认删除
function confirmdel(){
	return 	confirm("您确认要删除?");
}
//设置头像
function setavatar(json){
	var normal=json.data['normal'];
	var small=json.data['small'];
	$(".normal").attr("src",normal+'?t='+Math.random());
	$(".small").attr("src",small+'?t='+Math.random());
}
/*登陆框*/
function login_box(){
	$("#dialog_log_qiandao").show();
	$(".dialog-overlay").show();
}
function login_box_close(){
	$("#dialog_log_qiandao").hide();
	$(".dialog-overlay").hide();
}
function box_login(){
	var email=$("input[name='login[email]']").val();
	var userpwd=$("input[name='login[userpwd]']").val();
	if(email=='' || email==null || typeof(email)=='undefined'){
		$("#pperrmsg").html("请填写邮箱/用户名");
		return false;
	}
	if(userpwd=='' || userpwd==null || typeof(userpwd)=='undefined'){
		$("#pperrmsg").html("请填写密码");
		return false;
	}
	$("#pperrmsg").html();
	//登陆
	$(".sign").val('提交中..').attr("disabled",true);
	ajaxOperating('?mod=user&ac=login',{'login[email]':email,'login[userpwd]':userpwd},'POST','jsonp','box_logined');
	return false;
}
function box_logined(json){
	$(".sign").val('登陆').attr("disabled",false);
	if(json.code==0){
		location.reload();
	}else{
		$("#pperrmsg").html(json.msg);
	}
	return false;
}
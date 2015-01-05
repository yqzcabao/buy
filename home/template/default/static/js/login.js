//登陆验证
function chkLogin(){
	var email=$(".email").val();
	var userpwd=$(".userpwd").val();
	if(email=='' || email==null || typeof(email)=='undefined'){
		$(".err_box").html("请填写邮箱/用户名").show();
		$(".email").focus();
		return false;
	}
	if(userpwd=='' || userpwd==null || typeof(userpwd)=='undefined'){
		$(".err_box").html("请填写密码").show();
		$(".userpwd").focus();
		return false;
	}
	//登陆
	$(".loginBtn").val('提交中..').attr("disabled",true).after('<img src="static/images/loading.gif">');
	ajaxOperating('?mod=user&ac=login',{'login[email]':email,'login[userpwd]':userpwd,'login[save]':$("input[name='login[save]']:checked").val(),'gourl':$("input[name='gourl']").val()},'POST','jsonp','login');
	return false;
}
function login(json){
	$(".loginBtn").val('登陆').attr("disabled",false);
	$(".loginLi img").remove();
	if(json.code==0){
		location.href=json.gourl;
	}else{
		$(".err_box").html(json.msg).show();
	}
	return false;
}
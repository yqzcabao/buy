$(function(){
	$(".text_input").focus(function(){
		var name=$(this).attr("name");
		var msg='';
		switch(name){
			case 'reg[email]':
			msg='请填写常用邮箱';
			break;
			case 'reg[userpwd]':
			case 'userpwd[userpwd]':
			msg='请正确填写密码';
			break;
			case 'reg[reuserpwd]':
			case 'userpwd[reuserpwd]':
			msg='请正确填写确认密码';
			break;
			case 'reg[verify]':
			msg='请填写验证码';
			break;
		}
		$(this).siblings(".msg_alert").removeClass("error").removeClass("warning").removeClass("success").addClass("warning").show().children(".msg").html(msg);
	})
})
var userFlg=true;
var mailFlg=true;
var passFlg=true;
var npassFlg=true;
var verifyFlg=true;
var checkbox=true;



//邮箱验证start
function blurEmail(){
	var obj=$(".email_text");
	//验证邮箱
	var re=RegExp("^[a-z|A-Z|0-9]+([\.|\-|_][a-z|A-Z|0-9]+)*@[a-z|A-Z|0-9]+([\.|\-][a-z|A-Z|0-9]+)*(\.[a-z|A-Z]+)+$");
	obj.next().removeClass("error").removeClass("warning").removeClass("success");
	if(obj.val().length==0){
		obj.next().addClass('error').show().children(".msg").html('请填写常用邮箱');
		mailFlg=false;
		return false;
	}
	if(!re.test(obj.val())){
		obj.next().addClass('error').show().children(".msg").html('邮箱格式不对哦');
		mailFlg=false;
		return false;
	}
	ajaxOperating('?mod=ajax&ac=check&op=email',{'email':obj.val()},'POST','jsonp','chechemail')
	return true;
}
function chechemail(json){
	var obj=$(".email_text");
	if(json.code==0){//可以使用
		obj.next().addClass('success').show().children(".msg").html('邮箱正确');
		mailFlg=true;
		return true;
	}else{
		obj.next().addClass('error').show().children(".msg").html(json.msg);
		mailFlg=false;
		return false;
	}
}
//邮箱验证end

//密码验证start
var PasswordStrength={LevelValue:[30,20,0],Factor:[1,2,5],KindFactor:[0,0,10,20],Regex:[/[a-zA-Z]/g,/\d/g,/[^a-zA-Z0-9]/g]};
var getStrLength=function(str){
	var a=str.length;
	var b=str.match(/[^\x00-\x80]/g)?str.match(/[^\x00-\x80]/g).length:0;
	var c=(a-b)+b*2;
	return c;
};
PasswordStrength.StrengthValue=function(pwd){
	var strengthValue=0;
	var ComposedKind=0;
	for(var i=0;i<this.Regex.length;i++){
		var chars=pwd.match(this.Regex[i]);
		if(chars!=null){
			strengthValue+=chars.length*this.Factor[i];
			ComposedKind++;
		}
	}
	strengthValue+=this.KindFactor[ComposedKind];
	return strengthValue;
}
function blurPass(){
	var obj=$(".pwd_text");
	obj.next().removeClass("error").removeClass("warning").removeClass("success");
	if(obj.val().length<6){
		obj.next().addClass('error').show().children(".msg").html('有点短哦，最少6位');
		passFlg=false;
		return false;
	}else if(obj.val().length>16){
		obj.next().addClass('error').show().children(".msg").html('有点长哦，最长16位');
		passFlg=false;
		return false;
	}
	value=PasswordStrength.StrengthValue(obj.val());
	if(value<=15){
		$(".strong_degree .degree").html('<span class="fl weak"></span><span class="fl"></span><span class="fl"></span>');
		obj.next().addClass('success').show().children(".msg").html('一般安全 (╯﹏╰)');
	}else if(value<=25){
		$(".strong_degree .degree").html('<span class="fl"></span><span class="fl middle"></span><span class="fl"></span>');
		obj.next().addClass('success').show().children(".msg").html('比较安全 (∩_∩)');
	}else{
		$(".strong_degree .degree").html('<span class="fl"></span><span class="fl"></span><span class="fl strength"></span>');
		obj.next().addClass('success').show().children(".msg").html('非常安全 (^_^)');
	}
	passFlg=true;
	return true;
}
function blurNPass(){
	var obj=$(".confirm_text");
	obj.next().removeClass("error").removeClass("warning").removeClass("success");
	if(obj.val().length==0){
		obj.next().addClass('warning').show().children(".msg").html('请输入确认密码');
		npassFlg=false;
		return false;
	}
	if(obj.val()!=$(".pwd_text").val()){
		obj.next().addClass('error').show().children(".msg").html('确认密码与密码不一致');
		npassFlg=false;
		return false;
	}
	obj.next().addClass('success').show().children(".msg").html('确认密码正确');
	npassFlg=true;
	return true;
}
//密码 end
//验证码
function checkVerify(){
	var obj=$(".vercode_text");
	obj.siblings(".msg_alert").removeClass("error").removeClass("warning").removeClass("success");
	if(obj.val().length==0){
		obj.siblings(".msg_alert").addClass('warning').show().children(".msg").html('');
		verifyFlg=false;
		return false;
	}
	obj.siblings(".msg_alert").addClass('success').show().children(".msg").html('');
	verifyFlg=true;
	return true;
}
//验证码end
//注册协议
function checkAgreement(){
	var obj=$(".agreement");
	obj.siblings(".msg_alert").removeClass("error").removeClass("warning").removeClass("success");
	if(!obj.is(":checked")){
		obj.siblings(".msg_alert").addClass('warning').show().children(".msg");
		checkbox=false;
		return false;
	}
	obj.siblings(".msg_alert").addClass('success').show().children(".msg").html('');
	checkbox=true;
	return true;
}
//注册验证
function chkReg(){
	if(!blurEmail()||!mailFlg){$(".email_text").focus();return false;}
	if(!blurPass()||!passFlg){$(".pwd_text").focus();return false;}
	if(!blurNPass()||!npassFlg){$(".confirm_text").focus();return false;}
	if(!checkVerify()||!verifyFlg){$(".vercode_text").focus();return false;}
	if(!checkAgreement()||!checkbox){$(".agreement").focus();return false;}
	$(".regist").val('提交中..').attr("disabled",true).after('<img src="static/images/loading.gif">');
	//验证是否注册成功
	ajaxOperating('?mod=user&ac=register',{'reg[email]':$(".email_text").val(),'reg[userpwd]':$(".pwd_text").val(),'reg[reuserpwd]':$(".confirm_text").val(),'reg[verify]':$(".vercode_text").val()},'POST','jsonp','register')
	return false;
}
function register(json){
	$(".regist").val('立即注册').attr("disabled",false);
	$(".regist_atonce img").remove();
	if(json.code==-2){
		var obj=$(".email_text");
		obj.siblings(".msg_alert").removeClass("error").removeClass("warning").removeClass("success");
		obj.siblings(".msg_alert").addClass('error').show().children(".msg").html('邮箱格式不正确');
		mailFlg=false;
		return false;
	}else if(json.code==-4){
		var obj=$(".pwd_text");
		obj.siblings(".msg_alert").removeClass("error").removeClass("warning").removeClass("success");
		obj.siblings(".msg_alert").addClass('error').show().children(".msg").html('密码格式不合法');
		passFlg=false;
		return false;
	}else if(json.code==-5){
		var obj=$(".vercode_text");
		obj.siblings(".msg_alert").removeClass("error").removeClass("warning").removeClass("success");
		obj.siblings(".msg_alert").addClass('error').show().children(".msg").html('验证码错误');
		verifyFlg=false;
		return false;
	}else if(json.code==-6){
		var obj=$(".confirm_text");
		obj.siblings(".msg_alert").removeClass("error").removeClass("warning").removeClass("success");
		obj.siblings(".msg_alert").addClass('error').show().children(".msg").html('确认密码错误');
		npassFlg=false;
		return false;
	}else if(json.code==0){
		location.href=json.gourl;
	}
	return false;
}
//注册验证end
//重新发送激活邮件
var time=0
function againemail(email,type){
	if(time==0){
		var re=RegExp("^[a-z|A-Z|0-9]+([\.|\-|_][a-z|A-Z|0-9]+)*@[a-z|A-Z|0-9]+([\.|\-][a-z|A-Z|0-9]+)*(\.[a-z|A-Z]+)+$");
		if(!re.test(email)){
			show_msg('邮箱格式不对哦');
			return false;
		}
		ajaxOperating('?mod=ajax&ac=check&op=againemail',{'email':email,'type':type},'POST','jsonp','againemailok');
	}
	return true;
}
function againemailok(json){
	show_msg(json.msg);
	if(json.code==0){
		//开始倒计时
		time=60;
		countdown();
	}
}
function countdown(){
	if(time>0){
		time-=1;
		$("#againemail").text(time);
		setTimeout('countdown()',1000);
	}else if(time<=0){
		time=0
		$("#againemail").text('');
	}
}
/*忘记密码*/
function chkForgetPwd(){
	if(!blurPass()||!passFlg){$(".pwd_text").focus();return false;}
	if(!blurNPass()||!npassFlg){$(".confirm_text").focus();return false;}
	return true;
}

//注册方式切换
function registtype(type){
	$(".reigist_type p").removeClass("cur").addClass("lose");
	if(type=='quick'){
		$('.registInfo').hide();
		$('.quickLogin').show();
		$(".reigist_type p").eq(1).addClass("cur");
	}
	if(type=='regist'){
		$('.registInfo').show();
		$('.quickLogin').hide();
		$(".reigist_type p").eq(0).addClass("cur");
	}
}
//忘记密码邮箱
function blurforgetEmail(){
	var obj=$(".text_input");
	//验证邮箱
	var re=RegExp("^[a-z|A-Z|0-9]+([\.|\-|_][a-z|A-Z|0-9]+)*@[a-z|A-Z|0-9]+([\.|\-][a-z|A-Z|0-9]+)*(\.[a-z|A-Z]+)+$");
	obj.next().removeClass("error").removeClass("warning").removeClass("success");
	if(obj.val().length==0){
		obj.next().addClass('error').show().children(".msg").html('请填写常用邮箱');
		mailFlg=false;
		return false;
	}
	if(!re.test(obj.val())){
		obj.next().addClass('error').show().children(".msg").html('邮箱格式不对哦');
		mailFlg=false;
		return false;
	}
	ajaxOperating('?mod=ajax&ac=check&op=email',{'email':obj.val()},'POST','jsonp','chechforgetemail')
	return true;
}
function chechforgetemail(json){
	var obj=$(".text_input");
	if(json.code==0){//邮箱不存在
		obj.next().addClass('error').show().children(".msg").html('邮箱不存在');
		mailFlg=false;
		return false;
	}else if(json.code==-3){
		obj.next().addClass('success').show().children(".msg").html('');
		mailFlg=true;
		return true;
	}else{
		obj.next().addClass('error').show().children(".msg").html(json.msg);
		mailFlg=false;
		return false;
	}
}
//忘记密码的验证码
function checkforgetVerify(){
	var obj=$(".code_input");
	obj.siblings(".msg_alert").removeClass("error").removeClass("warning").removeClass("success");
	if(obj.val().length!=4){
		obj.siblings(".msg_alert").addClass('error').show().children(".msg").html('');
		verifyFlg=false;
		return false;
	}
	obj.siblings(".msg_alert").addClass('success').show().children(".msg").html('');
	verifyFlg=true;
	return true;
}
//忘记密码
function chkforgetReg(){
	if(!blurforgetEmail()||!mailFlg){$(".account_input").focus();return false;}
	if(!checkforgetVerify()||!verifyFlg){$(".code_input").focus();return false;}
}
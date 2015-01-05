//设置昵称
var user_nameFlg=true;
var passFlg=true;
var npassFlg=true;
var oldpassFlg=true;
var bindmailFlg=true;
function bluruser_name(){
	var obj=$(".input_text");
	obj.next().removeClass("error").removeClass("warning").removeClass("success");
	if(obj.val().length==0){
		obj.next().addClass('error').html('请填写昵称').show();
		user_nameFlg=false;
		return false;
	}
	ajaxOperating('?mod=ajax&ac=check&op=user_name',{'user_name':obj.val()},'POST','jsonp','chechuser_name')
	return true;
}
function chechuser_name(json){
	var obj=$(".input_text");
	if(json.code==0){//可以使用
		obj.next().addClass('success').html('昵称可用').show();
		user_nameFlg=true;
		return true;
	}else{
		obj.next().addClass('error').html(json.msg);
		user_nameFlg=false;
		return false;
	}
}
//设置昵称
function setnick(){
	if($(".input_text").length>0){
		if(!bluruser_name()||!user_nameFlg){
			$(".input_text").focus();
			return false;
		}
	}
	return true;
}

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
//设置密码
function blurPass(){
	var obj=$(".newpwd");
	obj.next().removeClass("error").removeClass("warning").removeClass("success");
	if(obj.val().length<6){
		obj.next().addClass('error').html('有点短哦，最少6位');
		passFlg=false;
		return false;
	}else if(obj.val().length>16){
		obj.next().addClass('error').html('有点长哦，最长16位');
		passFlg=false;
		return false;
	}
	value=PasswordStrength.StrengthValue(obj.val());
	if(value<=15){
		obj.next().addClass('success').html('一般安全 (╯﹏╰)');
	}else if(value<=25){
		obj.next().addClass('success').html('比较安全 (∩_∩)');
	}else{
		obj.next().addClass('success').html('非常安全 (^_^)');
	}
	passFlg=true;
	return true;
}
//确认密码
function blurNPass(){
	var obj=$(".conpwd");
	obj.next().removeClass("error").removeClass("warning").removeClass("success");
	if(obj.val().length==0){
		obj.next().html('请输入确认密码');
		npassFlg=false;
		return false;
	}
	if(obj.val()!=$(".newpwd").val()){
		obj.next().addClass('error').html('确认密码与密码不一致');
		npassFlg=false;
		return false;
	}
	obj.next().addClass('success').html('确认密码正确');
	npassFlg=true;
	return true;
}
//原密码验证
function oldpass(){
	var obj=$(".pwd");
	obj.next().removeClass("error").removeClass("warning").removeClass("success");
	if(obj.val().length<6 || obj.val().length>16){
		obj.next().addClass('error').html('密码错误');
		oldpassFlg=false;
		return false;
	}
	ajaxOperating('?mod=ajax&ac=check&op=password',{'userpwd':obj.val()},'POST','jsonp','chechuserpwd')
	return true;
}
function chechuserpwd(json){
	var obj=$(".pwd");
	if(json.code==0){//可以使用
		obj.next().addClass('success').html('密码正确').show();
		oldpassFlg=true;
		return true;
	}else{
		obj.next().addClass('error').html(json.msg);
		oldpassFlg=false;
		return false;
	}
}
function setpassword(){
	if($(".pwd").length>0){
		if(!oldpass()||!oldpassFlg){
			$(".pwd").focus();
			return false;
		}
	}
	if(!blurPass()||!passFlg){
		$(".newpwd").focus();
		return false;
	}
	if(!blurNPass()||!npassFlg){
		$(".conpwd").focus();
		return false;
	}
	return true;
}
//绑定邮箱
function bluremail(){
	var obj=$(".input_text");
	//验证邮箱
	var re=RegExp("^[a-z|A-Z|0-9]+([\.|\-|_][a-z|A-Z|0-9]+)*@[a-z|A-Z|0-9]+([\.|\-][a-z|A-Z|0-9]+)*(\.[a-z|A-Z]+)+$");
	obj.next().removeClass("error").removeClass("warning").removeClass("success");
	if(obj.val().length==0){
		obj.next().addClass('error').html('请填写常用邮箱');
		bindmailFlg=false;
		return false;
	}
	if(!re.test(obj.val())){
		obj.next().addClass('error').html('邮箱格式不对哦');
		bindmailFlg=false;
		return false;
	}
	ajaxOperating('?mod=ajax&ac=check&op=email',{'email':obj.val()},'POST','jsonp','chechemail')
	return true;
}
function chechemail(json){
	var obj=$(".input_text");
	if(json.code==0){//可以使用
		obj.next().addClass('error').html('邮箱可以使用');
		bindmailFlg=true;
		return true;
	}else{
		obj.next().addClass('error').html(json.msg);
		bindmailFlg=false;
		return false;
	}
}
function bindemail(){
	if(!bluremail()||!bindmailFlg){
		$(".input_text").focus();
		return false;
	}
	return true;
}
//收货地址设置
var truenameFlg=true;
var areaFlg=true;
var addressFlg=true;
var mobileFlg=true;
var zipcodeFlg=true;
function blurtruename(){
	var obj=$(".realName");
	obj.next().removeClass("error").removeClass("warning").removeClass("success");
	if(checkTruename(obj.val())){
		obj.next().addClass('error').html('');
		truenameFlg=true;
		return true;
	}else{
		obj.next().addClass('error').html('请填写正确的姓名');
		truenameFlg=false;
		return false;
	}
	truenameFlg=true;
	return true;
}
//地区
function checkarea(){
	var province=$("#s_province").val();
	var city=$("#s_city").val();
	var county=$("#s_county").val();
	if(!isNull(province) || province=='省份' || !isNull(city) || city=='地级市' || !isNull(county) || county=='市、县级市'){
		$(".itemarea").addClass('error').html('请选择地区');
		areaFlg=false;
		return false;
	}else{
		$(".itemarea").addClass('error').html('');
		areaFlg=true;
		return true;
	}
	areaFlg=true;
	return true;
}
//详细地址
function bluraddress(){
	var obj=$(".address");
	obj.next().removeClass("error").removeClass("warning").removeClass("success");
	if(address(obj.val())){
		obj.next().addClass('error').html('');
		addressFlg=true;
		return true;
	}else{
		obj.next().addClass('error').html('请填写正确的收货地址');
		addressFlg=false;
		return false;
	}
	addressFlg=true;
	return true;
}
//验证手机
function blurmobile(){
	var obj=$(".mobile");
	obj.next().removeClass("error").removeClass("warning").removeClass("success");
	if(checkmobile(obj.val())){
		obj.next().addClass('error').html('');
		mobileFlg=true;
		return true;
	}else if(checkphone(obj.val())){
		obj.next().addClass('error').html('');
		mobileFlg=true;
		return true;
	}else{
		obj.next().addClass('error').html('请填写正确的电话号码');
		mobileFlg=false;
		return false;
	}
	mobileFlg=true;
	return true;
}
//邮政编码
function blurcode(){
	var obj=$(".postcode");
	obj.next().removeClass("error").removeClass("warning").removeClass("success");
	if(checkZipcode(obj.val())){
		obj.next().addClass('error').html('');
		zipcodeFlg=true;
		return true;
	}else{
		obj.next().addClass('error').html('请填写正确的邮编');
		zipcodeFlg=false;
		return false;
	}
	zipcodeFlg=true;
	return true;
}
function setaddress(obj){
	if(!blurtruename()||!truenameFlg){
		$(".realName").focus();
		return false;
	}
	if(!checkarea()||!areaFlg){
		return false;
	}
	if(!bluraddress()||!addressFlg){
		$(".address").focus();
		return false;
	}
	if(!blurmobile()||!mobileFlg){
		$(".mobile").focus();
		return false;
	}
	if(!blurcode()||!zipcodeFlg){
		$(".postcode").focus();
		return false;
	}
	return true;
}
//用户中心删除收藏
function delfav(){
	var obj=$("input[name='fav[]']:checked");
	var length=obj.length;
	var fav=tag='';
	if(length>0){
		for(var i=0;i<length;i++){
			fav+=tag+obj.eq(i).val();
			tag=',';
		}
		ajaxOperating('?mod=ajax&ac=operat&op=delfav',{'fav':fav},'POST','jsonp','favdelok');
	}
}
function favdelok(json){
	show_msg(json.msg);
	$("input[name='fav[]']:checked").parents(".goods_de_list").remove();
}
//删除礼品记录
function delgiftlog(aid){
	ajaxOperating('?mod=ajax&ac=operat&op=delgiftlog',{'aid':aid},'POST','jsonp','delgiftlogok');
}
function delgiftlogok(json){
	show_msg(json.msg);
	if(json.code==0){
		$("#log_"+json.data.aid).remove();
	}
}
//用户中心晒单
$(function(){
	$(".show_point").mouseleave(function(){$(this).hide()}).children(".imgShow ul").html('');
})
//晒单
function showorder(obj,id){
	$("input[name='id']").val(id);
	var position=obj.position();
	$(".show_point").css("top",parseInt(position.top+25)+'px').show();
}
//晒单
function addsuncomment(){
	var id=$("input[name='id']").val();
	var message=$('#comment').val();
	//判断评论是否为空
	var messagelength=message.replace(/(\[.*?\])/g, "");
	if(messagelength.length<1){
		show_msg('内容不能为空');
		return false;
	}
	//图片
	var pic={}
	var picobj=$("input[name='pic[]']");
	for(var i=0;i<picobj.length;i++){
		pic[i]=picobj.eq(i).val();
	}
	//当前地址
	var gourl=get_url();
	ajaxOperating('?mod=ajax&ac=operat&op=comment',{'comment[id]':id,'comment[idtype]':'sun','pic':pic,'comment[message]':message,'gourl':gourl},'POST','jsonp',"suncomment");
}
function suncomment(json){
	if(json.code=='-13'){
		location.href=json.gourl;
	}else{
		show_msg(json.msg);
	}
	return false;
}
//设置晒单图片
function setsunpic(json){
	var name=$("#changeImg").attr("name");
	if(json.code==0){
		$(".imgShow").show().children("ul").append('<li class="fl" id="file_'+json.data[name].filename+'"><em class="close_img" onclick="delsunpic($(this),\''+json.data[name].pic+'\')"></em><img src="'+json.data[name].small+'" /><input type="hidden" name="pic[]" value="'+json.data[name].small+'"></li>');
	}else{
		show_msg(json.msg);
	}
}
//删除图片
function delsunpic(obj,path){
	ajaxOperating('?mod=ajax&ac=operat&op=delsunpic',{'path':path},'POST','jsonp',"delsunpicok");
}
function delsunpicok(json){
	//删除
	if(json.code==0){
		$("#file_"+json.data.filename).remove();
		if($(".imgShow ul li").length<=0){
			$(".imgShow").hide();
		}
	}else{
		show_msg(json.msg);
	}
}
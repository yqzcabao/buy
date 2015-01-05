//一步上传图片
function ajaxFileUpload(fileupload){
	var callback=arguments[1]?arguments[1]:"callback";
	$.getScript("../static/js/jquery.form.js",function(){
		$("#"+fileupload).change(function(){
			var action=$("#"+fileupload).attr("action");
			if($("#"+fileupload+"_form").length==0){
				$("#"+fileupload).wrap("<form id='"+fileupload+"_form' action='"+action+"' method='post' enctype='multipart/form-data'></form>");
			}
			$("#"+fileupload+"_form").ajaxSubmit({
				dataType:  'json',
				beforeSend: function() {
					//alert("上传中...")上传前;
				},
				//上传进度
				uploadProgress: function(event, position, total, percentComplete) {
					//上传进度 //percentComplete + '%';
				},
				success: function(data) {
					eval(callback+'(data)');
				},
				error:function(xhr){
					alert("上传失败");//xhr.responseText
				}
			});
		});
	});
}
/*****************************ajax end********************************************/
function show_wait(){
	$(".wait").show();
}
function close_wait(){
	$(".wait").hide();
	$(".show_box_msg").hide();
}
function show_msg(){
	var title=content='';
	if(arguments.length==1){
		content = arguments[0];
		title = '系统提示';
	}else{
		content = arguments[1];
		title = arguments[0];
	}
	$(".msg_title").html(title);
	$(".inner").html(content);
	$(".show_box_msg").show();
	$(".wait").show();
}
//ajax交互操作
function ajaxOperating(url,data,type,dataType){
	//获取base
	//判断是否已经是http
	var urlreg=new RegExp("^http://.*?", "i");
	if (urlreg.test(url)) { 
		var base='';
	}else{
		var base=$("base").attr("href");
	}
	if(typeof(base) == "undefined"){
		base='';
	}
	url+='&inajax=1';
	var callback=arguments[4]?arguments[4]:"callback";
	var showwait=!arguments[5]?false:true;
	if(showwait){
		show_wait();
	}
	$.ajax({
		url:base+url,
		type:type,
		data:data,
		dataType: dataType,  //类型
		jsonp: 'callback', //jsonp回调参数，必须
		jsonpCallback:callback,
		error:function (){
			if(showwait){
				close_wait();
				show_msg("操作错误，请重试");
			}
		},
		timeout: 10000
	})
}
//一步上传图片
function ajaxFileUpload(fileupload){
	var callback=arguments[1]?arguments[1]:"callback";
	$.getScript("../static/js/jquery.form.js",function(){
		$("#"+fileupload).change(function(){
			var action=$("#"+fileupload).attr("action");
			if($("#"+fileupload+"_form").length==0){
				$("#"+fileupload).wrap("<form id='"+fileupload+"_form' action='"+action+"' method='post' enctype='multipart/form-data'></form>");
			}
			$("#"+fileupload+"_form").ajaxSubmit({
				dataType:  'json',
				beforeSend: function() {
					//alert("上传中...")上传前;
				},
				//上传进度
				uploadProgress: function(event, position, total, percentComplete) {
					//上传进度 //percentComplete + '%';
				},
				success: function(data) {
					eval(callback+'(data)');
				},
				error:function(xhr){
					alert("上传失败");//xhr.responseText
				}
			});
		});
	});
}
/******************************获取商品************************************************/
/**
*获取淘宝商品
**/
function getgoods(url){
	if(url==''){
		return false;
	}
	//获取淘宝客宝贝
	if(!checkurl(url)){
		show_msg("系统提示",'url地址错误');
		return false;
	}
	var num_iid=getiid(url);
	//开始交互
	show_wait();
	var goodind=taokeing=false;
	if($(".box-content").length>0){
		system_getgoodsimg(num_iid);
	}
	if(!system_getgoods(num_iid)){
		show_msg("系统提示",'获取信息失败,宝贝不存在');
	}
	close_wait();
	return false;
}
/**
获取试用
**/
function gettry(url){
	if(url==''){
		return false;
	}
	//获取淘宝客宝贝
	if(!checkurl(url)){
		show_msg("系统提示",'url地址错误');
		return false;
	}
	var num_iid=getiid(url);
	//开始交互
	show_wait();
	var goodind=taokeing=false;
	if(!system_getgoods(num_iid,'settry')){
		show_msg("系统提示",'获取信息失败,宝贝不存在');
	}
	close_wait();
	return false;
}
/**
获取兑换
**/
function getexc(url){
	if(url==''){
		return false;
	}
	//获取淘宝客宝贝
	if(!checkurl(url)){
		show_msg("系统提示",'url地址错误');
		return false;
	}
	var num_iid=getiid(url);
	//开始交互
	show_wait();
	var goodind=taokeing=false;
	if(!system_getgoods(num_iid,'setexc')){
		show_msg("系统提示",'获取信息失败,宝贝不存在');
	}
	close_wait();
	return false;
}


//验证图片地址
function checkimg(images){
	var imgRegex=/^(https|http)\:\/\/img\d+\.taobaocdn\.com\/.*?\.jpg(_\d+x\d+\.jpg)?$/;
	if(!imgRegex.test(images)){
		return false;
	}
	return true;
}
//连接验证
function checkurl(url){
	var urlRegex = /^(https|http)\:\/\/(item|detail)\.(taobao|tmall)\.com\/item\.htm.*?(\?|\&)id\=\d+.*?$/;
	if(!urlRegex.test(url)){
		return false;
	}
	return true;
}
//验证id
function checkid(gid){
	var gidre=/^\d+$/;
	if(!gidre.test(gid)){
		return false;
	}else{
		return true;
	}
}
//获取id
function getiid(url){
	//获取id
	var reg = /(?:\^|\?|&)id=(\d*)/;
	var num_iid = url.match(reg);
	try{
		num_iid=num_iid[1];
		return num_iid;
	}catch(e){
		show_msg("系统提示",'url地址错误');
		return false;
	}
}
/*****************************验证类************************************************/
String.prototype.trim = function(){return this.replace(/(^\s*)|(\s*$)/g, "");} 
String.prototype.ltrim = function(){return this.replace(/(^\s*)/g, "");} 
String.prototype.rtrim = function(){return this.replace(/(\s*$)/g, "");} 
//此处为独立函数
function ltrim(str)
{
    var i;
    for(i=0;i<str.length;i++)
    {
        if(str.charAt(i)!=" "&&str.charAt(i)!=" ")break;
    }
    str=str.substring(i,str.length);
    return str;
}
function rtrim(str)
{
    var i;
    for(i=str.length-1;i>=0;i--)
    {
        if(str.charAt(i)!=" "&&str.charAt(i)!=" ")break;
    }
    str=str.substring(0,i+1);
    return str;
}
function trim(str)
{
    return ltrim(rtrim(str));
}
//链接验证
function checkurl(url){
	var urlRegex = /^(https|http)\:\/\/(item|detail)\.(taobao|tmall)\.com\/item\.htm.*?(\?|\&)id\=\d+.*?$/;
	if(!urlRegex.test(url)){
		return false;
	}
	return true;
}
//验证图片地址
function checkimg(images){
	var imgRegex=/^(https|http)\:\/\/img\d+\.taobaocdn\.com\/.*?\.jpg(_\d+x\d+\.jpg)?$/;
	if(!imgRegex.test(images)){
		return false;
	}
	return true;
}
//判断商品价格
function ckProPrice(price){
	var reg =/(^[-+]?[1-9]\d*(\.\d{1,2})?$)|(^[-+]?[0]{1}(\.\d{1,2})?$)/;
	if(price == ""){
		return false;
	}else{
		if(!reg.test(price)){
			return false;
		}else{
			return true;
		}
	}
}
/**验证是否输入规范***********************闷骚的分割线**********************************/
function input(value, role){
	if(typeof(value)=='undefined' || value=='' || value==null){
		return false;
	}
	value = value.trim();
	if(value==""){
		return false;
		//masg="不能为空！";
	}else{
		if(role.test(value)){
			return true;
		}
		if(!role.test(value)){
			return false;
			//masg="格式有误！";
		}
	}
}
/**验证不为空*/
function isNull(value){
	if(typeof(value)=='undefined' || value=='' || value==null){
		return false;
	}
	value = value.trim();
	if(value==""){
		return false;
		//masg="不能为空！";
	}else{
		return true;
	}
}
/**验证固话格式*/
function checkphone(value){
	//正确格式为：XXXX-XXXXXXX，XXXX-XXXXXXXX，XXX-XXXXXXX，XXX-XXXXXXXX，XXXXXXX，XXXXXXXX
	var role=/^(\(\d{3,4}\)|\d{3,4}-)?\d{7,8}$/;
	var value = value.trim();
	if(value==""){
		return false;
	}else{
		if(role.test(value)){
			return true;
		}
		if(!role.test(value)){
			return false;
			//masg="固话格式有误！";
		}
	}
}
/***********************闷骚的分割线**********************************/

//验证中文名
function checkTruename(name){
	var reg = /^[\u4E00-\u9FA5\uF900-\uFA2D]+$/i;
	var name=name.trim();
	if (!reg.test(name))
	{
		return false;
	}
	return true;
}
//验证手机
function checkmobile(mobile){
	var reg=/^1[3-8]{1}\d{9}$/;
	return input(mobile,reg);
}
//验证邮编
function checkZipcode(code){
	var reg=/^[0-9]{6}$/;
	return input(code,reg);
}
//验证收货地址
function address(address){
	return isNull(address);
}
//去除html
function del_html_tags(str)
{
    var words = '';
    words = str.replace(/<[^>]+>/g,"");
    return words;
}
//计算长度包括中文
function get_length(str)
{
    var char_length = 0;
    for (var i = 0; i < str.length; i++){
        var son_char = str.charAt(i);
        //如果是汉字，长度大于2，其他任何字符（包括￥等特殊字符，长度均为1）另外：根据需求规则，限制n个字，一个字=2个字符
        encodeURI(son_char).length > 2 ? char_length += 1 : char_length += 0.5;
    }
    return char_length; 
}
//截取字符串
function cut_str(idname, maxlen)
{
    var str = $('#'+idname).val();
    var char_length = 0;
    var sub_len = 0;
    for (var i = 0; i < str.length; i++)
    {
        var son_str = str.charAt(i);
        //如果是汉字，长度大于2，其他任何字符（包括￥等特殊字符，长度均为1）另外：根据需求规则，限制n个字，本方法里面，一个字（汉字）的长度=2个字符的长度，可根据需要改动
        encodeURI(son_str).length > 2 ? char_length += 1 : char_length += 0.5;
        //如果长度大于给定的n个字，就进行截取
        if (char_length >= maxlen)
        {
           
            var sub_len = char_length == maxlen ? i+1: i;
            var tmp=$('#'+idname).val().substr(0, sub_len);
            $('#'+idname).val(tmp);
            break;
        }
    }
}
//倒计时
function countdown(time){
	if(time>0){
		var day=Math.floor(time/(3600*24));
		var hour=Math.floor(time%(3600*24)/3600);
		hour=hour<10?'0'+hour:hour;
		var minute=Math.floor((time%(3600*24))%3600/60);
		minute=minute<10?'0'+minute:minute;
		var second=Math.floor(((time%(3600*24))%3600)%60);
		second=second<10?'0'+second:second;
		$(".countdown").html('<i>'+day+'</i>天<em class="one">'+hour+'</em><em class="two">'+minute+'</em><em class="three">'+second+'</em>');
		time-=1;
		setTimeout(function(){countdown(time)},1000);
	}
}
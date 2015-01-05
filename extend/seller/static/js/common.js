$(function(){
	//*后端*//
	//付费选择
	$("#activity_pay").click(function(){
		var checked=$(this).prop('checked');
		if(checked){
			$(this).parents("tr").next().show();
		}else{
			$(this).parents("tr").next().hide().find("input").val('');
		}
	})
	$(".addpay").click(function(){
		var html=$(this).parent().find("p:first").html();
		if($(this).parent().find("p").length>=5){
			return false;
		}
		$(this).prev().after('<p style="margin-bottom: 5px;">'+html+'<a href="javascript:void(0);" class="tip" onclick="delpay(this);">-删除</a></p>');
	})
	/*报名抓取商品*/
	$("#getcid").click(function(){
		var url=$("#cid").val();
		if(url==''){
			$("#getgoods_box").removeClass("hidden").html('请填写链接地址');
			return false;
		}
		//判断是否已经存在
		if(!checkurl(url)){
			$("#getgoods_box").removeClass("hidden").html('链接地址错误');
			return false;
		}
		var num_iid=getiid(url);
		if(num_iid==="" || num_iid===undefined){
			$("#getgoods_box").removeClass("hidden").html('链接地址错误');
			return false;
		}
		//验证商品是否存在
		check_goods(num_iid);
	})
	//充值相关
	$("input[name='gateway']").click(function(){
		var type=$(this).val();
		if(type=='audit'){
			$("#audit").show();
		}else{
			$("#audit").hide().find("input").val('');
		}
	})
	//资金管理页面说明
	$(".yue em").hover(function(){
		var e="",f=$(this),g=f.offset(),d=g.left,h=g.top,c=f.prev().html();
		switch(c){
			case "可用余额":
				e="可用余额：您帐户中的可用余额。不包括报名活动排期时预扣的“活动冻结”部分和已经提交提现申请的“提现冻结”部分。";
				break;
			case "保证金余额":
				e="保证金余额：用于保证活动进行及消费者的合法权益。";
				break;
			case "活动冻结":
				e="活动冻结：推广活动的冻结余额，用于对应活动的消费，如果活动结束后冻结未用完，将对剩余部分解冻。";
				break;
			case "提现冻结":
				e="提现冻结：您正在提现的金额。";
				break
		}
		quespop(e,d+16,h+8);
	},function(){quespopClose();}
	);
})
function quespop(e,left,top){
	if($("#quespop").length==0){
		$("body").append('<div id="quespop" class="quespop"></div>');
	}
	$("#quespop").css({"top":top+'px',"left":left+'px'}).html(e).show();
}
function quespopClose(){
	$("#quespop").hide();
}
function delpay(obj){
	$(obj).parent().remove();
}
/*商家基本信息*/
var user_nameFlg=true;
var bindmailFlg=true;
var mobileFlg=true;
var alipayFlg=true;
var shopFlg=true;
var contactFlg=true;
var passFlg=true;
var npassFlg=true;
var checkbox=true;
var oldpassFlg=true;
function check_seller(){
	if($("#user_name").length>0){
		if(!check_nick()||!user_nameFlg){
			$("#user_name").focus();
			return false;
		}
	}
	if($("#email").length>0){
		if(!check_email()||!bindmailFlg){
			$("#email").focus();
			return false;
		}
	}
	if(!check_mobile()||!mobileFlg){
		$("#mobile").focus();
		return false;
	}
	if(!check_alipay()||!alipayFlg){
		$("#alipay").focus();
		return false;
	}
	if(!check_shop()||!shopFlg){
		$("#shop").focus();
		return false;
	}
	if(!check_contact()||!contactFlg){
		$("#contact").focus();
		return false;
	}
	return true;
}
/*注册验证*/
function seller_register(){
	if(!blurEmail()||!bindmailFlg){$("#email").focus();return false;}
	if(!blurPass()||!passFlg){$(".pwd_text").focus();return false;}
	if(!blurNPass()||!npassFlg){$(".confirm_text").focus();return false;}
	if(!checkAgreement()||!checkbox){$(".agreement").focus();return false;}
	return true;
}
//修改密码验证
function seller_set_pwd(){
	if($(".pwd").length>0){
		if(!oldpass()||!oldpassFlg){
			$(".pwd").focus();
			return false;
		}
	}
	if(!blurPass()||!passFlg){$(".pwd_text").focus();return false;}
	if(!blurNPass()||!npassFlg){$(".confirm_text").focus();return false;}
	return true;
}
//绑定邮箱验证
function seller_set_mail(){
	if(!blurEmail()||!bindmailFlg){$("#email").focus();return false;}
	return true;
}
//邮箱验证start
function blurEmail(){
	var obj=$("#email");
	//验证邮箱
	var re=RegExp("^[a-z|A-Z|0-9]+([\.|\-|_][a-z|A-Z|0-9]+)*@[a-z|A-Z|0-9]+([\.|\-][a-z|A-Z|0-9]+)*(\.[a-z|A-Z]+)+$");
	obj.next().removeClass("error");
	if(obj.val().length==0){
		obj.next().addClass('error').html('<i class="icon-error-small"></i>请填写常用邮箱');
		bindmailFlg=false;
		return false;
	}
	if(!re.test(obj.val())){
		obj.next().addClass('error').html('<i class="icon-error-small"></i>邮箱格式不对哦');
		bindmailFlg=false;
		return false;
	}
	ajaxOperating('?mod=seller&ac=check&op=email',{'email':obj.val()},'POST','jsonp','chechemail')
	return true;
}
/*邮箱验证end*/
/*密码验证*/
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
//原密码验证
function oldpass(){
	var obj=$(".pwd");
	obj.next().removeClass("error");
	if(obj.val().length<6 || obj.val().length>16){
		obj.next().addClass('error').html('<i class="icon-error-small"></i>密码错误');
		oldpassFlg=false;
		return false;
	}
	ajaxOperating('?mod=ajax&ac=check&op=password',{'userpwd':obj.val()},'POST','jsonp','chechuserpwd')
	return true;
}
function chechuserpwd(json){
	var obj=$(".pwd");
	if(json.code==0){//可以使用
		obj.next().addClass('error').html('<i class="icon-ok-small"></i>密码正确');
		oldpassFlg=true;
		return true;
	}else{
		obj.next().addClass('error').html('<i class="icon-error-small"></i>'+json.msg);
		oldpassFlg=false;
		return false;
	}
}
function blurPass(){
	var obj=$(".pwd_text");
	obj.next().removeClass("error");
	if(obj.val().length<6){
		obj.next().addClass('error').html('<i class="icon-error-small"></i>有点短哦，最少6位');
		passFlg=false;
		return false;
	}else if(obj.val().length>16){
		obj.next().addClass('error').html('<i class="icon-error-small"></i>有点长哦，最长16位');
		passFlg=false;
		return false;
	}
	value=PasswordStrength.StrengthValue(obj.val());
	if(value<=15){
		obj.next().removeClass('error').html('<i class="icon-ok-small"></i>一般安全 (╯﹏╰)');
	}else if(value<=25){
		obj.next().removeClass('error').html('<i class="icon-ok-small"></i>比较安全 (∩_∩)');
	}else{
		obj.next().removeClass('error').html('<i class="icon-ok-small"></i>非常安全 (^_^)');
	}
	passFlg=true;
	return true;
}
function blurNPass(){
	var obj=$(".confirm_text");
	obj.next().removeClass("error");
	if(obj.val().length==0){
		obj.next().addClass('error').html('<i class="icon-error-small"></i>请输入确认密码');
		npassFlg=false;
		return false;
	}
	if(obj.val()!=$(".pwd_text").val()){
		obj.next().addClass('error').html('<i class="icon-error-small"></i>确认密码与密码不一致');
		npassFlg=false;
		return false;
	}
	obj.next().removeClass('error').html('<i class="icon-ok-small"></i>确认密码正确');
	npassFlg=true;
	return true;
}
//密码验证end
//注册协议
function checkAgreement(){
	var obj=$(".agreement");
	obj.parents("li").find(".tip").removeClass("error");
	if(!obj.is(":checked")){
		obj.parents("li").find(".tip").addClass('error').html('<i class="icon-error-small"></i>');
		checkbox=false;
		return false;
	}
	obj.parents("li").find(".tip").removeClass('error').html('<i class="icon-ok-small"></i>');;
	checkbox=true;
	return true;
}
function forget(){
	var filed=$("input[name='email']").val();
	if(filed===''||filed===undefined){
		$("input[name='email']").next().removeClass('error').html('<i class="icon-error-small"></i>请填写邮箱/账号');;
		return false;
	}
	return true;
}
function set_pass(){
	if(!blurPass()||!passFlg){$(".pwd_text").focus();return false;}
	if(!blurNPass()||!npassFlg){$(".confirm_text").focus();return false;}
	return true;
}
/*验证昵称*/
function check_nick(){
	var obj=$("#user_name");
	obj.next().removeClass("error");
	if(obj.val().length==0){
		obj.next().addClass('error').html('<i class="icon-error-small"></i>请填写昵称');
		user_nameFlg=false;
		return false;
	}
	ajaxOperating('?mod=seller&ac=check&op=user_name',{'user_name':obj.val()},'POST','jsonp','chechuser_name')
	return true;
}
/*验证邮箱*/
function check_email(){
	var obj=$("#email");
	//验证邮箱
	var re=RegExp("^[a-z|A-Z|0-9]+([\.|\-|_][a-z|A-Z|0-9]+)*@[a-z|A-Z|0-9]+([\.|\-][a-z|A-Z|0-9]+)*(\.[a-z|A-Z]+)+$");
	obj.next().removeClass("error");
	if(obj.val().length==0){
		obj.next().addClass('error').html('<i class="icon-error-small"></i>请填写常用邮箱');
		bindmailFlg=false;
		return false;
	}
	if(!re.test(obj.val())){
		obj.next().addClass('error').html('<i class="icon-error-small"></i>邮箱格式不对哦');
		bindmailFlg=false;
		return false;
	}
	ajaxOperating('?mod=seller&ac=check&op=email',{'email':obj.val()},'POST','jsonp','chechemail')
	return true;
}
/*验证手机*/
function check_mobile(){
	var obj=$("#mobile");
	obj.next().removeClass("error");
	if(!checkmobile(obj.val())){
		obj.next().addClass('error').html('<i class="icon-error-small"></i>手机格式不对哦');
		mobileFlg=false;
		return false;
	}
	mobileFlg=true;
	return true;
}
/*验证支付宝*/
function check_alipay(){
	var obj=$("#alipay");
	obj.next().removeClass("error");
	if(obj.val()==="" || obj.val()===undefined){
		obj.next().addClass('error').html('<i class="icon-error-small"></i>请填写支付宝');
		alipayFlg=false;
		return false;
	}
	var re=RegExp("^[a-z|A-Z|0-9]+([\.|\-][_a-z|A-Z|0-9]+)*@[a-z|A-Z|0-9]+([\.|\-][a-z|A-Z|0-9]+)*(\.[a-z|A-Z]+)+$");
	if(!re.test(obj.val()) && !checkmobile(obj.val())){
		obj.next().addClass('error').html('<i class="icon-error-small"></i>支付宝格式不对哦');
		alipayFlg=false;
		return false;
	}
	alipayFlg=true;
	return true;
}
/*验证店铺*/
function check_shop(){
	var obj=$("#shop");
	obj.next().removeClass("error");
	if(obj.val().length<2){
		obj.next().addClass('error').html('<i class="icon-error-small"></i>请填写正确的店铺名称');
		shopFlg=false;
		return false;
	}
	shopFlg=true;
	return true;
}
/*验证联系人*/
function check_contact(){
	var obj=$("#contact");
	obj.next().removeClass("error");
	var re=RegExp("^[\u4e00-\u9fff]+$");
	if(obj.val().length<2 || obj.val().length>10){
		obj.next().addClass('error').html('<i class="icon-error-small"></i>请填写正确的联系人名');
		contactFlg=false;
		return false;
	}
	if(!re.test(obj.val())){
		obj.next().addClass('error').html('<i class="icon-error-small"></i>联系人只允许使用汉字');
		contactFlg=false;
		return false;
	}
	contactFlg=true;
	return true;
}

function chechuser_name(json){
	var obj=$("#user_name");
	obj.next().removeClass("error");
	if(json.code==0){//可以使用
		obj.next().html('<i class="icon-ok-small"></i>');
		user_nameFlg=true;
		return true;
	}else{
		obj.next().addClass('error').html('<i class="icon-error-small"></i>'+json.msg);
		user_nameFlg=false;
		return false;
	}
}
function chechemail(json){
	var obj=$("#email");
	obj.next().removeClass("error");
	if(json.code==0){//可以使用
		obj.next().html('<i class="icon-ok-small"></i>');
		bindmailFlg=true;
		return true;
	}else{
		obj.next().addClass('error').html('<i class="icon-error-small"></i>'+json.msg);
		bindmailFlg=false;
		return false;
	}
}
function check_withdraw(){
	var amount=$("input[name='amount']").val();
	if(amount===""||amount===undefined){
		$("input[name='amount']").parents(".tipbox").find(".tips").removeClass("hidden").find("i").html("请填写充值金额。");
		return false;
	}
	var b=new RegExp("^[0-9]+(.[0-9]{1,2})?$");
	if(!b.test(amount)){
		$("input[name='amount']").parents(".tipbox").find(".tips").removeClass("hidden").find("i").html("充值金额需为整数或小数，小数点后不超过2位。");
		return false;
	}
	return true;
}
/*获取商品*/
function setgoods(json){
	$("#get_goods_box").remove();
	$(this).removeAttr("disabled",true);
	if(json.code!=undefined && json.code!=200){
		$("#getgoods_box").removeClass("hidden").html(json.error_msg);
		return false;
	}
	$("#contentC").show();
	//详细页面
	$("input[name='deal[title]']").val(json.title);
	$("#productprice").html(json.price);
	$("input[name='deal[price]']").val(json.price);
	$("input[name='deal[num_iid]']").val(json.num_iid);
	//销量
	$("#xiaoliang").html(json.volume);
	$("input[name='deal[volume]']").val(json.volume);
	//商家
	$("input[name='deal[nick]']").val(json.nick);
	$("input[name='deal[seller_id]']").val(json.seller_id);
	//包邮
	if(json.freight_payer=='seller'){
		$("#ispost_1").attr("checked","checked");
	}else{
		if(Number(json.post_fee)<=0 || Number(json.express_fee)<=0 || Number(json.ems_fee)<=0){
			$("#ispost_1").attr("checked","checked");
		}else{
			$("#ispost_1").removeAttr("checked");
			$("#ispost_0").attr("checked","checked");
		}
	}
	//图片
	$("#imageurl").attr("src",json.pic_url+'_290x290.jpg');
	$("input[name='deal[pic]']").val(json.pic_url);
	$("input[name='deal[taopic]']").val(json.pic_url);
	//站点
	if(json.auction_point==0){
		$("input[name='deal[site]']").val('taobao');
	}else{
		$("input[name='deal[site]']").val('tmall');
	}
}
/*充值操作*/
function rechange(url){
	//选择支付方式
	if($("input[name='gateway']:checked").length<=0){
		$("input[name='gateway']").parents("p").find(".tips").removeClass("hidden").find("i").html("请选择支付方式。");
		return false;
	}
	//验证金额是否填写
	var amount=$("input[name='amount']").val();
	if(amount===""||amount===undefined){
		$("input[name='amount']").parent().find(".tips").removeClass("hidden").find("i").html("请填写充值金额。");
		return false;
	}
	var b=new RegExp("^[0-9]+(.[0-9]{1,2})?$");
	if(!b.test(amount)){
		$("input[name='amount']").parent().find(".tips").removeClass("hidden").find("i").html("充值金额需为整数或小数，小数点后不超过2位。");
		return false;
	}
	var min_money=$("#min_money").html();
	if(min_money==="" || min_money===undefined){
		min_money=0.01;
	}
	if(parseFloat(amount)<parseFloat(min_money)){
		$("input[name='amount']").parent().find(".tips").removeClass("hidden").find("i").html("充值金额至少为"+min_money+"元。");
		return false;
	}
	//判断交易号
	if($("input[name='gateway']:checked").val()=='audit'){
		var trade_num=$("input[name='trade_num']").val();
		if(trade_num==="" || trade_num===undefined){
			$("input[name='trade_num']").parent().find(".tips").removeClass("hidden").find("i").html("请填写交易号!");
			return false;
		}
		//移除新窗口打开
		$("input[name='gateway']").parents("form").removeAttr("target");
	}
	if($("input[name='gateway']:checked").val()=='alipay'){
		show_recharge_box(url);
	}
	return true;
}
//充值框
function show_recharge_box(url){
	var html='<div id="dialog_sucpop" class="diglog-wrapper" style="top:230px;left: 50%;margin-left: -200px;"><a href="javascript:void(0)" onclick="close_dialog_sucpop();" title="关闭窗口"><span class="close"></span></a><div class="diginfo"><div class="sucpop"><h1>请您在新打开的页面上完成付款</h1><h2>付款完成前请不要关闭此窗口</h2><h2>完成付款后根据您的情况点击下面的链接：</h2><hr color="#e7e7e7"><div class="suc"><em></em><i>付款成功</i><a href="'+url+'">查看充值记录&gt;&gt;</a></div><div class="fail"><em></em><i>付款遇到问题</i><a href="javascript:void(0);" onclick="location.reload();">重新充值&gt;&gt;</a></div></div></div></div><div class="dialog-overlay" style="width: 100%; height: 100%; opacity: 0.5; position: absolute; overflow: hidden; left: 0px; top: 0px; z-index: 99999; background: rgb(0, 0, 0);"></div>';
	$("body").append(html);
}
function close_dialog_sucpop(){
	$(".dialog-overlay").remove();
	$("#dialog_sucpop").remove();
}
/*报名*/
function apply(){
	var data_status=true;
	//判断类型
	var type=$("input[name='type']").val();
	//验证标题
	var title=$("input[name='deal[title]']").val();
	if(title==='' || title===undefined){
		$("input[name='deal[title]']").next().removeClass("hidden").html('请填写商品名称');
		data_status=false;
	}
	//验证频道
	if($("#channellist").length>0){
		if($("input[name='deal[channel]']:checked").length==0){
			$("#channellist").next().removeClass("hidden").html('请选择频道');
			data_status=false;
		}
	}
	//验证分类
	if($("#classifylist").length>0){
		if($("input[name='deal[cat]']:checked").length==0){
			$("#classifylist").next().removeClass("hidden").html('请选择分类');
			data_status=false;
		}
	}
	//活动价格
	var promotion_price=$("input[name='deal[promotion_price]']").val();
	if(promotion_price===""||promotion_price===undefined||parseFloat(promotion_price)<=0){
		$("input[name='deal[promotion_price]']").parent().find(".msg").removeClass("hidden").html('请填写活动价格');
		data_status=false;
	}
	var b=new RegExp("^[0-9]+(.[0-9]{1,2})?$");
	if(!b.test(promotion_price)){
		$("input[name='deal[promotion_price]']").parent().find(".msg").removeClass("hidden").html('活动价格需为整数或小数，小数点后不超过2位');
		data_status=false;
	}
	//付费类型
	if($("#deal_type").length>0){
		if($("input[name='deal[pay_type]']:checked").length==0){
			$("#deal_type").find(".msg").removeClass("hidden").html('请选择付费类型');
			data_status=false;
		}
	}
	//验证图片
	var pic=$("input[name='deal[pic]']").val();
	if(pic==='' || pic===undefined){
		$(".picmsg").removeClass("hidden").html('请上传图片');
		data_status=false;
	}
	//验证提供数量
	if($("input[name='deal[num]']").length>0){
		var num=parseInt($("input[name='deal[num]']").val());
		if(num<=0){
			$("input[name='deal[num]']").parent().find(".msg").removeClass("hidden").html('请填写提供数量');
			data_status=false;
		}
	}
	return data_status;
}
//报名更改图片
function setapply(json){
	var name=$("#changeImg").attr("name");
	$("input[name='data[pic]']").val(json[name].pic);
	$("#imageurl").attr('src',json[name].pic);
}
//验证报名商品
function check_goods(num_iid){
	var aid=$("input[name=aid]").val();
	ajaxOperating('http://'+window.location.host+'/?mod=seller&ac=check&op=check_goods',{'num_iid':num_iid,'aid':aid},'POST','jsonp','check_goods_callback');
	return false;
}
function check_goods_callback(json){
	if(json.code==0){
		$("input[name='formhash']").val(json.data.formhash);
		//显示提交框
		system_getgoods(json.data.num_iid)
		//显示
		if($("#get_goods_box").length==0){
			$("body").append('<div id="get_goods_box" class="diglog-wrapper" style="top: 304px; left: 530.5px;"><div class="diginfo"><div class="brnmsg"><span></span><em>正在获取宝贝信息</em></div></div></div>');
		}
		$(this).attr("disabled",true);
	}else{
		$("#getgoods_box").removeClass("hidden").html(json.msg);
	}
	return false;
}

//审核排期操作
function recharge_audit(lid,trade_no,money){
	show_box("充值审核",'<div id="recharge_auditbox"><p class="mb10"><b>支付宝交易号:'+trade_no+'</b></p><p><b>充值金额:</b><input type="text" class="textinput w70" name="money" value="'+money+'"></p>',function(){return recharge_audit_callback(lid,trade_no)});
}
function recharge_audit_callback(lid,trade_no){
	var money=$("#recharge_auditbox").find("input[name='money']").val();
	ajaxOperating(extend_url+'&pmod=ajax&op=recharge_audit',{'money':money,'trade_no':trade_no,'lid':lid},'POST','jsonp','recharge_audit_callback_ok');
	return false;
}
function recharge_audit_callback_ok(json){
	if(json.code==0){
		$("#trade_no_"+json.trade_no).remove();
	}
	box.title('系统提示！').content(json.msg).time(1);
}
/*提现审核*/
function withdraw_audit(serialno,money,method,account){
	if(method==1){method="支付宝";}
	show_box("提现审核",'<div id="withdraw_auditbox"><p class="mb10"><b>提现金额:'+money+'</b></p><p class="mb10"><b>提现方式:'+method+'</b></p><p class="mb10"><b>提现账号:'+account+'</b></p><p><b>'+method+'交易号:</b><input type="text" class="textinput w70" name="trade_no" value=""></p>',function(){return withdraw_audit_callback(serialno,money)});
}
function withdraw_audit_callback(serialno,money){
	var trade_no=$("#withdraw_auditbox").find("input[name='trade_no']").val();
	if(trade_no==='' || trade_no===undefined){
		$("#withdraw_auditbox").find("input[name='trade_no']").css({"border-color":"red"});
		return false;
	}
	ajaxOperating(extend_url+'&pmod=ajax&op=withdraw_audit',{'serialno':serialno,'money':money,'trade_no':trade_no},'POST','jsonp','withdraw_audit_callback_ok');
	return false;
}
function withdraw_audit_callback_ok(json){
	if(json.code==0){
		$("#serialno_"+json.serialno).remove();
	}
	box.title('系统提示！').content(json.msg).time(1);
}
/*重新发送邮件*/
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
	alert(json.msg);
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
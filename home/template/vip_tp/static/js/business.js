$(function(){
	$(".activitySignUp").mouseenter(function(){$(this).children(".hidden").show();})
	$(".activitySignUp i").mouseleave(function(){$(this).hide();})
})

var good={};
//设置宝贝===========================================================================
function setgoods(item){
	good={};
	$(".blockB").show();
	$("#goods_title").text(item.title);
	$("#price").text(item.price);
	//包邮
	if(item.freight_payer=='seller'){
		$("#goods_ispost").attr("checked","checked");
	}else{
		if(Number(item.post_fee)<=0 || Number(item.express_fee)<=0 || Number(item.ems_fee)<=0){
			$("#goods_ispost").attr("checked","checked");
		}else{
			$("#goods_ispost").removeAttr("checked");
		}
	}
	//是否vip价格
	if(item.has_discount){
		$("#goods_isvip").attr("checked","checked");
	}else{
		$("#goods_isvip").removeAttr("checked");
	}
	$("#imageurl").attr("src",item.pic_url+'_310x310.jpg');
	$("input[name='data[pic]']").val(item.pic_url);
	//设置数据
	good.title=item.title;
	good.price=item.price;
	good.num_iid=item.num_iid;
	good.cid=item.cid;
	if(item.auction_point){good.site="tmall";}
	else{good.site="taobao";}
	//good.pic=item.pic_url;
	good.nick=item.nick;
	return false;
}

function setgoodstk(item){
	$("#volume").text(item.volume);//30天销售量
	$("#goods_promotion_price").val(item.promotion_price);
	good.volume=item.volume;
}

//添加试用
function settry(item){
	$(".blockB").show();
	$("#goods_title").text(item.title);
	$("#price").text(item.price);
	$("#imageurl").attr("src",item.pic_url+'_310x310.jpg');
	$("input[name='data[pic]']").val(item.pic_url);
	//设置数据
	good.title=item.title;
	good.price=item.price;
	good.num_iid=item.num_iid;
	//good.pic=item.pic_url;
	good.nick=item.nick;
	return false;
}

function settrytk(item){
	$("#goods_promotion_price").val(item.promotion_price);
	//good.commission_rate=item.commission_rate;
}
//添加兑换
function setexc(item){
	$(".blockB").show();
	$("#goods_title").text(item.title);
	$("#price").text(item.price);
	$("#imageurl").attr("src",item.pic_url+'_310x310.jpg');
	$("input[name='data[pic]']").val(item.pic_url);
	//设置数据
	good.title=item.title;
	good.price=item.price;
	good.num_iid=item.num_iid;
	//good.pic=item.pic_url;
	good.nick=item.nick;
	return false;
}
function setexctk(item){
	$("#goods_promotion_price").val(item.promotion_price);
	//good.commission_rate=item.commission_rate;
}
//获取积分兑换
function getexchange(url){
	getexc(url);
}
//提交申请===========================================================================
function apply(type){
	//处理输入数据
	eval('apply'+type+'();');
	return false;
}
function applygoods(){
	//处理数据
	good.cat=$("select[name='data[cat]']").val();
	good.promotion_price=$("input[name='data[promotion_price]']").val();
	//	包邮
	if($("#goods_ispost").prop("checked")){good.ispost=1}else{good.ispost=-1}
	//	包邮
	if($("#goods_isvip").prop("checked")){good.isvip=1}else{good.isvip=-1}
	//	拍改
	if($("#goods_ispaigai").prop("checked")){good.ispaigai=1}else{good.ispaigai=-1}
	good.remark=$("#goods_remark").val();
	good.channel=$("input[name='data[channel]']").val();
	//id
	good.id=$("input[name='data[id]']").val();
	good.pic=$("input[name='data[pic]']").val();
	//验证价格
	if(!ckProPrice(good.promotion_price) || parseFloat(good.promotion_price)<=0){
		show_msg('请填写正确的活动价格');
		return false;
	}
	//验证图片
	if(!good.pic){
		show_msg('请上传图片');
		return false;
	}
	ajaxOperating('?mod=business&ac=apply',{'apply':good,'type':'goods'},'POST','jsonp','applyover');
	return false;
}
//试用
function applytry(){
	//处理数据
	good.cat=$("select[name='data[cat]']").val();
	good.promotion_price=$("input[name='data[promotion_price]']").val();
	good.num=$("input[name='data[num]']").val();
	good.remark=$("#goods_remark").val();
	good.channel=$("input[name='data[channel]']").val();
	good.id=$("input[name='data[id]']").val();
	good.pic=$("input[name='data[pic]']").val();
	//验证价格
	if(!ckProPrice(good.promotion_price) || parseFloat(good.promotion_price)<=0){
		show_msg('请填写正确的活动价格');
		return false;
	}
	//验证提供数量
	if(good.num=='' || good.num==null || typeof(good.num)=='undefined' || parseInt(good.num)<1 || isNaN(good.num)){
		show_msg('请填写正确的提供数量');
		return false;
	}
	//验证图片
	if(!good.pic){
		show_msg('请上传图片');
		return false;
	}
	ajaxOperating('?mod=business&ac=apply',{'apply':good,'type':'try'},'POST','jsonp','applyover');
	return false;
}
var Jump_Url_str='';
function applyover(json){
	show_msg(json.msg);
	if(json.code==0 && json.gourl!=''){
		Jump_Url_str=json.gourl;
		setTimeout('Jump_Url()',json.limittime);
	}
}
//这是图片
function setapply(json){
	var name=$("#changeImg").attr("name");
	$("input[name='data[pic]']").val(json[name].pic);
	$("#imageurl").attr('src',json[name].pic);
}
//试用
function applyexchange(){
	//处理数据
	good.cat=$("select[name='data[cat]']").val();
	good.promotion_price=$("input[name='data[promotion_price]']").val();
	good.num=$("input[name='data[num]']").val();
	good.remark=$("#goods_remark").val();
	good.channel=$("input[name='data[channel]']").val();
	good.id=$("input[name='data[id]']").val();
	good.pic=$("input[name='data[pic]']").val();
	//验证价格
	if(!ckProPrice(good.promotion_price) || parseFloat(good.promotion_price)<=0){
		show_msg('请填写正确的活动价格');
		return false;
	}
	//验证提供数量
	if(good.num=='' || good.num==null || typeof(good.num)=='undefined' || parseInt(good.num)<1 || isNaN(good.num)){
		show_msg('请填写正确的提供数量');
		return false;
	}
	//验证图片
	if(!good.pic){
		show_msg('请上传图片');
		return false;
	}
	ajaxOperating('?mod=business&ac=apply',{'apply':good,'type':'exchange'},'POST','jsonp','applyover');
	return false;
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
function Jump_Url(){
	if(Jump_Url_str!=''){
		var url=Jump_Url_str;
		//判断是不是js
		if(url.substr(0,11)=='javascript:'){
			eval(url.substr(11));
		}else{
			location=url;
		}
	}
}
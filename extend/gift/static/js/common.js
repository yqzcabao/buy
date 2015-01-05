$(function(){
	//选项卡
	$(".tb-tabbar li").click(function(){
		$(".tb-tabbar li").removeClass("selected");
		$(this).addClass("selected");
		var index=$(".tb-tabbar li").index($(this));
		$(".displayIF").hide();
		$(".displayIF").eq(index).show();
	})
	//列表显示积分
	$(".goods-list li").mouseenter(function(){$(this).addClass("mouse_hover")});
	$(".goods-list li").mouseleave(function(){$(this).removeClass("mouse_hover")});
})
function save_address(){
	var truename=$(".name_input").val();
	var mobile=$(".phone_input").val();
	var postcode=$(".postcode_input").val();
	var province=$("#s_province").val();
	var city=$("#s_city").val();
	var county=$("#s_county").val();
	var addr=$(".address_input").val();
	//保存地址
	ajaxOperating('?mod=user&ac=address',{"address[truename]":truename,"address[mobile]":mobile,"address[postcode]":postcode,"address[province]":province,"address[city]":city,"address[county]":county,"address[county]":county,"address[addr]":addr},'get','jsonp',"save_address_callback");
}
function save_address_callback(json){
	if(json.code!=0){
		$(".masteraddr-btn span").html(json.msg).show();
	}else{
		var html='<li class="on masteraddr-def"><em></em><span><b>'+json.data.province+'</b>&nbsp;<b>'+json.data.city+'</b>&nbsp;<b>'+json.data.county+'</b>&nbsp;<b>'+json.data.addr+'&nbsp;'+json.data.truename+'</b>&nbsp;&nbsp;&nbsp;<b>'+json.data.mobile+'</b></span><i class="masteraddr-modifyaddr" onclick="edit_address(this);">修改</i></li>';
		$(".masteraddr-addr").html(html);
		$(".masteraddr-content").hide();
		var jsonstr=JSON.stringify(json.data);
		jsonstr=jsonstr.replace(/\"/ig,"\\\"");
		$(".masteraddr-def").attr('data-address',jsonstr);
	}
	return false;
}
function edit_address(obj){
	var data=$(obj).parents("li").attr("data-address");
	data=data.replace(/\\\"/ig,"\"");
	data=eval("("+data+")");
	$(".name_input").val(data.truename);
	$(".phone_input").val(data.mobile);
	$(".postcode_input").val(data.postcode);
	$(".address_input").val(data.addr);
	//地区
	_init_area(data.province,data.city,data.county);
	$(".masteraddr-content").show();
}
//提交申请
function exc_apply(integral){
	var is_addr=$(".masteraddr-addr .on").length;
	if(is_addr==0){
		$(".errortip").html("<u></u>请填写收货地址!").show();
		return false;
	}
	//初步验证积分
	if($("input[name='userintegral']").val()<$("input[name='needintegral']").val()){
		$(".errortip").html("<u></u>您的"+integral+"不足!").show();
		return false;
	}
	return true;
}
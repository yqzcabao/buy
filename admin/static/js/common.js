function setgoods(item){
	$("input[name='good[num_iid]']").val(item.num_iid);//产品id
	if(item.auction_point){
		$("input[name='good[site]']").val("tmall");//是否天猫
	}else{
		$("input[name='good[site]']").val("taobao");//是否天猫
	}
	$("input[name='good[volume]']").val(item.volume);//标题
	$("input[name='good[title]']").val(item.title);//标题
	$("input[name='good[price]']").val(item.price);//价格
	$("input[name='good[nick]']").val(item.nick);//卖家昵称
	$("input[name='good[pic]']").val(item.pic_url);//图片
	$("input[name='good[taopic]']").val(item.pic_url);//图片
	$(".box-content .img img").attr("src",item.pic_url+'_290x290.jpg');
	//包邮
	if(item.freight_payer=='seller'){
		$("input[name='good[ispost]']").attr("checked","checked");
	}else{
		if(Number(item.post_fee)<=0 || Number(item.express_fee)<=0 || Number(item.ems_fee)<=0){
			$("input[name='good[ispost]']").attr("checked","checked");
		}else{
			$("input[name='good[ispost]']").removeAttr("checked");
		}
	}
	//是否vip价格
	if(item.has_discount){
		$("input[name='good[isvip]']").attr("checked","checked");
	}else{
		$("input[name='good[isvip]']").removeAttr("checked");
	}
}

function setgoodstk(item){
	$("input[name='good[promotion_price]']").val(item.promotion_price);//促销价格
}
//修改商品状态
function setgoodsstatus(id,field){
	ajaxOperating('?mod=ajax&ac=operat&op=status',{'id':id,'field':field},'GET','jsonp','goodsstatus_callback');
}
function goodsstatus_callback(json){
	if(json.code==0){
		//修改图片
		var obj=$("#"+json.field+'_'+json.id);
		if(obj.attr("status")=='1'){
			obj.attr({'status':0,'src':'static/images/cross.gif'});
		}else{
			obj.attr({'status':1,'src':'static/images/tick.gif'});
		}
	}
	show_box("系统提示",json.msg);
}
//添加试用
function settry(item){
	$("input[name='try[num_iid]']").val(item.num_iid);//产品id
	if(item.auction_point){
		$("input[name='try[site]']").val("tmall");//是否天猫
	}else{
		$("input[name='try[site]']").val("taobao");//是否天猫
	}
	$("input[name='try[title]']").val(item.title);//标题
	$("input[name='try[pic]']").val(item.pic_url);//图片
	$(".box-content .img img").attr("src",item.pic_url+'_290x290.jpg');
	$("input[name='try[price]']").val(item.price);//价格
	$("input[name='try[promotion_price]']").val(item.promotion_price);//促销价格
	$("input[name='try[nick]']").val(item.nick);//卖家昵称
}
//添加兑换
function setexc(item){
	$("input[name='exc[num_iid]']").val(item.num_iid);//产品id
	if(item.auction_point){
		$("input[name='exc[site]']").val("tmall");//是否天猫
	}else{
		$("input[name='exc[site]']").val("taobao");//是否天猫
	}
	$("input[name='exc[title]']").val(item.title);//标题
	$("input[name='exc[pic]']").val(item.pic_url);//图片
	$(".box-content .img img").attr("src",item.pic_url+'_290x290.jpg');
	$("input[name='exc[price]']").val(item.price);//价格
	$("input[name='exc[promotion_price]']").val(item.promotion_price);//促销价格
	$("input[name='exc[nick]']").val(item.nick);//卖家昵称
}
//审核排期操作
function audit(id,type){
	var html='';
	//免费使用和积分兑换都需要设置积分
	if(type=='try' || type=='exchange'){
		html='<p class="mt10"><b>所需积分:</b><input type="text" class="textinput" name="needintegral" value=""/></p>';
	}
	show_box("宝贝审核",'<div id="auditbox"><p class="mb10"><b>开始时间:</b></p><p><b>结束时间:</b></p><p><input type="hidden" name="type" value="'+type+'" /></p>'+html+'</div>',function(){return sendaudit(id)});
	var input = $('<input type="text" class="textinput w70" name="start" value="">').datetimepicker({
		timeFormat: "HH:mm",
		dateFormat: "yy-mm-dd"
	});
	var input1 = $('<input type="text" class="textinput w70" name="end" value="">').datetimepicker({
		timeFormat: "HH:mm",
		dateFormat: "yy-mm-dd"
	});
	var pfirst=$("#auditbox p").eq(0);
	var psecond=$("#auditbox p").eq(1);
	if(pfirst.children("input").length==0){pfirst.append(input);}
	if(psecond.children("input").length==0){psecond.append(input1);}
}
//审核提交处理
function sendaudit(id){
	var start=$("#auditbox input[name='start']").val();
	var end=$("#auditbox input[name='end']").val();
	var type=$("#auditbox input[name='type']").val();
	if(start==='' || start===undefined){
		$("#auditbox input[name='start']").css({"border-color":"red"});
		return false;
	}
	if(end==='' || end===undefined){
		$("#auditbox input[name='end']").css({"border-color":"red"});
		return false;
	}
	if(type=='try' || type=='exchange'){
		var needintegral=$("#auditbox input[name='needintegral']").val();
		if(needintegral==='' || needintegral===undefined){
			$("#auditbox input[name='needintegral']").css({"border-color":"red"});
			return false;
		}
		var data={'id':id,'type':type,'start':start,'end':end,'needintegral':needintegral};
	}else{
		var data={'id':id,'type':type,'start':start,'end':end};
	}
	ajaxOperating('?mod=ajax&ac=operat&op=audit',data,'GET','jsonp','audit_callback');
	return false;
}
function audit_callback(json){
	if(json.code==0){
		//删除本行记录
		$("#data_"+json.id).remove();
	}else if(json.code==-2){
		//时间设置上红色边框
		$("#auditbox .textinput").css({"border-color":"red"});
		return false;
	}
	box.title('系统提示！').content(json.msg).time(1);
}
//拒绝处理
function refuse(id,type){
	show_box("拒绝处理",'<p id="refusebox"><b style="vertical-align: top;">拒绝理由:</b><textarea name="refuse" style="width:180px;height: 55px;"></textarea><input type="hidden" name="type" value="'+type+'" /></p>',function(){return sendrefuse(id)});
}
function sendrefuse(id){
	var refuse=$("#refusebox textarea").val();
	var type=$("#refusebox input[name='type']").val();
	ajaxOperating('?mod=ajax&ac=operat&op=refuse',{'id':id,'type':type,'refuse':refuse},'GET','jsonp','refuse_callback');
	return false;
}
function refuse_callback(json){
	if(json.code==0){
		//删除本行记录
		$("#data_"+json.id).remove();
	}else if(json.code==-2){
		//时间设置上红色边框
		$("#refusebox textarea").css({"border-color":"red"});
		return false;
	}
	box.title('系统提示！').content(json.msg).time(2);
	return false;
}
//测试邮件发送
function test_mail(){
	var emailform=$("#email").serialize();
	var email=$('#test_email').val();
	if(email==''){
		show_box("测试邮件","发送失败，请填写测试邮件");
		return false;
	}
	var content=$("#test_email_content").val();
	if(content==''){
		show_box("测试邮件","发送失败，请填写测试邮件内容");
		return false;
	}
	$.ajax({
		url:'?mod=ajax&ac=operat&op=testsendmail',
		type:'GET',
		data:emailform,
		dataType: 'jsonp',  //类型
		jsonp: 'callback', //jsonp回调参数，必须
		jsonpCallback:'test_email_callback',
		error:function (){
			show_box("测试邮件","发送失败，请检查配置是否正确");
		},
		timeout: '5000'
	})
}
function test_email_callback(json){
	show_box("系统提示",json.msg);
}
//修改排序
function changesort(obj,id,type){
	var sort=obj.val();
	ajaxOperating('?mod=ajax&ac=operat&op=changesort',{'id':id,'sort':sort,'type':type},'GET','jsonp');
}
//设置产品图片
function setgoodspic(json){
	var filename=$("#fileupload").attr("name");
	$("input[name='good[pic]']").val(json[filename].pic);
	$(".box-content .img img").attr("src",'../'+json[filename].pic);
}
/*
function setgoodstaopic(json){
	var filename=$("#fileuploadtao").attr("name");
	$("input[name='good[taopic]']").val(json[filename].pic);
	$(".box-content .img img").attr("src",'../'+json[filename].pic+'_290x290.jpg');
	$(".taoimglist li").removeClass("on");
}
*/
//设置试用图片
function settrypic(json){
	var filename=$("#fileupload").attr("name");
	$("input[name='try[pic]']").val(json[filename].pic);
	$(".box-content .img img").attr("src",'../'+json[filename].pic);
}
//设置积分兑换图片
function setexcpic(json){
	var filename=$("#fileupload").attr("name");
	$("input[name='exc[pic]']").val(json[filename].pic);
	$(".box-content .img img").attr("src",'../'+json[filename].pic);
}
//设置友情链接图片
function setlinkpic(json){
	var filename=$("#fileupload").attr("name");
	$("input[name='link[pic]']").val(json[filename].pic);
}
//设置logo
function setsite_logo(json){
	var filename=$("#fileupload").attr("name");
	$("input[name='base[site_logo]']").val(json[filename].pic);
}
//左侧logo
function side_logo(json){
	var filename=$("#fileupload").attr("name");
	$("input[name='tpl[side_logo]']").val(json[filename].pic);
}
//设置手机版logo
function setwap_logo(json){
	var filename=$("#fileupload").attr("name");
	$("input[name='wap[wap_logo]']").val(json[filename].pic);
}
//设置产品加载图片
function site_goodlogo(json){
	var filename=$("#fileupload").attr("name");
	$("input[name='goods[site_goodlogo]']").val(json[filename].pic);
}
//微信二维码
function site_weixinpic(json){
	var filename=$("#fileuploadweixin").attr("name");
	$("input[name='sys[site_weixinpic]']").val(json[filename].pic);
}
//广告图片设置
function setadpic(json){
	var filename=$("#fileupload").attr("name");
	$("#adpic").val(json[filename].pic);
}
//设置品牌logo
function setbrandlogo(json){
	var filename=$("#fileupload").attr("name");
	$("input[name='brand[logo]']").val(json[filename].pic);
	$(".box-content .img img").attr("src",'../'+json[filename].pic);
}
//设置品牌图片
function setbrandpic(json){
	var filename=$("#fileuploadpic").attr("name");
	$("input[name='brand[pic]']").val(json[filename].pic);
	$(".box-content .img img").attr("src",'../'+json[filename].pic);
}
//派发
function payment(logid,type){
	ajaxOperating('?mod=ajax&ac=operat&op=payment',{'aid':logid,'type':type},'POST','jsonp','paymentok');
}
//派发完成
function paymentok(json){
	show_box("系统提示",json.msg);
	//从单签列表中移除
	$("#log"+json.aid).remove();
	return false;
}
//发货
function ship(logid,type){
	ajaxOperating('?mod=ajax&ac=operat&op=ship',{'aid':logid,'type':type},'POST','jsonp','shipok');
	return false;
}
function shipok(json){
	show_box("系统提示",json.msg,function(){$("#ship_form").submit();});
	return false;
}
//拒绝处理
function applyrefuse(logid,type){
	ajaxOperating('?mod=ajax&ac=operat&op=applyrefuse',{'aid':logid,'type':type},'POST','jsonp','applyrefuseok');
	return false;
}
function applyrefuseok(json){
	show_box("系统提示",json.msg);
	if(json.code==0){
		$("#log"+json.data).remove();
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
//设置关键词
function set_seo(obj,type){
	var data=obj.attr("data");
	if(type=='title'){
		$("input[name='seo[title]']").insertAtCaret(data);
	}else if(type=='keyword'){
		$("input[name='seo[keyword]']").insertAtCaret(data);
	}else if(type=='desc'){
		$("input[name='seo[desc]']").insertAtCaret(data);
	}
}
//设置邮件模板
function set_email(obj,name){
	var data=obj.attr("data");
	$("textarea[name='"+name+"']").insertAtCaret(data);
}
//删除备份
function backup(key){
	ajaxOperating('?mod=ajax&ac=operat&op=delbackup',{'key':key},'GET','jsonp','delbackup_callback');
}
function delbackup_callback(json){
	$("#back_"+json.key).remove();
}
//显示数据源
function set_source_nav(json){
	var selected=html='';
	for(var i in json){
		if(i==select_nav){
			selected='selected';
		}else{
			selected='';
		}
		html+='<option value="'+i+'" '+selected+'>'+json[i].name+'</option>'
	}
	$("select[name='task[rule][nav]']").html(html);
}
//显示数据源
function set_source_cat(json){
	var disabled='';
	var html='';
	for(var i in json){
		var s_id=json[i].id;
		var s_name=json[i].name;
		if(hadeset[s_id]){
			if(hadeset[s_id]!=cat){
				disabled='disabled';
			}else{
				disabled='checked';
			}
		}else{
			disabled='';
		}
		html+='<li><input name="boutiquecat[]" type="checkbox" value="'+s_id+'" id="cat_'+s_id+'" class="taskcat" style="vertical-align: -2px;margin-right: 2px;" '+disabled+'><label for="cat_'+s_id+'">'+s_name+'</label></li>';
	}
	$("#source_cat").html(html);
}
//一键采集
function allgather(){
	if($(".checkbox:checked").length<=0){
		show_box("系统提示","请选择要采集的规则");
		return false;
	}
	var idstr=tag='';
	for(var i=0;i<$(".checkbox:checked").length;i++){
		idstr+=tag+$(".checkbox:checked").eq(i).val();
		tag=',';
	}
	location.href='?mod=data&ac=goodsgather&op=do&tid='+idstr;
	return false;
}
//box
var box;
function show_box(title,content,succee,cancel,width){
	if(!title){title='系统提示';}
	if(!width){width='300';}
	if(!succee){
		succee=function(){};
	}
	art.dialog({
		id:'msgDialog',
		title:title,
		lock:true,
		fixed:true,
		width:width,
		height:100,
		ok:function(){box=this;return succee();},
		cancel:cancel,
		content:content
	});
}
//设置广告产品图片
function set_img_list(json){
	var html='';
	if(json){
		for(var i in json){
			var check="";
			if(check_img_url){
				if(check_img_url==json[i]){
					check=" class='on'";
				}
			}else if(check=='' && check_img_eq==i){
				check=" class='on'";
			}
			html+='<li'+check+'><a href="javascript:void(0)" onclick="check_img(\''+json[i]+'\','+i+');"><img src="'+json[i]+'_60x60.jpg"></a></li>';
		}
	}
	$(".taoimglist").html(html);
}
function check_img(img,i){
	check_img_eq=i;
	$(".taoimglist li").removeClass("on").eq(i).addClass("on");
	$("input[name='good[pic]']").val(img);//图片
	$("input[name='good[taopic]']").val(img);//淘宝图片	
	$(".box-content .img img").attr("src",img+'_290x290.jpg');
}
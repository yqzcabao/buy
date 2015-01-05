$(function(){
	var reg = /^[0-9]+$/;
	var timer =$("#countDown").attr('data-time');
	console.log(timer);
	if (reg.test(timer)) {
		show_date_time(timer);
	}
	$(".nos").not($(".no")).click(function(){
		var price=$(this).attr("data-price");
		var posts=$(this).attr("data-posts");
		$(this).siblings().removeClass("cur");
		$(this).addClass("cur")
		$(".buyprice").html('￥'+price);
		$("#posts_err_msg").html('');
		//设置展位
		$("input[name='deal[pay_id]']").val(posts);
	})
	$("#moreattr").click(function(){
		var html=$(this).children().html();
		if(html=='展开全部'){
			$(this).siblings().show();
			$(this).children().attr("title","点击隐藏").html("合并显示");
		}else{
			$(this).siblings(".hidden").hide();
			$(this).children().attr("title","点击查看更多").html("展开全部");
		}
	})
	//立即购买
	$("input[name='activities']").click(function(){
		//判断有没有选择展位
		var pay_id=$("input[name='deal[pay_id]']").val();
		if(pay_id=='' || isNaN(pay_id)){
			$("#posts_err_msg").html("请选择展位");
			return false;
		}
		//获取商品
		$("#posts").slideToggle("slow");
		$("#goods").show();
		return false;
	})
})
function show_date_time(end){
	today=new Date();
	timeold=((end)*1000-today.getTime());
	if (timeold < 0) {
		$("#countDown").html('已结束');
		return;
	}
	setTimeout("show_date_time("+end+")", 1000);
	sectimeold=timeold/1000;
	secondsold=Math.floor(sectimeold);
	msPerDay=24*60*60*1000;
	e_daysold=timeold/msPerDay;
	daysold=Math.floor(e_daysold);
	e_hrsold=(e_daysold-daysold)*24;
	hrsold=Math.floor(e_hrsold);
	e_minsold=(e_hrsold-hrsold)*60;
	minsold=Math.floor((e_hrsold-hrsold)*60);
	e_seconds = (e_minsold-minsold)*60;
	seconds=Math.floor((e_minsold-minsold)*60);
	hrsold1=daysold*24+hrsold;
	$("#countDown").html(daysold+"天"+(hrsold<10?'0'+hrsold:hrsold)+"小 时"+(minsold<10?'0'+minsold:minsold)+"分"+(seconds<10?'0'+seconds:seconds)+"秒.");
}
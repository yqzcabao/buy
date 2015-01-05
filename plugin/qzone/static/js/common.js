$(function(){
	/*高度自适应*/
	if(window.fusion2)
	{
		fusion2.canvas.setScroll({
			top : -50
		});
	}
	fusion2.canvas.setHeight
	({
		// 可选。表示要调整的高度
		// 不指定height的值或指定为0则默认取当前窗口的实际高度。
		// 注：由于浏览器兼容问题或者应用内页面不规范，可能会导致高度自适应失效，则必须在这里指定每个页面的height值。
		height : 0
	});
	//添加到面板
	$("#addwidget").click(function(){
		//**添加到qq面板
		fusion2.dialog.addClientPanel
		({
			onSuccess : function (opt)
			{
				// opt.context：可选。opt.context为调用该接口时的context透传参数，以识别请求
				//alert("Succeeded: " + opt.context);
				//判断是否添加成功 添加成功奖励积分
				addwidget();
			},
			onCancel : function (opt)
			{
				// opt.context：可选。opt.context为调用该接口时的context透传参数，以识别请求
				console.log("设置失败");
			},
			onClose : function (opt)
			{
				console.log("关闭");
			}
		});
	})
	//签到
	$(".sign").click(function(){
		//隐藏提示
		$(".jifenpop").hide();
		//签到请求
		$.ajax({
			url:qzone_url+'/?mod=qzone&ac=ajax&op=sign',
			type:'get',
			dataType: 'json',  //类型
			jsonp: 'callback', //jsonp回调参数，必须
			error:function (){
				return false;
			},
			success:function(json){
				console.log(json);
				//未登录
				if(json.code==-2){
					fusion2.dialog.relogin();
					return false;
				}else if(json.code==-3){
					$("#dialog_log_yiqiandao").show();
					return false;
				}else if(json.code==0){
					$("#today_integral").html(json.integral);
					$("#user_integral").html("<i></i>"+json.user_integral)
					$("#dialog_log_qiandao").show();
				}
				return false;
			},
			timeout: 10000
		})
		console.log("ok");
	})
	//功能
	$(".deal").hover(
	function() {
		$(this).addClass("deal_h");
	},
	function() {
		$(this).removeClass("deal_h");
	}
	)
	//关闭提示框
	$(".close").click(function(){
		$(".dialog-wrapper").hide();
	})
})
//设置背景图
function setsite_qzone_bg(json){
	var filename=$("#fileupload").attr("name");
	$("input[name='qzone[site_qzone_bg]']").val(json[filename].pic);
}
//添加到面板奖励
function addwidget(){
	//检测是否已经添加到主面板
	$.ajax({
		url:qzone_url+'/?mod=qzone&ac=ajax&op=hadeaddwidget',
		type:'get',
		dataType: 'json',  //类型
		jsonp: 'callback', //jsonp回调参数，必须
		error:function (){
			return false;
		},
		success:function(json){
			//未登录
			if(json.code==-2){
				fusion2.dialog.relogin();
				return false;
			}
		}
	})
}
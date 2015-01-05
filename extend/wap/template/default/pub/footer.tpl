<div class="foot">
	<div class="foot_nav">
    	<a href="<?=u(MODNAME,'index');?>">首页</a>
        <i></i>
    	<a href="<?=u(MODNAME,'download');?>">客户端</a>
        <i></i>
    	<a href="<?=$_webset['site_url'];?>/?form_wap=1">电脑版</a>
    </div>
    <div class="foot_copyright"></div>
    <h2>©2014<?=$_webset['site_name'];?></h2>
</div>
<script type="text/javascript" src="static/js/jquery.lazyload.js"></script>
<script type="text/javascript">
//图片异步加载
$("img.lazy").lazyload({threshold:200,failure_limit:30});

$("#user").on("click",function(){
	//$(".alert_bg").show();
})
$(".header_top .find").click(function(){
	if($(".view").is(":hidden")){
		$(".view").show();
		$(".nav_list").show();
		$(this).css("background","#fff");
		$(".header_top .find").find("img").attr("src","<?=WAP_TPL_PATH;?>/static/images/sspix.png")
	}else{
		$(".view").hide();
		$(".nav_list").hide();
		$(this).css("background","");
		$(".header_top .find").find("img").attr("src","<?=WAP_TPL_PATH;?>/static/images/ss1.png")
	}
})
</script>
</div>
</div>
</body>
</html>
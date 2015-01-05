	<script type="text/javascript" src="static/js/jquery.lazyload.js"></script>
	<script type="text/javascript">
	//图片异步加载
	$("img.lazy").lazyload({threshold:200,failure_limit:30});
	</script>
	<div id="paipaiAD" class="area">
		<?php foreach ($qzone_slides as $key=>$value){ ?>
		<a target="_blank" href="<?=$value['url'];?>"><img alt="<?=$value['title'];?>" src="<?=$value['pic'];?>" style="width:307px;height:100px;"></a>
	  	<?php } ?>
	</div>
	
	<div id="footer" class="area"><?=$_webset['site_copyright'];?></div>

	<!--//签到成功-->
	<div id="dialog_log_qiandao" class="dialog-wrapper">
		<div class="diginfo"><em id="today_integral">0</em><span class="cl close"></span><span class="goon close"></span></div>
	</div>
	
	<!--已签到-->
	<div id="dialog_log_yiqiandao" class="dialog-wrapper">
		<div class="diginfo"><span class="cl close"></span><span class="goon close"></span></div>
	</div>
	<div style="display:none"><?=$_webset['site_footer'];?></div>
</body>
</html>
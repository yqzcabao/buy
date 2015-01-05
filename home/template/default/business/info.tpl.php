<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/business.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="<?=PATH_TPL;?>/static/js/business.js"></script>
<span class="businessCooperation area">
	<a href="<?=u('index','index');?>"><?=$_webset['site_name'];?></a>
	&nbsp;&gt;&nbsp;<a href="<?=u('business','index');?>">商家报名系统</a>
	&nbsp;&gt;&nbsp;活动准备 
</span>
<div class="ready_c area">
	<div class="ready_content">
		<?=$article['content'];?>
	</div>
</div>					
<?php include(PATH_TPL."/public/footer.tpl");?>
</body>
</html>
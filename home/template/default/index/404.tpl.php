<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/404.css" type="text/css" rel="stylesheet"/>
<div class="nofound area">
	<div class="block404">
    	<h4>您访问的页面不存在！</h4>
        <p>
          <em>您可以：</em>
          1. 检查您的网址输入是否正确
          <br>
          2. 访问 <a href="<?=u('index','index');?>"><?=$_webset['site_name'];?></a> 首页
        </p>
    </div>
</div>
<?php include(PATH_TPL."/footer.tpl.php");?>
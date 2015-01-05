<div class="i2_botd">
    <ul class="uline">
      <li><a href="<?=u(MODNAME,'index');?>">首页</a></li>
      <li><a href="<?=u('index','index',array('form_wap'=>'mob'));?>">电脑版</a></li>
      <li><a href="<?=u(MODNAME,'index');?>" style="color: #666">手机版</a></li>
      <li style=" border-right: none"><a style="color: #E32014;" href="">客户端</a></li>
    </ul>
</div>
<div class="botmlogind">

    <a href="<?=u(MODNAME,'login');?>" class="a1">登录</a>
    <a href="<?=u(MODNAME,'register');?>" class="a2">注册</a>

</div>
<div class="bottom">©2014 <?=$_webset['site_url'];?></div>
<script type="text/javascript" src="static/js/jquery.lazyload.js"></script>
<script type="text/javascript">
//图片异步加载
$("img.lazy").lazyload({threshold:200,failure_limit:30});
</script>
</body>
</html>
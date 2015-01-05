<script type="text/javascript" src="static/js/jquery.lazyload.js"></script>
<script type="text/javascript">
//图片异步加载
$("img.lazy").lazyload({threshold:200,failure_limit:30});
</script>
<?php 
//帮助文档
$help=gethelpcat();
$helparticle=gethelp();
?>
<div class="clear"></div>
<div class="about">
    <ul class="area" style="width: 1020px;">
    	<?php if(!empty($help)){ ?>
        	<?php foreach ($help as $key=>$value){ ?>
            <li class="lw fl">
                <span><?=$value['title'];?></span>
                <?php foreach ($helparticle[$value['id']] as $k=>$val){ ?>
                <a href="<?=empty($val['url'])?u('help','info',array('cid'=>$value['id'],'id'=>$val['id'])):$val['url'];?>" target="_blank"><?=$val['title'];?></a>
                <?php } ?>
            </li>
            <?php } ?>
        <?php } ?>
        <li class="lw w2 fl">
            <span>关注我们</span>
            <?php if(!empty($_webset['site_weibo_sina'])){ ?>
            <a href="http://widget.weibo.com/dialog/follow.php?fuid=<?=$_webset['site_weibo_sina'];?>" target="_blank">新浪微博</a>
            <?php } ?>
            <?php if(!empty($_webset['site_weibo_tencent'])){ ?>
            <a href="http://e.t.qq.com/<?=$_webset['site_weibo_tencent'];?>" target="_blank">腾讯微博</a>
            <?php } ?>
            <?php if(!empty($_webset['site_qzone'])){ ?>
            <a href="<?=$_webset['site_qzone'];?>" target="_blank">QQ空间</a>
            <?php } ?>
            <?php if(!empty($_webset['site_service'])){ ?>
        	<a href="http://wpa.qq.com/msgrd?v=3&uin=<?=$_webset['site_service'];?>&site=qq&menu=yes" class="contractKf" title="在线客服" target="_blank">在线客服</a>
            <?php } ?>
        </li>
        <li class="w3 fl">
            <span>下次怎么来?</span>
            <h3><a href="<?=u('index','desktop');?>" title="下载桌面快捷方式" target="_blank">下载桌面快捷方式</a></h3>
            <h3>记住域名：<a href="javascript:void(0);"><em><?=str_replace('http://','',$_webset['site_url']);?></em></a></h3>
            <h5>收藏本站：<a class="clt" href="javascript:void(0);" onclick="return addfavorite(this,'<?=$_webset['site_name'];?>','<?=$_webset['site_url'];?>');"><u>加入收藏</u></a></h5>
        </li>
        <li class="w4 fl">
            <span>关注<?=$_webset['site_name'];?></span>
            <h4>
                <img src="<?=$_webset['site_weixinpic'];?>" class="fl" alt="" width="72" height="73">
                <p>
                    关注<?=$_webset['site_name'];?>，秒杀早知道
                    <br>
                    如何关注？
                    <br>
                    1) 查找微信号“<em><?=$_webset['site_weixin'];?></em>”
                    <br>
                    2) 用微信扫描左侧二维码
                </p>
            </h4>
        </li>
    </ul>
</div>
<div class="clear"></div>
<?php if(!empty($link)){ ?>
<div class="friendly_links area">
	<span class="fl">友情链接：</span>
	<a href="<?=u('help','link');?>" target="_blank" class="more fr">更多&gt;&gt;</a>
        <ul class="flinks fl">
        	<?php foreach ($link as $key=>$value){ ?>
        	<?php if($value['isindex']==1){ ?>
            <li class="fl"><a href="<?=$value['url'];?>" target="_blank"><?=$value['title'];?></a></li>
            <?php } ?>
            <?php } ?>
        </ul>
</div>
<script type="text/javascript">
//友情链接滚动
if($('.flinks li').length>0){
	var ulheight=parseInt($('.flinks').height());
	setInterval(function(){
		var marginTop=parseInt($('.flinks').css("marginTop"));
		marginTop=marginTop-15;
		if(ulheight<=Math.abs(marginTop)){
			marginTop=0;
		}
		$('.flinks').animate({marginTop:marginTop+"px"}, 800);
	},5E3);
}
</script>
<?php } ?>
<div class="area footer">
	<?=$_webset['site_icp'];?> <?=$_webset['site_copyright'];?>
	<br>
	<?=$_webset['site_footer'];?>
</div>
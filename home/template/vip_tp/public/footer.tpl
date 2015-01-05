<script type="text/javascript" src="static/js/jquery.lazyload.js"></script>
<script type="text/javascript">
//图片异步加载
$("img.lazy").lazyload({threshold:200,failure_limit:30});
</script>
<div class="foot about">
		<div class="white_bg">
			<?php $help=gethelpcat();?>
			<div class="xd_info" style="border-bottom:none;">
				<div class="left-info"><div class="menu">
					<a href="./" rel="nofollow">首页</a>
					<?php if(!empty($help)){ ?>
	        			<?php foreach ($help as $key=>$value){ ?>
						|<a href="<?=empty($val['url'])?u('help','info',array('cid'=>$value['id'])):$val['url'];?>"><?=$value['title'];?></a>
						<?php } ?>
					<?php } ?>
					|<a href="<?=u('index','desktop');?>" target="_blank">下载到桌面</a>
				</div>
			</div>
			<div class="refer"><div class="follow">
				<ul>
					<?php if($_webset['site_weibo_sina']){ ?>
					<li><a class="sina" href="http://widget.weibo.com/dialog/follow.php?fuid=<?=$_webset['site_weibo_sina'];?>" target="_blank" rel="nofollow">新浪微博</a></li>
					<?php } ?>
					<?php if(!empty($_webset['site_weibo_tencent'])){ ?>
					<li><a class="tt" href="http://e.t.qq.com/<?=$_webset['site_weibo_tencent'];?>" target="_blank" rel="nofollow">腾讯微博</a></li>
					<?php } ?>
					<li>
						<a class="kik" id="foot_kik" href="javascript:;" title="关注微信" rel="nofollow">微信</a>
						<span class="kit-img" style="background: url('<?=$_webset['site_weixinpic'];?>') no-repeat scroll 0 0 transparent;background-size: 180px;"></span>
					</li>
					<?php if(!empty($_webset['site_qzone'])){ ?>
					<li><a class="qzone" href="<?=$_webset['site_qzone'];?>" target="_blank" title="QQ空间" rel="nofollow">QQ空间</a><span class="tb-img"></span></li>
					<?php } ?>
				</ul>
			</div>
			<div class="miibeian">
				<p><a href="<?=$_webset['site_url'];?>" target="_blank" rel="nofollow"><?=$_webset['site_name'];?></a>-<?=$_webset['site_icp'];?><br><?=$_webset['site_copyright'];?></p>
			</div>
		</div>
	</div>
	<div class="foot_right">
		<img src="<?=PATH_TPL;?>/static/images/common/sao.png" class="fl">
		<img src="<?=$_webset['site_weixinpic'];?>" class="fl" style="width:93px;"></div>
	<?php if(!empty($link)){ ?>
	<div class="links">
		<span>友情链接：</span>
		<div class="links_list_box">
			<ul class="links_list" style="margin-top: 0px;">
				<li>
					<?php foreach ($link as $key=>$value){ ?>
		        	<?php if($value['isindex']==1){ ?>
		            	<a href="<?=$value['url'];?>" target="_blank"><?=$value['title'];?></a>
		            <?php } ?>
		            <?php } ?>
		         </li>
			</ul>
		</div>
		<a href="<?=u('help','link');?>" target="_blank" class="more">更多&gt;&gt;</a>
	</div>
	<script type="text/javascript">
	//友情链接滚动
	if($('.links_list li').length>0){
		var ulheight=parseInt($('.links_list').height());
		setInterval(function(){
			var marginTop=parseInt($('.links_list').css("marginTop"));
			marginTop=marginTop-17;
			if(ulheight<=Math.abs(marginTop)){
				marginTop=0;
			}
			$('.links_list').animate({marginTop:marginTop+"px"}, 800);
		},5E3);
	}
	</script>
	<?php } ?>
</div>
<div style="clear:both;text-align: center;"><?=$_webset['site_footer'];?></div>
</div>
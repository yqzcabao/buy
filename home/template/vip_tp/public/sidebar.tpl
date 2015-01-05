<?php 
if(empty($catlist)){
	$catlist=getgoodscat();
}
?>
<div class="side_nav">
	<div class="logo">
		<a href="<?=u('index','index');?>"><img alt="<?=$_webset['site_name'];?>" src="<?php if(!empty($_webset['side_logo'])){ ?><?=$_webset['side_logo'];?><?php }else{ ?><?=PATH_TPL;?>/static/images/side_logo_min.png<?php } ?>" width="145" height="70"></a>
	</div>
	<div class="content">
		<div class="bd">
		<ul>
			<?php foreach ($_nav as $key=>$value){ ?>
			<?php if($value['mod']!='index' && $value['ac']!='index'){ ?>
			<li><a <?php if($value['tag']==$_navtag){ ?>class="light"<?php } ?> href="<?=!empty($value['url'])?$value['url']:u($value['mod'],$value['ac']);?>" <?php if($value['target']==1){ ?>target="_blank"<?php } ?>><?=$value['name'];?></a></li>
			<?php } ?>
			<?php } ?>
		</ul>
		</div>
		<div class="line"></div>
		<div class="bdc">
			<ul>
				<?php foreach ($catlist as $key=>$value){ ?>
				<li class="bdc<?=$key;?>"><a class="" href="<?=u('index','index',array('cat'=>$value['id']));?>" title="<?=$value['title'];?>"><i></i><?=$value['title'];?></a></li>
				<?php } ?>
				<!--
				<li class="bdc0"><a class="" href=""><i></i>女装</a></li>
				<li class="bdc1"><a class="" href=""><i></i>男装</a></li>
				<li class="bdc2"><a class="" href=""><i></i>居家</a></li>
				<li class="bdc3"><a class="" href=""><i></i>母婴</a></li>
				<li class="bdc4"><a class="" href=""><i></i>鞋包</a></li>
				<li class="bdc5"><a class="" href=""><i></i>配饰</a></li>
				<li class="bdc6"><a class="" href=""><i></i>美食</a></li>
				<li class="bdc7"><a class="" href=""><i></i>数码</a></li>
				<li class="bdc8"><a class="" href=""><i></i>美妆</a></li>
				<li class="bdc9"><a class="" href=""><i></i>文体</a></li>
				<li class="bdc10"><a class="" href=""><i></i>中老年</a></li>
				-->
			</ul>
			<form action="<?=u('index','index');?>" class="search" target="_blank" method="GET">
				<input type="hidden" name="mod" value="index">
	            <input type="hidden" name="ac" value="index">
				<input type="text" name="keyword" class="txt" placeholder="搜索" autocomplete="off"><input type="submit" value="" class="smt"></form></div><div class="zhi_guang">
			</form>
		</div>
		<?php if(!empty($_webset['site_service'])){ ?>
		<div class="bd move_padding">
			<div class="add_link"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?=$_webset['site_service'];?>&site=qq&menu=yes" title="在线客服" id="contractKf" target="_blank"><i class="contact_w"></i><span>在线客服</span></a></div>
		</div>
		<?php } ?>
	</div>
</div>
<script type="text/javascript">
$(window).scroll(function(){
	var scrollTop=0;
	if (typeof window.pageYOffset != 'undefined') {
		scrollTop = window.pageYOffset; //Netscape
	}
	else if (typeof document.compatMode != 'undefined' &&
	document.compatMode != 'BackCompat') {
		scrollTop = document.documentElement.scrollTop; //Firefox、Chrome
	}
	else if (typeof document.body != 'undefined') {
		scrollTop = document.body.scrollTop; //IE
	}
	if(scrollTop>=180){
		$(".side_nav").addClass("affix");
	}else if(scrollTop<=106){
		$(".side_nav").removeClass("affix");
	}
})
</script>
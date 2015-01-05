<?php 
if(empty($catlist)){
	$catlist=getgoodscat();
}
?>
<div class="side_nav">
	<div class="side_logo"><a href="<?=u('index','index');?>" <?php if(!empty($_webset['side_logo'])){ ?>style="background: url(<?=$_webset['side_logo'];?>) no-repeat center;"<?php } ?>></a></div>
	<div class="content">
    	<div class="hd">
            <h3><a href="<?=u('index','index');?>">[独家]每天9点更新</a></h3>
        </div>
        <div class="bd">
            <ul>
            	<?php foreach ($catlist as $key=>$value){ ?>
                <li class="fl">
                	<a href="<?=u('index','index',array('cat'=>$value['id'],'sort'=>$sort));?>" <?php if($value['id']==request('cat')){ ?>class="on"<?php } ?>><?=$value['title'];?></a></li>
                <?php } ?>
            </ul>
            <div class="clear"></div>
            <form class="search_form"  action="<?=u('index','index');?>" method="GET">
                <input type="text" name="keyword" class="txt fl" placeholder="快捷搜索" />
                <input type="hidden" name="mod" value="index">
            	<input type="hidden" name="ac" value="index">
                <input type="submit" value="&nbsp;" class="smt" />
            </form>
        </div>
        <div class="hd"><h3>精选推荐</h3></div>
        <div class="bd">
        	  <ul>
                <li class="fl"><a href="<?=u('index','tomorrow');?>">精选预告</a></li>
                <li class="fl"><a href="<?=u('brand','index');?>" style="color: rgb(224, 47, 47);">品牌团</a></li>
            </ul>
        </div>
        <?php if(!empty($_webset['site_service'])){ ?>
        <div class="bd move_padding">
       		<div class="add_link">
            	<a href="http://wpa.qq.com/msgrd?v=3&uin=<?=$_webset['site_service'];?>&site=qq&menu=yes" target="_blank">
                	<i class="contact_w fl"></i>
                    <span>在线客服</span>
                </a>
            </div>
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
		$(".side_nav").addClass("flutter");
	}else if(scrollTop<=106){
		$(".side_nav").removeClass("flutter");
	}
})
</script>
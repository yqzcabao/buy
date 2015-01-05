<?php if(!empty($_ad['ad_1'])){ ?>
<link href="static/plugins/focuspic/static/css/common.css" type="text/css" rel="stylesheet"/>
<div class="flexslider">
	<ul class="slides">
		<?php foreach ($_ad['ad_1'] as $key=>$value){ ?>
		<li>
			<?php if(!empty($value['url'])){ ?>
			<div class="img"><a href="<?=$value['url'];?>" target="_blank"><img src="<?=$value['pic'];?>" alt="<?=$value['title'];?>" /></a></div>
			<?php }else{ ?>
			<div class="img"><img src="<?=$value['pic'];?>" alt="<?=$value['title'];?>" /></div>
			<?php } ?>
		</li>
		<?php } ?>
	</ul>
</div>
<script defer src="static/plugins/focuspic/static/js/common.js"></script> 
<script type="text/javascript">
$(function(){
  $('.flexslider').flexslider({
    animation: "slide",
    start: function(slider){
      $('body').removeClass('loading');
    }
  });
});
</script>
<?php } ?>
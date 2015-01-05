<link href="<?=PATH_APP;?>/static/css/common.css" type="text/css" rel="stylesheet"/>
<div class="banner_column area">
	<div class="content">
	  <dl>
	        <dt><a href="<?=$screenad[1]['url'];?>" title="<?=$screenad[1]['title'];?>" target="_blank"><img alt="<?=$screenad[1]['title'];?>" src="<?=$screenad[1]['pic'];?>"></a></dt>
	        <dt><a href="<?=$screenad[2]['url'];?>" title="<?=$screenad[2]['title'];?>" target="_blank"><img alt="<?=$screenad[2]['title'];?>" src="<?=$screenad[2]['pic'];?>"></a></dt>
	        <dd><a href="<?=$screenad[3]['url'];?>" title="<?=$screenad[3]['title'];?>" target="_blank"><img alt="9.<?=$screenad[3]['title'];?>" src="<?=$screenad[3]['pic'];?>"></a></dd>
	        <dd><a href="<?=$screenad[5]['url'];?>" title="<?=$screenad[5]['title'];?>" target="_blank"><img alt="<?=$screenad[5]['title'];?>" src="<?=$screenad[5]['pic'];?>"></a></dd>
	        <dd><a href="<?=$screenad[4]['url'];?>" title="<?=$screenad[4]['title'];?>" target="_blank"><img alt="<?=$screenad[4]['title'];?>" src="<?=$screenad[4]['pic'];?>"></a></dd>
	        <dd><a href="<?=$screenad[6]['url'];?>" title="<?=$screenad[6]['title'];?>" target="_blank"><img alt="<?=$screenad[6]['title'];?>" src="<?=$screenad[6]['pic'];?>"></a></dd>
	  </dl>
	</div>
</div>
<script type="text/javascript">
//首页banner
var a=$(".banner_column");
a.find("dt img,dd img").css("position","relative")
.bind("mouseenter",function(){
	t=$(this);
	num=$(this).parents("dt").attr("site");
	if(num!='' && num!==undefined){
		var left_num=num=='coubei'?120:365;
		$("#"+num).stop().animate({left:left_num},200);
	}
	t.stop().animate({left:-10},200);
})
.bind("mouseleave",function(){
	num=$(this).parents("dt").attr("site");
	if(num!='' && num!==undefined){
		var left_num=num=='coubei'?130:375;
		$("#"+num).stop().animate({left:left_num},200);
	}
	$(this).stop().animate({left:0},200)
});
</script>
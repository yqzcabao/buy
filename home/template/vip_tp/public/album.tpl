<?php
//判断是否存在专题
if(intval($index_album['num'])){
?>
<style type="text/css">
/*专题*/
.bigdeal li .slide-box{ width:310px; overflow:hidden; height:389px;background: #FFF;}
.bigdeal li .slide-box dl{ height:310px; width:2000px;}
.bigdeal li .slide-box dl dd{ float:left; height:310px; width:310px;}
.bigdeal li .slide-box dl dd img{ width:310px; height:auto;}
.bigdeal li .slide_title {width:290px;font-size:14px; height:18px; line-height:18px;overflow: hidden;margin:8px auto 7px;font-weight:normal;color:#333;}
.bigdeal li .slide_title a{ display: inline;color:#333;font-size:14px;}
.bigdeal li .slide_title a:hover{ text-decoration:underline; color:#333;}

.bigdeal li .slide_title {width:290px;font-size:14px; height:18px; line-height:18px;overflow: hidden;margin:8px auto 7px;font-weight:normal;color:#333;}
.bigdeal li .slide_title a{ display: inline;color:#333;font-size:14px;}
.bigdeal li .slide_title a:hover{ text-decoration:underline; color:#333;}
.bigdeal li .slide_desc{width:160px; height:40px;line-height:38px; float:left; display:inline;overflow:hidden; margin:2px 0 0 9px;}
.bigdeal li .slide_desc a{ color:#333; font-family:"微软雅黑","宋体"; font-size:22px;}
.bigdeal li .slide_desc a:hover{ color:#ff6c01; text-decoration:none;}
.bigdeal li .slide-box .slide_page{ float:right; margin:12px 9px 0 0;display:inline;}
.bigdeal li .slide-box .slide_page span{ width:19px; height:19px; background:#c6c6c6; display:inline; float:left; line-height:19px; text-align:center; color:#fff;border-radius:50px; margin-left:7px; cursor:pointer;}
.bigdeal li .slide-box .slide_page span.cur{background:#ee4e22;}
</style>
<li>
    <div class="slide-box" id="slide_index">
        <dl style="margin-left: 0px;">
           <?php foreach ($index_album['album'] as $key=>$value){ ?>
           <dd><a target="_blank" href="<?=u('album','index',array('aid'=>$value['aid']));?>"><img src="<?=$value['cover'];?>" width="310" height="310" alt="<?=$value['title'];?>" data-title="<?=$value['brief'];?>"></a></dd>
           <?php } ?>
        </dl>
        <h3 class="slide_title"><a target="_blank" href="<?=u('album','index',array('aid'=>$index_album['album'][0]['aid']));?>"><?=$index_album['album'][0]['brief'];?></a></h3>
        <div class="slide_desc"><a target="_blank" href="<?=u('album','index',array('aid'=>$index_album['album'][0]['aid']));?>"><?=$index_album['album'][0]['title'];?></a></div>
        <div class="slide_page">
        	<?php foreach ($index_album['album'] as $key=>$value){ ?>
            <span <?php if($key==0){ ?>class="cur"<?php } ?>><?=$key+1;?></span>
            <?php } ?>
        </div>
    </div>
</li>
<script type="text/javascript">
/*专题幻灯*/
var myCarousel = function(){
	var playTimer = null;
	var index = 0;
	var img = $("#slide_index dl dd img");
	var btn = $("#slide_index .slide_page span");
	var oList = $("#slide_index dl");

	//按钮点击切换
	btn.mouseover(function(){
		index = $(this).index();
		var i = $(this).index() - btn.index($("#slide_index .slide_page span.cur"));
		i = i-1;
		if(i>0){
			for (i; i > 0; i--){
				oList.find("dd:first").insertAfter(oList.find("dd:last"));
			}
		}else{
			for (i; i < 0; i++){
				oList.find("dd:last").insertBefore(oList.find("dd:first"));
			}
		}
		oList.stop(false,true);
		oList.css("margin-left",0);
		cutover(function(){
			oList.find("dd:first").insertAfter(oList.find("dd:last"));
			oList.css("margin-left",0);
		});

	});

	function next(){
		index++;
		if(index > btn.length - 1){
			index = 0;
		}
		cutover(function(){
			oList.find("dd:first").insertAfter(oList.find("dd:last"));
			oList.css("margin-left",0);
		});
	}

	playTimer = setInterval(next, 3000);

	function cutover(func){
		oList.stop(false,true);
		btn.removeClass("cur");
		btn.eq(index).addClass("cur");
		$("#slide_index .slide_title").html('<a target="_blank" href="'+oList.find("dd:eq(1) a").attr("href")+'">'+oList.find("dd:eq(1) img").data("title")+'</a>');
		$("#slide_index .slide_desc").html('<a target="_blank" href="'+oList.find("dd:eq(1) a").attr("href")+'">'+oList.find("dd:eq(1) img").attr("alt")+'</a>');
		oList.animate({marginLeft:"-310px"},func);
	}

	//鼠标移入展示区停止自动播放
	$("#slide_index").mouseover(function (){
		clearInterval(playTimer)
	}
	)

	//鼠标离开展示区开始自动播放
	$("#slide_index").mouseout(function (){
		clearInterval(playTimer);
		playTimer = setInterval(next, 3000)
	});
}

if($("#slide_index").size() > 0 && $("#slide_index dd").size() > 1){
	myCarousel();
}
</script>
<?php } ?>
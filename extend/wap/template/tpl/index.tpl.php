<?php require tpl_extend(WAP_TPL.'/pub/header.tpl');?>
<?php require tpl_extend(WAP_TPL.'/pub/nav.tpl');?>
<?php if(ACTNAME=='index'){ ?>
<!--//排序-->
<div class="i2_menu2d">
    <ul>
        <li style="position: relative"><a class="cagam" style=""><span>分类</span></a></li>
        <li style="position: relative" <?php if(empty($g_sort)){ ?>class="curr"<?php } ?>><a href="<?=u(MODNAME,'index');?>"><span>默认</span></a></li>
        <li style="position: relative" <?php if($g_sort=='discount'){ ?>class="curr"<?php } ?>><a href="<?=u(MODNAME,'index',array('sort'=>'discount'));?>"><span>折扣</span><i class="i2_icon up"></i></a></li>
        <li style="position: relative" <?php if($g_sort=='hot'){ ?>class="curr"<?php } ?>><a href="<?=u(MODNAME,'index',array('sort'=>'hot'));?>"><span>热度</span><i class="i2_icon down"></i></a></li>
    </ul>
</div>
<!--//分类-->
<?=show_cat_table();?>
<?php } ?>
<!--//列表-->
<section class="deals" id="stage">
	<?php foreach ($goods as $key=>$value){ ?>
    <div>
	    <a href="<?=u(MODNAME,'jump',array('iid'=>$value['num_iid']));?>" target="_blank" class="imgd imgd_mod2">
	        <img width="140" src="<?=DEF_GD_LOGO;?>" class="lazy" data-original="<?=get_img($value['pic'],'290');?>">
	        <?php if($value['start']>strtotime('today')){ ?>
	        <i class="mb_ico goodsdpi gisnew1"></i>
	        <?php } ?>
	    </a>
	    <h2>
		   <span>
		       <a href="<?=u(MODNAME,'jump',array('iid'=>$value['num_iid']));?>" target="_blank"><?=$value['title'];?></a>
		   </span>
	    </h2>
	    <aside>
	        ￥<span><?=trim_last0($value['promotion_price']);?></span>
	    </aside>
	    <p>
	        <del>￥<?=trim_last0($value['price']);?></del>
	        <cite><?=trim_last0($value['discount']);?>折</cite>
	        <?php if($value['start']>$_timestamp){ ?>
	        <b class="b2">未开始</b>
	        <?php }elseif ($value['end']<$_timestamp){ ?>
	        <b class="b3">已结束</b>
	        <?php }else{ ?>
	        <b class="b1"><?=$value['volume'];?>人想买</b>
	        <?php } ?>
	    </p>
	</div>
	<?php } ?>
</section>
<!--//更多-->
<div class="i_clicka">
    <a id="Disb" href="javascript:jsonajax();">点击查看更多</a>

</div>
<?php require tpl_extend(WAP_TPL.'/pub/footer.tpl');?>
<script type="text/javascript">
//加载更多
$(window).scroll(function(){
	//此方法是在滚动条滚动时发生的函数
	// 当滚动到最底部以上100像素时，加载新内容
	var doc_height,s_top,now_height;
	doc_height = $(document).height();        //这里是document的整个高度
	s_top = $(this).scrollTop();            //当前滚动条离最顶上多少高度
	now_height = $(this).height();
	//这里的this 也是就是window对象
	if((doc_height - s_top - now_height) < 250) jsonajax();
});
var start = <?=$start;?>;
var cat = '<?=$cat;?>';
var sort = "<?=$g_sort;?>";

function jsonajax(){
	$.ajax({
		url:'<?=u(MODNAME,'index');?>',
		type:'POST',
		data:"&sort="+sort+"&cat="+cat+"&inajax=1&start="+(start+=20),
		dataType:'json',
		success:function(json){
			if(!json.isover){
				goods = json.goods;
				var str = newstr='';
				var timestamp = (new Date()).valueOf();
				timestamp = timestamp/1000;
				for(var i=0,l=goods.length;i<l;i++){
					if(goods[i].start>timestamp){
						str = " <b class='b2'>即将开抢</b>";
					}else{
						if(goods[i].end<timestamp){
							str = "<b class='b3'>已结束</b>";
						}else{
							str = " <b class='b1'>"+goods[i].volume+"人想买</b>";
						}
					}
					if(goods[i].is_new){
						newstr='<i class="mb_ico goodsdpi gisnew1"></i>';
					}
					$("#stage").append("<div><a class='imgd' href='"+goods[i].url_format+"'><img width='140'  src='"+goods[i].pic+"'/>"+newstr+"</a><h2><span><a href='"+goods[i].url_format+"'>"+goods[i].title+"</a></span></h2><aside>￥<span>"+goods[i].promotion_price+"</span></aside><p><del>￥"+goods[i].price+"</del><cite>"+goods[i].discount+"折</cite> "+str+"</p></div>");
				}
			}else{
				$("#Disb").hide();
			}
		}
	});
}
</script>
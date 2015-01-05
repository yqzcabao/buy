<?php require tpl_extend(WAP_TPL.'/pub/header.tpl');?>
<?php foreach ($brandlist['data'] as $key=>$value){ ?>
<img width="100%" style="display: block;width: 100%;height: auto;z-index: 10;position: relative; " src="<?=$value['pic'];?>">
<div class="c_pptbd" style="">
    <a class="loga">
        <img width="70" height="35" src="<?=$value['logo'];?>">
    </a>
    <h2><?=$value['brand'];?></h2>
    <cite><?=date('m.d',$value['start']);?>~<?=date('m.d',$value['end']);?></cite>
    <b></b>
</div>
<section class="deals m_pptdobj<?=$value['bid'];?> " style="padding-bottom: 10px;">
<?php foreach ($brandgood['bid_'.$value['bid']]['goods'] as $k=>$val){ ?>
<div id="<?=$val['id'];?>">
    <a href="<?=u(MODNAME,'jump',array('iid'=>$val['num_iid']));?>" target="_blank" class="imgd imgd_mod2">
        <img width="140" src="<?=DEF_GD_LOGO;?>" class="lazy" data-original="<?=get_img($val['pic'],'290');?>">
        <?php if($val['start']>strtotime('today')){ ?>
        <i class="mb_ico goodsdpi gisnew1"></i>
        <?php } ?>
    </a>
    <h2><span><a href="<?=u(MODNAME,'jump',array('iid'=>$val['num_iid']));?>" target="_blank"><?=$val['title'];?></a></span></h2>
	<aside>￥<span><?=$val['promotion_price'];?></span></aside>
    <p>
        <del>￥<?=$val['price'];?></del>
        <cite><?=$val['discount'];?>折</cite>
        <?php if($val['start']>$_timestamp){ ?>
        <b class="b2">未开始</b>
        <?php }elseif ($val['end']<$_timestamp){ ?>
        <b class="b3">已结束</b>
        <?php }else{ ?>
        <b class="b1"><?=$val['volume'];?>人想买</b>
        <?php } ?>
    </p>
</div>
<?php } ?>
</section>
<div class="pptmoreg m_mored<?=$value['bid'];?>">
 <a onclick="jsonajax('<?=$value['bid'];?>');">还有<span><?=($brandgood['bid_'.$value['bid']]['num']-3);?>款</span>商品&nbsp;∨</a>
</div>
<?php } ?>
<script type="text/javascript">
function jsonajax(bid){
	//计算已有的id
	var idstr=tag='';
	$(".m_pptdobj"+bid+" div").each(function(i){
		idstr+=tag+$(this).attr("id");
		tag=',';
	})
	$.ajax({
		url:'<?=u(MODNAME,'brands');?>',
		type:'POST',
		data:"bid="+bid+"&idstr="+idstr+"&inajax=1",
		dataType:'json',
		success:function(json){
			if(json.num>0){
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
					$(".m_pptdobj"+bid).append("<div><a class='imgd' href='"+goods[i].url_format+"'><img width='140'  src='"+goods[i].pic+"'/>"+newstr+"</a><h2><span><a href='"+goods[i].url_format+"'>"+goods[i].title+"</a></span></h2><aside>￥<span>"+goods[i].promotion_price+"</span></aside><p><del>￥"+goods[i].price+"</del><cite>"+goods[i].discount+"折</cite> "+str+"</p></div>");
					$(".m_mored"+bid).hide();
				}
			}else{
				$(".m_mored"+bid).hide();
			}
		}
	});
}
</script>
<?php require tpl_extend(WAP_TPL.'/pub/footer.tpl');?>
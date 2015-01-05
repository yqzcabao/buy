<?php require tpl_extend(SPECIAL_TPL.'/pub/header.tpl');?>
<span data-time="1415353687" id="time"></span>
<script type="text/javascript">
var endtime='1415664000';
var nowtime=$("#time").attr("data-time");
var len=endtime-nowtime;
function set_time(){
	--len;
	var html='';
	if(len>0){
		var dd = parseInt(len / 60 / 60 / 24, 10);//计算剩余的天数
		var hh = parseInt(len / 60 / 60 % 24, 10);//计算剩余的小时数
		var mm = parseInt(len / 60 % 60, 10);//计算剩余的分钟数
		var ss = parseInt(len % 60, 10);//计算剩余的秒数
		//html
		var dd_shiwei=parseInt(dd/10);
		var dd_gewei=dd%10;
		html+='<i class="time'+dd_shiwei+'">&nbsp;</i><i class="time'+dd_gewei+'">&nbsp;</i>:';
		var hh_shiwei=parseInt(hh/10);
		var hh_gewei=hh%10;
		html+='<i class="time'+hh_shiwei+'">&nbsp;</i><i class="time'+hh_gewei+'">&nbsp;</i>:';
		var mm_shiwei=parseInt(mm/10);
		var mm_gewei=mm%10;
		html+='<i class="time'+mm_shiwei+'">&nbsp;</i><i class="time'+mm_gewei+'">&nbsp;</i>:';
		var ss_shiwei=parseInt(ss/10);
		var ss_gewei=ss%10;
		html+='<i class="time'+ss_shiwei+'">&nbsp;</i><i class="time'+ss_gewei+'">&nbsp;</i>';
		$("#time").html(html);
		setTimeout(function(){
			set_time();
		}, 1000);
	}
}
set_time();
</script>
<div class="act-bg"></div>
<div class="body">
	<ul class="area bigdeal clearfix">
		<?php foreach ($goodslist as $key=>$value){ ?>
		<li>
			<div class="deal dealbig">
				<?php if($value['start']>=strtotime('today') && $value['start']<strtotime('tomorrow')){ ?>
				<i class="new"></i>
				<?php } ?>
				<h3 class="stnmclass">
					<a href="javascript:vpid(0);">
						<img src="<?=DEF_GD_LOGO;?>" data-original="<?=get_img($value['pic'],'310');?>" alt="<?=$value['title'];?>" class="lazy" style="display: inline;">
					</a>
				</h3>
				<div class="beauty_pro_info <?php if($value['start']>$_timestamp){ ?>unstart<?php }elseif ($value['end']<$_timestamp){ ?>end<?php } ?>">
					<em class="ptitle"><a href="javascript:vpid(0);" num_iid="<?=$value['num_iid'];?>" title="<?=$value['title'];?>"><?php if($value['ispost']==1){ ?>【包邮】<?php } ?><?=$value['title'];?></a></em>
					<span class="price_list_sale fl"> ￥ <em><?=trim_last0($value['promotion_price']);?></em></span>
					<span class="des-other fl">
						<?php if($value['ispaigai']==1){ ?>
						<em class="icon-gai">拍下改价</em>
	                	<?php }elseif ($value['isvip']==1){ ?>
	                	<em class="icon-vip">VIP价格</em>
	                	<?php }else{ ?>
	                	<em class="icon-jingxuan">小编精选</em>
	                	<?php } ?>
	                    <span class="price-old"><em>￥</em><?=trim_last0($value['price']);?></span>
	                    <span class="discount">(<em><?=trim_last0($value['discount']);?></em>折)</span>
	                </span>
					<a class="beauty_link_b" href="javascript:vpid(0);" >
						<?php if($value['start']>$_timestamp){ ?>即将开始
						<?php }elseif ($value['end']<$_timestamp){ ?>已结束
						<?php }else{ ?>
						去<?php if($value['site']=='tmall'){ ?>天猫<?php }elseif ($value['site']=='taobao'){ ?>淘宝<?php } ?>抢购
						<?php } ?>
					</a>
				</div>
				<div class="btm">
					<span class="sold">已有<em><?=$value['volume'];?></em>人购买</span>
					<span class="share">
						<a title="<?=$value['title'];?>" <?=gogood($value['num_iid'],false);?> class="tip" style="margin-right: 10px;">详细</a>
						<a rel="nofollow" title="分享" class="tip" href="javascript:vpid(0);" target="_blank">分享到：</a>
						<a href="javascript:;" onclick="share.doShare('t_sina',{'url':'<?=urlencode(u('goods','detail',array('iid'=>$value['num_iid'])));?>','title':'<?=$value['title'];?>','pic':'<?=urlencode(get_img($value['pic']));?>'});" rel="nofollow" class="weibo"></a>
						<a  href="javascript:;" onclick="share.doShare('qzone',{'url':'<?=urlencode(u('goods','detail',array('iid'=>$value['num_iid'])));?>','title':'<?=$value['title'];?>','pic':'<?=urlencode(get_img($value['pic']));?>'});" rel="nofollow" class="qzone"></a>
						<a href="javascript:;" onclick="share.doShare('t_qq',{'url':'<?=urlencode(u('goods','detail',array('iid'=>$value['num_iid'])));?>','title':'<?=$value['title'];?>','pic':'<?=urlencode(get_img($value['pic']));?>'});" rel="nofollow" class="tqq"></a>
					</span>
				</div>
			</div>
		</li>
		<?php } ?>
	</ul>
	<!--//分页-->
	<?php include(PATH_TPL."/public/pages.tpl");?>
</div>
<?php require tpl_extend(SPECIAL_TPL.'/pub/footer.tpl');?>
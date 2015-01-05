<?php require tpl_extend(ALBUM_TPL.'/pub/header.tpl');?>
<div class="banner" style="position:relative; height:400px; background:url('<?=ALBUM_TPL_PATH;?>/static/images/banner.jpg') center center no-repeat; margin-bottom:15px;"></div>
<ul class="area bigdeal clearfix">
<?php foreach ($album_goods as $key=>$value){ ?>
	<li>
		<div class="deal dealbig">
			<?php if($value['start']>=strtotime('today') && $value['start']<strtotime('tomorrow')){ ?>
			<i class="new"></i>
			<?php } ?>
			<h3 class="stnmclass">
				<a <?=gogood($value['num_iid']);?>>
					<img src="<?=DEF_GD_LOGO;?>" data-original="<?=get_img($value['pic'],'290');?>" alt="<?=$value['title'];?>" class="lazy" style="display: inline;">
				</a>
			</h3>
			<div class="beauty_pro_info <?php if($value['start']>$_timestamp){ ?>unstart<?php }elseif ($value['end']<$_timestamp){ ?>end<?php } ?>">
				<em class="ptitle"><a <?=gogood($value['num_iid']);?> num_iid="<?=$value['num_iid'];?>" title="<?=$value['title'];?>"><?php if($value['ispost']==1){ ?>【包邮】<?php } ?><?=$value['title'];?></a></em>
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
				<a class="beauty_link_b" <?=gogood($value['num_iid']);?>>
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
<?php require tpl_extend(ALBUM_TPL.'/pub/footer.tpl');?>
<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/brands.css" type="text/css" rel="stylesheet"/>

<div class="brands area">
	<div class="list_introduce">
    	<div class="fl pic">
        	<img src="<?=$brand['pic'];?>"/>
        </div>
        <div class="detail fr">
        	<div class="img">
            	<img src="<?=$brand['logo'];?>"/>
            </div>
            <p class="shop_name"><?=$brand['brand'];?></p>
            <p class="discount" style="display:block;"><?=$brand['preferential'];?></p>
        </div>
    </div>
</div>


<ul class="area bigdeal clearfix brands_box" style="border-bottom:none">
	<?php if(!empty($goodslist) && is_array($goodslist)){ ?>
	<?php foreach ($goodslist as $key=>$value){ ?>
	<li>
		<div class="deal dealbig">
			<h3 class="stnmclass">
				<a <?=gogood($value['num_iid']);?> title="<?=$value['title'];?>">
					<img src="<?=DEF_GD_LOGO;?>" data-original="<?=get_img($value['pic'],'290');?>" class="lazy" style="display: inline;">
				</a>
			</h3>
			<div class="beauty_pro_info">
				<em class="ptitle">
					<a <?=gogood($value['num_iid']);?> title="<?=$value['title'];?>">
						<?php if($value['ispost']==1){ ?><b>【包邮】</b><?php } ?><?=$value['title'];?>
					</a></em>
				<span class="price_list_sale"> ￥ <em><?=trim_last0($value['promotion_price']);?></em><del class="f14 gray">￥<?=trim_last0($value['price']);?></del></span>
				<a class="beauty_link_b" <?=gogood($value['num_iid']);?> title="<?=$value['title'];?>">去<?php if($value['site']=='tmall'){ ?>天猫<?php }elseif ($value['site']=='taobao'){ ?>淘宝<?php } ?>抢购 </a>
			</div>
			<div class="btm">
				<span class="sold">已有<em><?=$value['volume'];?></em>人购买</span>
				<span class="share">
					<a title="<?=$value['title'];?>" <?=gogood($value['num_iid'],false);?> target="_blank" class="tip" style="margin-right: 10px;">详细</a>
					<a rel="nofollow" title="分享" class="tip" href="javascript:vpid(0);" target="_blank">分享到：</a>
					<a href="javascript:;" onclick="share.doShare('t_sina',{'url':'<?=urlencode(u('goods','detail',array('iid'=>$value['num_iid'])));?>','title':'<?=$value['title'];?>','pic':'<?=urlencode(get_img($value['pic']));?>'});" rel="nofollow" class="weibo"></a>
					<a href="javascript:;" onclick="share.doShare('qzone',{'url':'<?=urlencode(u('goods','detail',array('iid'=>$value['num_iid'])));?>','title':'<?=$value['title'];?>','pic':'<?=urlencode(get_img($value['pic']));?>'});" rel="nofollow" class="qzone"></a>
					<a href="javascript:;" onclick="share.doShare('t_qq',{'url':'<?=urlencode(u('goods','detail',array('iid'=>$value['num_iid'])));?>','title':'<?=$value['title'];?>','pic':'<?=urlencode(get_img($value['pic']));?>'});" rel="nofollow" class="tqq"></a>
				</span>
			</div>
		</div>
	</li>
	<?php } ?>
    <?php } ?>
</ul>
<?php $brandlist=brandlist(array('start<='.$_timestamp,'end>'.$_timestamp),'`sort` DESC,`addtime` DESC',0,100);?>
<?php if(!empty($brandlist)){ ?>
<div class="clear"></div>
<div class="contentA area">
    <div class="brandbox">
    	  <?php foreach ($brandlist['data'] as $key=>$value){ ?>
          <a href="<?=u('brand','info',array('bid'=>$value['bid']));?>" title="<?=$value['brand'];?>" target="_blank" class="fl">
            <img src="<?=get_img($value['logo']);?>" alt="<?=$value['brand'];?>"></a>
          <?php } ?>
          <a class="fl ctinue">敬请期待</a>
    </div>
</div>
<?php } ?>
<?php include(PATH_TPL."/footer.tpl.php");?>
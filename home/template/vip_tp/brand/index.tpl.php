<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/brands.css" type="text/css" rel="stylesheet"/>
<div class="brands_logo area">
	<?php if($brandlist['total']>16){ ?>
	<a href="javascript:void(0);" class="prev trigger"> 
        <i></i>
    </a>
	<a href="javascript:void(0);" class="next trigger"> 
        <i></i>
    </a>
    <?php } ?>
    <ul style="margin-left:0">
    	<li class="fl">
    	<?php foreach ($brandlist['data'] as $key=>$value){ ?>
          <a href="<?=u('brand','info',array('bid'=>$value['bid']));?>" target="_blank" class="fl">
            <img src="<?=$value['logo'];?>" alt="<?=$value['brand'];?>"></a>
        <?php } ?>
        </li>
    </ul>
</div>
<?php foreach ($brandgood as $key=>$value){ ?>
<div class="bandBox area">
	<div class="hd">
      <h3>
        <a target="_blank" href="<?=u('brand','info',array('bid'=>$value['bid']));?>">
          <img src="<?=$brandlist['data'][$key]['logo'];?>"><?=$brandlist['data'][$key]['brand'];?>
        </a>
      </h3>
    </div> 
</div>
<ul class="area bigdeal clearfix brands_box">
	<?php 
    $i=1;
    foreach ($value['goods'] as $k=>$val){ ?>
	<li>
		<div class="deal dealbig">
			<h3 class="stnmclass">
				<a <?=gogood($val['num_iid']);?> title="<?=$val['title'];?>">
					<img src="<?=DEF_GD_LOGO;?>" data-original="<?=get_img($val['pic'],'290');?>" class="lazy" style="display: inline;">
				</a>
			</h3>
			<div class="beauty_pro_info">
				<em class="ptitle">
					<a <?=gogood($val['num_iid']);?> title="<?=$val['title'];?>">
						<?php if($val['ispost']==1){ ?><b>【包邮】</b><?php } ?><?=$val['title'];?>
					</a></em>
				<span class="price_list_sale"> ￥ <em><?=trim_last0($val['promotion_price']);?></em><del class="f14 gray">￥<?=trim_last0($val['price']);?></del></span>
				<a class="beauty_link_b" <?=gogood($val['num_iid']);?> title="<?=$val['title'];?>">去<?php if($val['site']=='tmall'){ ?>天猫<?php }elseif ($val['site']=='taobao'){ ?>淘宝<?php } ?>抢购 </a>
			</div>
			<div class="btm">
				<span class="sold">已有<em><?=$val['volume'];?></em>人购买</span>
				<span class="share">
					<a title="<?=$val['title'];?>" <?=gogood($val['num_iid'],false);?> target="_blank" class="tip" style="margin-right: 10px;">详细</a>
					<a rel="nofollow" title="分享" class="tip" href="javascript:vpid(0);" target="_blank">分享到：</a>
					<a href="javascript:;" onclick="share.doShare('t_sina',{'url':'<?=urlencode(u('goods','detail',array('iid'=>$val['num_iid'])));?>','title':'<?=$val['title'];?>','pic':'<?=urlencode(get_img($val['pic']));?>'});" rel="nofollow" class="weibo"></a>
					<a href="javascript:;" onclick="share.doShare('qzone',{'url':'<?=urlencode(u('goods','detail',array('iid'=>$val['num_iid'])));?>','title':'<?=$val['title'];?>','pic':'<?=urlencode(get_img($val['pic']));?>'});" rel="nofollow" class="qzone"></a>
					<a href="javascript:;" onclick="share.doShare('t_qq',{'url':'<?=urlencode(u('goods','detail',array('iid'=>$val['num_iid'])));?>','title':'<?=$val['title'];?>','pic':'<?=urlencode(get_img($val['pic']));?>'});" rel="nofollow" class="tqq"></a>
				</span>
			</div>
		</div>
	</li>
	<?php $i++;}?>
</ul>
<?php if($value['num']>3){ ?>
<a class="bar area" target="_blank" href="<?=u('brand','info',array('bid'=>$value['bid']));?>">全部<?=$value['num'];?>款限时抢&gt;&gt;</a>
<?php } ?>
<?php } ?>
<?php include(PATH_TPL."/footer.tpl.php");?>
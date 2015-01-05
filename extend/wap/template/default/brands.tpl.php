<?php require tpl_extend(WAP_TPL.'/pub/header.tpl');?>
<div class="goods" style="margin-top:55px;">
	<?php if(empty($bid)){ ?>
    <div class="jp_scroll" style="overflow:auto">
    	<div style="width:1000px">
        	<div class="hot_title">
        		<?php foreach ($brandlist['data'] as $key=>$value){ ?>
            	<a href="<?=u(MODNAME,'brands',array('bid'=>$value['bid']));?>">
                	<div><img  class="lazy" src="<?=DEF_GD_LOGO;?>" data-original="<?=get_img($value['logo']);?>" /><h1><?=$value['brand'];?></h1></div>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if(empty($bid)){ ?>
    <?php foreach ($brandgood as $key=>$value){ ?>
    <div class="hot_goods">
    	<a href="<?=u(MODNAME,'brands',array('bid'=>$value['bid']));?>">
    		<div class="goods_title"><?=$brandlist['data'][$key]['brand'];?></div>
    	</a>
        <ul class="good_list clear">
        	<?php foreach ($value['goods'] as $k=>$val){ ?>
        	<li class="fl">
            	<a href="<?=u(MODNAME,'brands',array('bid'=>$val['cat']));?>">
                	<img class="fl lazy" src="<?=DEF_GD_LOGO;?>" data-original="<?=get_img($val['pic'],'290');?>" />
                    <h1 class="fl"><?=$val['title'];?><?php if(!empty($val['ispost'])){ ?>  包邮<?php } ?></h1>
                    <div class="price">
                        <span class="price_new">
                            <i>￥</i>
                            <?=$val['promotion_price'];?>
                        </span>
                        <i class="del">/￥<?=$val['price'];?></i>
                        <span class="buy_btn">去抢购
                        	<?php if($val['site']=='tmall'){?>
                        	<i class="fl"><img src="<?=WAP_TPL_PATH;?>/static/images/sts.png" /></i>
                        	<?php } ?>
                        </span>
                    </div>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>
    <?php }else{ ?>
    <div class="hot_goods">
    	<a href="<?=u(MODNAME,'brands',array('bid'=>$bid));?>"><div class="goods_title"><?=$brand['brand'];?></div></a>
        <ul class="good_list clear">
        	<?php foreach ($brandgood as $k=>$val){ ?>
        	<li class="fl">
            	<a href="<?=u(MODNAME,'jump',array('iid'=>$val['num_iid']));?>">
                	<img class="fl lazy" src="<?=DEF_GD_LOGO;?>" data-original="<?=get_img($val['pic'],'290');?>" />
                    <h1 class="fl"><?=$val['title'];?><?php if(!empty($val['ispost'])){ ?>  包邮<?php } ?></h1>
                    <div class="price">
                        <span class="price_new">
                            <i>￥</i>
                            <?=$val['promotion_price'];?>
                        </span>
                        <i class="del">/￥<?=$val['price'];?></i>
                        <span class="buy_btn">去抢购
                        	<?php if($val['site']=='tmall'){?>
                        	<i class="fl"><img src="<?=WAP_TPL_PATH;?>/static/images/sts.png" /></i>
                        	<?php } ?>
                        </span>
                    </div>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>
</div>
<?php require tpl_extend(WAP_TPL.'/pub/footer.tpl');?>
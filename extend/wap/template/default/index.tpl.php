<?php require tpl_extend(WAP_TPL.'/pub/header.tpl');?>
<div class="goods">
	<ul class="goods_list">
		<?php foreach ($goods as $key=>$value){ ?>
    	<li class="fl">
        	<a class="goods_a" href="<?=u(MODNAME,'jump',array('iid'=>$value['num_iid']));?>" target="_blank">
        		<img src="<?=DEF_GD_LOGO;?>" data-original="<?=get_img($value['pic'],'290');?>" class="lazy">
                <?php if($value['site']=='tmall'){?>
                <img class="tmall_icon" src="<?=WAP_TPL_PATH;?>/static/images/tmall.png" />
                <?php } ?>
            </a>
            <a href="<?=u(MODNAME,'jump',array('iid'=>$value['num_iid']));?>" target="_blank">
            	<h1><?=$value['title'];?> <?php if(!empty($value['ispost'])){ ?><i>包邮</i><?php } ?></h1>
                <div class="price">
                	<span class="price_new">
                    	<i>￥</i>
                        <?=trim_last0($value['promotion_price']);?>
                    </span>
                    <i class="del">/￥<?=trim_last0($value['price']);?></i>
                    <span class="buy_btn">去抢购</span>
                </div>
            </a>
        </li>
        <?php } ?>
    </ul>
    <div class="goods_bottom">
    	<?php if($page>1){ ?>
    	<div class="bottom_nav fl mt11">
    		<a href="<?=u(MODNAME,ACTNAME,array('keyword'=>$keyword,'cat'=>$cat,'start'=>$pages['prev']));?>" class="next">上一页</a>
    	</div>
    	<?php } ?>
    	<div class="bottom_nav fl mt11">
        	<a href="<?=u(MODNAME,ACTNAME,array('keyword'=>$keyword,'cat'=>$cat,'start'=>$pages['next']));?>" class="next">下一页</a>
        </div>
        <div class="bottom_totop fr mt11">
        	<a href="<?=get_cururl();?>#"><i class="totop_icon"></i>回到顶部</a>
        </div>
    </div>
</div>
<?php require tpl_extend(WAP_TPL.'/pub/footer.tpl');?>
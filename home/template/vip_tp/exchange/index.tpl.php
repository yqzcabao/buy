<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/gift.css" type="text/css" rel="stylesheet"/>
<div class="announcement">
	<span class="announcementImg fl"></span>
		一旦兑换即扣除相应<?=INTEGRAL;?>，所兑换的礼品将在后台审核后发出。如审核过程中发现该用户<?=INTEGRAL;?>行为异常，兑换礼品将不予发放，已扣除<?=INTEGRAL;?>不退还。如该用户恶意<?=INTEGRAL;?>行为严重，我们保留不另行通知而直接封禁该用户账号的权利。
</div>
<div class="area">
	<div class="deallist mod_2">
	<?php foreach ($exchangelist as $key=>$value){ ?>
    	<div class="fl list1 list">
        	<a href="<?=u('exchange','detail',array('id'=>$value['id']));?>" class="img" target="_blank">
            	<img alt="<?=$value['title'];?>" src="<?=DEF_GD_LOGO;?>" data-original="<?=get_img($value['pic'],'290');?>" class="lazy"/>
            </a>
            <h3>
            	<a target="_blank" title="<?=$value['title'];?>" href="<?=u('exchange','detail',array('id'=>$value['id']));?>"><?=$value['title'];?></a>
            </h3>
            <p>
                <em class="fr"><?=$value['apply'];?>人已参与</em> <span class="fl">价值：<?=$value['price'];?>元</span>  兑换名额：<b><?=$value['num'];?></b>
            </p>
            <h4>
            	<span class="fl"><em><?=$value['needintegral'];?></em><?=INTEGRAL;?></span>
                <a href="<?=u('exchange','detail',array('id'=>$value['id']));?>" target="_blank" class="dh <?php if($value['num']<=$value['apply'] || $value['end']<$_timestamp){ ?>over<?php }elseif($value['start']>$_timestamp){ ?>jjks<?php } ?>">
                <?php if(!($value['num']<=$value['apply'] || $value['end']<$_timestamp)){ ?>
					  <?php if($value['start']>$_timestamp){ ?>
					  即将开始
					  <?php }elseif ($value['start']<$_timestamp && $value['end']>$_timestamp){ ?>
					  我要兑换
					  <?php } ?>
				<?php } ?>
                </a>
            </h4>
        </div>
    <?php } ?>
    </div>
</div>
<!--//分页-->
<?php include(PATH_TPL."/public/pages.tpl");?>
<?php include(PATH_TPL."/footer.tpl.php");?>
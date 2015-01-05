<?php require tpl_extend("pub/header.tpl");?>
<div class="jifen-list clear area MT_20">
<ul class="goods-list clear">
	<?php foreach ($exchangelist as $key=>$value){ ?>
		<li>
		    <div class="list-good <?php if($value['num']<=$value['apply'] || $value['end']<$_timestamp){ ?>gone<?php }elseif($value['start']>$_timestamp){ ?>start<?php }else{ ?>buy<?php } ?>">
		        <div class="good-pic">
		            <a target="_blank" href="<?=u(MODNAME,'detail',array('id'=>$value['id']));?>">
		                <img width="290" height="290" data-original="<?=get_img($value['pic'],'290');?>" class="lazy" src="<?=DEF_GD_LOGO;?>" alt="<?=$value['title'];?>" style="display: inline;">
		            </a>
		        </div>
		        <h5 class="good-title">
		            <a target="_blank" href="<?=u(MODNAME,'detail',array('id'=>$value['id']));?>"><?=$value['title'];?></a>
		        </h5>
		        <div class="title-tips">
		            <span class="fl">价值：<em class="old-price"><?=$value['price'];?>元</em></span>
		            <span class="fr">份数：<em class=" jd-num01"><?=$value['apply'];?>/<?=$value['num'];?></em></span>
		        </div>
		        <div class="good-price clear">
		            <span class="price-current"><?=$value['needintegral'];?><em class="unit"><?=INTEGRAL;?></em></span>
		            <div class="btn <?php if($value['num']<=$value['apply'] || $value['end']<$_timestamp){ ?>gone<?php }elseif($value['start']>$_timestamp){ ?>start<?php }else{ ?>buy<?php } ?>">
		            	<a target="_blank" href="<?=u(MODNAME,'detail',array('id'=>$value['id']));?>">
						  <?php if($value['start']>$_timestamp){ ?>
						  <span>即将开始</span>
						  <?php }elseif ($value['end']<$_timestamp){ ?>
						  <span>已结束</span>
						  <?php }elseif ($value['num']<=$value['apply']){ ?>
						  <span>兑光了</span>
						  <?php }elseif ($value['start']<$_timestamp && $value['end']>$_timestamp && $value['num']>$value['apply']){ ?>
						  <span>我要兑换</span>
						  <?php } ?>
		            	</a>
		            </div>
		        </div>
		        <?php if(!empty($user['uid']) && $value['start']<$_timestamp && $value['end']>$_timestamp && $value['num']>$value['apply']){ ?>
		        <div class="hover <?php if(($key+1)%3==0){ ?>other<?php } ?>">
		            <p>
		            	当前<?=INTEGRAL;?><span class="green"><?=$user['integral'];?></span><br>
		                还差<?=INTEGRAL;?><span class="red"><?=abs($value['needintegral']-$user['integral']);?></span><br>
		                <a target="_blank" href="<?=u(MODNAME,'task');?>">去赚<?=INTEGRAL;?>&gt;&gt;</a>
		            </p>
		        </div>
		        <?php } ?>
		    </div>
		</li>
	<?php } ?>
</ul>
</div>
<!--//分页-->
<?php require tpl_extend("pub/pages.tpl");?>
<?php require tpl_extend("pub/footer.tpl");?>
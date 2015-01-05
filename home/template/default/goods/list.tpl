<div class="area">
	<div class="dealbox">
        <?php foreach ($goodslist as $key=>$value){ ?>
        <div class="deal fl mod_2">
        	<a <?=gogood($value['num_iid']);?> num_iid="<?=$value['num_iid'];?>">
            	<img src="<?=DEF_GD_LOGO;?>" data-original="<?=get_img($value['pic'],'290');?>" alt="<?=$value['title'];?>" class="lazy mod_2"/>
            </a>
            <h3>
                <?php if($value['ispost']==1){ ?><b>【包邮】</b><?php } ?>
                <a <?=gogood($value['num_iid']);?> num_iid="<?=$value['num_iid'];?>" title="<?=$value['title'];?>"><?=$value['title'];?></a>
            </h3>
            <h4>
                <em class="fl"><b>¥</b><?=trim_last0($value['promotion_price']);?></em>
                <span class="fl">
                <i>¥<?=trim_last0($value['price']);?></i>
                <u>(<?=trim_last0($value['discount']);?>折)</u>
                <strong>
                	<?php if($value['ispaigai']==1){ ?>
                	<b class="i2 fl" title="拍下改价"></b>
                	<?php }elseif ($value['isvip']==1){ ?>
                	<b class="i3 fl" title="VIP价格"></b>
                	<?php } ?>
                </strong>
                </span>
                <?php if($value['start']>$_timestamp){ ?>
                <a <?=gogood($value['num_iid']);?> class="kqtx"><i class="clock_icon"></i>即将开始</a>
				<?php }elseif($value['end']<$_timestamp){ ?>
				<a <?=gogood($value['num_iid']);?> class="over">已结束</a>
				<?php }else{ ?>
				<a <?=gogood($value['num_iid']);?> class="qqg"><i class="clock_icon"></i>去<?php if($value['site']=='tmall'){ ?>天猫<?php }elseif ($value['site']=='taobao'){ ?>淘宝<?php } ?>抢购</a>
				<?php } ?>
            </h4>
            <?php if($value['start']>$_timestamp){ ?>
            <span class="mark nostart"></span>
            <?php }elseif($value['end']<$_timestamp){ ?>
            <span class="mark"></span>
            <?php } ?>
            <h5 class="hidden mod_2">
            	<?php if($value['start']>$_timestamp){ ?>
					<i class="fl">开始&nbsp;:&nbsp;<?=date('m月d日 H时i分',$value['start']);?></i>
				<?php }elseif($value['end']<$_timestamp){ ?>
					<i class="fl">已结束</i>
				<?php }else{ ?>
	            	<i class="fl">开始:&nbsp;<?=date('Y-m-d',$value['start']);?></i>
            	<?php } ?>
            	
            		<a <?=gogood($value['num_iid'],false);?> style="right: 80px;">[详情]</a>
	                <a href="javascript:void(0);" onclick="goodsfav('<?=$value['id'];?>')" class="sc">收藏</a>
	                <?php if($_webset['open_report']==1){ ?>
	                <a href="javascript:void(0);" onclick="report('<?=$value['id'];?>','<?=$value['title'];?>');" class="jb">举报</a>
	                <?php } ?>

            </h5>
            
            <?php if($value['start']>=strtotime('today') && $value['start']<strtotime('tomorrow')){ ?>
            <span class="newicon">今日新品</span>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
</div>
<!--//分页-->
<?php include(PATH_TPL."/public/pages.tpl");?>
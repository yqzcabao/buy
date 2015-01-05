<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/goodslist.css" type="text/css" rel="stylesheet"/>
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
    <div class="dealbox <?php if($value['num']>3){ ?>box_list<?php } ?> fl">
    	<?php if($value['num']>3){ ?>
    	<a class="bar" target="_blank" href="<?=u('brand','info',array('bid'=>$value['bid']));?>">全部<?=$value['num'];?>款限时抢&gt;&gt;</a>
    	<?php } ?>
    	<?php 
    	$i=1;
    	foreach ($value['goods'] as $k=>$val){ ?>
        <div class="deal fl <?php if($i%3==0){ ?>last_deal<?php } ?>">
        	<a  <?=gogood($val['num_iid']);?>>
            	<img src="<?=DEF_GD_LOGO;?>" data-original="<?=get_img($val['pic'],'290');?>" class="lazy" width="290" height="190" style="display:inline;" />
            </a>
            <h3>
                <?php if($val['ispost']==1){ ?><b>【包邮】</b><?php } ?>
                <a <?=gogood($val['num_iid']);?> title="<?=$val['title'];?>"><?=$val['title'];?></a>
            </h3>
            <h4>
                <em class="fl"><b>¥</b><?=trim_last0($val['promotion_price']);?></em>
                <span class="fl">
                <i>¥<?=trim_last0($val['price']);?></i>
                <u>(<?=trim_last0($val['discount']);?>折)</u>
                <strong>
                	<?php if($val['ispaigai']==1){ ?>
                	<b class="i2 fl" title="拍下改价"></b>
                	<?php }elseif ($val['isvip']==1){ ?>
                	<b class="i2 fl" title="VIP价格"></b>
                	<?php } ?>
                </strong>
                </span>
                <?php if($val['start']>$_timestamp){ ?>
                	<a <?=gogood($val['num_iid']);?> class="kqtx"><i class="clock_icon"></i>即将开始</a>
				<?php }elseif($val['end']<$_timestamp){ ?>
					<a <?=gogood($val['num_iid']);?> class="over">已结束</a>
				<?php }else{ ?>
					<a <?=gogood($val['num_iid']);?> class="qqg"><i class="clock_icon"></i>去<?php if($val['site']=='tmall'){ ?>天猫<?php }elseif ($val['site']=='taobao'){ ?>淘宝<?php } ?>抢购</a>
				<?php } ?>
            </h4>
            <?php if($val['start']>$_timestamp){ ?>
            <span class="mark nostart"></span>
            <?php }elseif($val['end']<$_timestamp){ ?>
            <span class="mark"></span>
            <?php } ?>
            <h5 class="hidden">
            	<em class="fl">剩余时间：</em>
            	<?php if($val['start']>$_timestamp){ ?>
					<i class="fl">即将开始</i>
				<?php }elseif($val['end']<$_timestamp){ ?>
					<i class="fl">已结束</i>
				<?php }else{ ?>
	            	<?php $timearr=timediff($_timestamp,$val['end']);?>
	            	<i class="fl"><?=$timearr['day'];?>天<?=$timearr['hour'];?>时<?=$timearr['min'];?>分</i>
            	<?php } ?>
                
                <a <?=gogood($val['num_iid'],false);?> style="right: 80px;">[详情]</a>
                <a href="javascript:void(0);" onclick="goodsfav('<?=$val['id'];?>')" class="sc">收藏</a>
                <?php if($_webset['open_report']==1){ ?>
                <a href="javascript:void(0);" onclick="report('<?=$val['id'];?>','<?=$val['title'];?>');" class="jb">举报</a>
                <?php } ?>
            </h5>
           
            <?php if($val['start']>=strtotime('today') && $val['start']<strtotime('tomorrow')){ ?>
            <span class="newicon">今日新品</span>
            <?php } ?>
        </div>
        <?php 
    	$i++;
    	} 
    	?>
    </div>
</div>
<?php } ?>
<?php include(PATH_TPL."/footer.tpl.php");?>
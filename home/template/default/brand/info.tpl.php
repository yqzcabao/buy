<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/goodslist.css" type="text/css" rel="stylesheet"/>

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


<div class="bandBox area">
<div class="dealbox box_list fl">
	<?php if(!empty($goodslist) && is_array($goodslist)){ ?>
	<?php foreach ($goodslist as $key=>$value){ ?>
    <div class="deal fl <?php if(($key+1)%3==0){ ?>last_deal<?php } ?>">
    	<a <?=gogood($value['num_iid']);?>>
        	<img src="<?=DEF_GD_LOGO;?>" data-original="<?=get_img($value['pic'],'290');?>" class="lazy" style="display:inline;width:290px;height:290px" />
        </a>
        <h3>
           <?php if($value['ispost']==1){ ?><b>【包邮】</b><?php } ?>
           <a <?=gogood($value['num_iid']);?> title="<?=$value['title'];?>"><?=$value['title'];?></a>
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
            	<b class="i2 fl" title="VIP价格"></b>
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
        <h5 class="hidden">
        	<em class="fl">剩余时间：</em>
        	<?php if($value['start']>$_timestamp){ ?>
				<i class="fl">即将开始</i>
			<?php }elseif($value['end']<$_timestamp){ ?>
				<i class="fl">已结束</i>
			<?php }else{ ?>
            	<?php $timearr=timediff($_timestamp,$value['end']);?>
            	<i class="fl"><?=$timearr['day'];?>天<?=$timearr['hour'];?>时<?=$timearr['min'];?>分</i>
        	<?php } ?>
        	
        	<a <?=gogood($val['num_iid'],false);?> style="right: 80px;">[详情]</a>
            <a href="javascript:void(0);" onclick="goodsfav('<?=$val['id'];?>')" class="sc">收藏</a>
            <?php if($_webset['open_report']==1){ ?>
            <a href="javascript:void(0);" onclick="report('<?=$val['id'];?>','<?=$val['title'];?>');" class="jb">举报</a>
            <?php } ?>
        </h5>
        <?php if($value['start']>=strtotime('today') && $value['start']<strtotime('tomorrow')){ ?>
        <span class="newicon">今日新品</span>
        <?php } ?>
    </div>
    <?php } ?>
    <?php } ?>
</div>
</div>

<?php 
$brandlist=brandlist(array('start<='.$_timestamp,'end>'.$_timestamp),'`sort` DESC,`addtime` DESC',0,100);
?>
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
<?php 
$catlist=getgoodscat();
//今日特惠
$sort=request('sort','');
$goods=tomorrow_goods($sort,request('start',0));
$pages=$goods['pages'];
$page_url=$goods['page_url'];
//所属分类
$cat=intval(request('cat',0));
$goodscat=!empty($cat)?$catlist['cid_'.$cat]['title']:'';
include(PATH_TPL."/header.tpl.php");
?>
<link href="<?=PATH_TPL;?>/static/css/goodslist.css" type="text/css" rel="stylesheet"/>
<?php include(PATH_TPL."/public/cat.tpl");?>

<?php if(!empty($goods['data']) && is_array($goods['data'])){ ?>
<div class="area">
<div class="dealbox">
    <?php foreach ($goods['data'] as $key=>$value){ ?>
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
        	<em class="fl">开始：</em>
	        <i class="fl"><?=date('m月d日 H时i分',$value['start']);?></i>
	     
        	<a <?=gogood($value['num_iid'],false);?> style="right: 80px;">[详情]</a>
            <a href="javascript:void(0);" onclick="goodsfav('<?=$value['id'];?>')" class="sc">收藏</a>
            <?php if($_webset['open_report']==1){ ?>
            <a href="javascript:void(0);" onclick="report('<?=$value['id'];?>','<?=$value['title'];?>');" class="jb">举报</a>
            <?php } ?>
        </h5>
    </div>
    <?php } ?>
</div>
</div>
<?php }else{ ?>
<div class="area" style="background: #fff;margin-top:10px;">
<a href="<?=u('index','index');?>"><div class="con_coming"></div></a>
</div>
<?php } ?>
<!--//分页-->
<?php include(PATH_TPL."/public/pages.tpl");?>
<?php include(PATH_TPL."/footer.tpl.php");?>
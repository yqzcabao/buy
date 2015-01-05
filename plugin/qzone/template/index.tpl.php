<?php
$catlist=getgoodscat();
//今日特惠
$sort=request('sort','');
$goods=index_goods($sort,request('start',0),PAGE);
$pages=$goods['pages'];
$page_url=$goods['page_url'];
//所属频道
$channel=intval(request('channel',0));
//所属分类
$cat=intval(request('cat',0));
$goodscat=!empty($cat)?$catlist['cid_'.$cat]['title']:'';
require tpl_plugin("pub/header.tpl");
?>
<ul class="dealbox area">
	<?php foreach ($goods['data'] as $key=>$value){ ?>
	<li>
    <div class="deal">
        <a <?=gogood($value['num_iid'],true);?> title="<?=$value['title'];?>">
          <img src="<?=DEF_GD_LOGO;?>" data-original="<?=get_img($value['pic'],'310');?>" class="lazy" width="310" height="310" style="display: inline;">
        </a>
        <h3><a <?=gogood($value['num_iid'],true);?> title="<?=$value['title'];?>"><?=$value['title'];?></a></h3>
        <h4>
          <em><b>¥</b><?=trim_last0($value['promotion_price']);?></em> 
          <span> <i>¥<?=trim_last0($value['price']);?></i>
            (<?=trim_last0($value['discount']);?>折)
            <?php if($value['ispost']==1){ ?>
            <strong><b class="i4" title="包邮"></b></strong>
            <?php } ?>
          </span>
          <?php if($value['start']>$_timestamp){ ?>
          <a <?=gogood($value['num_iid'],true);?> title="<?=$value['title'];?>" class="start" href="javascript:void(0);">开抢提醒</a>
          <?php }elseif ($value['end']<$_timestamp){ ?>
          <a <?=gogood($value['num_iid'],true);?> title="<?=$value['title'];?>" class="over" href="javascript:void(0);">已结束</a>
          <?php }else{ ?>
          <a <?=gogood($value['num_iid'],true);?> title="<?=$value['title'];?>" href="javascript:void(0);">立即抢购</a>
          <?php } ?>
        </h4>
        <div class="btm">
			<span class="sold">已有<em><?=$value['volume'];?></em>人购买</span>
			<span class="share">
				<a rel="nofollow" title="分享" class="tip" href="javascript:vpid(0);" target="_blank">分享到：</a>
				<a href="javascript:;" onclick="share.doShare('qzone',{'url':'<?=urlencode(u('goods','detail',array('iid'=>$value['num_iid'])));?>','title':'<?=$value['title'];?>','pic':'<?=urlencode(get_img($value['pic']));?>'});" rel="nofollow" class="qzone"></a>
				<a href="javascript:;" onclick="share.doShare('t_qq',{'url':'<?=urlencode(u('goods','detail',array('iid'=>$value['num_iid'])));?>','title':'<?=$value['title'];?>','pic':'<?=urlencode(get_img($value['pic']));?>'});" rel="nofollow" class="tqq"></a>
			</span>
		</div>
     </div>
     </li>
     <?php } ?>
</ul>
<?php require tpl_plugin("pub/pages.tpl");?>
<?php require tpl_plugin("pub/footer.tpl");?>
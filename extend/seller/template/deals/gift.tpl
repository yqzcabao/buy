<?php require tpl_extend("pub/topflow.tpl");?>
<script type="text/javascript">
<?=system::getgoods_js(); ?>
</script>
<div id="contentA" class="area MT_30">
  <strong><?=$activity['title'];?>报名提示：</strong>
  <?=$activity['explain'];?>
</div>
<?php if(empty($goods)){ ?>
<div id="contentB" class="area">
	<div class="tags"><ul><li class="on">报名淘宝商品</li></ul></div>
	<div class="item" source="taobao">
		<strong>淘宝商品URL：</strong>
		<input type="text" id="cid" name="taobao_url" value="">
		<input id="getcid" class="btn" type="button">
		<p>什么是淘宝商品URL？</p>
		<p>如果您是B店，提供的商品格式为：<i>http://detail.tmall.com/item.htm?id=26914584813</i></p>
		<p>如果您是C店，提供的商品格式为：<i>http://item.taobao.com/item.htm?id=12345678910</i></p>
		<span class="msg hidden" id="getgoods_box" style="margin-left:0px;"></span>
	</div>
</div>
<?php } ?>
<form action="<?=u(MODNAME,ACTNAME);?>" method="POST" id="contentC" class="area" onsubmit="return apply();" <?php if(!empty($goods)){ ?>style="display:block"<?php } ?>>
    <div class="blockA">
		  <h2>活动商品信息</h2>
		  <ul class="clear">
		    <li class="item">
		      <label>商品名称：</label>
		      <input class="inp w480" name="deal[title]" type="text" value="<?=$goods['title'];?>">
		      <span class="msg hidden"></span>
		    </li>
		    <li>
		      <label>商品原价：</label>
		      <span id="productprice" class="readonly w100"><?=floatval($goods['price']);?></span> 元
		    </li>
		    <li class="item">
		      <label><em>*</em>活动价：</label>
		      <input class="inp" id="active_price" name="deal[promotion_price]" size="30" type="text" value="<?=floatval($goods['promotion_price']);?>"> 元
		      <span class="msg hidden"></span>
		    </li>
		    <li class="item">
		      <label><em>*</em>提供数量：</label>
		      <input class="inp" name="deal[num]" size="30" type="text" value="<?=intval($goods['num']);?>"> 件
		      <span class="msg hidden"></span>
		    </li>
		    <?php if($activity['pay']==1){ ?>
			    <li class="item" id="deal_type">
			      <label><em>*</em>付费类型：</label>
			      <div class="fl">
				      <?php if ($activity['free']==1){ ?>
				      <p><input class="is_baoyou" name="deal[pay_type]" type="radio" value="free" <?php if($goods['pay_type']==0){ ?>checked<?php } ?>> 免费报名</p>
				      <?php } ?>
				      <?php foreach ($activity['paydetail']['title'] as $k=>$val){ ?>
				      <p><input class="is_baoyou" name="deal[pay_type]" type="radio" value="pay_<?=$k;?>" <?php if($goods['pay_type']==1 && $goods['pay_id']==$k){ ?>checked<?php } ?>><?=$val;?>--付费<?=$activity['paydetail']['money'][$k];?>元</p>
				      <?php } ?>
			      </div>
			      <span class="msg hidden"></span>
			    </li>
		    <?php } ?>
		    <li class="item_dis js_descarea">
		      <label>商品描述：</label>
		      <textarea class="col999" cols="40" name="deal[remark]" rows="20"><?=$goods['remark'];?></textarea>
		      <!--<p>还可输入：<em class="txt">0</em>个字</p>-->
		    </li>
		    <li class="item">
		        <label>&nbsp;</label>
		        <input type="hidden" name="formhash" value="<?php if(!empty($goods)){ ?><?=formhash();?><?php } ?>">
		        <input type="hidden" name="aid" value="<?=$activity['aid'];?>">
		        <input type="hidden" name="deal[nick]" value="<?=$goods['nick'];?>">
		        <input type="hidden" name="deal[seller_id]" value="<?=$goods['seller_id'];?>">
		        <input type="hidden" name="deal[num_iid]" value="<?=$goods['num_iid'];?>">
		        <input type="hidden" name="deal[volume]" value="<?=$goods['volume'];?>">
		        <input type="hidden" name="deal[price]" value="<?=$goods['price'];?>">
		        <input type="hidden" name="deal[site]" value="<?=$goods['site'];?>">
		        <input type="hidden" name="deal[id]" value="<?=$goods['id'];?>">
		        <input class="btn" type="submit" name="applyform" value="&nbsp;">
		    </li>
		  </ul>
		</div>
		<?php require tpl_extend("deals/img.tpl");?>
</form>
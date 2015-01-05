<?php if(empty($goods)){ ?>
<link href="<?=PATH_APP;?>/static/css/special.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="<?=PATH_APP;?>/static/js/special.js"></script>
<div class="container" id="posts">
	<div class="huan-left">
		<div class="goods-inside clear">
			<div class="img_show fl">
				<img src="<?=PATH_APP;?>/static/images/1111.jpg" alt="双十一大促活动位置预定" style="width:400px;height:180px;"></div>
			<div class="title-info fl">
				<div class="detailmeta r">
					<h1><?=$activity['special']['title'];?></h1>
					<h3><?=$activity['special']['summary'];?></h3>
					<div class="panelA">
						<dl><dt class="fl">现价：</dt><dd class="red price buyprice">请先选择活动展位</dd></dl>
						<dl><dt class="fl">剩余：</dt><dd><time id="countDown" data-time="<?=$activity['special']['endtime'];?>">0天0小 时00分00秒.</time></dd></dl>
						<dl><dt class="fl">已预定：</dt><dd><b class="red"><?=$activity['special']['book'];?></b>&nbsp;个</dd></dl>
					</div>
				</div>
			</div>
			<!--//活动展位-->
			<dl class="color clear bot">
				<dt class="fl" style="line-height: 36px;">展位：</dt>
				<dd>
					<ul>
					<?php foreach ($activity['special_position'] as $key=>$val){ ?>
						<li id="posts_<?=$val['pid'];?>" data-posts="<?=$val['pid'];?>" data-price="<?=$val['price'];?>" class="nos <?php if($val['remain']<=0){ ?>no<?php } ?> <?php if($key>=40){ ?>hidden<?php } ?>">
							<a href="javascript:void(0)"><?=$val['name'];?></a>
						</li>
					<?php } ?>
					<?php if(count($activity['special_position'])>40){ ?>
					<li id="moreattr"><a href="javascript:void(0)" title="点击查看更多">展开全部</a></li>
					<?php } ?>
					</ul>
				</dd>
				<dd class="submit" style="text-align: right;border-top: 1px dotted #ccc;margin-top: 10px;padding-top: 15px;">
					<strong id="posts_err_msg" class="red1" style="line-height: 35px;font-size:14px;vertical-align: bottom;margin-right: 15px;"></strong>
					<strong class="red1 buyprice" style="line-height: 35px;font-size: 26px;vertical-align: bottom;margin-right: 15px;"></strong>
					<input type="submit" name="activities" value="立即购买" class="s2">
				</dd>
			</dl>
		</div>
	</div>
	<div class="bady-part clear" style="width: 974px">
		<div class="bady-tab"><ul><li><a class="badyactive" href="javascript:;">宝贝详情</a><div class="bady-line-top"></div></li></ul></div>
	</div>
	<div class="panel1 clear">
		<?=$activity['special']['introduce'];?>
	</div>
</div>
<?php } ?>
<!--//添加商品-->
<div id="goods" <?php if(empty($goods)){ ?>class="hidden"<?php } ?>>
<script type="text/javascript">
<?=system::getgoods_js(); ?>
</script>
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
	    <li>
	      <label>30天销量：</label>
	      <span id="xiaoliang" class="readonly w100"><?=intval($goods['volume']);?></span> 件
	    </li>
	    <li>
	      <label><em>*</em>所属频道：</label>
	      <span class="item" id="channellist">
	      <?php foreach ($apply_type as $key=>$value){ $key=explode('_',$key)?>
	      	  <?php if($key[0]=='goods'){ ?>
	          <input id="deal_channel_id_<?=$key[1];?>" name="deal[channel]" type="radio" value="<?=$key[1];?>" <?php if($key[1]==$goods['channel']){ ?>checked<?php } ?>> <?=$value;?>
	          <?php } ?>
	      <?php } ?>
	      </span>
	      <span class="msg hidden"></span>
	    </li>
	    <li>
	      <label><em>*</em>所属分类：</label>
	      <span class="item" id="classifylist">
	      <?php foreach ($catlist as $key=>$value){ ?>
	          <input id="deal_cat_id_<?=$value['id'];?>" name="deal[cat]" type="radio" value="<?=$value['id'];?>" <?php if($value['id']==$goods['cat']){ ?>checked<?php } ?>> <?=$value['title'];?>
	      <?php } ?>
	      </span>
	      <span class="msg hidden"></span>
	    </li>
	    <li class="item">
	      <label><em>*</em>邮费类型：</label>
	      <span><input class="is_baoyou" id="is_baoyou_1" name="deal[ispost]" type="radio" value="1" <?php if(intval($goods['ispost']==1) || empty($goods['ispost'])){ ?>checked<?php } ?>> 包邮</span>
	      <span><input class="is_baoyou" id="is_baoyou_-1" name="deal[ispost]" type="radio" value="-1"> 不包邮</span>
	      <script type="text/javascript">
         	$("#is_baoyou_"+<?=intval($goods['ispost']);?>).attr("checked","checked");
          </script>
	    </li>
	    <li class="item">
	      <label><em>*</em>优惠方式：</label>
	      <span><input name="deal[privilege]" type="radio" value="1" checked> 拍下改价</span>
	      <span><input name="deal[privilege]" type="radio" value="2"> VIP价格</span>
	    </li>
	    <li class="item">
	      <label><em>*</em>活动价：</label>
	      <input class="inp" id="active_price" name="deal[promotion_price]" size="30" type="text" value="<?=floatval($goods['promotion_price']);?>"> 元
	      <span class="msg hidden"></span>
	    </li>
	    <li class="item_dis js_descarea">
	      <label>商品描述：</label>
	      <textarea class="col999" cols="40" name="deal[remark]" rows="20"><?=$goods['remark'];?></textarea>
	      <!--<p>还可输入：<em class="txt">0</em>个字</p>-->
	    </li>
	    <li class="item">
	        <label>&nbsp;</label>
	        <input type="hidden" name="formhash" value="<?php if(!empty($goods)){ ?><?=formhash();?><?php } ?>">
	        <input type="hidden" name="aid" value="<?=$activity['aid'];?>">
	        <input type="hidden" name="deal[pay_id]" value="<?=$goods['pay_id'];?>">
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
</div>
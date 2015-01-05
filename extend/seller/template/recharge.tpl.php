<?php require tpl_extend("pub/header.tpl");?>
<div class="area chongzhiarea MT_30">
	<p class="p1">
	  <strong class="neg">充值</strong>
	  <span>可用余额：<i><?=$user['money'];?></i>元</span>
	  <a href="<?=u(MODNAME,'funds',array('op'=>'log-recharge'));?>">查看充值记录&gt;&gt;</a>
	</p>
    <form accept-charset="UTF-8" action="<?=u(MODNAME,ACTNAME);?>" method="post" target="_blank" onsubmit="return rechange('<?=u(MODNAME,'funds',array('op'=>'logrecharge'));?>');">
	  <div class="content2">
	    <div class="czje">
	      <i>充值金额：</i>
	      <div class="jeip">
	        <input id="amount" type="text" name="amount">
	        <?php if(intval($_webset['extend_seller_minrecharge']>0)){ ?>
	        <span>系统要求最小充值<b id="min_money"><?=$_webset['extend_seller_minrecharge'];?></b>元。</span>
	        <?php }else{ ?>
	        <span>元</span>
	        <?php } ?>
	        <div class="tips hidden"><em></em><i></i></div>
	      </div>
	    </div>
	    <div class="czje" id="audit" style="display:none;">
	      <i>交易号：</i>
	      <div class="jeip">
	        <input id="amount" type="text" name="trade_num" maxlength="16"><span>通过支付宝的转账付款功能充值，将钱转入<?=$_webset['extend_seller_alipay'];?>获得交易号。</span>
	        <div class="tips hidden"><em></em><i></i></div>
	      </div>
	    </div>
	    <p>
	      <i>充值方式：</i>
	      <?php if($_webset['extend_seller_apirecharge']==1){ ?>
	      <label class="zfb" for="alipay_r"><input type="radio" id="alipay_r" value="alipay" name="gateway"></label>
	      <?php } ?>
	      <?php if($_webset['extend_seller_auditrecharge']==1){ ?>
	      <label class="sh" for="audit_r"><input type="radio" id="audit_r" value="audit" name="gateway"></label>
	      <?php } ?>
	      <span class="tips hidden"><em></em><i></i></span>
	    </p>
	    <input type="hidden" name="formhash" value="<?=formhash();?>">
	    <input class="gocheck" name="recharge" type="submit" value="&nbsp;">
	  </div>
	</form>
</div>
<script type="text/javascript">
//返回时处理充值方式
if($("#audit_r:checked").length>0){
	$("#audit").show();
}
</script>
<?php require tpl_extend("pub/footer.tpl");?>
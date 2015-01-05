<div class="area chongzhiarea MT_30">
  <p class="p1">
	  <strong class="neg">解冻保证金</strong>
	  <span>冻结保证金余额：<i><?=$user['margin'];?></i>元</span>
	  <a href="<?=u(MODNAME,'funds');?>">查看消费记录&gt;&gt;</a>
	</p>
	<?php if(!empty($user['margin']) && ($_timestamp-$user['paidtime'])>$_webset['extend_seller_freeze']*24*3600){ ?>
	  <!--//付款页面-->
	  <form action="<?=u(MODNAME,ACTNAME,array('op'=>$op));?>" method="POST">
	  <div class="content2">
	    <div class="czje" style="height:auto;">
	      <i style="width: 100px;">冻结金额：</i>
	      <div><span class="neg"><?=$user['margin'];?></span>&nbsp;元</div>
	    </div>
	    <input type="hidden" name="formhash" value="<?=formhash();?>">
	    <input class="gocheck unfreeze" name="unfreeze" type="submit" value="&nbsp;">
	  </div>
	  </form>
	<?php }else{ ?>
	<div class="content3 failure">
	  <h1><em></em><span>您目前还有活动尚未处理完毕，暂不能解冻保证金。</span></h1>
	  <h2>
	    <span>您可以选择：</span>
	    <a href="<?=u(MODNAME,'funds');?>">查看消费记录&gt;&gt;</a>
	  </h2>
	</div>
	<?php } ?>
</div>
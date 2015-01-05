<div class="area yuearea MT_30">
	<div class="yue yueleft">
		<p><span>可用余额</span><em></em>：</p>
		<p class="yuecontent"><?=money_show($user['money'],'<i class="b1 neg">','</i><i class="s1 neg">.','&nbsp;&nbsp;</i>');?><i class="m1 neg">元</i></p>
		<a class="chongzhi" href="<?=u(MODNAME,'recharge');?>" target="_blank">充值</a>
		<?php if($user['money']<=0){;?>
		<a class="tixian tixiandis" href="javascript:void();">提现</a>
		<?php }else{ ?>
		<a class="tixian" href="<?=u(MODNAME,ACTNAME,array('op'=>'withdraw'));?>">提现</a>
		<?php } ?>
	</div>
	<div class="yue yueleft">
		<p><span>保证金余额</span><em></em>：</p>
		<p class="yuecontent"><?=money_show($user['site']==1?floatval($_webset['extend_seller_tbdeposit']):floatval($_webset['extend_seller_tmdeposit']),'<i class="b1 neg">','</i><i class="s1 neg">.','&nbsp;&nbsp;</i>');?></i><i class="m1 neg">元</i></p>
		<?php if(floatval($user['margin'])==0 && 0<($user['site']==1?$_webset['extend_seller_tbdeposit']:$_webset['extend_seller_tmdeposit'])){ ?>
		<a class="chongzhi" href="<?=u(MODNAME,'callback',array('op'=>'deposit'));?>">缴纳</a>
		<?php }else{ ?>
		<a class="chongzhi tixiandis" href="javascript:void(0)">缴纳</a>
		<?php } ?>
		<?php if(($_timestamp-$user['paidtime'])>$_webset['extend_seller_freeze']*24*3600 && floatval($user['margin'])>0){ ?>
			<a class="tixian" href="<?=u(MODNAME,ACTNAME,array('op'=>'unfreeze'));?>">解冻</a>
		<?php }else{ ?>
			<a class="tixian tixiandis" href="javascript:void(0);">解冻</a>
		<?php } ?>
	</div>
	<div class="yue yueright">
		<p class="rp"><span>活动冻结</span><em></em>：<?=money_show($user['margin'],'<i class="b2 neg">','</i><i class="s2 neg">.','&nbsp;&nbsp;</i>');?><i class="m2 neg">元</i></p>
		<p><span>提现冻结</span><em></em>：<?=money_show($user['withdraw'],'<i class="b2 neg">','</i><i class="s2 neg">.','&nbsp;&nbsp;</i>');?><i class="m2 neg">元</i></p>
	</div>
</div>
<div class="area jilu">
	<?php $logop[$op]='class="on"';?>
	<div class="navg">
	  <a href="<?=u(MODNAME,ACTNAME,array('op'=>'index'));?>" <?=$logop['index'];?>>消费记录<i></i></a><em></em>
	  <a href="<?=u(MODNAME,ACTNAME,array('op'=>'logrecharge'));?>" <?=$logop['logrecharge'];?>>充值记录<i></i></a><em></em>
	  <a href="<?=u(MODNAME,ACTNAME,array('op'=>'logwithdraw'));?>" <?=$logop['logwithdraw'];?>>提现记录<i></i></a><em></em>
	  <a href="<?=u(MODNAME,ACTNAME,array('op'=>'deposit'));?>" <?=$logop['deposit'];?>>保证金记录<i></i></a><em></em>
	</div>
	<?php if(empty($loglist)){ ?>
    <div class="nodata">
      <h1>您还没有消费记录！</h1>
    </div>
    <?php }else{ ?>
    	<?php if($op=='index'){ ?>
    		<?php require tpl_extend("funds/logindex.tpl");?>
    	<?php }elseif($op=='logrecharge'){ ?>
	    	<?php require tpl_extend("funds/logrecharge.tpl");?>
	    <?php }elseif($op=='logwithdraw'){ ?>
	    	<?php require tpl_extend("funds/logwithdraw.tpl");?>
	    <?php }elseif($op=='deposit'){ ?>
	    	<?php require tpl_extend("funds/deposit.tpl");?>	
	    <?php } ?>
    <?php } ?>
  	<div class="foot_ct"></div>
</div>
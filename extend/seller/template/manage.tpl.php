<?php require tpl_extend("pub/header.tpl");?>
<div class="area MT_30" id="contentA">
	<?php $active[$op]='class="on"'; ?>
	<div class="navg">
	  <a href="<?=u(MODNAME,ACTNAME,array('op'=>'goods'));?>" <?=$active['goods'];?>>商品报名<i></i></a><em></em>
	  <a href="<?=u(MODNAME,ACTNAME,array('op'=>'try'));?>" <?=$active['try'];?>>试用报名<i></i></a><em></em>
	  <a href="<?=u(MODNAME,ACTNAME,array('op'=>'exchange'));?>" <?=$active['exchange'];?>>兑换报名<i></i></a><em></em>
	</div>
	<?php if($op=='goods'){ ?>
	<div class="blockD">
      <form accept-charset="UTF-8" action="<?=u(MODNAME,'manage');?>" method="get">
        <label>淘宝商品ID</label>
        <input type="text" name="num_iid" value="">
        <label>活动类型</label>
        <select name="aid">
	        <option>请选择</option>
	        <?php foreach ($activity_list as $key=>$value){ ?>
	        	<?php if($value['type']=='goods' || $value['type']=='album'){ ?>
	        	<option value="<?=$value['type'];?>_<?=$value['tid'];?>"><?=$value['title'];?></option>
	        	<?php } ?>
	        <?php } ?>
        </select>
        <input type="hidden" name="mod" value="<?=MODNAME;?>">
        <input type="hidden" name="ac" value="manage">
        <input type="hidden" name="op" value="goods">
        <input class="btn" name="commit" type="submit" value="">
		</form>
	</div>
	<?php } ?>
	<?php $statusactive[$status]='on'; ?>
	<div class="blockA">
	  <a class="managebt <?=$statusactive['all'];?>" href="<?=u(MODNAME,ACTNAME,array('op'=>$op,'s'=>'all'));?>"><em>全部活动(<?=intval($num_arr['all']);?>)</em></a>
	  <a class="managebt <?=$statusactive['nonpay'];?>" href="<?=u(MODNAME,ACTNAME,array('op'=>$op,'s'=>'nonpay'));?>"><em>未付款(<?=intval($num_arr['nonpay']);?>)</em></a>
      <a class="managebt <?=$statusactive['audit'];?>" href="<?=u(MODNAME,ACTNAME,array('op'=>$op,'s'=>'audit'));?>"><em>审核中(<?=intval($num_arr['audit']);?>)</em></a>
      <a class="managebt <?=$statusactive['listing'];?>" href="<?=u(MODNAME,ACTNAME,array('op'=>$op,'s'=>'listing'));?>"><em>已排期(<?=intval($num_arr['listing']);?>)</em></a>
      <a class="managebt <?=$statusactive['online'];?>" href="<?=u(MODNAME,ACTNAME,array('op'=>$op,'s'=>'online'));?>"><em>上线中(<?=intval($num_arr['online']);?>)</em></a>
      <a class="managebt <?=$statusactive['over'];?>" href="<?=u(MODNAME,ACTNAME,array('op'=>$op,'s'=>'over'));?>"><em>已结束(<?=intval($num_arr['over']);?>)</em></a>
	  <a class="managebt <?=$statusactive['pass'];?>" href="<?=u(MODNAME,ACTNAME,array('op'=>$op,'s'=>'pass'));?>"><em>未通过(<?=intval($num_arr['pass']);?>)</em></a>
	</div>
	<?php if($op=='goods'){ ?>
		<?php require tpl_extend("manage/goods.tpl");?>
	<?php }elseif ($op=='try'){ ?>
		<?php require tpl_extend("manage/try.tpl");?>
	<?php }elseif ($op=='exchange'){ ?>
		<?php require tpl_extend("manage/exchange.tpl");?>
	<?php } ?>
	<?php require tpl_extend("pub/pages.tpl");?>
</div>
<?php require tpl_extend("pub/footer.tpl");?>
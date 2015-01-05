<!--//充值记录-->
	<p class="head">
  <span class="h1_cz">充值时间</span>
  <span class="h2_cz">流水号</span>
  <span class="h3_cz textr">充值金额（元）</span>
  <span class="h4_cz">充值渠道</span>
  <span class="h5_cz">状态
    <!--<select onchange="location.replace(this.options[this.selectedIndex].value)">
      <option value="?status=success">成功</option>
      <option value="?status=waiting">未付款</option>
      <option value="?status=waiting">审核中</option>
      <option value="?status=waiting">审核失败</option>
    </select>-->
  </span>
</p>
<?php foreach ($loglist as $key=>$value){ ?>
<div class="chongzhijl">
  <span class="h1_cz"><?=date('Y/m/d H:i:s',$value['addtime']);?></span>
  <span class="h2_cz"><?=$value['serialno'];?></span>
  <span class="h3_cz textr"><?=$value['money'];?></span>
  <span class="h4_cz"><?php if($value['method']=='1'){ ?>[支付宝]<?php }elseif ($value['method']==2){ ?>审核充值<?php } ?><?php if(!empty($value['account'])){ ?><?=$value['account'];?><?php } ?></span>
  <span class="h5_cz textc">
  	<?php if($value['status']==1){ ?>成功
  	<?php }elseif ($value['status']==0){ ?>
  		<?php if($value['method']==1){ ?>未付款<?php }elseif ($value['method']==2){ ?>审核中<?php } ?>
  	<?php }elseif ($value['status']==3){ ?>
  		审核失败
  	<?php } ?>
  </span>
</div>
<?php } ?>
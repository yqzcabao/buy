<!--//提现记录-->
<p class="head">
  <span class="h1_cz">操作时间</span>
  <span class="h2_cz">流水号</span>
  <span class="h3_cz textr">金额（元）</span>
  <span class="h4_cz">明细</span>
  <span class="h5_cz textc">状态</span>
</p>
<?php foreach ($loglist as $key=>$value){ ?>
<div class="chongzhijl">
  <span class="h1_cz"><?=date('Y/m/d H:i:s',$value['addtime']);?></span>
  <span class="h2_cz"><?=$value['serialno'];?></span>
  <span class="h3_cz textr"><?=$value['money'];?></span>
  <span class="h4_cz"><?php if($value['type']=='4'){ ?>保证金缴纳<?php }elseif ($value['type']==5){ ?>保证金解冻<?php } ?></span>
  <span class="h5_cz textc">
  	<?php if($value['status']==1){ ?>成功
  	<?php }elseif ($value['status']==0){ ?>审核中<?php } ?>
  </span>
</div>
<?php } ?>
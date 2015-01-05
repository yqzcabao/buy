<!--//消费记录-->
<p class="head">
  <span class="h1_cz">流水号</span>
  <span class="h2_cz">时间</span>
  <span class="h3_cz textr">金额（元）</span>
  <span class="h4_cz">明细</span>
</p>
<?php foreach ($loglist as $key=>$value){ ?>
<div class="chongzhijl">
  <span class="h1_cz"><?=$value['serialno'];?></span>
  <span class="h2_cz"><?=date('Y/m/d H:i:s',$value['addtime']);?></span>
  <span class="h3_cz textr"><?=$value['money'];?></span>
  <span class="h4_cz"><?=$value['account'];?></span>
  <span class="h5_cz textc">--</span>
</div>
<?php } ?>
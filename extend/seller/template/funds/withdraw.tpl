<div class="area chongzhiarea MT_30">
  <p class="p1">
    <strong class="neg">提现</strong><span>可提现：<i class="neg"><?=$user['money'];?></i>元</span><em>(提现处理时间为5~10个工作日)</em>
    <a href="<?=u(MODNAME,'funds',array('op'=>'log-withdraw'));?>">查看提现记录&gt;&gt;</a>
  </p>
  <?php if(empty($user['alipay'])){ ?>
  <div class="content3 failure">
    <h1><em></em><span>您尚未设置收款支付宝，请先设置收款支付宝后再进行提现。</span></h1>
    <h2><span>您可以选择：</span><a href="<?=u(MODNAME,'account',array('op'=>'profile_edit'));?>">设置收款支付宝&gt;&gt;</a></h2>
  </div>
  <?php }else{ ?>
  <form class="bzj_box clear" method="POST" action="<?=u(MODNAME,ACTNAME,array('op'=>'withdraw'));?>" onsubmit="return check_withdraw();">
    <ul class="clear">
      <li class="js_mon">
        <label>提现金额：</label>
        <div class="tipbox">
          <span><input name="amount" type="text" class="smmi"><em class="fwn">元</em></span>
          <div class="tips hidden"><em></em><i></i></div>
         </div>
      </li>
     <!-- <li>
        <label>开户名：</label>
        <div class="tipbox">
          <span class="fwn"></span>
        </div>
      </li>-->
      <li>
        <label>收款支付宝：</label>
        <div class="tipbox">
          <span class="fwn">
            <?=$user['alipay'];?>
            <a class="blue" href="<?=u(MODNAME,'account',array('op'=>'profile_edit'));?>">修改</a>
          </span>
        </div>
      </li>
      <!--<li class="zpass">
        <label>支付密码：</label>
        <div class="tipbox">
            <span>
              <a class="blue" href="" target="_blank">请先设置支付密码</a>
            </span>
            <div class="tips"><em></em><i>请先设置支付密码</i></div>
        </div>
      </li>-->
    </ul>
    <div class="bzjbtn clear">
    	<input type="hidden" name="formhash" value="<?=formhash();?>">
	    <input class="txsub" name="withdraw" type="submit" value="提现">
    </div>
  </form>
  <?php } ?>
</div>
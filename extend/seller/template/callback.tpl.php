<?php require tpl_extend("pub/header.tpl");?>
<?php if($op=='appaly'){ ?>
	<div class="area chongzhiarea MT_30">
	  <p class="p1">
		  <strong class="neg">付款</strong><span>可用余额：<i><?=$user['money'];?></i>元</span>
		  <a href="<?=u(MODNAME,'funds',array('op'=>'index'));?>">查看消费记录&gt;&gt;</a>
	  </p>
	  <?php if($money<$goods['pay_money']){ ?>
	  <div class="content3 neg">
	      <h1><span>账户余额不足。</span></h1>
	      <h2><span>您可以选择：</span><a href="<?=u(MODNAME,'recharge');?>">立即充值&gt;&gt;</a></h2>
	  </div>	
	  <?php }else{ ?>
	  <!--//付款页面-->
	  <form action="<?=u(MODNAME,'deals');?>" method="POST">
	  <div class="content2">
	    <div class="czje" style="height:auto;">
	      <i>付款金额：</i>
	      <div><span class="neg"><?=$goods['pay_money'];?></span>&nbsp;元</div>
	    </div>
	    <div class="czje" style="height:auto;">
	      <i>付款明细：</i>
	      <div><?=$goods['title'];?>
	      	<span class="neg">
	      	<?php if($activity['type']=='special'){ ?>
	      	[<?=$activity['special_position'][$goods['pay_id']]['name'];?>-<?=$activity['special_position'][$goods['pay_id']]['price'];?>元]
	      	<?php }else{ ?>
	      	[<?=$activity['paydetail']['title'][$goods['pay_id']];?>-<?=$activity['paydetail']['money'][$goods['pay_id']];?>元]
	      	<?php } ?>
	      	</span>
	      </div>
	    </div>
	    <input type="hidden" name="id" value="<?=$goods['id'];?>">
	    <input type="hidden" name="type" value="<?=$type;?>">
	    <input type="hidden" name="formhash" value="<?=formhash();?>">
	    <input class="gocheck" name="pay_money" type="submit" value="&nbsp;">
	  </div>
	  </form>
	  <?php } ?>
	</div>
<?php }elseif($op=='success'){ ?>
	<div class="area chongzhiarea MT_30">
	  <p class="p1">
		  <strong class="neg">充值</strong><span>可用余额：<i><?=$user['money'];?></i>元</span>
		  <a href="<?=u(MODNAME,'funds',array('op'=>'logrecharge'));?>">查看充值记录&gt;&gt;</a>
	  </p>
	  <!--//充值成功-->
	  <?php if($log['status']==1){ ?>
	  <div class="content3">
	      <h1><em></em><span>恭喜，您已经成功充值<i><?=$log['money'];?></i>元。</span></h1>
	    <h2><span>您可以选择：</span><a href="<?=u(MODNAME,'funds',array('op'=>'logrecharge'));?>">查看充值记录&gt;&gt;</a></h2>
	  </div>
	  <?php }else{ ?>
	  <div class="content3 neg">
	      <h1><span>充值发生错误。</span></h1>
	      <h2><span>您可以选择：</span><a href="<?=u(MODNAME,'funds',array('op'=>'logrecharge'));?>">查看充值记录&gt;&gt;</a></h2>
	  </div>
	  <?php } ?>
	</div>
<?php }elseif ($op=='wdsuccess'){ ?>
<div class="area chongzhiarea MT_30">
  <p class="p1">
    <strong class="neg">提现</strong>
    <span>可提现：<i class="neg"><?=$user['money'];?></i>元</span>
    <em>(提现处理时间为5~10个工作日)</em>
    <a href="<?=u(MODNAME,'funds',array('op'=>'log-withdraw'));?>">查看提现记录&gt;&gt;</a>
  </p>
  <div class="content3">
    <h1 class="tx"><em></em><span>提现申请已提交，请等待处理，处理时间为5~10个工作日。</span></h1>
    <h2 class="tx"><span>您可以选择：</span><a href="<?=u(MODNAME,'funds',array('op'=>'logwithdraw'));?>">查看提现记录&gt;&gt;</a></h2>
  </div>
</div>
<?php }elseif ($op=='deposit'){ ?>
<div class="area chongzhiarea MT_30">
	  <p class="p1">
		  <strong class="neg">保证金缴纳</strong><span>可用余额：<i><?=$user['money'];?></i>元</span>
		  <a href="<?=u(MODNAME,'funds',array('op'=>'index'));?>">查看消费记录&gt;&gt;</a>
	  </p>
	  <?php if($money<$deposit){ ?>
	  <div class="content3 neg">
	      <h1><span>账户余额不足。</span></h1>
	      <h2><span>您可以选择：</span><a href="<?=u(MODNAME,'recharge');?>">立即充值&gt;&gt;</a></h2>
	  </div>
	  <?php }else{ ?>
	  <!--//付款页面-->
	  <form action="<?=u(MODNAME,ACTNAME,array('op'=>$op));?>" method="POST">
	  <div class="content2">
	    <div class="czje" style="height:auto;">
	      <i style="width: 100px;">保证金金额：</i>
	      <div><span class="neg"><?=$deposit;?></span>&nbsp;元</div>
	    </div>
	    <input type="hidden" name="formhash" value="<?=formhash();?>">
	    <input class="gocheck" name="pay_deposit" type="submit" value="&nbsp;">
	  </div>
	  </form>
	  <?php } ?>
</div>
<?php }elseif ($op=='forget'){ ?>
<div class="area chongzhiarea MT_30">
  <h1><span>找回密码</span></h1>
  <p style="margin-left: 10px;margin-top:20px">您可以通过密码找回邮件中的链接地址找回密码</p>
  <p style="margin-left: 10px;margin-top:20px">您将收到找回密码的邮件。</p>
  <p style="margin-left: 10px;margin-top:20px">
  尝试到广告、垃圾邮件目录里找找看，或者&nbsp;<a href="javascript:void(0)" onclick="againemail('<?=$email;?>','forget');" style="color:#c83345">重新发送<em id="againemail"></em></a> 找回密码邮件
  </p>
</div>
<?php }elseif ($op=='fgcall'){ ?>
<div class="acc_control clear">
	<div class="article">
    <h1>重设密码</h1>
    <form class="buss_form" method="POST" action="<?=u(MODNAME,ACTNAME,array('op'=>$op));?>" onsubmit="return set_pass();">
      <ul>
        <li>
          <label for="">新密码：</label>
          <input type="password" class="text pwd_text" data-placeholder="6-16位，字母、数字、符号，区分大小写" min-length="6" max-length="16" onblur="blurPass()" onkeyup="blurPass()">
          <span class="tip"></span>
        </li>
        <li>
          <label for="">确认密码：</label>
          <input type="password"  name="password" class="text confirm_text" data-placeholder="请再次输入您的密码" onblur="blurNPass()" onkeyup="blurNPass()">
          <span class="tip"></span>
        </li>
        <li>
          <input type="hidden" name="uid" value="<?=$userinfo['uid'];?>">
          <input type="hidden" name="formhash" value="<?=formhash();?>">
          <input type="submit" name="fgcall" value="重设密码" class="btn btn-red">
        </li>
      </ul>
    </form>
  </div>
</div>
<?php }elseif ($op=='email_signed'){ ?>
<div class="area chongzhiarea MT_30">
  <h1><span>邮箱验证</span></h1>
  <p style="margin-left: 10px;margin-top:20px">验证邮件已经发送至 <?=$email;?> </p>
  <p style="margin-left: 10px;margin-top:20px">请在48小时以内登录邮箱验证！</p>
  <p style="margin-left: 10px;margin-top:20px">
  尝试到广告、垃圾邮件目录里找找看，或者&nbsp;<a href="javascript:void(0)" onclick="againemail('<?=$email;?>','register');" style="color:#c83345">重新发送<em id="againemail"></em></a> 验证邮件
  </p>
  <p></p>
</div>
<?php }elseif ($op=='register'){ ?>
<div class="acc_control clear">
	<p class="gx">
	<span>
		<em class="ok fl"></em>
		恭喜!您已经成功注册<?=$_webset['site_name'];?>商家系统!
	</span>
	</p>
	<p style="margin-left: 10px;margin-top:20px">请您妥善保管好密码!</p>
	<p style="margin-left: 10px;margin-top:20px">为了您的账户安全，请去安全中心完善其他密保设置！</p>
	<p style="margin-left: 10px;margin-top:20px">
	<input type="button" class="btn btn-red" value="立即登录" onclick="location.href='<?=u(MODNAME,'login');?>'">
	</p>
</div>
<?php } ?>
<?php require tpl_extend("pub/footer.tpl");?>
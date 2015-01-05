<h3>绑定邮箱</h3>
<div class="details">
	  <?php if(!empty($user['email'])){ ?>
	  <p class="tips">请您绑定邮箱，以获得我们的更多增值服务。请确保绑定邮箱是您的常用邮箱。</p>
      <div class="process">
        <p><span>验证身份</span><span class="mid on">修改邮箱</span><span>完成</span></p>
        <p class="bar modify"></p>
      </div>
      <form action="<?=u(MODNAME,'account',array('op'=>'bind_mail'));?>" class="buss_form" method="post" onsubmit="return seller_set_mail();">
        <ul>
          <li>
            <label for="email">常用邮箱：</label>
            <input type="text" class="text" name="email" id="email" onblur="return blurEmail();">
            <span class="tip"></span>
          </li>
          <li>
          	<input type="hidden" name="formhash" value="<?=formhash();?>">
            <input class="btn btn-red" name="bind_mail" type="submit" value="提交">
          </li>
        </ul>
	 </form>
	<?php }else{ ?>
      
	<?php } ?>
</div>

<!--
<div class="details">
  <p class="tips">请您绑定邮箱，以获得我们的更多增值服务。请确保绑定邮箱是您的常用邮箱。</p>
  <div class="process">
    <p><span>验证身份</span><span class="mid on">修改邮箱</span><span>完成</span></p>
    <p class="bar modify"></p>
  </div>
  <div class="verMail">
    <p>验证邮件已发送至<span class="mailAddress">bankonly@qq.com</span>,请在48小时以内登录邮箱验证！</p>
    <p>邮箱验证不通过则修改邮箱失败。</p>
    <p><a class="btn btn-red btnMail" href="http://mail.qq.com/">立即登录邮箱验证</a></p>
  </div>
  <div class="noAccept">
    <h4>没收到验证邮件？</h4>
    <ul>
      <li>1.尝试到广告、垃圾邮件目录里找找看，或者 <a class="resend" href="##">重新发送</a> 验证邮件</li>
      <li>2.邮箱是否填写正确</li>
    </ul>
  </div>
  
  <div class="msgSuccess">恭喜，您已成功绑定邮箱<span class="mailNum">bankonly@qq.com</span>！</div>
</div>


<div class="errorInfo">
	<h2>您的验证链接无效，请按以下说明重试</h2>
	<ul>
	  <li>1.请到您的邮箱中完整复制验证链接后，拷贝至浏览器的地址栏中重试一次。 </li>
	  <li>2.验证邮件链接的有效期为48小时，如果您已经超过有效期48小时，请重新绑定邮箱重新收取邮件。</li>
	  <li>3.您可能已成功验证邮箱，请登录帐号管理进行查看。</li>
	</ul>
</div>
-->
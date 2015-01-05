<?php if($op=='profile' && !empty($user['user_name'])){ ?>
<div class="merchant_infor">
	<h2 class="clearfix">商家信息<a id="infor_edit" href="<?=u(MODNAME,ACTNAME,array('op'=>'profile_edit'));?>">编辑</a></h2>
	<ul>
		<li class="clearfix"><span>登录昵称：</span>
		<p><?=$user['user_name'];?></p>
		</li>
		<li class="clearfix"><span>邮箱：</span>
		<p><?=$user['email'];?></p>
		</li>
		<li class="clearfix"><span>手机：</span>
		<p><?=$user['mobile'];?></p>
		</li>
		<li class="clearfix">
			<span>收款支付宝：</span>
		<p><?=$user['alipay'];?></p>
		</li>
		<li class="clearfix">
			<span>店铺名称：</span>
		<p><?=$user['shop'];?></p>
		</li>
		<li class="clearfix"><span>联系人：</span>
		<p><?=$user['contact'];?></p>
		</li>
		<li class="clearfix"><span>客服旺旺：</span>
		<p><?=$user['wangwang'];?></p>
		</li>
		<li class="clearfix"><span>客服qq：</span>
		<p><?=$user['qq'];?></p>
		</li>
		<li class="clearfix"><span>店铺介绍：</span>
		<p><?=$user['introduce'];?></p>
		</li>
	</ul>
</div>
<?php }else{ ?>
<div class="merchant_infor_edit">
<h2 class="clearfix">商家信息</h2>
<form action="<?=u(MODNAME,ACTNAME,array('op'=>'profile_edit'));?>" class="buss_form" method="post" onsubmit="return check_seller();">
  <ul>
	<li class="clearfix nick_name">
		<label for="user_name">登录昵称：</label>
		<?php if(empty($user['user_name'])){ ?>
		<input type="text" name="seller[user_name]" class="text" id="user_name" data-placeholder="请输入昵称" maxlength="20" value="<?=$user['user_name'];?>">
		<span class="tip"></span>
		<?php }else{ ?>
		<?=$user['user_name'];?>
		<?php } ?>
	</li>
	<?php if(empty($user['user_name'])){ ?>
	<li class="clearfix nick_name_notice"><label for=""></label><em>昵称不能和淘宝店铺名称以及店铺旺旺相同，长度为5到20个字符，设置后不可修改</em></li>
	<?php } ?>
	<li class="clearfix">
		<label for="email">邮箱：</label>
		<?php if(empty($user['email'])){ ?>
		<input class="text" name="seller[email]" class="text" id="email" data-placeholder="请输入邮箱" value="<?=$user['email'];?>">
		<span class="tip"></span>
		<?php }else{ ?>
		<?=$user['email'];?>
		<?php } ?>
	</li>
	
	<li class="clearfix">
		<label for="mobile">手机：</label>
		<input class="text" name="seller[mobile]" class="text" id="mobile" data-placeholder="请输入手机号" value="<?=$user['mobile'];?>">
		<span class="tip"></span>
	</li>
	<li class="clearfix">
		<label for="alipay">收款支付宝：</label>
		<input class="text" name="seller[alipay]" class="text" id="alipay" data-placeholder="请输入支付宝账号" value="<?=$user['alipay'];?>">
		<span class="tip"></span>
	</li>
	<li class="clearfix">
		<label for="shop">店铺名称：</label>
		<input type="text" name="seller[shop]" class="text" id="shop" data-placeholder="请输入店铺名称" value="<?=$user['shop'];?>">
		<span class="tip"></span>
	</li>
	
	<li class="clearfix nick_name_next">
		<label for="contact">联系人：</label>
		<input type="text" name="seller[contact]" class="text" id="contact" data-placeholder="请输入联系人" value="<?=$user['contact'];?>">
		<span class="tip"></span>
	</li>
	
	<li class="clearfix kfwangwang">
		<label for="wangwang">客服旺旺：</label>
		<input type="text" name="seller[wangwang]" class="text" id="wangwang"  data-placeholder="请输入旺旺号"  value="<?=$user['wangwang'];?>">
	</li>
	
	<li class="clearfix kfqq">
		<label for="qq">客服QQ：</label>
		<input type="text" name="seller[qq]" class="text" id="qq"  data-placeholder="请输入QQ号"  value="<?=$user['qq'];?>" onkeyup="value=value.replace(/[^\d]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" maxlength="11">
	</li>
	
	<li class="clearfix nick_name_notice">
	<label for=""></label><em>请确保该号码已启用“<a href="http://shang.qq.com/widget/set.php" style="vertical-align: top;" target="_blank">QQ在线状态</a>”服务，便于买家与您进行会话咨询。</em>
	</li>
	<li class="clearfix text_li"><label for="">店铺介绍：</label>
		<textarea name="seller[introduce]"><?=$user['introduce'];?></textarea>
	</li>
    <li class="clearfix">
    	<label for=""></label>
    	<input type="hidden" name="formhash" value="<?=formhash();?>">
      	<input type="submit" name="profile_edit" class="btn btn-red" value="提交">
    	<span><font color="red"></font> </span>
    </li>
</ul>
</form>
</div>
<?php } ?>
<div class="profile_info">
	<div class="avatar fl">
		<img alt="<?=$user['user_name'];?>" src="<?=avatar($user['uid'],'small');?>">
		<?php if($op=='index'){ ?>
		<span>
		  <a href="<?=u('user','base',array('op'=>'avatar'));?>">修改头像</a>
		</span>
		<?php } ?>
	</div>
	<form action="<?=u('user','base',array('op'=>$op));?>" method="POST" onsubmit="return setnick();">
		<div class="item">
			<label class="fl">昵称：</label>
			<?php if(empty($user['user_name'])){ ?>
				<input type="text" name="userinfo[user_name]" class="input_text" onblur="bluruser_name()" />
			<?php }else{ ?>
				<?=$user['user_name'];?>
			<?php } ?>
			<span></span>
		</div>
		<?php if(!empty($user['email'])){ ?>
		<div class="item">
			<label class="fl">邮箱：</label>
			<?=$user['email'];?>
		</div>
		<?php } ?>
		<div class="item">
		  <label class="fl">性别：</label>
		  <p class="sexradio">
		  <?=showRadio('userinfo[sex]',array('1'=>'男','-1'=>'女'),empty($user['sex'])?1:$user['sex']);?>
		  </p>
		</div>
		<div class="item birthday">
		  <label class="fl">生日：</label>
		  <select name="userinfo[year]"></select>
		  <select name="userinfo[month]"></select>
		  <select name="userinfo[day]"></select>
		</div>
		<script>
		new YMDselect('userinfo[year]','userinfo[month]','userinfo[day]','<?=$user['year'];?>','<?=$user['month'];?>','<?=$user['day'];?>');
		</script>
		<div class="item address" >
		  <label class="fl">所在地：</label>
		  <select id="s_province" name="userinfo[province]"></select>
		  <select id="s_city" name="userinfo[city]" ></select>
		  <select id="s_county" name="userinfo[county]"></select>
		</div>
		<div class="item">
			<label class="fl">QQ：</label>
			<input type="text" name="userinfo[qq]" class="input_text" value="<?=$user['qq'];?>"/>
		</div>
		<div class="item">
			<label class="fl">支付宝：</label>
			<input type="text" name="userinfo[alipay]" class="input_text" value="<?=$user['alipay'];?>"/>
		</div>
		<script type="text/javascript">_init_area('<?=$user['province'];?>','<?=$user['city'];?>','<?=$user['county'];?>');</script>
		<div class="item">
			<label class="fl">&nbsp;</label>
			<input type="hidden" name="gourl" value="<?=$gourl;?>">
			<input type="submit" value="保存" class="save btn"/>
		</div>
	</form>
</div>
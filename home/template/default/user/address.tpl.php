<?php include(PATH_TPL."/user/center/center_header.tpl");?>
<ul class="an_tab_nav">
    <li class="fl on"><a href="<?=u('user','address');?>">收货地址</a></li>
</ul>

<div class="usermain">
	<form action="<?=u('user','address');?>" method="POST" onsubmit="return setaddress();">
	<div class="item">
		  <label class="fl">真实姓名：</label>
		  <input name="address[truename]"size="30" type="text" value="<?=$address['truename'];?>" class="realName text_input" onblur="blurtruename();">
		  <span></span>
	</div>
	<div class="item">
		  <label class="fl">省/市/区：</label>
			<select id="s_province" name="address[province]"></select>
			<select id="s_city" name="address[city]" ></select>
			<select id="s_county" name="address[county]"></select>
			<span class="itemarea"></span>
		  <span></span>
	</div>
	<script type="text/javascript">_init_area('<?=$address['province'];?>','<?=$address['city'];?>','<?=$address['county'];?>');</script>
	<div class="item">
		  <label class="fl">详细地址：</label>
		  <input name="address[addr]" class="wid1 address text_input" type="text" value="<?=$address['addr'];?>" onblur="bluraddress();">
		  <span></span>
	</div>
	<div class="item">
		  <label class="fl">电话号码：</label>
		  <input name="address[mobile]" class="mobile text_input" maxlength="13" type="text" value="<?=$address['mobile'];?>" onblur="blurmobile();">
		  <span></span>
	</div>
	<div class="item">
		  <label class="fl">邮政编码：</label>
		  <input name="address[postcode]" class="postcode text_input" maxlength="6" type="text" value="<?=$address['postcode'];?>" onblur="blurmobile()">
		  <span></span>
	</div>
	<div class="item">
		  <label class="fl">&nbsp;</label>
		  <input class="save btn" type="submit" value="保存">
	</div>
	
	</form>
</div>
<?php include(PATH_TPL."/user/center/center_footer.tpl");?>
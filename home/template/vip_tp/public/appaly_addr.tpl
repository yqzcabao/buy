<script type="text/javascript" src="static/js/area.js"></script>
<div class="apply_addredd area <?=MODNAME;?>">
	<?php if(MODNAME=='try'){ ?>
	<div class="apply_title">
		<h5>试用申请</h5>
		<div class="one"></div>
	</div>
	<?php }elseif(MODNAME=='exchange'){ ?>
	<div class="apply_title">
		<h5>积分兑换</h5>
		<div class="one"></div>
	</div>
	<?php } ?>
	<div class="address_c">
	<h5>您现在填写的地址将作为最后的收货地址，请认真填写哦～</h5>
	<div class="select_addredd">
		<form action="<?=u('user','address');?>" method="POST" onsubmit="return address($(this),'<?=MODNAME;?>address');">
			<ul>
				<li class="name">
					<label>收货人姓名:</label>
					<input type="text" name="address[truename]" class="name_input input_text">
					<em>*</em>
					<p class="messp">请填写收货人真实姓名，只能含字母或汉字</p>
				</li>
				<li class="address">
					<label>收货人地址:</label>
					<select id="s_province" name="address[province]"></select>&nbsp;&nbsp;
				    <select id="s_city" name="address[city]" ></select>&nbsp;&nbsp;
				    <select id="s_county" name="address[county]"></select>
					<br>
					<div class="null"</div>
					<input type="text" name="address[addr]" class="address_input input_text">
					<em>*</em>
					<p class="messp">请填写详细地址信息</p>
				</li>
				<li class="phone">
					<label>收货人电话:</label>
					<input type="text" name="address[mobile]" maxlength="13" class="phone_input input_text">
					<em>*</em>
				</li>
				<li class="zip">
					<label>邮编:</label>
					<input type="text" name="address[postcode]" maxlength="6" class="name_input input_text">
					<em>*</em>
				</li>
				<li class="btns">
					<input type="submit" value="下一步" class="next btn" />
				</li>
			</ul>
		</form>
	</div>
	</div>
</div>
<!--//地区-->
<script type="text/javascript">_init_area();</script>
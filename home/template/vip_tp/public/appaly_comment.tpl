<link href="static/css/smohan.face.css" type="text/css" rel="stylesheet">
<div class="apply_addredd area <?=MODNAME;?>">
	<?php if(MODNAME=='try'){ ?>
	<div class="apply_title">
		<h5>试用申请</h5>
		<div class="two"></div>
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
	<ul>
		<li class="name">
			<p class="warning">申请填写格式：#<?=$title;?>#+申请理由～</p>
		</li>
		<li class="address">
			<div id="Smohan_FaceBox" style=" position: relative;">
			<textarea id="pb_content" class="pub_txt">#<?=$title;?>#</textarea>
			<br/>
			<a href="javascript:void(0)" class="face" title="表情"></a>
			</div>
		</li>
		<li class="btns">
			<input type="hidden" name="successurl" value="<?=$successurl;?>">
			<input type="submit" class="next btn" value="下一步" onclick="addcomment('<?=$id;?>','<?=$type;?>',$('#pb_content'),'<?=$type;?>comment')" /></li>
		</li>
	</ul>
</div>
</div>
</div>
<script type="text/javascript">
$(function (){
	$.getScript('static/js/smohan.face.js',function(){
		$("a.face").smohanfacebox({
			Event : "click",	//触发事件
			divid : "Smohan_FaceBox", //外层DIV ID
			textid : "pb_content" //文本框 ID
		});
	})
});
</script>
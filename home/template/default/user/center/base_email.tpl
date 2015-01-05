<form action="<?=u('user','base',array('op'=>$op));?>" target="_blank" method="POST" onsubmit="return bindemail();">
<div class="fl right_r">
   	 <div class="item">
		  <label class="fl">邮箱地址：</label>
		  <input type="text" name="email" class="input_text" placeholder="邮箱地址" onblur="bluremail();">
		  <span></span>
	 </div>
	 <div class="item">
	 	<label class="fl">&nbsp;</label>
		<input type="submit" value="保存" class="save btn"/>
	 </div>
</div>
</form>
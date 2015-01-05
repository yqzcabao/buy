<?php include(PATH_TPL."/public/header.tpl.php");?>
<div class="box-content">
	<div class="table">
		<div id="notice"></div>
		<div id="schedule"><b></b><span></span></div>
	</div>
</div>
<div class="box-footer">
    <div class="box-footer-inner">
    	<input type="button" value="开始清理" name="clear" onclick="location.href='?mod=data&ac=clear&start=1'">
    </div>
</div>
<script type="text/javascript">
function show_message(message) {
	document.getElementById('notice').innerHTML += message + '<br />';
	document.getElementById('notice').scrollTop = 100000000;
}
</script>
<?php 
if(!empty($start)){
	//清理缓存
	clear_cache(PATH_DATA.'/cache/config');
	clear_cache(PATH_DATA.'/cache/task');
	showjsmessage("清理完成");
}
?>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
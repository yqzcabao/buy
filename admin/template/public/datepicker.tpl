<!--//jq ui-->
<script src="../static/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="static/js/jquery.ui.datepicker-zh-CN.js"></script>
<link href="../static/jqueryui/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$(function(){
	$('.datepicker').prop("readonly",true).datepicker({
        dateFormat: "yy-mm-dd"
	});
})
</script>
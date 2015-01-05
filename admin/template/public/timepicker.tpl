<!--//jq ui-->
<script src="../static/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="static/js/jquery_timepicker.js"></script>
<script src="static/js/jquery.ui.datepicker-zh-CN.js"></script>
<script src="static/js/jquery-ui-timepicker-zh-CN.js"></script>
<link href="../static/jqueryui/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />
<link href="static/css/jquery_timepicker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$(function(){
	$('.timepicker').prop("readonly",true).datetimepicker({
		timeFormat: "HH:mm",
        dateFormat: "yy-mm-dd"
	});
})
</script>
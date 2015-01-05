<?php
	$reportarr=explode("\r\n",$_webset['report_reason']);
?>
<script type="text/javascript">
function report(id,goods){
	<?php if($_webset['open_report']==0){ ?>
	return false;
	<?php } ?>
	report_gid=id;
	report_goods=goods;
	show_msg('<div class="inner_report">\
				<form method="post" id="reportform" onsubmit="return formreport();">\
				<select name="report[report]" class="selectClass" onchange="setreport()">\
					<option value="">请选择</option>\
					<?php foreach ($reportarr as $key=>$value){ ?>
					<option value="<?=$value;?>"><?=$value;?></option>\
					<?php } ?>
					<option value="-1">其它原因</option>\
				</select><br />\
				<label class="reportother\" style="display:none">\
					其它原因： <input type="text" name="report[otherReasons]" class="other_text" id="otherReasons"><br>\
				</label>\
				<input type="submit" value="提交" class="sub_btn" />\
				</form>\
			</div>');
}
</script>
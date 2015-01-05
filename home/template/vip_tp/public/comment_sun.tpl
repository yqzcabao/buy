<div class="show_point" style="display:none">
<link href="static/css/smohan.face.css" type="text/css" rel="stylesheet">
	<em class="angle"></em>
	<div class="text_div">
		<textarea class="account fl" name="comment" id="comment"></textarea>
		<div class="ruleDescripition fl">
			通过您对获得的礼品发布晒单我们将给与奖励。服务、配送等建议请在满意度评价提出。
			<a href="<?=u('help','info',array('id'=>$_webset['base_rule']));?>" target="_blank">积分规则&gt;&gt;</a>
		</div>
		<div class="clear"></div>
		<div class="upload" id="comment_textArea">
			<label>添加：</label>
			<a href="javascript:;" class="addFace" title="表情">表情</a>
			<input type="file" class="addImg_file" name="sunpic" id="changeImg" action="<?=u('ajax','operat',array('op'=>'ajaxsunpic'));?>" hidefocus="true"/>
			<a href="javascript:;" class="addImg_a" title="选择图片">图片</a>
			<input type="hidden" name="id" value="">
			<input type="button"  class="sub_btn" value="提交" onclick="addsuncomment();"/>
		</div>
		<div class="imgShow" style="display:none"><ul></ul></div>
	</div>
</div>
<script type="text/javascript">
$(function (){
	$.getScript('static/js/smohan.face.js',function(){
		$(".addFace").smohanfacebox({
			Event : "click",	//触发事件
			divid : "comment_textArea", //外层DIV ID
			textid : "comment" //文本框 ID
		});
	})
});
ajaxFileUpload("changeImg",'setsunpic');
</script>
<?php if($_webset['base_isComment']==1){ ?>
<link href="static/css/smohan.face.css" type="text/css" rel="stylesheet">
<div class="comment_textArea" id="comment_textArea">
  <div class="com_box">
      <div class="cf_b com_big">
          <div class="pub_area">
          	  <textarea  class="pub_txt" name="comment" id="comment"></textarea>
          	  <input type="hidden" name="authorid" id="authorid" value="">
			  <input type="hidden" name="author" id="author" value="">
              <div class="pub_area_ft">
                  <span class="count fl"><em><?=intval($commentresult['total']);?></em>条评论</span>
                  <a class="pub_btn fr" href="javascript:void(0);" onclick="addcomment('<?=$good['id'];?>','goods',$('#comment'),'goodscomment',$('#authorid'),$('#author'))">发表</a>
                  <a href="javascript:void(0);" w="f" class="expressionSymbol add_face fr"></a>
              </div>
          </div>
      </div>
  </div>
</div>
<script type="text/javascript">
$(function (){
	$.getScript('static/js/smohan.face.js',function(){
		$(".expressionSymbol").smohanfacebox({
			Event : "click",	//触发事件
			divid : "comment_textArea", //外层DIV ID
			textid : "comment" //文本框 ID
		});
	})
});
</script>
<?php } ?>
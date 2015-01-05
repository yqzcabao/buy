<?php 
$commentlist=array();
if (!empty($commentresult))
{
	$page_url=u('goods','detail',$commentresult['urls']);
	$pages=get_page_number_list($commentresult['total'], request('start',0),CPAGE);
	$commentlist=$commentresult['data'];
}
?>
<div class="dl displayIF" id="tab1">
	<div class="uslist">
		<?php if(empty($commentlist)){ ?>
		<div class="plzw">还没有人进行过评论，快来评论！</div>
		<?php }else{ ?>
		<ul id="rlist" class="dhuan">
		<?php foreach ($commentlist as $key=>$value){ ?>
		<li>
			<span class="w1">
				<a href="javascript:void(0);">
					<img src="<?=avatar($value['uid'],'little');?>" />
				</a>
			</span>
			<span class="w3">
				<a href="javascript:void(0);"><?=$value['user_name'];?></a>
				<i><?=date('Y-m-d H:i:s',$value['addtime']);?></i>
			</span>
			<span class="comment_c fl">
				<em class="comment_message"><?=$value['message'];?></em>
			</span>
		</li>
		<?php } ?>
		</ul>
		<?php } ?>
	</div>
	<?php include(PATH_TPL."/public/small_page.tpl");?>
</div>
<script type="text/javascript">
$(function (){
	$.getScript('static/js/smohan.face.js',function(){
		//解析表情
		$('.comment_message').each(function(i){
			$('.comment_message').eq(i).replaceface($('.comment_message').eq(i).html());
		})
	})
});
</script>
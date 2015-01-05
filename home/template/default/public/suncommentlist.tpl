<?php
$suncommentlist=array();
if (!empty($suncommentresult))
{
	$page_url=u('goods','detail',$suncommentresult['urls']);
	$pages=get_page_number_list($suncommentresult['total'], $start,CPAGE);
	$suncommentlist=$suncommentresult['data'];
}
?>
<div class="dl displayIF" id="tab2">
	<div class="uslist">
		<?php if(empty($suncommentlist)){ ?>
		<div class="plzw">这些人都太懒了，没有晒单</div>
		<?php }else{ ?>
		<ul id="rlist" class="dhuan">
		<?php foreach ($suncommentlist as $key=>$value){ ?>
			<li class="ul_li">
				<span class="w1">
					<a href="javascript:void(0);" class="fl">
						<img src="<?=avatar($value['uid'],'little');?>" />
					</a>
				</span>
				<span class="w3">
					<a href="javascript:void(0);"><?=$value['user_name'];?></a>
					<i><?=date('Y-m-d H:i:s',$value['addtime']);?></i>
				</span>
				<span class="comment_c fl">
					<em class="comment_message" style="word-wrap:break-word;">
						<?=$value['message'];?>
					</em>
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
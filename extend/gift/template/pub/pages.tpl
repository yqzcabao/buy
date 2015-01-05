<div class="clear"></div>
<?php if(isset($pages) && !empty($pages)){ ?>
<div class="page area">
	<div class="list_page">
		<?php if($pages['prev']>-1){ ?><span class="prev"><a href="<?=page_url($page_url,$pages['prev']);?>" style=" width:100px">上一页</a></span><?php } ?><?php foreach ($pages as $k=>$v){ ?><?php if($k != 'prev' && $k != 'next'){ ?><?php if($k == 'omitf' || $k == 'omita'){ ?><span class="fl ">…</span><?php }else{ ?><?php if($v > -1){ ?><span class="page"><a href="<?=page_url($page_url,$v);?>"><?=$k;?></a></span><?php }else{ ?><span class="page current"><a href="javascript:void(0);"><?=$k;?></a></span><?php } ?><?php } ?><?php } ?><?php } ?><?php if($pages['next'] > -1){ ?><span class="next"><a href="<?=page_url($page_url,$pages['next']);?>" style=" width:100px">下一页</a></span><?php } ?>
    </div>
</div>
<?php } ?>
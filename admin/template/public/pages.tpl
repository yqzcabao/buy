<?php if(isset($pages) && !empty($pages)){ ?>
<div class="pages">
    <?php if($pages['prev']>-1){ ?>
    <a href="<?=$page_url;?>&start=<?=$pages['prev'];?>">&laquo; 上一页</a>
    <? }else{ ?>
    <span class="nextprev">&laquo; 上一页</span>
    <?php } ?>
    <?php foreach ($pages as $k=>$v){ ?>
        <?php if($k != 'prev' && $k != 'next'){ ?>
        	<?php if($k == 'omitf' || $k == 'omita'){ ?>
            <span>…</span>
            <?php }else{ ?>
            	<?php if($v > -1){ ?>
                <a href="<?=$page_url;?>&start=<?=$v;?>"><?=$k;?></a>
                <?php }else{ ?>
                <span class="current"><?=$k;?></span>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    <?php if($pages['next'] > -1){ ?>                     
    <a href="<?=$page_url;?>&start=<?=$pages['next'];?>">下一页 &raquo;</a>
    <?php }else{ ?>
    <span class="nextprev">下一页 &raquo;</span>
    <?php } ?>
</div>                
<?php } ?>
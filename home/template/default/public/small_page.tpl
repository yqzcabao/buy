<?php 
if(isset($pages) && !empty($pages)){ ?>
<div class="pagination">
	<ul>
	<?php if($pages['prev']>-1){ ?>
		<li class="fl on"><a href="<?=page_url($page_url,$pages['prev']);?>">上一页</a></li>
    <?php } ?>		
	<?php foreach ($pages as $k=>$v){ ?>
        <?php if($k != 'prev' && $k != 'next'){ ?>
        	<?php if($k == 'omitf' || $k == 'omita'){ ?>
            <li class="fl ">…</li>
            <?php }else{ ?>
            	<?php if($v > -1){ ?>
            		<li class="fl"><a href="<?=page_url($page_url,$v);?>"><?=$k;?></a></li>      	
                <?php }else{ ?>
                	<li class="fl on"><a href="javascript:;"><?=$k;?></a></li>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    <?php if($pages['next'] > -1){ ?>
    	<li class="fl on"><a href="<?=page_url($page_url,$pages['next']);?>">下一页</a></li>
    <?php } ?>
	</ul>
</div>
<?php } ?>
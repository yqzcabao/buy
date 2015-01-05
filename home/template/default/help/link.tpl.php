<?php 
include(PATH_TPL."/header.tpl.php");
$_link=system::getlink()
?>
<link href="<?=PATH_TPL;?>/static/css/link.css" type="text/css" rel="stylesheet"/>
<div class="content">
	<div class="content_c mg0 auo">
    	<div class="link mg0">
        	<p class="link_title">友情链接</p>
        	<ul class="auo mg0">
        		<?php foreach ($_link as $key=>$value){ ?>
                <li class="fl"><a href="<?=$value['url'];?>" target="_blank"><?=$value['title'];?></a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="link_condition mg0 auo">
        	<?=$link_rule['content'];?>
        </div>
    </div>
</div>
<?php include(PATH_TPL."/footer.tpl.php");?>
<?php if(!empty($sunpic)){ ?>
<ul class="singleSun">
	<?php foreach ($sunpic as $key=>$value){ ?>
	<li class="fl"><a href="javascript:;" class="fl"><img src="<?=$value;?>"></a></li>
	<?php } ?>
</ul>
<?php } ?>
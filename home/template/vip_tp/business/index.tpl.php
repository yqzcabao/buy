<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/business.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="<?=PATH_TPL;?>/static/js/business.js"></script>
<div class="cooperatonType area">
	<ul>
	<?php foreach ($_nav as $key=>$value){ ?>
		<?php if($value['mod']=='goods' || $value['mod']=='try' || $value['mod']=='exchange'){ ?>
		<li class="fl">
			<h3><?=$value['name'];?></h3>
			<p><?=$value['remark'];?></p>
			<h4><a href="<?=u('business','apply',array('nid'=>$value['id']));?>" target="_blank"></a></h4>
		</li>
		<?php } ?>
	<?php } ?>
	</ul>
</div>			
<?php include(PATH_TPL."/public/footer.tpl");?>
</body>
</html>
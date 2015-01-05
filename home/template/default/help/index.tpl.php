<?php
$help=gethelp();
$helpclass=gethelpcat();
$cid=request('cid',0);
$id=request('id',0);
if(empty($cid) && !empty($id)){
	foreach ($help as $k=>$val){
		if(isset($val[$id])){
			$cid=$k;
			break;
		}
	}
}
if(!empty($cid)){
	$active[$cid]="class='on'";
	//当前分类
	$helpcat=$helpclass['cid_'.$cid]['title'];
}
include(PATH_TPL."/header.tpl.php");
?>
<link href="<?=PATH_TPL;?>/static/css/helpcenter.css" type="text/css" rel="stylesheet"/>
<div class="area baockP">
	<?php include(PATH_TPL."/help/left.tpl");?>
	<div class="fr rightb">
		<div class="bp">
			<?php if(empty($cid) && empty($id)){ ?>
			<div class="tit">
				<h2 class="fl">帮助中心</h2>
			</div>
			<ul class="blockBL">
	            <?php foreach ($help as $k=>$val){ ?>
				<li style="list-style-type: none;"><?=$helpclass['cid_'.$k]['title'];?></li>
					<?php foreach ($val as $key=>$value){ ?>
					<li style="list-style-type: none;margin-left: 10px;">
						<a href="<?=u('help','info',array('cid'=>$k,'id'=>$value['id']));?>" title="<?=$value['title'];?>"><?=$value['title'];?></a>
					</li>
					<?php } ?>
				<?php } ?>
	        </ul>
			<?php  }else{?>
			<div class="tit">
				<h2 class="fl"><?=$helpcat;?></h2>
			</div>
			<ul class="blockBL">
	            <?php foreach ($help[$cid] as $k=>$val){ ?>
				<li>
					<a href="<?=u('help','info',array('cid'=>$value['id'],'id'=>$val['id']));?>" title="<?=$val['title'];?>"><?=$val['title'];?></a>
				</li>
				<?php } ?>
	        </ul>
	        <?php } ?>
		</div>
	</div>
</div>			
<?php include(PATH_TPL."/footer.tpl.php");?>
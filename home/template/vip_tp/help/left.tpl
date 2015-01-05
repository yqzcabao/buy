<div class="fl leftb">
	<?php foreach ($helpclass as $key=>$value){ ?>
	<dl>
        <dt><?=$value['title'];?></dt>
        <?php foreach ($help[$value['id']] as $k=>$val){ ?>
        <dd><a href="<?=u('help','info',array('cid'=>$value['id'],'id'=>$val['id']));?>" <?=$active[$val['id']];?>><?=$val['title'];?></a></dd>
        <?php } ?>   
    </dl>
    <?php } ?>
</div>
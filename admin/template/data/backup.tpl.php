<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=list">数据库维护</a></li>
	<li <?=$active['regain'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=regain">备份恢复</a></li>
	<li <?=$active['optimiza'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=optimiza">数据库优化</a></li>
</ul>
<div class="box-content">
<?php if($op=='list'){ ?>
<!--//数据库列表-->
	<?php if($step==1){ ?>
    <form method="POST" action="?mod=data&ac=backup&op=list&step=2">
    	 <table class="admin-tb"><tbody>
    	 <tr><td>
    	 数据库备份保存在/data/backup/目录中;
    	 <input type="submit" value="开始备份">
    	 </td></tr>
    	 </tbody></table>
    </form>
    <?php }elseif($step==2){ ?>
	<table class="admin-tb"><tbody>
    	 <tr><td>
    	 <?=$dbbackup->backup();?>
    	 </td></tr>
	 </tbody></table>
    <?php } ?>
<?php }elseif($op=='regain'){ ?>
<?php if($step==1){ ?>
<form method="POST" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=regain&step=2">
   <div class="table">
	    <table class="admin-tb"><tbody>
	    <tr>
	        <th width="200" class="text-left">数据库备份</th>
	        <th>&nbsp;</th>
	    </tr>
	    <?php if(empty($silentlist)){ ?>
	    <tr><td colspan="2" class="text-center">你还没有备份</td></tr>
	    <?php } ?>
	    <?php foreach ($backup as $key=>$value){ ?>
		<tr id="back_<?=$key;?>">
	        <td class="text-left">
	        <input type="radio" id="idkey_<?=$key;?>" name="idkey" value="<?=$key;?>" class="checkbox">
	        <label for="idkey_<?=$key;?>"><?=$key;?></label>
	        </td>
	        <td>
	        	<a href="javascript:;" onclick="backup('<?=$key;?>');">删除备份</a>
	        </td>
	    </tr>
	    <?php } ?>                               
	    </tbody></table>
   </div>
	<div class="box-footer">
	    <div class="box-footer-inner">
	    	<input type="hidden" name="formhash" value="<?=formhash();?>">
	        <input type="submit" value="恢复备份">&nbsp;&nbsp;
	    </div>
	</div>
</form>
<?php }elseif($step==2){ ?>
<div class="table">
	<table class="admin-tb"><tbody>
    	 <tr><td>
    	 <?=$dbbackup->restore($backuparr[0]);?>
    	 </td></tr>
	 </tbody></table>
</div>
<?php } ?>
<?php }elseif($op=='optimiza'){ ?>
<form method="POST" action="?mod=data&ac=backup&op=optimiza">
  <div class="table">
    <table class="admin-tb"><tbody>
    <tr>
    	<th width="10" class="text-center">
    		<input type="checkbox" name="all" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
    	</th>
        <th width="200">数据表</th>
        <th width="100">类型</th>
        <th width="100">记录数</th>
        <th width="100">数据</th>
        <th width="100">索引</th>
    	<th width="100">碎片</th>
    </tr>
    <?php if(empty($silentlist)){ ?>
    <tr><td colspan="7" class="text-center">数据表没有碎片，不需要再优化</td></tr>
    <?php } ?>
    <?php foreach ($silentlist as $key=>$value){ ?>
	<tr>
        <td class="text-center">
        	<input type="checkbox" name="optimizetables[]" value="<?=$value['Name'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
        </td>
        <td class="text-center"><?=$value['Name'];?></td>
        <td class="text-center"><?=$value['tabletype'];?></td>
        <td class="text-center"><?=$value['Rows'];?></td>
        <td class="text-center"><?=$value['Data_length'];?></td>
        <td class="text-center"><?=$value['Index_length'];?></td>
        <td class="text-center"><?=$value['Data_free'];?></td>
    </tr>
    <?php } ?>                               
    </tbody></table>
    </div>
	<div class="box-footer">
	    <div class="box-footer-inner">
	    	<input type="hidden" name="formhash" value="<?=formhash();?>">
	        <input type="submit" value="优化">&nbsp;&nbsp;
	    </div>
	</div>
</form>
<?php } ?>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
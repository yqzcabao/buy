<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['mytpl'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=mytpl">我的模板</a></li>
	<li <?=$active['tplset'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=tplset">模板设置</a></li>
</ul>
<p class="line mb10"></p>
<div class="box-content">
<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=<?=$op;?>">		
	<?php if($op=='mytpl'){ ?>
		<table class="table-font"><tbody>
		<tr><td>
			<?php foreach ($tpls as $k=>$val){ ?>
			<div style="width:170px; height:250px; float:left;margin: 0px 20px 10px;">
			    <a href="javascript:void(0);">
			    	<img src="../home/template/<?=$val['name'];?>/tpl.png" width="170px" height="185px" style="border:1px solid #ccc;">
			    </a>
			    <p class="mt5">
			    	<input type="radio" name="tpl[site_tpl]" value="<?=$k;?>" <?php if($k==$_webset['site_tpl']){ ?>checked<?php } ?>><label for=""><?=$val['name'];?></label>
			    	<a href="../home/template/<?=$val['name'];?>/tpl_big.png" target="_blank" style="float:right;color: red;font-weight: bold;">点击预览</a>
			    </p>
		    </div>
		    <?php } ?>
		</td></tr>
		</tbody></table>
		<div class="box-footer">
	        <div class="box-footer-inner">
	        	<input type="hidden" name="formhash" value="<?=formhash();?>">
	        	<input type="submit" name="tplset" value="保存更改">
	        </div>
	    </div>
	<?php }elseif($op=='tplset'){ ?>
		<table class="table-font"><tbody>
		<!--//模板设置项-->
		<?php include(PATH_FRONT_TPL.'/'.$_webset['site_tpl'].'/_set');?>
		<!--//扩展模板设置项-->
		<?php foreach ($extend_tpl_set as $set_tpl){ ?>
		<?php include($set_tpl);?>
		<?php } ?>
		</tbody></table>
		<div class="box-footer">
	        <div class="box-footer-inner">
	        	<input type="hidden" name="formhash" value="<?=formhash();?>">
	        	<input type="submit" name="tplset" value="保存更改">
	        </div>
	    </div>
	<?php } ?>
</form>
<!--//END-->
<?php include(PATH_TPL."/public/footer.tpl.php");?>
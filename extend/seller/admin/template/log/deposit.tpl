<?php $active[$status]='class="active"';?>
<ul class="nav">
	<li <?=$active['paid'];?>><a href="<?=$_extend_url;?>&pmod=log&op=deposit&s=paid">缴纳记录</a></li>
	<li <?=$active['unfreeze'];?>><a href="<?=$_extend_url;?>&pmod=log&op=deposit&s=unfreeze">解冻记录</a></li>
</ul>
<div class="box-content">
	<div class="table">
	<form method="POST">
	  	<div class="th">
			用户搜索:
			<input type="text" name="keyword" value="<?=request('keyword','');?>" placeholder="用户名/流水号/交易号">
			<input type="submit" value="搜索">
	    </div>
	</form>
	</div>
	<form method="POST" action="<?=$_extend_url;?>&pmod=del" onsubmit="return confirmdel();">
		<div class="table">
	    <table class="admin-tb"><tbody>
		    <tr>
		    	<th width="10" class="text-center">
		    		<input type="checkbox" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
		    	</th>
		    	<th width="60">流水号</th>
		    	<th width="60">用户</th>
		        <th width="50">金额</th>
		    	<th width="100" class="text-center">缴纳时间</th>
		    </tr>
		    <?php foreach ($loglist as $key=>$value){ ?>
		    <tr>
		    	<td class="text-center">
		    		<input type="checkbox" name="id[]" value="<?=$value['lid'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
		    	</td>
		        <td class="text-left"><?=$value['serialno'];?></td>
		        <td class="text-center"><?=$value['user_name'];?></td>
		        <td class="text-center"><?=$value['money'];?></td>
		        <td class="text-center"><?=date('Y-m-d H:i:s',$value['addtime']);?></td>
		    </tr>
		    <?php } ?>
	    </tbody></table>
		</div>
		<div class="box-footer">
			<!--//分页-->
			<?php include(PATH_TPL."/public/pages.tpl");?>       
		    <div class="box-footer-inner">
		    	<input type="hidden" name="op" value="log">
		    	<input type="hidden" name="gomod" value="log">
		    	<input type="hidden" name="goop" value="<?=$op;?>">
		    	<input type="hidden" name="s" value="<?=$status;?>">
		        <input type="submit" value="删除">
		    </div>
		</div>
	</form>
</div>
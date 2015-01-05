<?php $active[$status]='class="active"';?>
<ul class="nav">
	<li <?=$active['all'];?>><a href="<?=$_extend_url;?>&pmod=log&op=recharge&s=all">全部</a></li>
	<li <?=$active['audit'];?>><a href="<?=$_extend_url;?>&pmod=log&op=recharge&s=audit">待审核</a></li>
	<li <?=$active['succeed'];?>><a href="<?=$_extend_url;?>&pmod=log&op=recharge&s=succeed">已成功</a></li>
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
		    	<th width="100" class="text-center">充值时间</th>
		    	<th width="100" class="text-center">成功时间</th>
		    	<th width="50" class="text-center">充值方式</th>
		    	<th width="50" class="text-center">账号</th>
		    	<th width="50" class="text-center">支付宝交易号</th>
		    	<th width="50" class="text-center">状态</th>
		        <th width="80" class="text-center">操作</th>
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
		        <td class="text-center">
	        		<?php if(empty($value['succeed'])){ ?>
	        		--
	        		<?php }else{ ?>
	        		<?=date('Y-m-d H:i:s',$value['succeed']);?>
	        		<?php } ?>
		        </td>
		        <td class="text-center">
		        	<?php if($value['method']==1){ ?>支付宝充值
	        		<?php }elseif ($value['method']==2){ ?>审核充值<?php } ?>
		        </td>
		        <td class="text-center"><?=$value['account'];?></td>
		        <td class="text-center"><?=$value['trade_no'];?></td>
		        <td class="text-center red">
		        	<?php if($value['status']==1){ ?>成功
		        	<?php }elseif ($value['status']==0){ ?>
		        		<?php if($value['method']==1){ ?>
		        		未付款
		        		<?php }elseif ($value['method']==2){ ?>
		        		待审核
		        		<?php } ?>
		        	<?php } ?>
		        </td>
		        <td class="text-center">
		        	<?php if($value['status']==0 && $value['method']==2){ ?>
		        	<a href="javascript:void(0);" id="trade_no_<?=$value['trade_no'];?>" onclick="recharge_audit('<?=$value['lid'];?>','<?=$value['trade_no'];?>','<?=$value['money'];?>');">审核</a>
		        	<?php } ?>
		        </td>
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
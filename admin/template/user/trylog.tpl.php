<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['apply'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=apply">申请记录</a></li>
	<li <?=$active['ship'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=ship">发货记录</a></li>
	<li <?=$active['show'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=show">晒单记录</a></li>
	<li <?=$active['fail'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=fail">失败申请</a></li>
</ul>
<div class="box-content">
	<div class="table">
	<form method="GET" action="index.php">
		<div class="th">
			<?php if($op=='apply'){ ?>
			<?=showSelect('status',array('no'=>'申请状态','0'=>'申请','1'=>'待发货','2'=>'已发货','3'=>'已晒单'),request('status','no'));?>
			<?php }elseif($op=='ship'){ ?>
			<?=showSelect('status',array('no'=>'发货状态','1'=>'未发货','2'=>'已发货'),request('status','no'));?>
			<?php }elseif($op=='show'){ ?>
			<?=showSelect('status',array('no'=>'晒单状态','2'=>'未晒单','3'=>'已晒单'),request('status','no'));?>
			<?php } ?>
			<input type="text" name="keyword" value="<?=request('keyword','');?>" placeholder="用户名/标题/申请评论">
			<input type="hidden" name="mod" value="<?=MODNAME;?>">
			<input type="hidden" name="ac" value="<?=ACTNAME;?>">
			<input type="hidden" name="op" value="<?=$op;?>">
			<input type="submit" value="搜索">
		</div>
	</form>
	</div>
	
	<form method="POST" action="?mod=public&ac=del" onsubmit="return confirmdel();">
		<div class="table">
			<table class="admin-tb">
			<tbody>
			<tr>
				<th width="10" class="text-center">
					<input type="checkbox" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
				</th>
			    <th width="100">试用</th>
			    <th width="200">申请评论</th>
			    <th width="200" class="text-center">用户</th>
				<th width="80" class="text-center">申请时间</th>
				<?php if ($op=='ship'){ ?>
				<th width="50" class="text-center">订单号</th>
				<?php } ?>
				<th width="50" class="text-center">状态</th>
			    <th width="136" class="text-center">操作</th>
			</tr>
			<?php foreach ($applylog as $key=>$value){ ?>
			<tr id="log<?=$value['aid'];?>">
				<td class="text-center">
					<input type="checkbox" name="id[]" value="<?=$value['aid'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
				</td>
			    <td><a href="" target="_blank"><?=$value['title'];?></a></td>
			    <td class="text-left"><?=$value['message'];?></td>
				<td class="text-center"><?=$value['user_name'];?></td>	
				<td class="text-center"><?=date('Y-m-d H:i:s',$value['addtime']);?></td>
				<?php if ($op=='ship'){ ?>
				<td class="text-center"><?=$value['order'];?></td>
				<?php } ?>
				<td class="text-center">
					<?php if($value['status']==0){ ?>
						待处理
					<?php }elseif ($value['status']==1){ ?>
						待发货
					<?php }elseif ($value['status']==2){ ?>
						待晒单
					<?php }elseif ($value['status']==3){ ?>
						已晒单
					<?php } ?>
				</td>
			    <td class="text-center">
			    	<?php if($value['status']==0){ ?>
			    	[<a href="javascript:;" onclick="payment('<?=$value['aid'];?>','try');">派发</a>] &nbsp;
			    	[<a href="javascript:;" onclick="applyrefuse('<?=$value['aid'];?>','try');">拒绝</a>] &nbsp;
			    	<?php }elseif ($value['status']==1){ ?>
			    	[<a href="javascript:;" onclick="ship('<?=$value['aid'];?>','try');">发货</a>] &nbsp;
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
				<input type="hidden" name="gomod" value="<?=MODNAME;?>">
				<input type="hidden" name="goac" value="<?=ACTNAME;?>">
				<input type="hidden" name="goop" value="<?=$op;?>">
		        <input type="submit" value="删除">
		    </div>
		</div>
	</form>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
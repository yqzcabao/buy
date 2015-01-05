<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=list">会员评论</a></li>
</ul>
<div class="box-content">
   <div class="table">
  	<form method="POST" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>">
  	<div class="th">
        <input type="text" name="keyword" value="<?=request('keyword','');?>" placeholder="内容/用户名">
        <?=showSelect('idtype',array(''=>'评论类型','goods'=>'宝贝评论','try'=>'试用申请','exchange'=>'积分兑换'),request('idtype',''));?>
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
            <th width="200" class="text-left">用户名</th>
        	<th>评论</th>
        	<th width="150">评论时间</th>
        	<th width="50">类型</th>
        	<th width="100">操作</th>
        </tr>
        <?php foreach ($commentlist as $key=>$value){ ?>
        <tr>
        	<td class="text-center">
        		<input type="checkbox" name="id[]" value="<?=$value['cid'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
        	</td>
            <td class="text-left">
            	<img src="/<?=avatar($value['uid'],'small');?>" style="vertical-align: middle;width: 30px;height: 30px;">
            	<?=$value['user_name'];?>
            </td>
            <td class="text-left"><?=$value['message'];?></td>
            <td class="text-center"><?=date('Y-m-d H:i:s',$value['addtime']);?></td>
            <td class="text-center">
            	<?php if($value['idtype']=='try'){ ?>
            	试用申请
            	<?php }elseif($value['idtype']=='exchange'){ ?>
            	积分兑换
            	<?php }elseif ($value['idtype']=='goods'){ ?>
            	宝贝评论
            	<?php } ?>
            </td>
            <td class="text-center">
            	<?php if( $_webset['base_commentAudit']==1 && $value['idtype']=='goods' && $value['status']==0){ ?>
            	[<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=audit&cid=<?=$value['cid'];?>" class="del">审核</a>] &nbsp;
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
	    	<input type="hidden" name="op" value="commit">
	    	<input type="hidden" name="gomod" value="<?=MODNAME;?>">
	    	<input type="hidden" name="goac" value="<?=ACTNAME;?>">
	    	<input type="hidden" name="goop" value="<?=$op;?>">
            <input type="submit" value="删除">
	    </div>
	</div>
    </form>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
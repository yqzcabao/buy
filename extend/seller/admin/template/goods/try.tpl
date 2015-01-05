<?php $active[$status]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['0'];?>><a href="<?=$_extend_url;?>&pmod=apply&op=try&status=0">待审核试用</a></li>
	<li <?=$active['-1'];?>><a href="<?=$_extend_url;?>&pmod=apply&op=try&status=-1">拒绝的试用</a></li>
	<li <?=$active['1'];?>><a href="<?=$_extend_url;?>&pmod=apply&op=try&status=1">已审核通过</a></li>
</ul>
<div class="box-content">
	<?php if($do=='edit'){ ?>
	<?php include(PATH_TPL."/main/try/add.tpl.php");?>
	<?php }else{ ?>
	<div class="table">
		<form method="GET">
			<div class="th">
				  <?php if(ACTNAME=='index'){ ?>       	 
			      <?=showSelect('type',array('0'=>'状态','1'=>'进行中','-1'=>'已结束','2'=>'未开始'),request('type','0'));?>
			      <?php } ?>
			      <input type="text" name="keyword" value="<?=request('keyword','');?>" placeholder="ID/标题/卖家昵称">
			      <input type="hidden" name="mod" value="<?=MODNAME;?>">
			      <input type="hidden" name="ac" value="<?=ACTNAME;?>">
			      <input type="hidden" name="op" value="<?=$op;?>">
			      <input type="submit" value="搜索">
			</div>
		</form>
	</div>
	
	<form method="POST" action="<?=$_extend_url;?>&pmod=del" onsubmit="return confirmdel();">
    <div class="table">
        <table class="admin-tb"><tbody>
        <tr>
        	<th width="10" class="text-center">
        		<input type="checkbox" class="allbox" onclick="checkAll($(this),$('.checkbox'));"></th>
        	<th width="55">试用图片</th>
            <th width="200">试用名称</th>        
        	<th width="50" class="text-center">现/原价</th>
        	<th width="30" class="text-center">卖家</th>
        	<th width="50" class="text-center">提供数量</th>
        	<th width="50" class="text-center">状态</th>
        	<th width="80">报名时间</th>
            <th width="80" class="text-center">操作</th>
        </tr>
        <?php foreach ($trylist as $key=>$value){ ?>
        <tr id="data_<?=$value['id'];?>">
        	<td class="text-center">
        		<input type="checkbox" name="id[]" value="<?=$value['id'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
        	</td>
        	<td class="text-center">
        		<img onerror="this.onerror=null;this.src='.<?=DEF_GD_LOGO;?>'" src="<?=get_img($value['pic'],'290');?>" style="width:50px;margin:2px auto;">
        	</td>
            <td>
            	<img src="static/images/taobao.ico" style="vertical-align: middle;">
            	<a href="http://detail.tmall.com/item.htm?id=<?=$value['num_iid'];?>" target="_blank"><?=$value['title'];?></a>
            	<b style="color:red">[<?=$value['nick'];?>]</b>
            </td>
        	<td class="text-center"><?=$value['price'];?>/<?=$value['promotion_price'];?></td>
        	<td class="text-center">
        		<a target="_blank" href="http://amos.alicdn.com/msg.aw?v=2&uid=<?=urlencode($value['nick']);?>&site=cntaobao&s=1&charset=utf-8"><img border="0" src="http://amos.im.alisoft.com/online.aw?v=2&uid=<?=urlencode($value['nick']);?>&site=cntaobao&s=2&charset=utf-8" alt="点击这里给我发消息"></a>
        	</td>
        	<td class="text-center"><?=$value['num'];?></td>
        	<td class="text-center">        		
        		<?php if($value['status']==0){ ?>
        			<?php if($value['pay_type']==1 && empty($value['pay_serialno'])){ ?>
        			<b style="color: red;">待付款</b>
        			<?php }else{ ?>
        			<b style="color: red;">待审核</b>
        			<?php } ?>
        		<?php }elseif($value['status']==-1){ ?>
        		<b style="color: orange;">已拒绝</b>
        		<?php } ?>
        	</td>
        	<td class="text-center"><?=date('m-d H:i',$value['addtime']);?></td>
        	<td class="text-center">
        		<?php if($value['status']==1){ ?>
            	[<a href="<?=$_extend_url;?>&pmod=apply&op=try&do=edit&status=<?=$status;?>&id=<?=$value['id'];?>">修改</a>]&nbsp;
            	<?php }else{ ?>
	            	<?php if($value['status']==0){ ?>
	            	[<a href="javascript:;" onclick="refuse('<?=$value['id'];?>','try');">拒绝</a>]&nbsp;
	            	<?php } ?>
	         		[<a href="javascript:;" onclick="audit('<?=$value['id'];?>','try')">通过排期</a>]&nbsp;
         		<?php } ?>
            </td>
        </tr>
        <?php if($value['status']==-1){ ?>
        <!--//拒绝理由-->
        <tr><td colspan="9">拒绝理由:<?=$value['refuse'];?></td></tr>
        <?php } ?>
        <?php } ?>      						               
        </tbody></table>
	</div>
	<div class="box-footer">
		<!--//分页-->
		<?php include(PATH_TPL."/public/pages.tpl");?>
	    <div class="box-footer-inner">
	    	<input type="hidden" name="op" value="try">
			<input type="hidden" name="gomod" value="apply">
			<input type="hidden" name="goop" value="<?=$op;?>">
            <input type="submit" value="删除">&nbsp;&nbsp;
	    </div>
	</div>
    </form>
    <?php } ?>
</div>
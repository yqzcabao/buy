<?php 
include(PATH_TPL."/public/header.tpl.php");
include(PATH_TPL."/public/timepicker.tpl");
?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=list">待审核试用</a></li>
	<li <?=$active['refuse'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=refuse">拒绝的试用</a></li>           
</ul>
<div class="box-content">
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
	
	<form method="POST" action="?mod=public&ac=del" onsubmit="return confirmdel();">
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
        	<th width="50" class="text-center">申请数量</th>
        	<th width="50" class="text-center">中奖数量</th>
        	<?php if(ACTNAME=='index'){ ?>
        	<th width="80">活动时间</th>
        	<th width="50" class="text-center">排序</th>
        	<th width="50" class="text-center">状态</th>
        	<?php }elseif(ACTNAME=='audit'){ ?>
        	<th width="80">报名时间</th>
        	<?php } ?>
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
            	<a href="../?mod=index&ac=jump&tag=<?=$value['url'];?>" target="_blank"><?=$value['title'];?></a>
            	<b style="color:red">[<?=$value['nick'];?>]</b>
            </td>
        	<td class="text-center"><?=$value['price'];?>/<?=$value['promotion_price'];?></td>
        	<td class="text-center">
        		<a target="_blank" href="http://amos.alicdn.com/msg.aw?v=2&uid=<?=urlencode($value['nick']);?>&site=cntaobao&s=1&charset=utf-8"><img border="0" src="http://amos.im.alisoft.com/online.aw?v=2&uid=<?=urlencode($value['nick']);?>&site=cntaobao&s=2&charset=utf-8" alt="点击这里给我发消息"></a>
        	</td>
        	<td class="text-center"><?=$value['num'];?></td>
        	<td class="text-center"><?=$value['apply'];?></td>
        	<td class="text-center"><?=$value['payment'];?></td>
        	<?php if(ACTNAME=='index'){ ?>
        	<td class="text-center"><?=date('m-d H:i',$value['start']);?><br/><?=date('m-d H:i',$value['end']);?></td>
        	<td class="text-center"><?=$value['sort'];?></td>
        	<td class="text-center">        		
        		<?php if($value['end']<$_timestamp){ ?>
        		<b style="color: red;">已结束</b>
        		<?php }elseif($value['start']>$_timestamp){ ?>
        		<b style="color: green;">未开始</b>
        		<?php }elseif($value['start']<$_timestamp && $value['end']>$_timestamp){ ?>
        		<b style="color: orange;">进行中</b>
        		<?php } ?>
        	</td>
        	<?php }elseif(ACTNAME=='audit'){ ?>
        	<td class="text-center"><?=date('m-d H:i',$value['addtime']);?></td>
        	<?php } ?>
        	<td class="text-center">
        		<?php if($value['status']==1){ ?>
            	[<a href="?mod=try&ac=index&op=tryAdd&id=<?=$value['id'];?>">修改</a>]&nbsp;
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
        <tr><td colspan="12">拒绝理由:<?=$value['refuse'];?></td></tr>
        <?php } ?>
        <?php } ?>      						               
        </tbody></table>
	</div>
	<div class="box-footer">
		<!--//分页-->
		<?php include(PATH_TPL."/public/pages.tpl");?>
	    <div class="box-footer-inner">
	    	<input type="hidden" name="op" value="try">
    		<input type="hidden" name="gomod" value="<?=MODNAME;?>">
    		<input type="hidden" name="goac" value="<?=ACTNAME;?>">
    		<input type="hidden" name="goop" value="<?=$op;?>">
            <input type="submit" value="删除">&nbsp;&nbsp;
	    </div>
	</div>
    </form>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="<?=$_extend_url;?>&pmod=black&op=list">黑名单</a></li>
	<li <?=$active['addblack'];?>><a href="<?=$_extend_url;?>&pmod=black&op=addblack">添加黑名单</a></li>           
</ul>
<div class="box-content">
<?php if($op=='list'){ ?>
	<div class="table">
		<form method="POST" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>">
			<div class="th">
				昵称/拒绝原因:
				<input type="text" name="keyword" value="">
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
	        		<input type="checkbox" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
	        	</th>
	            <th width="100">卖家昵称</th>
	            <th width="100">在线联系</th>
	            <th width="100">拉黑原因</th>
	        	<th width="25" class="text-center">时间</th>
	        </tr>
	        <?php foreach ($blacklist as $key=>$value){ ?>
	        <tr>
	        	<td class="text-center">
	        		<input type="checkbox" name="id[]" value="<?=$value['id'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
	        	</td>
	            <td><?=$value['nick'];?></td>
	            <td class="text-center">
	            <a target="_blank" href="http://amos.alicdn.com/msg.aw?v=2&uid=<?=urlencode($value['nick']);?>&site=cntaobao&s=1&charset=utf-8"><img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=<?=urlencode($value['nick']);?>&site=cntaobao&s=1&charset=utf-8" alt="点击这里给我发消息"></a>
	            </td>
	            <td class="text-left"><?=$value['reason'];?></td>
	        	<td class="text-center"><?=date('Y-m-d H:i:s',$value['addtime']);?></td>
	        </tr>
	        <?php } ?>
        </tbody></table>
    </div>
    <div class="box-footer">
    	<?php include(PATH_TPL."/public/pages.tpl");?>
	    <div class="box-footer-inner">
	    	<input type="hidden" name="op" value="black">
	    	<input type="hidden" name="gomod" value="black">
    		<input type="hidden" name="goop" value="<?=$op;?>">
            <input type="submit" value="删除">
	    </div>
	</div>
    </form>
<?php }elseif ($op=='addblack'){ ?>
	<form method="post" action="<?=$_extend_url;?>&pmod=black&op=addblack">
    <table class="table-font"><tbody>
        <tr>
            <th class="w120">商家昵称：</th>
            <td>
            	<input type="text" class="textinput w270" name="blacklist[nick]" value="">
            </td>
        </tr>
        <tr>
            <th class="w120" style="vertical-align: top;">添加理由：</th>
            <td>
            	<textarea class="w270 h80" name="blacklist[reason]"></textarea>
            </td>
        </tr>
    </tbody></table>
	<div class="box-footer">
	    <div class="box-footer-inner">
	    	<input type="submit" value="添加">
	    </div>
	</div>
	</form>
<?php } ?>
</div>	
<?php include(PATH_TPL."/public/footer.tpl.php");?>
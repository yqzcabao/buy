<form method="POST" action="?mod=public&ac=del" onsubmit="return confirmdel();">
<div class="table">
    <table class="admin-tb">
    <tbody>
    <tr>
    	<th width="40" class="text-center">
    		<input type="checkbox" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
    	</th>
        <th width="300">分类名称</th>
        <th width="300">排序</th>
        <th width="161">操作</th>
    </tr>
    <?php foreach ($catlist as $key=>$value){ ?>
	<tr>
        <td class="text-center">
        	<input type="checkbox" name="id[]" value="<?=$value['id'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
        </td>
        <td><span class="closeed" style="margin-left:<?=($value['level']-1)*5;?>px"></span><?=$value['title'];?></td>
        <td class="text-center">
        	<input type="text" value="<?=$value['sort'];?>" class="textinput" onblur="changesort($(this),'<?=$value['id'];?>','cat');">
        </td>
        <td class="text-center">
        	[<a href="?mod=<?=MODNAME;?>&ac=cat&op=add&id=<?=$value['id'];?>">修改</a>]
        </td>
    </tr>
    <?php } ?>                          
    </tbody></table>
</div>
<div class="box-footer">
    <div class="box-footer-inner">
    	<input type="hidden" name="op" value="type">
		<input type="hidden" name="gomod" value="<?=MODNAME;?>">
		<input type="hidden" name="goac" value="<?=ACTNAME;?>">
		<input type="hidden" name="goop" value="<?=$op;?>">
        <input type="submit" value="删除">
    </div>
</div>
</form>
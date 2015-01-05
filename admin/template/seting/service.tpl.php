<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=list">客服列表</a></li>
	<li <?=$active['add'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=add">添加客服</a></li>       
</ul>
<p class="line"></p>
<?php if($op=='list'){ ?>
<form method="POST" action="?mod=public&ac=del" onsubmit="return confirmdel();">
<div class="box-content">
	<div class="table">
		<table class="admin-tb"><tbody>
		    <tr>
		    	<th width="10" class="text-center">
		    		<input type="checkbox" name="all" class="allbox"  onclick="checkAll($(this),$('.checkbox'));">
		    	</th>
		        <th width="200">名称</th>
		        <th width="100">账号</th>
		        <th width="100">类型</th>
		        <th width="100">排序</th>
		        <th width="161">操作</th>
		    </tr>                           
		</tbody></table>
	</div>
</div>
<div class="box-footer">
    <div class="box-footer-inner">
    	<input type="hidden" name="formhash" value="<?=formhash();?>">
    	<input type="hidden" name="op" value="nav">
        <input type="submit" value="删除">&nbsp;&nbsp;
    </div>
</div>
</form>
<?php }elseif ($op=='add'){ ?>
<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=add">
<div class="box-content">
	<table class="table-font"><tbody>
        <tr>
            <th class="w120">客服名称：</th>
            <td><input type="text" class="textinput w270" name="nav[name]" value="<?=$nav['name'];?>"></td>
        </tr>
        <tr>
            <th class="w120">客服账号：</th>
            <td><input type="text" class="textinput w270" name="nav[mod]" value="<?=$nav['mod'];?>"></td>
        </tr>
        <tr>
            <th class="w120">类型：</th>
            <td><input type="text" class="textinput w270" name="nav[ac]" value="<?=$nav['ac'];?>"></td>
        </tr>
        <tr>
            <th>排序：</th>
            <td>
            	<input type="text" class="textinput w70" name="nav[sort]" value="<?=$nav['sort'];?>">
            </td>
        </tr>
    </tbody></table>
</div>
<div class="box-footer">
    <div class="box-footer-inner">
    	<input type="hidden" name="formhash" value="<?=formhash();?>">
    	<input type="submit" name="serviceadd" value="添加">
    </div>
</div>
</form>
<?php } ?>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
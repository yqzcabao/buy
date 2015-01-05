<!--//快捷登陆-->
<div class="table">
    <table class="admin-tb">
    <tbody>
    <tr>
    	<th width="20" class="text-center"></th>
        <th width="100">名称</th>
        <th width="200">描述</th>
        <th width="100">作者</th>
        <th width="60">操作</th>
    </tr>
    <?php foreach ($connect as $key=>$value){ ?>
	<tr>
        <td class="text-center"><img src="<?=$value['ico'];?>"></td>
        <td class="text-center"><?=$value['name'];?></td>
        <td class="text-center"><?=$value['desc'];?></td>
        <td class="text-center"><?=$value['author'];?></td>
        <td class="text-center">
        	<?php if (isset($value['install']) && !empty($value['install'])) {?>
    		<a href="<?=$_extend_url;?>&pmod=user&op=uninstall&key=<?=$key;?>">[卸载]</a>
    		<a href="<?=$_extend_url;?>&pmod=user&op=install&key=<?=$key;?>">[设置]</a>
    		<?php }else{ ?>
    		<a href="<?=$_extend_url;?>&pmod=user&op=install&key=<?=$key;?>">[安装]</a>
    		<?php } ?>
        </td>
    </tr>
    <?php } ?>                               
    </tbody></table>
</div>
<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php include(PATH_PLUGIN.'/admin/template/menu.tpl');?>
<div class="box-content">
<form method="post" action="<?=$_plugin_url;?>&pmod=set">
    <table class="table-font"><tbody>
    	<tr>
            <th>U站网址：</th>
            <td><input type="text" class="textinput w360" name="uzsite[uz_site]" value="<?=$_webset['uz_site'];?>"></td>
        </tr>
        <tr>
            <th>U站通信密钥：</th>
            <td><input type="text" class="textinput w360" name="uzsite[uz_secretkey]" value="<?=$_webset['uz_secretkey'];?>"></td>
        </tr>
    </tbody></table>
<div class="box-footer">
    <div class="box-footer-inner">
    	<input type="hidden" name="formhash" value="<?=formhash();?>">
    	<input type="submit" name="uzset" value="保存更改">
    </div>
</div>
</form>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
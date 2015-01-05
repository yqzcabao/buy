<!--//会员设置-->
<form method="post" action="<?=$_extend_url;?>&pmod=user&op=set">
	<table class="table-font"><tbody>
		<tr>
            <th class="w180">注册激活：</th>
            <td>
            	<input type="radio" name="user[site_activation]" value="1" id="site_activation_1">
            		<label for="site_activation_1" class="mr10">开启</label>
            	<input type="radio" name="user[site_activation]" value="-1" id="site_activation_-1">
            		<label for="site_activation_-1" class="mr10">关闭</label>
            	<script type="text/javascript">
	         	$("#site_activation_"+<?=intval($_webset['site_activation']);?>).attr("checked","checked");
	         	</script>
            </td>
        </tr>
        <tr>
            <th class="w180">积分规则文章id：</th>
            <td>
            	<input type="text" class="textinput w60" name="user[base_rule]" value="<?=$_webset['base_rule'];?>">
            	<a href="?mod=article&ac=list&op=articleAdd&id=<?=$_webset['base_rule'];?>" class="tip red">点击修改</a>
            </td>
        </tr>
        <tr>
            <th class="w180">注册协议文章id：</th>
            <td>
            	<input type="text" class="textinput w60" name="user[base_agreement]" value="<?=$_webset['base_agreement'];?>">
            	<a href="?mod=article&ac=list&op=articleAdd&id=<?=$_webset['base_agreement'];?>" class="tip red">点击修改</a>
            </td>
        </tr>
        <tr>
            <th>注册激活邮件有效期：</th>
            <td><input type="text" class="textinput w60" name="user[base_registeractivate]" value="<?=$_webset['base_registeractivate'];?>">秒（0表示不会失效）</td>
        </tr>
        <tr>
            <th>找回密码邮件有效期：</th>
            <td><input type="text" class="textinput w60" name="user[base_forgetactivate]" value="<?=$_webset['base_forgetactivate'];?>">秒（0表示不会失效）</td>
        </tr>
        <tr>
            <th>绑定邮箱邮件有效期：</th>
            <td><input type="text" class="textinput w60" name="user[base_bindemailactivate]" value="<?=$_webset['base_bindemailactivate'];?>">秒（0表示不会失效）</td>
        </tr>       
	</tbody></table>
	<div class="box-footer">
        <div class="box-footer-inner">
        	<input type="hidden" name="formhash" value="<?=formhash();?>">
        	<input type="submit" name="userset" value="保存更改">
        </div>
    </div>
</form>
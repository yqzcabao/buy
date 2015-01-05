<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['set'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=set">邮件服务</a></li>
	<li <?=$active['tpl'];?><?=$active['tpledit'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=tpl">邮件模板</a></li>
</ul>
<p class="line"></p>
<?php if($op=='set'){ ?>
<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=set" id="email">
<div class="box-content">
  <table class="table-font"><tbody>
	<tr>
	    <th class="w120">邮件服务：</th>
	    <td>
	    	<input type="radio" name="email[email_open]" value="1" id="email_open_1">
	    		<label for="email_open_1" class="mr10">开启</label>
	    	<input type="radio" name="email[email_open]" value="-1" id="email_open_-1">
	    		<label for="email_open_-1" class="mr10">关闭</label>
	    	<script type="text/javascript">
         	$("#email_open_"+<?=intval($_webset['email_open']);?>).attr("checked","checked");
         	</script>
	    </td>
	</tr>
	<tr>
	    <th>邮件服务模式：</th>
	    <td>
	    	<input type="radio" name="email[email_mod]" value="smtp" id="email_mod_smtp">
	    		<label for="email_mod_smtp" class="mr10">采用其他的 SMTP 服务</label>
	    	<input type="radio" name="email[email_mod]" value="mail" id="email_mod_mail">
	    		<label for="email_mod_mail" class="mr10">采用服务器内置的 Mail 服务</label>
	    	<script type="text/javascript">
         	$("#email_mod_<?=$_webset['email_mod'];?>").attr("checked","checked");
         	</script>
         	<span class="tip">邮件服务模式：  一般选择smtp方式，个别linux可选择mail方式。</span>
	    </td>
	</tr>
	<tr>
	    <th>服务器地址(SMTP):</th>
	    <td>
	    	<input type="text" class="textinput w360" name="email[email_smtp]" value="<?=$_webset['email_smtp'];?>">
	    	<span class="tip">如：smtp.126.com。建议使用126邮箱，QQ邮箱需要自行在QQ邮箱设置</span>
	    </td>
	</tr>
	<tr>
	    <th>服务器端口：</th>
	    <td><input type="text" class="textinput w360" name="email[email_port]" value="<?=$_webset['email_port'];?>"></td>
	</tr>   
	<tr>
	    <th>邮件发送帐号：</th>
	    <td>
	    	<input type="text" class="textinput w360" name="email[email_account]" value="<?=$_webset['email_account'];?>">
	    	<span class="tip">您的邮箱用户名，如service@126.com</span>
	    </td>
	</tr>
	<tr>
	    <th>帐号密码：</th>
	    <td>
	    	<input type="password" class="textinput w360" name="email[email_password]" value="<?=$_webset['email_password'];?>">
	    	<span class="tip">您的邮箱密码</span>
	    </td>
	</tr>
	<tr>
	    <th>发送昵称：</th>
	    <td><input type="text" class="textinput w360" name="email[email_fromname]" value="<?=$_webset['email_fromname'];?>"></td>
	</tr>       
	</tbody></table>
	<p class="line mt10 mb10"></p>
	<table class="table-font"><tbody>
	<tr>
	    <th class="w120">测试邮件地址：</th>
	   	<td>
	   		<input type="text" name="test_email" class="textinput w360" id="test_email">
	   	</td>
	</tr>
	<tr>
	    <th class="w120">测试邮件内容：</th>
	   	<td>
	   		<textarea class="w360 h80" name="test_content" id="test_email_content"></textarea>
	   	</td>
	</tr>
	<tr>
	    <th>&nbsp;</th>
	   	<td><input type="button" value="发送测试邮件" onclick="test_mail();" /></td>
	</tr>
	</tbody></table>
	<div class="box-footer">
	    <div class="box-footer-inner">
	    	<input type="hidden" name="formhash" value="<?=formhash();?>">
	    	<input type="submit" name="emailset" value="保存更改">
	    </div>
	</div>
</div>
</form>
<?php }elseif ($op=='tpl'){ ?>
<script type="text/javascript" src="static/js/jquery.cursor.js"></script>
<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=tpl">
<div class="box-content">
	<!--//邮件服务器设置-->
    <table class="table-font"><tbody>
    	<tr>
            <th>请选择模板：</th>
            <td>
            	<?=showSelect('email_tpl',$email_tpl,$tpl,'email_tpl');?>
            </td>
        </tr>
        <tr>
            <th>邮件主题：</th>
            <td><input type="text" class="textinput w360" name="<?=$tpl;?>[title]" value="<?=$tpl_value['title'];?>"></td>
        </tr>
        <tr>
            <th>邮件内容：</th>
            <td>
            	<textarea class="w360 h80" name="<?=$tpl;?>[tpl]"><?=$tpl_value['tpl'];?></textarea>
            </td>
        </tr>
        <tr>
            <th>变量：</th>
            <td>
            <?php foreach ($tpl_value['variablearr'] as $key=>$value){ ?>
            	<a href="javascropt:void(0);" data="<?=$value[0];?>" onclick="set_email($(this),'<?=$tpl;?>[tpl]')"  style="color:blue;margin: 0 10px;"><?=$value[1];?></a>
            <?php } ?>
            <input type="hidden" name="<?=$tpl;?>[variable]" value="<?=$tpl_value['variable'];?>">
            </td>
        </tr>
    </tbody></table>
</div>
<div class="box-footer">
    <div class="box-footer-inner">
    	<input type="submit" value="保存更改">
    </div>
</div>
</form>
<script type="text/javascript">
$(function(){
	$(".email_tpl").change(function(){
		var val=$(this).val();
		location.href="?mod=seting&ac=email&op=tpl&email_tpl="+val;
		return false;
	})
})
</script>
<?php } ?>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
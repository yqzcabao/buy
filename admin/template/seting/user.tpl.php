<?php include(PATH_TPL."/public/header.tpl.php");?>
<!--//START-->
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['set'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=set">会员设置</a></li>
	<li <?=$active['connect'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=connect">快捷登陆</a></li>
	<?php if($op=='install'){ ?>
	<li <?=$active['install'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=install&key=<?=$connectkey;?>">安装/设置</a></li>
	<?php } ?> 
</ul>
<div class="box-content">
	<?php if($op=='set'){ ?>
	<!--//会员设置-->
	<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>">
		<table class="table-font"><tbody>
			<tr>
	            <th class="w120">注册激活：</th>
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
	        <tr>
	            <th class="w180">积分名称：</th>
	            <td><input type="text" class="textinput w60" name="user[base_integralName]" value="<?=$_webset['base_integralName'];?>"></td>
	        </tr>
	        <tr>
	            <th class="w180">注册赠送积分：</th>
	            <td>
	            	<input type="text" class="textinput w120" name="user[reward_register]" value="<?=$_webset['reward_register'];?>">积分
	            </td>
	        </tr>
	        <tr>
	            <th class="w180">签到赠送积分：</th>
	            <td>
	            <input type="text" class="textinput w60" name="user[reward_sign_day]" value="<?=$_webset['reward_sign_day'];?>">积分,
	            连续<input type="text" class="textinput w60" name="user[reward_continuous_day]" value="<?=$_webset['reward_continuous_day'];?>">天-
	            递增<input type="text" class="textinput w60" name="user[reward_plus]" value="<?=$_webset['reward_plus'];?>">，
	            每日最多获取<input type="text" class="textinput w60" name="user[reward_daymax]" value="<?=$_webset['reward_daymax'];?>">积分
	            </td>
	        </tr>
	        <tr>
	            <th class="w180">邀请赠送积分：</th>
	            <td>
	            	<input type="text" class="textinput w60" name="user[reward_invite]" value="<?=$_webset['reward_invite'];?>">积分/人,
	            	每日最多获取<input type="text" class="textinput w60" name="user[reward_invite_daymax]" value="<?=$_webset['reward_invite_daymax'];?>">积分
	            </td>
	        </tr>
	        <tr>
	            <th class="w180">晒单赠送积分：</th>
	            <td><input type="text" class="textinput w120" name="user[reward_showsingle]" value="<?=$_webset['reward_showsingle'];?>">积分</td>
	        </tr>
	        <tr>
	            <th class="w180">评论赠送积分：</th>
	            <td>
	            	<input type="text" class="textinput w120" name="user[reward_comment]" value="<?=$_webset['reward_comment'];?>">
	            	积分,
	            	每日最多获取
	            	<input type="text" class="textinput w60" name="user[reward_comment_daymax]" value="<?=$_webset['reward_comment_daymax'];?>">积分
	            </td>
	        </tr>            
		</tbody></table>
		<div class="box-footer">
	        <div class="box-footer-inner">
	        	<input type="hidden" name="formhash" value="<?=formhash();?>">
	        	<input type="submit" name="userset" value="保存更改">
	        </div>
	    </div>
	</form>
	<?php }elseif ($op=='connect'){ ?>
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
        		<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=uninstall&key=<?=$key;?>">[卸载]</a>
        		<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=install&key=<?=$key;?>">[设置]</a>
        		<?php }else{ ?>
        		<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=install&key=<?=$key;?>">[安装]</a>
        		<?php } ?>
	        </td>
        </tr>
        <?php } ?>                               
        </tbody></table>
    </div>
	<?php }elseif ($op=='install'){ ?>
	<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=install">
    <table class="table-font"><tbody>
        <?php foreach ($connect['config'] as $key=>$value){ ?>
        	<tr <?php if($value['type']=='hidden'){ ?>style="display:none"<?php } ?>>
                <th class="w120"><?=$value['lan'];?>：</th>
                <td>
                	<input type="<?=$value['type'];?>" 
						   id="<?=$connectkey;?>_<?=$key;?>" 
						   name="connect[<?=$key;?>][value]" 
						   <?php if($value['type']=='checkbox'){ ?>
						   		value="<?=$value['default'];?>"
						   		<?php if($value['default']==$value['value']){ ?>checked<?php } ?>
						   <?php }else{  ?>
						   value="<?=$value['value'];?>"
						   <?php } ?>
						   >
                	<?php if(!empty($value['label'])) ?>
                	<label for="<?=$connectkey;?>_<?=$key;?>"><?=$value['label'];?></label>
                </td>
            </tr>
        <?php } ?>
        </tbody></table>
	    <input type="hidden" name="key" value="<?=$connectkey;?>">
	    <div class="box-footer">
	        <div class="box-footer-inner">
	        	<input type="submit" value="保存更改">
	        </div>
	    </div>
    </form>
	<?php } ?>
</div>
<!--//END-->
<?php include(PATH_TPL."/public/footer.tpl.php");?>
<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/user.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="static/js/area.js"></script>
<script type="text/javascript" src="static/js/date.js"></script>
<div class="area baockP">
	<div class="fl leftb">
	    <dl>
	        <dt>用户中心</dt>
	        <dd><a href="<?=u('user','base');?>" <?php if(ACTNAME=='base' && $op=='index'){ ?>class="on"<?php } ?>>基本资料</a></dd>
	        <dd><a href="<?=u('user','base',array('op'=>'pwd'));?>" <?php if(ACTNAME=='base' && $op=='pwd'){ ?>class="on"<?php } ?>>密码设置</a></dd>
	        <dd><a href="<?=u('user','base',array('op'=>'avatar'));?>" <?php if(ACTNAME=='base' && $op=='avatar'){ ?>class="on"<?php } ?>>个人头像</a></dd>
	        <dd><a href="<?=u('user','base',array('op'=>'account'));?>" <?php if(ACTNAME=='base' && $op=='account'){ ?>class="on"<?php } ?>>关联账号</a></dd>
	        <dd><a href="<?=u('user','address');?>" <?php if(ACTNAME=='address'){ ?>class="on"<?php } ?>>收货地址</a></dd>        
	    </dl>
	    <dl>
	        <dt>积分中心</dt>
	        <dd><a href="<?=u('user','center');?>" <?php if(ACTNAME=='center'){ ?>class="on"<?php } ?>>我的积分</a></dd>        
	        <dd><a href="<?=u('user','gift',array('op'=>'exchange'));?>" <?php if(ACTNAME=='gift' && $op=='exchange'){ ?>class="on"<?php } ?>>积分兑换</a></dd>
	        <dd><a href="<?=u('user','gift',array('op'=>'try'));?>" <?php if(ACTNAME=='gift' && $op=='try'){ ?>class="on"<?php } ?>>免费试用</a></dd>
	    </dl>
	    <dl>
	        <dd><a href="<?=u('user','fav');?>" <?php if(ACTNAME=='fav'){ ?>class="on"<?php } ?>>我的收藏</a></dd>
	        <dd><a href="<?=u('user','invite');?>" <?php if(ACTNAME=='invite'){ ?>class="on"<?php } ?>>邀请好友</a></dd>
	    </dl>
	</div>
	<div class="fr rightb">
		<div class="bp">
			<?php if(empty($user['user_name'])){ ?>
	        <div class="blockBL">
	            <span class="fl">“您尚未绑设置昵称”：</span>
	            <span class="fl">请您设置昵称，请<a href="<?=u('user','base',array('op'=>'index'));?>">设置昵称</a>。</span>
	        </div>
	        <?php } ?>
	        <?php if(empty($user['email'])){ ?>
	        <div class="blockBL">
	            <span class="fl">“您尚未绑定邮箱”：</span>
	            <span class="fl">请您绑定邮箱，以获得我们的更多增值服务。请<a href="<?=u('user','base',array('op'=>'email'));?>">立刻绑定</a>。</span>
	        </div>
	        <?php }elseif(empty($user['sta'])){ ?>
	        <div class="blockBL">
	            <span class="fl">“您尚未邮箱尚未验证”：</span>
	            <span class="fl">请验证绑定邮箱，以获得我们的更多增值服务。请<a href="<?=u('user','base',array('op'=>'email','email'=>$user['email']));?>">立刻验证</a>。</span>
	        </div>
	        <?php } ?> 
	        <?php if(!check_set_pwd()){ ?>
	        <div class="blockBL">
	            <span class="fl">“您尚未设置密码”：</span>
	            <span class="fl">为了账号安全,请设置密码。请<a href="<?=u('user','base',array('op'=>'pwd'));?>">立刻设置</a>。</span>
	        </div>
	        <?php } ?> 
	        <?php if(!useraddress($user['uid'])){ ?>
	        <div class="blockBL">
	            <span class="fl">“您尚未设置收货地址”：</span>
	            <span class="fl">请您设置收货地址，以获得我们的处理使用等发货信息。请<a href="<?=u('user','address');?>">立刻设置</a>。</span>
	        </div>
	        <?php } ?>

	        
<!--
<div class="tit">
	<h2 class="fl">个人信息
	<?php if($op=='index'){ ?>个人信息
	<?php }elseif ($op=='pwd'){ ?>密码设置
	<?php }elseif ($op=='email'){ ?>邮件绑定
	<?php }elseif ($op=='avatar'){ ?>个人头像
	<?php }elseif ($op=='account'){ ?>关联账号<?php } ?>
	</h2>
</div>
<ul class="an_tab_nav">
    <li class="fl on"><a href="#">全部</a></li>
    <li class="fl"><a href="#">审核中</a></li>
    <li class="fl"><a href="#">已通过</a></li>
    <li class="fl"><a href="#">未通过</a></li>
</ul>
<ul class="blockE">
    <li class="one fl">
    	<span class="w1 fl">日期</span>
        <span class="w2 fl">审核状态</span>
        <span class="w3 fl">描述</span>
    </li>
</ul>
-->
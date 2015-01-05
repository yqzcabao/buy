<?php $active[ACTNAME]="on";?>
<div class="head_nav">
	<div class="head_nav_c area">
		<span class="fr bmlogin">
			<?php if(!empty($user['uid'])){ ?>
        	您好!<i>
        	<?php if(empty($user['user_name']) && empty($user['email'])){ ?>
        		<a href="<?=u(MODNAME,'account');?>">设置昵称</a>
        	<?php }else{ ?>
        		<?=!empty($user['user_name'])?$user['user_name']:$user['email'];?>
        	<?php } ?></i>
        	<b class="control"><a href="<?=u(MODNAME,'account');?>">账号管理</a></b>
        	[<a href="<?=u(MODNAME,'logout');?>">退出</a>]
        	<?php }else{ ?>
        	[<a href="<?=u(MODNAME,'login');?>">卖家登录</a>]
        	[<a href="<?=u(MODNAME,'register');?>">卖家注册</a>]
        	<?php } ?>
        </span>
    	<div class="fl nav_list">
    		<a class="fl" href="<?=u('index','index');?>">首页<i></i></a>
    		<a class="fl <?=$active['index'];?>" href="<?=u(MODNAME,'index');?>">活动报名<i></i></a>
    		<a class="fl <?=$active['manage'];?>" href="<?=u(MODNAME,'manage');?>">活动管理<i></i></a>
    		<a class="fl <?=$active['funds'];?>" href="<?=u(MODNAME,'funds');?>">资金管理<i></i></a>
    		<a class="fl <?=$active['help'];?>" href="<?=u(MODNAME,'help');?>">报名指南</a>
        </div>
    </div>
</div>
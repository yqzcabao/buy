<div class="toolbar">
	<div class="toolbar_c area">
    	<div class="fr flow d5">
    		<?php if(!empty($_webset['site_service'])){ ?>
        	<a href="http://wpa.qq.com/msgrd?v=3&uin=<?=$_webset['site_service'];?>&site=qq&menu=yes" class="contractkf" target="_blank">联系客服</a>
            |
            <?php } ?>
            <a href="<?=u($_seller_mod,'index');?>" target="_blank">卖家中心</a>
        </div>	
        <div class="login_type fr d5">
        	<em>
        	<!--登录前-->
        	<?php if(empty($user['uid'])){ ?>
        		<?php $otherlogon=system::getconnect(); ?>
				<?php if(!empty($otherlogon)){ ?>
					<?php foreach ($otherlogon as $key=>$value){ ?>
						<a href="<?=u('user','fastlogin',array('api'=>$key));?>" class="<?=$key;?>_login"><?=$value['name'];?></a>
					<?php } ?>
                |
                <?php } ?>
                <a href="<?=u('user','login');?>">登录</a>
                <a href="<?=u('user','register');?>">免费注册</a>
                <span></span>
           <!--登录后-->
            <?php }else{ ?>
                <span class="fl">您好，</span>
				<div class="deopdown fl">
					<?php if(empty($user['user_name'])){ ?>
					<a href="<?=u('user','center');?>" class="userNike">设置昵称</a>
					<?php }else{ ?>
					<a href="<?=u('user','center');?>" class="userNike"><?=$user['user_name'];?></a>
					<?php } ?>
                    <i class="icon_arrow arrow_down"></i>
                    <ul class="dropdown_menu hidden">
                        <li><a href="<?=u('user','base');?>">账号信息</a></li>
                        <li><a href="<?=u('user','invite');?>">邀请好友</a></li>
                        <li><a href="<?=u('user','fav');?>">我的收藏</a></li>
                        <li><a href="<?=u('user','address');?>">收货地址</a></li>
                        <li><a href="<?=u('user','gift');?>">我的礼品</a></li>
                        <li><a href="<?=u('user','logout');?>">退出</a></li>
                    </ul>
                </div>|
                <span>您当前积分为：</span>
                <a href="<?=u('user','center');?>" class="userNike"><?=$user['integral'];?></a>|
                <a href="<?=u('user','invite');?>" class="msg" target="_blank">邀请好友</a>|
            <?php } ?>  
            </em>
            <div class="hidden"></div>
        </div>		
            	
        <div class="fl d5">
        	<a href="<?=u('index','index');?>" target="_blank"><?=$_webset['site_name'];?></a>
            |
            <a href="<?=u('wap','index');?>" target="_blank">手机版</a>
            <?php if(V_MODE=='vip'){ ?>
            |
            <a href="<?=u($_exc_mod,'index');?>" target="_blank">积分商城</a>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">
//签到选项卡
$(".deopdown").mouseenter(function(){$(this).find(".dropdown_menu").show();})
$(".deopdown").mouseleave(function(){$(this).find(".dropdown_menu").hide();})
</script>
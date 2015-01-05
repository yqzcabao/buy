<?php require tpl_extend("pub/header.tpl");?>
<div class="area MT_20">
	<div class="clear">
            <div class="introduce fl">
                <h3>赚取<?=INTEGRAL;?></h3>
                <a class="more more-fz" href="<?=u(MODNAME,'task');?>">更多&gt;&gt;</a>
                <ul class="clear">
                    <li>
	                    <a href="<?=u('index','index');?>" target="_blank" class="pic introduce-pic fl"></a>
						<span class="introduce-mode fl">
							<p class="title">网站签到</p>
							<p class="num">可得<em class="jf-num01"><?=$_webset['reward_sign_day'];?>-</em><em class="jf-num01"><?=$_webset['reward_daymax'];?></em><?=INTEGRAL;?></p>
							<a href="<?=u('index','index');?>" target="_blank" class="join">立即参与&gt;&gt;</a>
						</span>
                    </li>
                    <li>
                        <a href="<?=u('user','invite');?>" target="_blank" class="pic introduce-pic01 fl"></a>
						<span class="introduce-mode fl">
							<p class="title">邀请好友</p>
							<p class="num">每人可得<em class="jf-num01"><?=$_webset['reward_invite'];?></em><?=INTEGRAL;?></p>
							<a href="<?=u('user','invite');?>" target="_blank" class="join">立即参与&gt;&gt;</a>
						</span>
                    </li>
                    <li>
                    <a href="<?=u('index','index');?>" target="_blank" class="pic introduce-pic04 fl"></a>
					<span class="introduce-mode fl">
						<p class="title">参与评论</p>
						<p class="num">可得<em class="jf-num01"><?=$_webset['reward_comment'];?></em><?=INTEGRAL;?></p>
						<a href="<?=u('index','index');?>" target="_blank" class="join">立即参与&gt;&gt;</a>
					</span>
                    </li>
                    <li>
                    <a href="<?=u('user','base',array('op'=>'account'));?>" target="_blank" class="pic introduce-pic05 fl"></a>
					<span class="introduce-mode fl">
						<p class="title">绑定快捷登录</p>
						<p class="num">可得<em class="jf-num01"><?=$_webset['reward_user_perfect'];?></em><?=INTEGRAL;?></p>
						<a href="<?=u('user','base',array('op'=>'account'));?>" target="_blank" class="join">立即参与&gt;&gt;</a>
					</span>
                    </li>
                </ul>
            </div>
            <?php if(!empty($user['uid'])){ ?>
            <div class="nav-userinfo fl">
                <div class="user-img">
                    <a class="userinfo-img" href="<?=u('user','center');?>">
                    	<img alt="<?=$user['user_name'];?>" src="<?=avatar($user['uid'],'small');?>"></a>
                    <a class="shezhi" href="<?=u('user','base',array('op'=>'avatar'));?>"></a>
                </div>
                <div class="user-personal">
                	<?php if(empty($user['user_name'])){ ?>
					<a href="<?=u('user','center');?>" class="userNike"><span class="name">设置昵称</span></a>
					<?php }else{ ?>
					<a href="<?=u('user','center');?>" class="userNike"><span class="name"><?=$user['user_name'];?></span></a>
					<?php } ?>
					<br>
                    <span class="jf">我的<?=INTEGRAL;?>：<i class="num"><?=$user['integral'];?></i></span><br>
                    <span class="wenzi">连续签到每天最多可获取<em class=" num jf-num01"><?=$_webset['reward_daymax'];?></em>
                </div>
                <div class="user-manage clear">
                    <a href="<?=u('user','gift',array('op'=>'exchange'));?>" class="my-jf active" target="_blank">我的兑换</a>
                    <a href="<?=u('user','address');?>" class="address" target="_blank">收货地址</a>
                </div>
            </div>
            <?php }else{ ?>
            <div class="nav-userlogin fl">
                <p class="title">登录赚<?=INTEGRAL;?></p>
                <p><a href="<?=u('user','login',array('gourl'=>base64_encode(u(MODNAME,'index'))));?>" class="userlogin-btn">登&nbsp;&nbsp;录</a></p>
                <p>注册即得<em class="num jd-num01"><?=$_webset['reward_register'];?></em><?=INTEGRAL;?>
                	<a href="<?=u('user','register');?>" target="_blank" class="register">立即注册</a>
                </p>
            </div>
            <?php } ?>
     </div>
	<div class="jifen-list clear MT_20">
	<ul class="goods-list clear">
	<?php foreach ($exchangelist as $key=>$value){ ?>
	<li>
	    <div class="list-good <?php if($value['num']<=$value['apply'] || $value['end']<$_timestamp){ ?>gone<?php }elseif($value['start']>$_timestamp){ ?>start<?php }else{ ?>buy<?php } ?>">
	        <div class="good-pic">
	            <a target="_blank" href="<?=u(MODNAME,'detail',array('id'=>$value['id']));?>">
	                <img width="290" height="290" data-original="<?=get_img($value['pic'],'290');?>" class="lazy" src="<?=DEF_GD_LOGO;?>" alt="<?=$value['title'];?>" style="display: inline;">
	            </a>
	        </div>
	        <h5 class="good-title">
	            <a target="_blank" href="<?=u(MODNAME,'detail',array('id'=>$value['id']));?>"><?=$value['title'];?></a>
	        </h5>
	        <div class="title-tips">
	            <span class="fl">价值：<em class="old-price"><?=$value['price'];?>元</em></span>
	            <span class="fr">份数：<em class=" jd-num01"><?=$value['apply'];?>/<?=$value['num'];?></em></span>
	        </div>
	        <div class="good-price clear">
	            <span class="price-current"><?=$value['needintegral'];?><em class="unit"><?=INTEGRAL;?></em></span>
	            <div class="btn <?php if($value['num']<=$value['apply'] || $value['end']<$_timestamp){ ?>gone<?php }elseif($value['start']>$_timestamp){ ?>start<?php }else{ ?>buy<?php } ?>">
	            	<a target="_blank" href="<?=u(MODNAME,'detail',array('id'=>$value['id']));?>">
					  <?php if($value['start']>$_timestamp){ ?>
					  <span>即将开始</span>
					  <?php }elseif ($value['end']<$_timestamp){ ?>
					  <span>已结束</span>
					  <?php }elseif ($value['num']<=$value['apply']){ ?>
					  <span>兑光了</span>
					  <?php }elseif ($value['start']<$_timestamp && $value['end']>$_timestamp && $value['num']>$value['apply']){ ?>
					  <span>我要兑换</span>
					  <?php } ?>
	            	</a>
	            </div>
	        </div>
	        <?php if(!empty($user['uid']) && $value['start']<$_timestamp && $value['end']>$_timestamp && $value['num']>$value['apply'] && $user['integral']<$value['needintegral']){ ?>
	        <div class="hover <?php if(($key+1)%3==0){ ?>other<?php } ?>">
	            <p>
	            	当前<?=INTEGRAL;?><span class="green"><?=$user['integral'];?></span><br>
	                还差<?=INTEGRAL;?><span class="red"><?=abs($value['needintegral']-$user['integral']);?></span><br>
	                <a target="_blank" href="<?=u(MODNAME,'task');?>">去赚<?=INTEGRAL;?>&gt;&gt;</a>
	            </p>
	        </div>
	        <?php } ?>
	    </div>
	</li>
	<?php } ?>
	</ul>
	</div>
</div>
<?php require tpl_extend("pub/footer.tpl");?>
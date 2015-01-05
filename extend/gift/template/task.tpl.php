<?php require tpl_extend("pub/header.tpl");?>
<div class="area MT_20">
    <div class="earn">
        <div class="earn-text"><h3>每日任务</h3></div>
        <div class="earn-list">
            <div class="earn-show special-show">
                <div class="earn-img"><a class="icon icon-web  " href="javascript:;"></a></div>
                <div class="behavior">
                    <h3>网站签到</h3>
                    <?php if(!empty($user['uid'])){ ?>
                    <div class="my_store">我的<?=INTEGRAL;?>：<b><?=$user['integral'];?></b><em></em></div>
                    <?php } ?>
                    <span class="includep">
                    <p class="special">点击签到，获得<strong class="strcolor"><?=$_webset['reward_sign_day'];?>-<?=$_webset['reward_daymax'];?></strong><?=INTEGRAL;?></p>
                    <p>每日在<?=$_webset['site_name'];?>签到可得<?=INTEGRAL;?>。第一天签到领取<strong class="strcolor"><?=$_webset['reward_sign_day'];?></strong><?=INTEGRAL;?>，连续</p>
                    <p>签到<?=$_webset['reward_continuous_day'];?>增加<?=$_webset['reward_plus'];?><?=INTEGRAL;?>，签到每天最多可获得<strong class="strcolor"><?=$_webset['reward_daymax'];?></strong><?=INTEGRAL;?>。如果中</p>
                    <p>断领取，又会从<?=$_webset['reward_sign_day'];?><?=INTEGRAL;?>开始。</p>
                   </span>
                    <div class="behavior-img"></div>
                </div>
            </div>
            <div class="earn-show">
                <div class="earn-img"><a href="<?=u('user','invite');?>" target="_blank" class="icon icon-client"></a></div>
                <div class="behavior">
                   <h3>邀请好友</h3>
                   <span class="includep">
                   <p>通过您的专属邀请链接邀请好友注册，您将获得<strong class="strcolor"><?=$_webset['reward_invite'];?></strong><?=INTEGRAL;?>，每</p>
                   <p>日最多可以获得<strong class="strcolor"><?=$_webset['reward_invite_daymax'];?></strong><?=INTEGRAL;?></p>
                  </span>
                    <div class="behavior-img">
                        <p class="show">
                        	<em class="emcolor"><?=$_webset['reward_invite'];?>-</em>
                        	<strong class="strcolor"><?=$_webset['reward_invite_daymax'];?></strong><?=INTEGRAL;?>
                        </p>
                        <a target="_blank" href="<?=u('user','invite');?>">立即参与&gt;&gt;</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="earn">
        <div class="earn-text"><h3>新手任务</h3></div>
        <div class="earn-list">
        	<div class="earn-show">
                <div class="earn-img"><a href="<?=u('user','register');?>" target="_blank" class="icon icon-download"></a></div>
                <div class="behavior">
                   <h3>新用户注册</h3>
                   <span class="includep">
                   <p>新用户成功注册<?=$_webset['site_name'];?>账号登录，可获得<strong class="strcolor"><?=$_webset['reward_register'];?></strong><?=INTEGRAL;?>奖励。</p>
                 </span>
                    <div class="behavior-img">
                        <p class="show"><strong class="strcolor"><?=$_webset['reward_register'];?></strong><?=INTEGRAL;?></p>
                        <?php if(empty($user['uid'])){ ?>
                        <a target="_blank" href="<?=u('user','register');?>">立即参与&gt;&gt;</a>
                        <?php }else{ ?>
                        <div class="error-box"><strong class="ok"></strong>已完成</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="earn-show">
                <div class="earn-img"><a href="<?=u('user','base');?>" target="_blank" class="icon icon-user"></a></div>
                <div class="behavior">
                    <h3>完善注册信息</h3>
                   <span class="includep">
                   <p>新用户注册或联合登录用户完善注册信息可获得<strong class="strcolor"><?=$_webset['reward_user_perfect'];?></strong><?=INTEGRAL;?>。</p>
                  </span>
                    <div class="behavior-img">
                        <p class="show"><em class="emcolor"><?=$_webset['reward_user_perfect'];?></em><?=INTEGRAL;?></p>
                        <?php if(empty($user['perfect'])){ ?>
                        <a target="_blank" href="<?=u('user','base');?>">立即参与&gt;&gt;</a>
                        <?php }else{ ?>
                        <div class="error-box"><strong class="ok"></strong>已完成</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="earn-list">
            <div class="earn-show">
                <div class="earn-img"><a href="<?=u('user','base',array('op'=>'email','email'=>$user['email']));?>" target="_blank" class="icon icon-annount"></a></div>
                <div class="behavior">
                   <h3>认证电子邮箱</h3>
                   <span class="includep">
                   <p>认证邮箱后即可获得<strong class="strcolor"><?=$_webset['reward_auth_email'];?></strong><?=INTEGRAL;?>。</p>
                    </span>
                    <div class="behavior-img">
                        <p class="show"><em class="emcolor"><?=$_webset['reward_auth_email'];?></em><?=INTEGRAL;?></p>
                        <?php if(empty($user['sta'])){ ?>
                        <a target="_blank" href="<?=u('user','base',array('op'=>'email','email'=>$user['email']));?>">立即参与&gt;&gt;</a>
                        <?php }else{ ?>
                        <div class="error-box"><strong class="ok"></strong>已完成</div>
                        <?php } ?>
                     </div>
                </div>
            </div>
            <div class="earn-show">
                <div class="earn-img"><a href="<?=u('user','base',array('op'=>'account'));?>" target="_blank" class="icon icon-iphone"></a></div>
                <div class="behavior">
                    <h3>绑定账号</h3>
                  <span class="includep">
                   <p>绑定第三方社交账号可得贝币。首次绑定第三方社交账号即可获得<strong class="strcolor"><?=$_webset['reward_quick_login'];?></strong><?=INTEGRAL;?>,解绑后无效。。</p>
                 </span>
                    <div class="behavior-img">
                        <p class="show"><strong class="strcolor"><?=$_webset['reward_quick_login'];?></strong><?=INTEGRAL;?></p>
                        <a target="_blank" href="<?=u('user','base',array('op'=>'account'));?>">立即参与&gt;&gt;</a>
                        <!--<div class="error-box"><strong class="ok"></strong>已完成</div>-->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php require tpl_extend("pub/footer.tpl");?>
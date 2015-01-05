<?php require tpl_extend(WAP_TPL.'/pub/header.tpl');?>
<div class="hpz_returntop"><span>我的<?=INTEGRAL;?></span></div>
<div class="mysinfobk">
    <span class="mysphotod">
        <img width="60" height="60" src="<?=avatar($user['uid'],'small');?>">
    </span>
	    <ul>
        <li><?=!empty($user['user_name'])?$user['user_name']:!empty($user['email'])?$user['email']:'未设置昵称';?></li>
        <li><?=$user['integral'];?><?=INTEGRAL;?></li>
    </ul>
    <img style="float: right" src="<?=WAP_TPL_PATH;?>/static/images/mysimg.png">
</div>
<div class="mystabd">
    <div class="mystab">
        <i class="one"></i>
        <ul>
            <li><a href="/?r=mob/user/sign"><h1>签到赚<?=INTEGRAL;?></h1></a></li>
            <li>最多可获得<span><?=$_webset['reward_daymax'];?></span><?=INTEGRAL;?></li>
        </ul>
    </div>
   <!-- <div class="mystab">
        <i class="two"></i>
        <ul>
            <li><a href=""><h1>下载客户端&nbsp;赚积分</h1></a></li>
            <li>赚积分不少&nbsp;特价不断</li>
        </ul>
    </div>-->
</div>
<?php require tpl_extend(WAP_TPL.'/pub/footer.tpl');?>
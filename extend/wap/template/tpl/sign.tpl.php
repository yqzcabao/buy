<?php require tpl_extend(WAP_TPL.'/pub/header.tpl');?>
<?php 
//没签到近日获取
$todaysign = getintegral("today");
$user['today']=$todaysign['integral'];
//明日签到可获取的积分
$tomorrowsign = getintegral("tomorrow");
$user['tomorrowsign']=$tomorrowsign['integral'];

?>
<div class="hpz_returntop"><span>签到</span></div>
<div class="hpz_qdnavbk">
    <div class="hpz_qdnavd">
        <span class="hpz_qdbtn1"><a href="<?=u(MODNAME,'sign',array('hash'=>formhash()));?>">签到&nbsp;领<?=INTEGRAL;?></a></span>
        <span class="hpz_qdw1">签到即可获得<?=$todaysign['integral'];?><?=INTEGRAL;?></span>
    </div>
</div>
<div class="calendard">
    <div class="calendardtit">
        <span><?=date('Y-m-d');?></span>
        <b>签到日历</b>
    </div>
    <ul class="" id="calender"><?=show_sign(date('Y'),date('m'),$sigin_log);?></ul>
</div>

<div class="qdruled">
    <ul>
        <li>签到1天得<?=$_webset['reward_sign_day'];?><?=INTEGRAL;?></li>
        <li>连续签到<?=$_webset['reward_continuous_day'];?>天得<?=$_webset['reward_plus'];?><?=INTEGRAL;?></li>
        <li>每天最多可以获得<?=$_webset['reward_daymax'];?><?=INTEGRAL;?></li>
        <li>注：如果连续中断，则从头开始</li>
    </ul>
</div>
<?php require tpl_extend(WAP_TPL.'/pub/footer.tpl');?>
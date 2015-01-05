<?php require tpl_extend(WAP_TPL.'/pub/header.tpl');?>
<section class="qiandao">
	<article>
    	<div class="fl left">
        	<var><?=date('Y年m月');?> 星期<?=$weekarray[date("w")];?></var>
            <var class="day"><?=date('d');?></var>
        </div>
    	<div class="fr right">
    		<?php 
    		//没签到近日获取
    		$todaysign = getintegral("today");
    		$user['today']=$todaysign['integral'];
    		//明日签到可获取的积分
    		$tomorrowsign = getintegral("tomorrow");
    		$user['tomorrowsign']=$tomorrowsign['integral'];
			?>
            <p>
              连续签到<?=$user['sign'];?>天 
              <?php if($user['lastsign']>strtotime('today')){ ?>
	        	<p>明日签到获得:<b><?=$user['tomorrowsign'];?></b><?=INTEGRAL;?></p>
	          <?php }else{ ?>
	           	<p>今天签到可赚：<b><?=$user['today'];?></b> <?=INTEGRAL;?></p>
			  <?php } ?>
            </p>
            <h5><b>我的积分：</b><i class="co1"><?=$user['integral'];?></i></h5>
            <?php if($user['lastsign']<strtotime('today')){ ?>
            <h6 id="weiqiandao"><span><a href="<?=u(MODNAME,'sign',array('hash'=>formhash()));?>">签&nbsp;到</a></span></h6>
            <?php }else{ ?>
            <h6 class="yiqiandao">
            	<span class="sug">已&nbsp;签</span>
            </h6>
            <?php } ?>
        </div
    ></article>
    <ul class="calender">
        <hgroup>
        	<span class="fl"></span>
        	<span class="fl"></span>
        	<span class="fl"></span>
        	<span class="fl"></span>
        	<span class="fl"></span>
        	<span class="fl"></span>
        	<span class="fl"></span>
        </hgroup>
        <?=printCal(date('Y'),date('m'),$sigin_log);?>
    </ul>
    <article>
        <hgroup><b>签到规则</b></hgroup>
        <p>签到1天得<?=$_webset['reward_sign_day'];?><?=INTEGRAL;?></p>
        <p>连续签到<?=$_webset['reward_continuous_day'];?>天递增<?=$_webset['reward_plus'];?><?=INTEGRAL;?></p>
        <p>每天最多可以获得<?=$_webset['reward_daymax'];?><?=INTEGRAL;?></p>
        <p>注: 如果连续签到中断则从头开始</p>
    </article>
</section>
<?php require tpl_extend(WAP_TPL.'/pub/footer.tpl');?>
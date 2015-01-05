<!--//导航-->
<div id="head_nav">
	<div class="area clearfix">
		<div class="left">
		<?php if(MODNAME!='business'){ ?>
			<?php foreach ($_nav as $key=>$value){ ?>
	    		<?php if($value['hide']!=1){ ?>
	        	<a class="<?php if($value['tag']==$_navtag){ ?>on<?php } ?>" href="<?=!empty($value['url'])?$value['url']:u($value['mod'],$value['ac']);?>" <?php if($value['target']==1){ ?>target="_blank"<?php } ?>><?=$value['name'];?><i></i></a>
	        	<?php } ?>
	        <?php } ?>
        <?php }else{ ?>
    		<a class="fl" href="<?=u('index','index');?>">首页<i></i></a>
    		<a class="fl <?php if('index'==ACTNAME){ ?>on<?php } ?>" href="<?=u('business','index');?>">报名中心<i></i></a>
    		<a class="fl <?php if('info'==ACTNAME){ ?>on<?php } ?>" href="<?=u('business','info');?>">活动准备<i></i></a>
    		<a class="fl <?php if('list'==ACTNAME){ ?>on<?php } ?>" href="<?=u('business','list');?>">审核结果</a>
    	<?php } ?>
		</div>
		<?php if(MODNAME!='business'){ ?>
		<ul class="fr">
			<li class="sign_panel">
				<a href="javascript:;" class="signin"><em></em>签到换礼<?php if($user['lastsign']<strtotime('today')){ ?><i class="focus"></i><?php } ?></a>
				<div class="dropdown-menu">
					<dl>
					<?php if(empty($user['uid'])){ ?>
						<dt>每天最多可赚：<b><?=$_webset['reward_daymax'];?></b>&nbsp;<?=INTEGRAL;?><br><a href="javascript:void(0);" onclick="login_box();" class="cnlogin">登录</a>&nbsp;后才能签到<br></dt>
						<dd><p><a href="javascript:void(0);" rel="nofollow">签到得<?=$_webset['reward_sign_day'];?><?=INTEGRAL;?></a>&nbsp;|&nbsp;<a target="_blank" href="<?=u($_exc_mod,'index');?>" rel="nofollow"><?=INTEGRAL;?>兑换</a></p></dd>
					</dl>
					<?php }else{ ?>
					<?php 
        			//没签到近日获取
					$todaysign = getintegral("today");
					$user['today']=$todaysign['integral'];
					//明日签到可获取的积分
					$tomorrowsign = getintegral("tomorrow");
					$user['tomorrowsign']=$tomorrowsign['integral'];
					//今日以获取的
					$todayhade=getintegral("todayhade");
					$user['todayhade']=$tomorrowsign['integral'];
        			?>
        			<?php if($user['lastsign']>strtotime('today')){ ?>
						<dt>连续签到：<?=$user['sign'];?>天，<?=INTEGRAL;?><b>+<?=$user['today'];?></b><br>明天签到可获得<b><?=$user['tomorrowsign'];?></b></dt>
						<dd><p><span>我的<?=INTEGRAL;?>：</span><a target="_blank" href="<?=u('user','center');?>" rel="nofollow"><b><?=$user['integral'];?></b></a>&nbsp;|&nbsp;<a target="_blank" href="<?=u($_exc_mod,'index');?>"><?=INTEGRAL;?>兑换</a></p></dd>
					<?php }else{ ?>
						<dt>连续签到：<?=$user['sign'];?>天<br>签到即可获得<b><?=$user['today'];?></b></dt>
						<dd><p><span>我的<?=INTEGRAL;?>：</span><a target="_blank" href="<?=u('user','center');?>" rel="nofollow"><b><?=$user['integral'];?></b></a>&nbsp;|&nbsp;<a target="_blank" href="<?=u($_exc_mod,'index');?>"><?=INTEGRAL;?>兑换</a></p></dd>
					<?php } ?>
					<?php } ?>
					</dl>
				</div>
			</li>
		</ul>
		<div class="fr"><a href="<?=u('index','tomorrow');?>">精选预告<i class="new"></i></a></div>
		<?php } ?>
	</div>
</div>
<div class="head_nav">
<div class="head_nav_c area">
    	<div class="fl nav_list">
    		<?php if(MODNAME!='business'){ ?>
	    		<?php foreach ($_nav as $key=>$value){ ?>
	    		<?php if($value['hide']!=1){ ?>
	        	<a class="fl <?php if($value['tag']==$_navtag){ ?>on<?php } ?>" href="<?=!empty($value['url'])?$value['url']:u($value['mod'],$value['ac']);?>" <?php if($value['target']==1){ ?>target="_blank"<?php } ?>><?=$value['name'];?><i></i></a>
	        	<?php } ?>
	        	<?php } ?>
        	<?php }else{ ?>
        		<a class="fl" href="<?=u('index','index');?>">首页<i></i></a>
        		<a class="fl <?php if('index'==ACTNAME){ ?>on<?php } ?>" href="<?=u('business','index');?>">报名中心<i></i></a>
        		<a class="fl <?php if('info'==ACTNAME){ ?>on<?php } ?>" href="<?=u('business','info');?>">活动准备<i></i></a>
        		<a class="fl <?php if('list'==ACTNAME){ ?>on<?php } ?>" href="<?=u('business','list');?>">审核结果</a>
        	<?php } ?>
        </div>
        <div class="r_con fr">
        	<div class="yg_wrap fl">
            	<a href="<?=u('index','tomorrow');?>" class="yg">
                	精选预告
                   <i class="icon_mini"></i>
                   <i class="line"></i>
                </a>
            </div>
            <div class="deopdown singn_panel fl">
            	<a class="<?php if($user['lastsign']>strtotime('today')){ ?>singined<?php }else{ ?>singin<?php } ?>" href="javascript:void(0);"></a>
                <div class="dropdown_menu hidden">
                	<div class="login_board">
                    	<div class="con">
                    		<?php if(empty($user['uid'])){ ?>
                    		<p>每天最多可赚：<b><?=$_webset['reward_daymax'];?></b> <?=INTEGRAL;?></p>
                           	<p><a target="_blank" href="<?=u('user','login');?>">登录</a>后才能签到</p>
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
                    			<p>我的<?=INTEGRAL;?>：<b><?=$user['integral'];?></b><?=INTEGRAL;?></p>
	                        	<p>连续签到：<?=$user['sign'];?> 天</p>
	                        	<?php if($user['lastsign']>strtotime('today')){ ?>
	                        	<p>明日签到获得:<b><?=$user['tomorrowsign'];?></b><?=INTEGRAL;?></p>
	                           	<?php }else{ ?>
	                           	<p>今天签到可赚：<b><?=$user['today'];?></b> <?=INTEGRAL;?></p>
								<?php } ?>
	                           	<p>连续签到最多可赚：<b><?=$_webset['reward_daymax'];?></b> <?=INTEGRAL;?></p>
                           	<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
</div>
</div>
<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/gift.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript">
	$(function(){
		$(".describe_goods h2 em").mousemove(function(){
			$(this).addClass("on");
			$(this).children(".shareLi").removeClass("hidden").show();
		})
		$(".describe_goods h2 em").mouseleave(function(){
			$(this).removeClass("on");
			$(this).children(".shareLi").addClass("hidden");
		})	
	})
</script>
<div class="detail_c mauto area">
<div class="content_left fl">
	<div class="img">
		<a <?=gogood($try['num_iid'],true);?> title="<?=$try['title'];?>">
			<img src="<?=get_img($try['pic'],'290');?>" class="lazy" alt="<?=$try['title'];?>"/>
		</a>
		<span class="bsr"></span>
	</div>
	<?php 
		//热门试用
		$hottry=hottry($try['id']);
		if(!empty($hottry)){ 
	?>
	<div class="hotactivity">
		<h2>热门试用活动...</h2>
		<?php foreach ($hottry as $key=>$value){ ?>
		<ul>
			<li>
				<a href="<?=u('try','detail',array('id'=>$value['id']));?>" target="_blank" title="<?=$value['title'];?>">
					<img class="fl" src="<?=get_img($value['pic'],'290');?>" style="width:60px;" alt="<?=$value['title'];?>" />
				</a>
				<h3>
					<a href="<?=u('exchange','detail',array('id'=>$value['id']));?>" target="_blank" title="<?=$value['title'];?>"><?=$value['title'];?></a>
				</h3>
				<p>
					<strong><?=$value['apply'];?></strong>人申请
				</p>
			</li>
		</ul>
		<?php } ?>
	</div>
	<?php } ?>
	<?php $whogettry=whogettry($try['id'],10);?>
	<?php if(!empty($whogettry)){ ?>
	<div class="content_left_last">
		<h2>谁获取了试用?</h2>
		<ul class="clear">
			<?php foreach ($whogettry as $key=>$value){ ?>
			<li>
			  <a href="javascript:void(0)" title="<?=$value['user_name'];?>">
				<img alt="<?=$value['user_name'];?>" src="<?=avatar($value['uid'],'small');?>" title="<?=$value['user_name'];?>">
			  </a>
			</li>
			<?php } ?>
		</ul>
	</div>
	<?php } ?>
</div>
<div class="content_right fr">
	<div class="describe_goods">
		<h2>
		   <span class="fl"><?=$try['title'];?></span>
		   <em class="">分享 
		   		<i class="hidden shareLi">
				<a class="sina fl" onclick="share.doShare('t_sina',{'url':'<?=u('try','detail',array('id'=>$try['id']));?>','title':'<?=$try['title'];?>','pic':'<?=get_img($try['pic']);?>'});"></a>
				<a class="qqwb fl" onclick="share.doShare('t_qq',{'url':'<?=urlencode(u('try','detail',array('id'=>$try['id'])));?>','title':'<?=$try['title'];?>','pic':'<?=urlencode(get_img($try['pic']));?>'});"></a>
				<a class="renren fl" onclick="share.doShare('renren',{'url':'<?=urlencode(u('try','detail',array('id'=>$try['id'])));?>','title':'<?=$try['title'];?>','pic':'<?=urlencode(get_img($try['pic']));?>'}});"></a>
				<a class="kaixin fl" onclick="share.doShare('kaixin',{'url':'<?=urlencode(u('try','detail',array('id'=>$try['id'])));?>','title':'<?=$try['title'];?>','pic':'<?=urlencode(get_img($try['pic']));?>'}});"></a>
				<a class="douban fl" onclick="share.doShare('douban',{'url':'<?=urlencode(u('try','detail',array('id'=>$try['id'])));?>','title':'<?=$try['title'];?>','pic':'<?=urlencode(get_img($try['pic']));?>'}});"></a>
				<a class="qzong" onclick="share.doShare('qzone',{'url':'<?=urlencode(u('try','detail',array('id'=>$try['id'])));?>','title':'<?=$try['title'];?>','pic':'<?=urlencode(get_img($try['pic']));?>'});"></a>
				</i>
		   </em>
		</h2>
		<h3>试用所需<?=INTEGRAL;?>：<em><?=$try['needintegral'];?></em>
		  <?=INTEGRAL;?>&nbsp;&nbsp;|&nbsp;&nbsp;
		  价值: <?=$try['price'];?>&nbsp;&nbsp;|&nbsp;&nbsp;
		  试用名额<strong><?=$try['num'];?></strong>
		</h3>
		<?php if($try['num']<=$try['payment']){?>
			<h5>距离活动结束：<span>活动已结束</span></h5>
		<?php }elseif($try['end']>$_timestamp){ ?>
			<?php if($try['start']>$_timestamp){ ?>
			<h5>距离活动开始：<span class="countdown"></span></h5>
			<script type="text/javascript">countdown(<?=($try['start']-$_timestamp);?>);</script>
			<?php }else{ ?>
			<h5>距离活动结束：<span class="countdown"></span></h5>				
			<script type="text/javascript">countdown(<?=($try['end']-$_timestamp);?>);</script>
			<?php } ?>
		<?php } ?>
		<h4>
		  <?php if($try['start']>$_timestamp){ ?>
			  <!--//即将开始-->
			  <a <?=gogood($try['num_iid'],true);?> title="<?=$try['title'];?>" class="btn jjks">即将开始</a>
		  <?php }elseif($try['end']<$_timestamp){ ?>
			  <a <?=gogood($try['num_iid'],true);?> title="<?=$try['title'];?>" class="btn over">试用已结束</a>
		  <?php }elseif($try['start']<$_timestamp && $try['end']>$_timestamp){ ?>
		  	  <?php if($try['num']<=$try['payment']){?>
				<a <?=gogood($try['num_iid'],true);?> title="<?=$try['title'];?>" class="btn over">试用已结束</a>
		  	  	<a class="hasbd" href="javascript:void(0);"><?=$try['apply'];?>人已申请</a>
			  <?php }else{ ?>
					  <?php if($try['start']>$_timestamp){ ?>
					  	<a <?=gogood($try['num_iid'],true);?> title="<?=$try['title'];?>" class="btn jjks">即将开始</a>
					  <?php }elseif($try['end']<$_timestamp){ ?>
					  	  <a <?=gogood($try['num_iid'],true);?> title="<?=$try['title'];?>" class="btn over">试用已结束</a>
					  	  <a class="hasbd" href="javascript:void(0);"><?=$try['apply'];?>人已申请</a>
					  <?php }elseif ($try['start']<$_timestamp && $try['end']>$_timestamp){ ?>
					  <a href="<?=u('try','apply',array('id'=>$try['id']));?>" class="btn" title="<?=$try['title'];?>">
					  	  立即试用
					  </a>
					  <a class="hasbd" href="javascript:void(0);">
				  	  	<?=$try['apply'];?>人已申请
				  	  </a>	  
					  <?php } ?>
			  <?php } ?>
		  	  <em>(剩余<b>
		  	  	<?php if(($try['num']-$try['payment'])<=0){?>
		  	  		0
		  	  	<?php }elseif(($try['num']-$try['payment'])>0){ ?>
		  	  		<?=$try['num']-$try['payment'] ?>
		  	  	<?php } ?></b>件)</em>
		  <?php } ?>
		  <?php if($try['start']>$_timestamp){ ?>
		  <i>开始申请试用时间：<?=date('m-d H:i',$try['start']);?> </i>
		  <?php } ?>
	   </h4>
	   <?php if(!empty($try['remark'])){?>
	   <p class="xbtx">小编提醒:<?=$try['remark'];?></p>
	   <?php } ?>
	</div>
	<?php 
		$commentresult=commentlist($try['id'],'try');
		$suncommentresult=suncommentlist($try['id'],'try'); 
	?>
	<div class="J_TabBarWrap">
	  <ul class="tb-tabbar">
		<li class="selected fl">
			<a href="javascript:void(0)" hidefocus="true">兑奖规则</a>
		</li>
		<li class="fl">
			<a href="javascript:void(0)" hidefocus="true">申请记录(<em><?=$try['apply'];?></em>)</a>
		</li>
		<li class="fl">
			<a href="javascript:void(0)" hidefocus="true">晒单分享(<em><?=$suncommentresult['total'];?></em>)</a>
		</li>
	  </ul>
	</div>
	
	<div class="fl displayIF" id="tab0">
	  <div class="topinfo fl"></div>
	  <div class="blockCJ fl"><?=$_webset['try_rule'];?></div>
	</div>
	<!--//试用申请-->
	<style type="text/css">#tab1{display:none}</style>
	<?php include(PATH_TPL."/public/commentlist.tpl");?>
	<!--//试用晒单-->
	<style type="text/css">#tab2{display:none}</style>
	<?php include(PATH_TPL."/public/suncommentlist.tpl");?>
</div>
</div>
<?php include(PATH_TPL."/footer.tpl.php");?>
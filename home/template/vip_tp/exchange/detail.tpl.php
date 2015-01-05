<?php include(PATH_TPL."/header.tpl.php");?>
<?php 
	$commentresult=commentlist($exchange['id'],'exchange');
	$suncommentresult=suncommentlist($exchange['id'],'exchange'); 
?>
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
			<a <?=gogood($exchange['num_iid'],true);?> title="<?=$exchange['title'];?>" >
			<img src="<?=get_img($exchange['pic'],'290');?>" class="lazy" alt="<?=$exchange['title'];?>"/>
			</a>
			<span class="bsr"></span>
		</div>
		<?php 
			//热门兑换
			$hotexc=hotexc($exchange['id']);
			if(!empty($hotexc)){
		?>
		<div class="hotactivity">
			<h2>热门兑换活动...</h2>
			<?php foreach ($hotexc as $key=>$value){ ?>
			<ul>
				<li>
					<a href="<?=u('exchange','detail',array('id'=>$value['id']));?>" target="_blank" title="<?=$value['title'];?>">
						<img class="fl" src="<?=get_img($value['pic'],'290');?>" style="width:60px;" alt="<?=$value['title'];?>" />
					</a>
					<h3>
						<a href="<?=u('exchange','detail',array('id'=>$value['id']));?>" target="_blank" title="<?=$value['title'];?>">
						<?=$value['title'];?>
						</a>
					</h3>
					<?php if($value['apply']>0){ ?>
					<p>
						<strong><?=$value['apply'];?></strong>人已经兑换
					</p>
					<?php } ?>
				</li>
			</ul>
			<?php } ?>
		</div>
		<?php } ?>
		
		<?php 
		if (!empty($commentresult))
		{
			$commentlist=$commentresult['data'];
			if(!empty($commentlist)){
		?>
		<div class="content_left_last">
			<h2>谁兑换了礼品？</h2>
			<ul class="clear">
				<?php foreach ($commentlist as $key=>$value){ ?>
				<li>
				  <a href="javascript:void(0);">
					<img alt="<?=$value['user_name'];?>" src="<?=avatar($value['uid'],'small');?>" title="<?=$value['user_name'];?>">
				  </a>
				</li>
				<?php } ?>
			</ul>
		</div>
		<?php 
			}
		}
		?>
	</div>
	<div class="content_right fr">
		<div class="describe_goods">
			<h2>
			   <span class="fl"><?=$exchange['title'];?></span>
			   <em class="">分享 
			   		<i class="hidden shareLi">
					<a class="sina fl" onclick="share.doShare('t_sina',{'url':'<?=u('exchange','detail',array('id'=>$exchange['id']));?>','title':'<?=$exchange['title'];?>','pic':'<?=get_img($exchange['pic']);?>'});"></a>
					<a class="qqwb fl" onclick="share.doShare('t_qq',{'url':'<?=urlencode(u('exchange','detail',array('id'=>$exchange['id'])));?>','title':'<?=$exchange['title'];?>','pic':'<?=urlencode(get_img($exchange['pic']));?>'});"></a>
					<a class="renren fl" onclick="share.doShare('renren',{'url':'<?=urlencode(u('exchange','detail',array('id'=>$exchange['id'])));?>','title':'<?=$exchange['title'];?>','pic':'<?=urlencode(get_img($exchange['pic']));?>'}});"></a>
					<a class="kaixin fl" onclick="share.doShare('kaixin',{'url':'<?=urlencode(u('exchange','detail',array('id'=>$exchange['id'])));?>','title':'<?=$exchange['title'];?>','pic':'<?=urlencode(get_img($exchange['pic']));?>'}});"></a>
					<a class="douban fl" onclick="share.doShare('douban',{'url':'<?=urlencode(u('exchange','detail',array('id'=>$exchange['id'])));?>','title':'<?=$exchange['title'];?>','pic':'<?=urlencode(get_img($exchange['pic']));?>'}});"></a>
					<a class="qzong" onclick="share.doShare('qzone',{'url':'<?=urlencode(u('exchange','detail',array('id'=>$exchange['id'])));?>','title':'<?=$exchange['title'];?>','pic':'<?=urlencode(get_img($exchange['pic']));?>'});"></a>
					</i>
			   </em>
			</h2>
			<h3>兑奖所需<?=INTEGRAL;?>：<em><?=$exchange['needintegral'];?></em><?=INTEGRAL;?>&nbsp;&nbsp;|&nbsp;&nbsp;
			  价值: <?=$exchange['price'];?>&nbsp;&nbsp;|&nbsp;&nbsp;
			  兑奖名额<strong><?=$exchange['num'];?></strong>
			</h3>
			<?php if($exchange['num']<=$exchange['apply']){?>
				<h5>距离活动结束：<span>活动已结束</span></h5>
			<?php }elseif($exchange['end']>$_timestamp){ ?>
				<h5>距离活动结束：<span class="countdown"></span></h5>
				<script type="text/javascript">countdown(<?=($exchange['end']-$_timestamp);?>);</script>
			<?php } ?>
			<h4>
			<?php if($exchange['num']<=$exchange['apply']){?>
				<a <?=gogood($exchange['num_iid'],true);?> title="<?=$exchange['title'];?>" class="btn over">兑换已结束</a>
			    <a class="hasbd" href="javascript:void(0);">
			  	  	<?=$exchange['apply'];?>人已经兑换
			  	</a>
			  	<em>(剩余<b>
			  	<?php if(($exchange['num']-$exchange['apply'])<=0){?>
		  	  		0
		  	  	<?php }elseif(($exchange['num']-$exchange['apply'])<0){ ?>
		  	  		<?=$exchange['num']-$exchange['apply'] ?>
		  	  	<?php } ?></b>件)</em>
			<?php }else{ ?>
			  <?php if($exchange['start']>$_timestamp){ ?>
				  <a <?=gogood($exchange['num_iid'],true);?> title="<?=$exchange['title'];?>" class="btn jjks">即将开始</a>
				  <?php if($exchange['start']>$_timestamp){ ?>
			  		<i>开始兑换时间：<?=date('m-d H:i',$exchange['start']);?> </i>
			  	  <?php } ?>
			  <?php }elseif($exchange['end']<$_timestamp){ ?>
				  <a <?=gogood($exchange['num_iid'],true);?> title="<?=$exchange['title'];?>" class="btn over">兑换已结束</a>
				   <a class="hasbd" href="javascript:void(0);">
			  	  	<?=$exchange['apply'];?>人已经兑换
			  	   </a>
			  	   <em>(剩余<b><?=($exchange['num']-$exchange['apply']);?></b>件)</em>
			  <?php }elseif($exchange['start']<$_timestamp && $exchange['end']>$_timestamp){ ?>
			  	  <a href="<?=u('exchange','apply',array('id'=>$exchange['id']));?>" class="btn" title="<?=$exchange['title'];?>">
			  	  我要兑换
			  	  </a>
			  	  <a class="hasbd" href="javascript:void(0);">
			  	  	<?=$exchange['apply'];?>人已经兑换
			  	  </a>
			  	  <em>(剩余<b><?=($exchange['num']-$exchange['apply']);?></b>件)</em>
			  <?php } ?>
		   <?php } ?>
		   </h4>
		   <?php if(!empty($exchange['remark'])){?>
		   <p class="xbtx">小编提醒:<?=$exchange['remark'];?></p>
		   <?php } ?>
		</div>
		<div class="J_TabBarWrap">
		  <ul class="tb-tabbar">
			<li class="selected fl">
				<a href="javascript:void(0)" hidefocus="true">兑奖规则</a>
			</li>
			<li class="fl">
				<a href="javascript:void(0)" hidefocus="true">申请记录(<em><?=$exchange['apply'];?></em>)</a>
			</li>
			<li class="fl">
				<a href="javascript:void(0)" hidefocus="true">晒单分享(<em><?=$suncommentresult['total'];?></em>)</a>
			</li>
		  </ul>
		</div>
		
		<div class="fl displayIF" id="tab0">
		  <div class="topinfo fl"></div>
		  <div class="blockCJ fl"><?=$_webset['exchange_rule'];?></div>
		</div>
		<!--//积分兑换-->
		<style type="text/css">#tab1{display:none}</style>
		<?php include(PATH_TPL."/public/commentlist.tpl");?>	
	 	<!--//试用晒单-->
		<style type="text/css">#tab2{display:none}</style>
		<?php include(PATH_TPL."/public/suncommentlist.tpl");?>
		
	</div>
</div>
<?php include(PATH_TPL."/footer.tpl.php");?>
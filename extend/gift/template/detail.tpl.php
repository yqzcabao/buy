<?php require tpl_extend("pub/header.tpl");?>
<div class="detail_c area MT_20">
	<div class="content_left fl">
		<div class="img">
			<a <?=gogood($exchange['num_iid'],true);?> title="<?=$exchange['title'];?>">
				<img src="<?=DEF_GD_LOGO;?>" data-original="<?=get_img($exchange['pic'],'310');?>" class="lazy" alt="<?=$exchange['title'];?>">
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
					<a href="<?=u(MODNAME,'detail',array('id'=>$value['id']));?>" target="_blank" title="<?=$value['title'];?>">
						<img class="fl" src="<?=get_img($value['pic'],'290');?>" style="width:60px;" alt="<?=$value['title'];?>" />
					</a>
					<h3>
						<a href="<?=u(MODNAME,'detail',array('id'=>$value['id']));?>" target="_blank" title="<?=$value['title'];?>">
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
		<?php }}?>
	</div>
	<div class="content_right fr">
		<div class="describe_goods">
			<h2>
			   <span class="fl"><?=$exchange['title'];?></span>
			   <em class="">分享 
			   		<i class="hidden shareLi">
					<a class="sina fl" onclick="share.doShare('t_sina',{'url':'<?=urlencode(u('exchange','detail',array('id'=>$exchange['id'])));?>','title':'<?=$exchange['title'];?>','pic':'<?=get_img($exchange['pic']);?>'});"></a>
					<a class="qqwb fl" onclick="share.doShare('t_qq',{'url':'<?=urlencode(u('exchange','detail',array('id'=>$exchange['id'])));?>','title':'<?=$exchange['title'];?>','pic':'<?=urlencode(get_img($exchange['pic']));?>'});"></a>
					<a class="renren fl" onclick="share.doShare('renren',{'url':'<?=urlencode(u('exchange','detail',array('id'=>$exchange['id'])));?>','title':'<?=$exchange['title'];?>','pic':'<?=urlencode(get_img($exchange['pic']));?>'}});"></a>
					<a class="kaixin fl" onclick="share.doShare('kaixin',{'url':'<?=urlencode(u('exchange','detail',array('id'=>$exchange['id'])));?>','title':'<?=$exchange['title'];?>','pic':'<?=urlencode(get_img($exchange['pic']));?>'}});"></a>
					<a class="douban fl" onclick="share.doShare('douban',{'url':'<?=urlencode(u('exchange','detail',array('id'=>$exchange['id'])));?>','title':'<?=$exchange['title'];?>','pic':'<?=urlencode(get_img($exchange['pic']));?>'}});"></a>
					<a class="qzong" onclick="share.doShare('qzone',{'url':'<?=urlencode(u('exchange','detail',array('id'=>$exchange['id'])));?>','title':'<?=$exchange['title'];?>','pic':'<?=urlencode(get_img($exchange['pic']));?>'});"></a>
					</i>
			   </em>
			</h2>
			<h3>兑奖所需<?=INTEGRAL;?>：<em><?=$exchange['needintegral'];?></em><?=INTEGRAL;?>&nbsp;&nbsp;|&nbsp;&nbsp;
			  价值: <?=$exchange['price'];?>元&nbsp;&nbsp;|&nbsp;&nbsp;
			  兑奖名额<strong><?=$exchange['num'];?></strong>
			</h3>
			<?php if($exchange['num']<=$exchange['apply']){?>
				<h5>距离活动结束：<span>活动已结束</span></h5>
			<?php }elseif($exchange['end']>$_timestamp){ ?>
				<h5>距离活动结束：<span class="countdown"></span></h5>
				<script type="text/javascript">countdown(<?=($exchange['end']-$_timestamp);?>);</script>
			<?php } ?>
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
			<h4>
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
				  <a href="<?=u(MODNAME,'apply',array('id'=>$exchange['id']));?>" class="btn" title="<?=$exchange['title'];?>">
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
				<a href="javascript:void(0)" hidefocus="true">申请记录<?php if(!empty($exchange['apply'])){ ?>(<em><?=$exchange['apply'];?></em>)<?php } ?></a>
			</li>
			<li class="fl">
				<a href="javascript:void(0)" hidefocus="true">晒单分享<?php if(!empty($suncommentresult['total'])){ ?>(<em><?=$suncommentresult['total'];?></em>)<?php } ?></a>
			</li>
		  </ul>
		</div>
		
		<div class="fl displayIF" id="tab0">
		  <div class="topinfo fl"></div>
		  <div class="blockCJ fl"><?=$_webset['exchange_rule'];?></div>
		</div>
		<!--//兑换记录-->
	 	<div class="clear displayIF" id="tab1" style="display: none;">
          <div class="topinfo"></div>
          <div class="uslist">
          		<?php if(empty($commentlist)){ ?>
          		<div class="plzw" style="display:none;">捡到宝了，这件商品还没有人进行过兑换，快来参与兑换！</div>
          		<?php }else{ ?>
          		<div class="tit"><span class="w1">用户名</span><span class="w2">属性</span><span class="w3">兑换时间</span></div>
          		<ul id="rlist" class="dhuan">
          			<?php foreach ($commentlist as $key=>$value){ ?>
          			<li>
          				<span class="w1"><a href="javascript:void(0);" target="_blank"><?=$value['user_name'];?></a></span>
          				<span class="w2">29 红色</span>
          				<span class="w3"><?=date('Y-m-d H:i:s',$value['addtime']);?></span>
          			</li>
          			<?php } ?>	
          		</ul>
          		<div class="list_page"></div>
          		<?php } ?>
          	</div>
        </div>
	 	<!--//晒单记录-->
	 	<div class="clear displayIF" id="tab2" style="display: none;">
          <div class="topinfo"></div>
          <div class="plzw" style="display:none;">这些人都太懒了！</div>
        </div>
	</div>
</div>
<script type="text/javascript" src="static/js/share.js"></script>
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
<?php require tpl_extend("pub/footer.tpl");?>
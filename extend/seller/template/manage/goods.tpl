<div class="blcokB">
	<span class="fl s1">活动详情</span>
	<span class="fl s2">现/原价格</span>
	<span class="fl s2">报名活动</span>
	<span class="fl s2">活动分类</span>
	<span class="fl s3">包邮</span>
	<span class="fl s3">付费</span>
	<span class="fl s4">报名时间</span>
	<span class="fl s4">状态</span>
	<span class="fl s5">操作</span>
</div>
<div class="blcokC activity_detail">
<?php foreach ($goodslist as $key=>$value){ ?>
	<div class="blcokC_bottom clear">
		<span class="fl s1">
			<a target="_blank" href="http://item.taobao.com/item.htm?id=<?=$value['num_iid'];?>">
				<img src="<?=$value['pic'];?>" class="fl"><?=$value['title'];?></a>
			<?php if($value['status']==1){ ?>
			<p class="neg">活动时间:<?=date('m/d H:i',$value['start']);?>-<?=date('m/d H:i',$value['end']);?></p>
			<?php } ?>
		</span>
		<span class="s2 fl"><?=$value['promotion_price'];?>/<?=$value['price'];?></span>		
	 	<span class="s2 fl">
	 		<?php if($value['aid']>0){ ?>
	 		<?=$album_list[$value['aid']]['title'];?>
	 		<?php }elseif ($value['aid']<0){ ?>
		 		<?=$special_list[abs($value['aid'])]['title'];?>
		 		<br/>
		 		<b style="color:red"><?=$special_position[$value['pay_id']]['name'];?></b>
	 		<?php }else{ ?>
	 		<?=$channel_list[$value['channel']];?>
	 		<?php } ?>
	 	</span>
		<span class="s2 fl"><?=$catlist['cid_'.$value['cat']]['title'];?></span>
		<span class="s3 fl neg">
			<?php if($value['ispost']==1){ ?>是
			<?php }else{ ?>否<?php } ?>
		</span>
		<span class="s3 fl">
			<?php if($value['pay_type']==1){ ?><?=$value['pay_money'];?><?php }else{ ?>--<?php } ?>
		</span>
		<span class="s4 fl"><?=date('y/m/d H:i',$value['addtime']);?></span>
	 	<span class="s4 fl neg">
	 		<?php if($value['status']==-1){ ?>未通过
	 		<?php }elseif($value['status']==0){ ?>待审核
	 		<?php }elseif($value['status']==1){ ?>
	 			<?php if($value['end']<$_timestamp){ ?>已结束
	 			<?php }elseif($value['start']>$_timestamp){ ?>已排期
	 			<?php }else{ ?>上线中<?php } ?>
	 		<?php } ?>
	 	</span>
	 	<span class="s5 fl">
	 		<?php if(!($value['status']==1 && $value['end']>$_timestamp)){ ?>
		 		<?php if($value['status']==0 && $value['pay_type']==1 && empty($value['pay_serialno'])){ ?>
		 		<a href="<?=u(MODNAME,'callback',array('op'=>'appaly','type'=>$op,'id'=>$value['id']));?>">立即付款</a>
		 		<?php } ?>
		  		<a href="<?=u(MODNAME,'deals',array('type'=>$op,'id'=>$value['id']));?>">编辑</a>
		  		<?php if($value['status']!=1 && empty($value['pay_serialno'])){ ?>
				<a href="<?=u(MODNAME,'del',array('type'=>$op,'id'=>$value['id']));?>">删除</a>
				<?php } ?>
			<?php } ?>
		</span>
	</div>
	<?php if($value['status']==-1){ ?>
	<div class="product-audit">
	    <div class="todo"><span class="daiban">未通过理由</span></div>
	    <span class="ad-tips ad-tips01"><?=$value['refuse'];?></span>
	</div>
	<?php } ?>
<?php } ?>
</div>
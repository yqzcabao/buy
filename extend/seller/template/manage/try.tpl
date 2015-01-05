<div class="blcokB">
	<span class="fl s6">活动详情</span>
	<span class="fl s7">现/原价格</span>
	<span class="fl s3">数量</span>
	<span class="fl s4">报名时间</span>
	<span class="fl s4">状态</span>
	<span class="fl s5">操作</span>
</div>
<div class="blcokC activity_detail">
<?php foreach ($trylist as $key=>$value){ ?>
	<div class="blcokC_bottom clear">
		<span class="s6 fl">
			<a target="_blank" href="http://item.taobao.com/item.htm?id=<?=$value['num_iid'];?>">
				<img src="<?=$value['pic'];?>" class="fl"><?=$value['title'];?></a>
			<?php if($value['status']==1){ ?>
			<p class="neg">活动时间:<?=date('m/d H:i',$value['start']);?>-<?=date('m/d H:i',$value['end']);?></p>
			<?php } ?>
		</span>
		<span class="s7 fl"><?=$value['promotion_price'];?>/<?=$value['price'];?></span>
		<span class="s3 fl"><?=$value['num'];?></span>
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
		 		<?php if($value['status']=0 && $value['pay_type']==1 && empty($value['pay_serialno'])){ ?>
		 		<a href="<?=u(MODNAME,'callback',array('op'=>'appaly','type'=>$op,'id'=>$value['id']));?>">立即付款</a>
		 		<?php } ?>
		  		<a href="<?=u(MODNAME,'deals',array('type'=>$op,'id'=>$value['id']));?>">编辑</a>
				<a href="<?=u(MODNAME,'del',array('type'=>$op,'id'=>$value['id']));?>">删除</a>
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
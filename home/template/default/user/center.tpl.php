<?php include(PATH_TPL."/user/center/center_header.tpl");?>
<?php $action[$op]='on';?>
<ul class="an_tab_nav">
    <li class="fl <?=$action['all'];?>"><a href="<?=u('user','center',array('op'=>'all'));?>">积分明细</a></li>
	<li class="fl <?=$action['plus'];?>"><a href="<?=u('user','center',array('op'=>'plus'));?>">积分增加</a></li>
	<li class="fl <?=$action['reduce'];?>"><a href="<?=u('user','center',array('op'=>'reduce'));?>">积分消耗</a></li>
</ul>

<div class="usermain">
	<?php if(empty($log)){ ?>
	<div class="blockD"> 您没有任何记录！</div>
	<?php }else{ ?>

	<table cellpadding="0" cellspacing="1" align="center" width="740" border="1">
		<tr class="title">
			<th class="date_span">日期</td>
			<th class="operating_span">操作</td>
			<th class="destribe_span">详情描述</td>
			<th class="integration_span">积分</td>
		</tr>
		<?php foreach ($log as $key=>$value){ ?>
		<tr>
			<td class="date_span"><?=date('Y年m月d日 H:i:s',$value['addtime']);?></td>
			<td class="operating_span">
				<?php if($value['type']=='sign'){?>
				签到
				<?php }elseif($value['type']=='sun'){ ?>
				晒单分享
				<?php }elseif($value['type']=='try'){ ?>
				试用申请
				<?php }elseif($value['type']=='exchange'){ ?>
				积分兑换
				<?php }elseif($value['type']=='comment'){ ?>
				评论
				<?php }elseif($value['type']=='lottery'){ ?>
				抽奖
				<?php }elseif($value['type']=='reward'){ ?>
				奖励
				<?php }elseif($value['type']=='other'){ ?>
				其他
                <?php }elseif($value['type']=='admin'){ ?>
                管理员
                <?php } ?>
            </td>
			<td class="destribe_span"><?=$value['exp'];?></td>
			<td class="integration_span"><?=$value['integ'];?></td>
		</tr>
		<?php } ?>
	</table>
	<?php } ?>
</div>
<div class="clear"></div>
<?php page_url() ?>
<?php include(PATH_TPL."/public/small_page.tpl");?>
<?php include(PATH_TPL."/user/center/center_footer.tpl");?>
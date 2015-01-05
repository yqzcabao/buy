<?php include(PATH_TPL."/user/center/center_header.tpl");?>
<?php $action[$op]='on';?>
<ul class="an_tab_nav">
    <li class="fl <?=$action['exchange'];?>"><a href="<?=u('user','gift',array('op'=>'exchange'));?>">积分兑换</a></li>
	<li class="fl <?=$action['try'];?>"><a href="<?=u('user','gift',array('op'=>'try'));?>">免费试用</a></li>
</ul>

<div class="usermain">
		<?php if(empty($applylog)){ ?>
		<div class="blockD"> 您没有任何礼品记录！</div>
		<?php }else{ ?>
		<div class="blockC">
			<table>
				<tr class="title">
					<th class="giftDetails_span">礼品详情</td>
					<th class="type_span">类型</td>
					<th class="date_span">时间</td>
					<th class="status_span">状态</td>
					<th class="operating_span">操作</td>
				</tr>
				<?php foreach ($applylog as $key=>$value){ ?>
				<tr>
					<td>
						<?php if($value['idtype']=='try'){ ?>
						<a href="<?=u('try','detail',array('id'=>$value['id']));?>" target="_blank" title="<?=$value['title'];?>"><?=$value['title'];?></a>
						<?php }elseif ($value['idtype']=='exchange'){ ?>
						<a href="<?=u('exchange','detail',array('id'=>$value['id']));?>" target="_blank" title="<?=$value['title'];?>"><?=$value['title'];?></a>
						<?php } ?>
					</td>
					<td>
						<?php if($value['idtype']=='try'){ ?>
						免费试用
						<?php }elseif ($value['idtype']=='exchange'){ ?>
						积分兑换
						<?php } ?>
					</td>
					<td><?=date('Y年m月d日 H:i:s',$value['addtime']);?></td>
					<td>
						<?php if($value['status']==-1){ ?>
						已失败
						<?php }elseif($value['status']==0){ ?>
						待处理
						<?php }elseif($value['status']==1){ ?>
						已处理
						<?php }elseif($value['status']==2){ ?>
						未晒单
						<?php }elseif($value['status']==3){ ?>
						成功
						<?php } ?>
					</td>
					<td>
						<?php if($value['status']==2){ ?>
						<input type="button" class="singleSun btn" value="晒单" onclick="showorder($(this),'<?=$value['aid'];?>');" />
						<?php } ?>
						
						<input type="button" class="delete btn" value="删除" />
						
					</td>
				</tr>
				<?php } ?>
			</table>
		</div>
		<?php } ?>
		<?php include(PATH_TPL."/public/comment_sun.tpl");?>
</div>
<?php include(PATH_TPL."/public/small_page.tpl");?>
<?php include(PATH_TPL."/user/center/center_footer.tpl");?>
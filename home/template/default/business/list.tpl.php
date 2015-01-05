<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/business.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="<?=PATH_TPL;?>/static/js/business.js"></script>
<?php
$action[$nid]='on';
?>
<span class="businessCooperation area">
	<a href="<?=u('index','index');?>"><?=$_webset['site_name'];?></a>
	&nbsp;&gt;&nbsp;<a href="<?=u('business','index');?>">商家报名系统</a>
	&nbsp;&gt;&nbsp;报名记录审核结果 
</span>
<div class="nav_c area">
	<div class="nav_menu">
		<?php foreach ($_nav as $key=>$value){ ?>
		<?php if($value['mod']=='goods' || $value['mod']=='try' || $value['mod']=='exchange'){ ?>
		<a href="<?=u('business','list',array('nid'=>$value['id']));?>" class="fl <?=$action[$value['id']];?>">
			<em><?=$value['name'];?></em>
		</a>
		<?php } ?>
		<?php } ?>
	</div>
	
	<div class="blockA">
		<ul>
			<li class="fl">
				<a href="<?=u('business','list',array('nid'=>$nid));?>">全部</a>
			</li>
			<li class="fl">
				<a href="<?=u('business','list',array('nid'=>$nid,'op'=>'wait'));?>">等待</a>
			</li>
			<li class="fl">
				<a href="<?=u('business','list',array('nid'=>$nid,'op'=>'willline'));?>">待上线</a>
			</li>
			<li class="fl">
				<a href="<?=u('business','list',array('nid'=>$nid,'op'=>'online'));?>">已上线</a>
			</li>
			<li class="fl">
				<a href="<?=u('business','list',array('nid'=>$nid,'op'=>'end'));?>">已结束</a>
			</li>
			<li class="fl">
				<a href="<?=u('business','list',array('nid'=>$nid,'op'=>'pass'));?>">未通过</a>
			</li>
		</ul>
	</div>
	
	<div class="blcokB">
		<span class="fl s1">活动详情</span>
		<span class="fl s3">审核信息</span>
		<span class="fl s4">操作</span>
	</div>
    <?php foreach ($goods as $key=>$value){ ?>
	<div class="blcokC activity_detail">
		<div class="blcokC_top">
			&nbsp;&nbsp;&nbsp;&nbsp;淘宝商品ID：<?=$value['num_iid'];?>
			&nbsp;&nbsp;&nbsp;&nbsp;更新时间：<?=date('Y-m-d H:i:s',$value['addtime'])?>
		</div>
		<div class="blcokC_bottom">
			<span class="fl s1">
				<a href="http://item.taobao.com/item.htm?id=<?=$value['num_iid'];?>">
					<img src="<?=$value['pic'];?>_290x290.jpg" class="fl">
				</a>
				<h3>
				  <a target="_blank" title="<?=$value['title'];?>" href="http://item.taobao.com/item.htm?id=<?=$value['num_iid'];?>">
					<?=$value['title'];?>
				  </a>
				</h3>
				<h4>
					  <?php if($type=='goods'){ ?>
					  <em>所属分类：<b><?=$catlist['cid_'.$value['cat']]['title'];?></b></em>
					  <?php } ?>
					  <em>原价：<b><?=$value['price'];?></b></em>
					  <em>活动价：<b><?=$value['promotion_price'];?></b></em>
					  <?php if($type=='try' || $type=='exchange'){ ?>
					  <em>商品数量：<b><?=$value['num'];?></b></em>
					  <?php }else{ ?>
					  <em>邮费类型：<b><?php if($value['ispost']==1){ ?>包邮<?php }else{ ?>不包邮<?php } ?></b></em>
					  <?php } ?>
				</h4>
			</span>
			<span class="s3 fl">
			审核状态：
			<?php if($value['status']==0){ ?>
			<em>待审核</em><br>
			<?php }elseif($value['status']==-1){ ?>
			<em>未通过</em><br>
			<?php }elseif ($value['status']==1){ ?>
				<?php if($value['start']>$_timestamp){ ?>
					<em>待上线</em><br>
				<?php }elseif($value['end']<$_timestamp){ ?>
					<em>已结束</em><br>
				<?php }elseif($value['start']<$_timestamp && $value['end']>$_timestamp){ ?>
					<em>已上线</em><br>
				<?php } ?>
			<?php } ?>
			<?php if($value['status']==-1){ ?>
			小编留言：<?=$value['refuse'];?>
			<?php } ?>
		  </span>
		  <span class="s4 fl">
			  <a href="<?=u('business','apply',array('type'=>$type,'id'=>$value['id']));?>">编辑活动详情</a>
		  </span>
		</div>
	</div>
	<?php } ?>
	<!--//分页-->
	<?php include(PATH_TPL."/public/pages.tpl");?>
</div>
<?php include(PATH_TPL."/footer.tpl.php");?>
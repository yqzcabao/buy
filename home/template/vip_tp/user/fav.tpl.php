<?php include(PATH_TPL."/user/center/center_header.tpl");?>
<ul class="an_tab_nav">
    <li class="fl on"><a href="<?=u('user','fav',array('op'=>'index'));?>">我的收藏</a></li>
</ul>

<div class="usermain">
	<div class="goods_mark mark_title">
		<span class="nike s1 tis">宝贝名称</span>
		<span class="price s2">价格</span>
		<span class="zt s3">状态</span>
		<span class="startTime s4">开始时间</span>
	</div>
	<?php if(empty($favlist)){ ?>
	<div class="blockD">还没有收藏哦！<a href="<?=u('index','index');?>" style="color:red">立即去收藏</a></div>
	<?php } ?>
	<?php if(is_array($favlist) && !empty($favlist)){ ?>
	<?php foreach ($favlist as $key=>$value){ ?>
	<div class="goods_mark goods_de_list">
		<span class="nike s1">
			<input type="checkbox" class="fl" name="fav[]" value="<?=$value['flog'];?>" onclick="checkoption($('.cancelAll'));" />
			<a <?=gogood($value['num_iid']);?> title="<?=$value['title'];?>">
				
				<img src="<?=get_img($value['pic'],'290');?>" title="<?=$value['title'];?>" alt="<?=$value['title'];?>" class="fl" style="width: 60px;" />
			</a>
			<a <?=gogood($value['num_iid']);?> class="sm fl" title="<?=$value['title'];?>"><?=$value['title'];?></a>
		</span>
		<span class="price s2"><em>￥<?=$value['promotion_price'];?></em></span>
		<span class="price s3">
			<?php if($value['issteal']==1){ ?><span class="zt s3">抢光了</span>
			<?php }elseif($value['start']>$_timestamp){ ?><span class="zt s3">即将开始</span>
			<?php }elseif($value['end']<$_timestamp){ ?><span class="zt s3">已结束</span>				
			<?php }else{ ?>
			<a <?=gogood($value['num_iid']);?> title="去抢购"><span class="zt s3">去抢购</span></a>
			<?php } ?>
		</span>
		<span class="startTime s4"><?=date('Y-m-d H:i:s',$value['start']);?></span>
	</div>
	<?php } ?>
	<div class="cancelCollection">
		<input type="checkbox" class="cancelAll" onclick="checkAll($(this),$('input[name=\'fav[]\']'));"/>全选
		<a href="javascript:;" onclick="delfav();">删除</a>
	</div>
	<?php } ?>
</div>
<?php include(PATH_TPL."/public/small_page.tpl");?>
<?php include(PATH_TPL."/user/center/center_footer.tpl");?>
<?php 
if(empty($catlist)){
	$catlist=getgoodscat();
}
$active['cat_'.$cat]="on";
?>
<div class="junav">
	<div class="area">
    	<span class="fl nav_list">
        	<a href="<?=u('index','index',array('sort'=>$sort));?>" class="fl <?=$active['cat_0'];?>"><em>全部</em></a>
        	<?php foreach ($catlist as $key=>$value){ ?>
            <a href="<?=u('index','index',array('cat'=>$value['id'],'sort'=>$sort));?>" title="<?=$value['title'];?>" class="fl <?=$active['cat_'.$value['id']];?>"><?=$value['title'];?></a>
            <?php } ?>
        </span>
        <span class="fr recommend">
        	 推荐:
        	 <?php if(!empty($cat)){ ?>
			<a href="<?=u('index','index',array('cat'=>$cat,'sort'=>'new'));?>" 
			   class="<?php if($sort=='new'){ ?>on<?php } ?>">最新</a>
			<a href="<?=u('index','index',array('cat'=>$cat,'sort'=>'hot'));?>" 
			   class="<?php if($sort=='hot'){ ?>on<?php } ?>">最热</a>
			<?php }else{ ?>
			<a href="<?=u('index','index',array('sort'=>'new'));?>" 
			   class="<?php if($sort=='new'){ ?>on<?php } ?>">最新</a>
			<a href="<?=u('index','index',array('sort'=>'hot'));?>" 
			   class="<?php if($sort=='hot'){ ?>on<?php } ?>">最热</a>
			<?php } ?>
        </span>
    </div>
</div>
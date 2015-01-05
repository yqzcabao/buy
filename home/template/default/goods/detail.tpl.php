<?php 
if(empty($catlist)){
	$catlist=getgoodscat();
}
//收藏记录
$favlog=goodsfavloglist(array('`gid`='.$good['id']),'`addtime` DESC',0,6);
//淘宝评论
$taobaocomment=get_taobao_comment($good['site'],$good['num_iid'],$good['seller_id']);
?>
<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/detail.css" type="text/css" rel="stylesheet"/>
<div class="clear"></div>
<div class="detail_content area">
<div class="detail_content_c">
	<div class="goods_show">
    	<div class="place_explain fl">
             <a href="<?=u('index','index');?>"><?=$_webset['site_name'];?></a>&gt;
             <a href="<?=u('index','index',array('cat'=>$good['cid']));?>"><?=$good['catname'];?></a>&gt;
             <a class="bady_xx_seo" <?=gogood($good['num_iid']);?>><?=$good['title'];?></a>
        </div>
        <div class="leimu_nav fr">
        	 <?php foreach ($catlist as $key=>$value){ ?>
             <a href="<?=u('index','index',array('cat'=>$value['id']));?>"><?=$value['title'];?></a>丨
             <?php } ?>
             <a class="last" href="<?=u('index','index');?>">返回全部</a>
         </div>
     </div>
     
         <div class="goods_item mod_2">
         	  <?php include(PATH_TPL."/goods/detail_mod_2.tpl");?>
              <div class="bady_part">
              	   <div class="bady_tab">
                   		<ul>
                        	<li class="fl tab1">
                            	<a class="badyactive" href="javascript:void(0);">买过的人说<em><?=$taobaocomment['total'];?></em></a>
                                <div class="line_top"></div>
                            </li>
                            <?php if($_webset['base_isComment']==1){ ?>
                        	<li class="fl tab2">
                            	<a class="" href="javascript:void(0);">用户评论<em></em></a>
                                <div class=""></div>
                            </li>
                            <?php } ?>
                        </ul>
                   	</div>
                    <div class="information comment" style="overflow: hidden;">
                    	<div class="info_parameter">
                        	<div class="item_comment">
                            	<div class="com_box">
                                   <div class="pl_box">
                                      <p>以下是来自<?php if($good['site']=='tmall'){ ?>天猫<?php }elseif($good['site']=='taobao'){ ?>淘宝<?php } ?>买家的评论</p>
                                  </div>
                                  <div class="com_big">
                                  	  <div class="com_list">
                                      	  <ul>
                                      	  <?php foreach ($taobaocomment['list'] as $key=>$value){ ?>
                                          	  <li class="fl">
                                              	  <div class="rate_user_info">
                                                  	 <span class="rate_user"><?=$value['UserNick'];?>
                                                  	 	<span class="rate-user-grade">
                                                  	 		<?php if($value['tamllSweetLevel']!=0){ ?>
                                                            <em class="tm_icon t<?=$value['tamllSweetLevel'];?>"> </em>
                                                            <?php } ?>
                                                            <em class="tm_icon <?=$value['RateSum'];?>"></em>
                                                        </span>
                                                    </span>
                                                    <span class="rate_right fr">
                                                        <em class="rate_time"><?=$value['Date'];?></em>
                                                        <em>评论来自 <?php if($good['site']=='tmall'){ ?>天猫<?php }elseif($good['site']=='taobao'){ ?>淘宝<?php } ?></em>
                                                    </span>
                                                    <div class="rate_leirong"><?=$value['Content'];?></div>
                                                  </div>
                                              </li>
                                            <?php } ?>
                                          </ul>
                                      </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
					<?php if($_webset['base_isComment']==1){ ?>
					<?php $commentresult=commentlist($good['id']); ?>
					<div class="information comment hidden" style="padding-top:0;">
					  <div class="info_parameter">
					      <div class="item_comment">
					          <p class="comment_title">评论</p>
					          <?php include(PATH_TPL."/public/comment_text.tpl");?>
					      </div>
						  <?php include(PATH_TPL."/public/commentlist.tpl");?>
					  </div>
					</div>
                    <?php } ?>
					
         </div>
    </div>
</div>
</div>
<script type="text/javascript">
$(".bady_tab li").click(function(){
	var index=$(".bady_tab li").index($(this));
	$(".bady_tab li div").removeClass("line_top");
	$(this).find("div").addClass("line_top");
	$(".information").addClass("hidden").eq(index).removeClass("hidden");
})
</script>
<?php if($good['channel']!=brandNid()){ ?>
<?php $youarelikegood=youlikegood($good['cat'],$good['id']); ?>
<div class="clear"></div>
<div class="item_goods_list area">
   <h3>同类热销宝贝</h3>
   <ul class="goods_list_ul">
   <?php foreach ($youarelikegood as $key=>$value){ ?>
   		<li class="fl">
        	<div class="g_list <?php if($value['start']>$_timestamp){ ?>start<?php }elseif($value['end']<$_timestamp){ ?>over<?php }else{ ?>buy<?php } ?>">
            	<a <?=gogood($value['num_iid']);?> title="<?=$value['title'];?>" class="good_pic mod_2">
                	<img src="<?=DEF_GD_LOGO;?>" data-original="<?=get_img($value['pic'],'290');?>" class="lazy"/>
                    <em class="brand_new"></em>
                </a>
                <h5 class="good_title">
                    <?php if($value['ispost']==1){ ?>【包邮】<?php } ?><a <?=gogood($value['num_iid']);?> title="<?=$value['title'];?>"><?=$value['title'];?></a>
                </h5>
                <div class="good_price">
                    <span class="price_current fl"><em>￥</em><?=$value['promotion_price'];?></span>
                    <span class="des_other fl">
                        <span class="price_old"><em>￥</em><?=$value['price'];?></span>
                        <span class="discount"><b><?=$value['discount'];?></b>折</span>
                    </span>
                    <div class="btn">
                    	<a <?=gogood($value['num_iid']);?> title="<?=$value['title'];?>">
                        	<span>
							<?php if($good['start']>$_timestamp){ ?>
							即将开始
							<?php }elseif($good['end']<$_timestamp){ ?>
							已结束
							<?php }else{ ?>
							去看看
							<?php } ?>
                        	</span>
                        </a>
                    </div>
                </div>
                <div class="pic-des">
		            <div class="des-state">
		                <span class="state-time fl">开始：
		                		<?php if($good['start']>$_timestamp){ ?>
									即将开始
								<?php }elseif($good['end']<$_timestamp){ ?>
									已结束
								<?php }else{ ?>
					            	<?=date('m月d日H时i分',$good['start']);?>
				            	<?php } ?></span>
				        <?php if($_webset['open_report']==1){ ?>
				           <a title="<?=$value['title'];?>" class="des-report fr report" style="display:block;" onclick="report('<?=$value['id'];?>','<?=$value['title'];?>');" href="javascript:;">举报</a>
	                    <?php } ?>  	
                      
                    </div>
		        </div>
            </div>
        </li>
     <?php } ?>
   </ul>
</div>
<script type="text/javascript">
$(".goods_list_ul li").mouseenter(function(){$(this).find(".pic-des").show()});
$(".goods_list_ul li").mouseleave(function(){$(this).find(".pic-des").hide()});
</script>
<?php } ?>
<?php include(PATH_TPL."/footer.tpl.php");?>
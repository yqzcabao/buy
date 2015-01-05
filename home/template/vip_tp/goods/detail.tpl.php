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
         	  <div class="show_body">
					  <div class="img_show fl">
				      <div class="show_big_wrap">
				           <div class="show_bgimg">
							  <a class="show_big buy" <?=gogood($good['num_iid'],true);?> title="<?=$good['title'];?>">
								 <img alt="<?=$good['title'];?>" src="<?=get_img($good['pic'],'290');?>">
				              </a>
				          </div>
				      </div>
				      <div class="other_show fl">
				      		<p class="price bady_time">
									<span class="fl">开抢时间：</span>
									<span class="time fl">
									<?php if($good['start']>$_timestamp){ ?>
									即将开始
								<?php }elseif($good['end']<$_timestamp){ ?>
									已结束
								<?php }else{ ?>
					            	<?=date('m月d日H时i分',$good['start']);?>
				            	<?php } ?>
				            	</span>
								</p>
				            <div class="share_box fr">
				              <span class="fl">分享</span>
				              <div class="box">
				                  <div class="bdshare">
				                      <a class="bds_qzone fl" title="分享到QQ空间"  href="javascript:;" onclick="share.doShare('qzone',{'url':'<?=urlencode(u('goods','detail',array('iid'=>$good['num_iid'])));?>','title':'<?=$good['title'];?>','pic':'<?=urlencode(get_img($good['pic']));?>'});"></a>
				                      <a class="bds_tsina fl" title="分享到新浪微博" href="javascript:;" onclick="share.doShare('t_sina',{'url':'<?=urlencode(u('goods','detail',array('iid'=>$good['num_iid'])));?>','title':'<?=$good['title'];?>','pic':'<?=urlencode(get_img($good['pic']));?>'});"></a>
				                      <a class="bds_tqq fl" title="分享到腾讯微博" href="javascript:;" onclick="share.doShare('t_qq',{'url':'<?=urlencode(u('goods','detail',array('iid'=>$good['num_iid'])));?>','title':'<?=$good['title'];?>','pic':'<?=urlencode(get_img($good['pic']));?>'});"></a>
				                  </div>
				              </div>
				          </div>
				      </div>
				  </div>
				  <div class="price_info fl">
				  	   <h3><?=$good['title'];?></h3>
				       <p class="tips">
				          <span class="item_pr fl">原价：<em class="old_price"><?=$good['price'];?>元</em></span>
				          <span class="fl">折扣：<em class=" jd_num01"><?=$good['discount'];?>折</em></span>
				       </p>
				       <p class="tips">
				          <span class="fl">最近销量：<em class=" jd_num01"><?=$good['volume'];?></em></span>
				       </p>
				      <?php if(!empty($favlog['data']) && is_array($favlog['data'])){ ?>
							<p class="price bady_time user_like">
							<em class="fl">TA也收藏</em>
							<?php foreach ($favlog['data'] as $key=>$value){ ?>
								<a href="javascript:void(0);">
								<img src="<?=avatar($value['uid'],'little');?>" width="35px" height="35px">
								</a>
							<?php } ?>	   
							</p>
						<?php } ?>
				      <p class="price fl" style="margin-top: 20px;margin-bottom: 20px;font-size: 16px;">
				      	  <?php if($good['ispaigai']==1){ ?>
				      	  <span class="title_tips01 fl">拍下自动改价
				          	 <em class="tip_b"></em>
				          </span>   
				    	  <?php }elseif ($good['isvip']==1){ ?>
				    		<span class="title_tips01 fl">VIP价格
				               <em class="tip_b"></em>
				            </span>
				    	 <?php } ?>    
				          <em class="org">￥</em> 
				          <span class="jd_current"><?=$good['promotion_price'];?></span> <?php if($good['ispost']==1){ ?>/包邮<?php } ?>
				       </p>
				      
						<div class="item_btn">
							<span>
							   <a class="btn fl <?php if($good['start']>$_timestamp){ ?>start<?php }elseif($good['end']<$_timestamp){ ?>over<?php }else{ ?>buy<?php } ?>" <?=gogood($good['num_iid'],true);?> title="<?=$good['title'];?>" > 
							   		<span>去<?php if($good['site']=='tmall'){ ?>天猫<?php }elseif($good['site']=='taobao'){ ?>淘宝<?php } ?>抢购</span>
							   </a>
							</span>
							<a href="javascript:void(0);" onclick="goodsfav('<?=$good['id'];?>')" class="item_like item_like_btn fl">
								<em class="heart"></em>
								<p class="like_l">收藏</p>
							</a>    
						</div>
				  </div>
				  <div class="price_ad">
						<?=A(1);?>
				  </div>
				</div>
			  <!--//宝贝end-->
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
<ul class="area bigdeal clearfix" style="margin-top: 30px;">
	<?php foreach ($youarelikegood as $key=>$value){ ?>
	<li>
		<div class="deal dealbig">
			<?php if($value['start']>=strtotime('today') && $value['start']<strtotime('tomorrow')){ ?>
			<i class="new"></i>
			<?php } ?>
			<h3 class="stnmclass">
				<a <?=gogood($value['num_iid']);?>>
					<img src="<?=DEF_GD_LOGO;?>" data-original="<?=get_img($value['pic'],'310');?>" alt="<?=$value['title'];?>" class="lazy" style="display: inline;">
				</a>
			</h3>
			<div class="beauty_pro_info <?php if($value['start']>$_timestamp){ ?>unstart<?php }elseif ($value['end']<$_timestamp){ ?>end<?php } ?>">
				<em class="ptitle"><a <?=gogood($value['num_iid']);?> num_iid="<?=$value['num_iid'];?>" title="<?=$value['title'];?>"><?php if($value['ispost']==1){ ?>【包邮】<?php } ?><?=$value['title'];?></a></em>
				<span class="price_list_sale fl"> ￥ <em><?=trim_last0($value['promotion_price']);?></em></span>
				<span class="des-other fl">
					<?php if($value['ispaigai']==1){ ?>
					<em class="icon-gai">拍下改价</em>
                	<?php }elseif ($value['isvip']==1){ ?>
                	<em class="icon-vip">VIP价格</em>
                	<?php }else{ ?>
                	<em class="icon-jingxuan">小编精选</em>
                	<?php } ?>
                    <span class="price-old"><em>￥</em><?=trim_last0($value['price']);?></span>
                    <span class="discount">(<em><?=trim_last0($value['discount']);?></em>折)</span>
                </span>
				<a class="beauty_link_b" <?=gogood($value['num_iid']);?> >
					<?php if($value['start']>$_timestamp){ ?>即将开始
					<?php }elseif ($value['end']<$_timestamp){ ?>已结束
					<?php }else{ ?>
					去<?php if($value['site']=='tmall'){ ?>天猫<?php }elseif ($value['site']=='taobao'){ ?>淘宝<?php } ?>抢购
					<?php } ?>
				</a>
			</div>
			<div class="btm">
				<span class="sold">已有<em><?=$value['volume'];?></em>人购买</span>
				<span class="share">
					<a title="<?=$value['title'];?>" <?=gogood($value['num_iid'],false);?> class="tip" style="margin-right: 10px;">详细</a>
					<a rel="nofollow" title="分享" class="tip" href="javascript:vpid(0);" target="_blank">分享到：</a>
					<a href="javascript:;" onclick="share.doShare('t_sina',{'url':'<?=urlencode(u('goods','detail',array('iid'=>$value['num_iid'])));?>','title':'<?=$value['title'];?>','pic':'<?=urlencode(get_img($value['pic']));?>'});" rel="nofollow" class="weibo"></a>
					<a  href="javascript:;" onclick="share.doShare('qzone',{'url':'<?=urlencode(u('goods','detail',array('iid'=>$value['num_iid'])));?>','title':'<?=$value['title'];?>','pic':'<?=urlencode(get_img($value['pic']));?>'});" rel="nofollow" class="qzone"></a>
					<a href="javascript:;" onclick="share.doShare('t_qq',{'url':'<?=urlencode(u('goods','detail',array('iid'=>$value['num_iid'])));?>','title':'<?=$value['title'];?>','pic':'<?=urlencode(get_img($value['pic']));?>'});" rel="nofollow" class="tqq"></a>
				</span>
			</div>
		</div>
	</li>
	<?php } ?>
</ul>
<?php } ?>
<?php include(PATH_TPL."/footer.tpl.php");?>
<div class="show_body">
	  <div class="img_show fl">
      <div class="show_big_wrap">
           <div class="show_bgimg">
				  <a class="show_big buy" <?=gogood($good['num_iid'],true);?> title="<?=$good['title'];?>">
					 <img alt="<?=$good['title'];?>" src="<?=get_img($good['pic'],'290');?>">
              </a>
               <?php if($_webset['open_report']==1){ ?>
               <div class="share report fr">
               		<a href="javascript:void(0);" onclick="report('<?=$value['id'];?>','<?=$value['title'];?>');" class="report" title="<?=$good['title'];?>"><i class="report_icon"></i>举报</a>
               </div>
               <?php } ?>
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
      <p class="price fl">
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
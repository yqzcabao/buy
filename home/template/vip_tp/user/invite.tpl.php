<?php include(PATH_TPL."/user/center/center_header.tpl");?>
<?php $action[$op]='on';?>
<ul class="an_tab_nav">
    <li class="fl <?=$action['index'];?>"><a href="<?=u('user','invite',array('op'=>'index'));?>">邀请好友</a></li>
	<li class="fl <?=$action['log'];?>"><a href="<?=u('user','invite',array('op'=>'log'));?>">邀请记录</a></li>
</ul>

<div class="usermain invite_friend">
<?php if($op=='index'){ ?>
		<h3>方式一：分享到微博</h3>
		<p>通过您的专属邀请链接邀请好友注册<?=$_webset['site_name'];?>， 您将每邀请1人获得<?=$_webset['reward_invite'];?>，每天最多可以获得<?=$_webset['reward_invite_daymax'];?>！</p>
		<dl>
			<dt>
			  <em>窍门1：</em>将<?=$_webset['site_name'];?>分享给你的微博好友
			</dt>
			<dd>
			  <textarea class="fl">我爱上了<?=$_webset['site_name'];?>每天9块9的小幸福。懂我的商品，懂我的价格，给力的9块9包邮。真的要跟你八卦一下才行。<?=$inviteurl;?></textarea>
			  <span class="fl">
			  	<div class="fuzhi">
					<a href="javascript:void(0)"></a>
				</div>
			 	<object type="application/x-shockwave-flash" data="static/flash/clipboard.swf" id="clipboard" 
					style="position: absolute;width: 73px;height: 30px;left: 520px;top: 5px;">
					<param name="movie" value="clipboard.swf" />
					<param name="wmode" value="transparent">
					<param name="flashvars" value="content=我爱上了<?=$_webset['site_name'];?>每天9块9的小幸福。懂我的商品，懂我的价格，给力的9块9包邮。真的要跟你八卦一下才行。<?=$inviteurl;?>">
			    </object>					    
			  </span>
			</dd>
			<dd class="no_change">
			  请不要更改自己的邀请链接，以免无法获得积分奖励
			</dd>
		  </dl>		
		 
		<h3>方式二：贴到Blog或BBS</h3> 
		<p>通过您的专属邀请链接邀请好友注册<?=$_webset['site_name'];?>， 您将每邀请1人获得<?$_webset['reward_invite'];?>，每天最多可以获得<?=$_webset['reward_invite_daymax'];?>！</p>
			<dl>
				<dd class="copyUrl">
				 <span class="links_txt">推广地址：</span>
				  <input class="links_in" type="text" value="<?=$inviteurl;?>">
					<div class="fuzhi">
						<a href="javascript:void(0)"></a>
					</div>
				 	<object type="application/x-shockwave-flash" data="static/flash/clipboard.swf" id="clipboard" 
						style="position: absolute;width: 73px;height: 30px;left: 520px;top: 5px;">
						<param name="movie" value="clipboard.swf" />
						<param name="wmode" value="transparent">
						<param name="flashvars" value="content=<?=$inviteurl;?>">
					</object>
				</dd>
				<dd class="copyUrl">
				  <span class="links_txt">UBB代码：</span>
				  <input class="links_in" type="text" value="[url=<?=$inviteurl;?>]<?=$_webset['site_name'];?><?=$inviteurl;?>[/url]">
					<div class="fuzhi">
						<a href="javascript:void(0)"></a>
					</div>
				 	<object type="application/x-shockwave-flash" data="static/flash/clipboard.swf" id="clipboard" 
						style="position: absolute;width: 73px;height: 30px;left: 520px;top: 5px;">
						<param name="movie" value="clipboard.swf" />
						<param name="wmode" value="transparent">
						<param name="flashvars" value="content=[url=<?=$inviteurl;?>]<?=$_webset['site_name'];?><?=$inviteurl;?>[/url]">
				  </object>
				</dd>
				<dd class="copyUrl">
				  <span class="links_txt">UBB代码：</span>
				  <input class="links_in" type="text" value="&lt;a href = &quot;<?=$inviteurl;?>&quot;&gt;<?=$_webset['site_name'];?>&lt;/a&gt;">
					<div class="fuzhi">
						<a href="javascript:void(0)"></a>
					</div>
				    <object type="application/x-shockwave-flash" data="static/flash/clipboard.swf" id="clipboard" 
						style="position: absolute;width: 73px;height: 30px;left: 520px;top: 5px;">
						<param name="movie" value="clipboard.swf" />
						<param name="wmode" value="transparent">
						<param name="flashvars" value="content=&lt;a href = &quot;<?=$inviteurl;?>&quot;&gt;<?=$_webset['site_name'];?>&lt;/a&gt;">
				   </object>
				</dd>
		  </dl>
<?php }elseif ($op=='log'){ ?>
<div class="tab_c">
	<?php if(empty($invitelog)){ ?>
	<div class="blockD"> 您没有邀请记录！</div>
	<?php }else{ ?>
	<table cellpadding="0" cellspacing="1" align="center" width="740" border="1">
		<tr class="title">
			<td class="date_span">用户名</td>
			<td class="operating_span">注册时间</td>
			<td class="destribe_span">ip</td>
			<td class="integration_span">奖励积分</td>
		</tr>
		<?php foreach ($invitelog as $key=>$value){ ?>
		<tr>
			<td class="date_span"><?=$value['tuser_name'];?></td>
			<td class="operating_span"><?=date('Y年m月d日 H:i:s',$value['addtime']);?></td>
			<td class="destribe_span"><?=$value['ip'];?></td>
			<td class="integration_span"><?=$value['reward'];?></td>
		</tr>
		<?php } ?>
	</table>
	<?php } ?>
</div>
<?php include(PATH_TPL."/public/small_page.tpl");?>
<?php } ?>
</div>
<?php include(PATH_TPL."/user/center/center_footer.tpl");?>
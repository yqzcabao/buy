<?php exit(); ?>
<root>
	<menu name='后台首页' id="1">
		<node name='常用操作' id="1">
		  	<item id="1" name='后台中心' url='?mod=index&ac=welcome' mod='index' ac='welcome' />
		  	<item id="2" name='数据备份' url='?mod=data&ac=backup' mod='data' ac='backup' />
	  		<item id="3" name='精品采集' url='?mod=data&ac=goodsgather' mod='data' ac='goodsgather' />
	  		<item id="4" name='品牌团采集' url='?mod=data&ac=brandgather' mod='data' ac='brandgather' />
	  		<item id="5" name='清理缓存' url='?mod=data&ac=clear' mod='data' ac='clear' />
		</node>
	</menu>
	
	<menu name='网站设置' id="2">
	  <node name='网站设置' id="1">
	    <item id="1" name='基本设置' url='?mod=seting&ac=base' mod='seting' ac='base' />
	    <item id="2" name='模板设置' url='?mod=seting&ac=tpl' mod='seting' ac='tpl' />
	    <item id="3" name='导航设置' url='?mod=seting&ac=nav' mod='seting' ac='nav' />
	    <item id="4" name='淘客设置' url='?mod=seting&ac=taobao' mod='seting' ac='taobao' />
	    <item id="5" name='邮件设置' url='?mod=seting&ac=email' mod='seting' ac='email' />
	    <item id="6" name='SEO设置' url='?mod=seting&ac=seo' mod='seting' ac='seo' />
	    <item id="7" name='WAP设置' url='?mod=seting&ac=wap' mod='seting' ac='wap' />
	    <item id="8" name='会员设置' url='?mod=seting&ac=user' mod='seting' ac='user' />
	    <item id="9" name='商品设置' url='?mod=seting&ac=goods' mod='seting' ac='goods' />
	    <item id="10" name='系统设置' url='?mod=seting&ac=system' mod='seting' ac='system' />
	    <item id="11" name='管理员设置' url='?mod=seting&ac=manager' mod='seting' ac='manager' />
	  </node>
	</menu>
	
	<menu name='会员管理' id="3">
	  <node name='会员管理' id="1"> 
	    <item id="1" name='会员列表' url='?mod=user&ac=index' mod='user' ac='index' />
	    <item id="2" name='评论管理' url='?mod=user&ac=comment' mod='user' ac='comment' />
	    <item id="3" name='试用申请' url='?mod=user&ac=trylog' mod='user' ac='trylog' />
	    <item id="4" name='积分兑换' url='?mod=user&ac=exclog' mod='user' ac='exclog' />
	  </node>
	</menu>
	
	<menu name='商品管理' id="4"> 
	  <node name='宝贝管理' id="1">
	  	<item id="1" name='添加宝贝' url='?mod=main&ac=goods&op=add' mod='main' ac='add' />
	  	<item id="2" name='宝贝列表' url='?mod=main&ac=goods' mod='main' ac='goods' />
	  	<item id="3" name='过期列表' url='?mod=main&ac=goods&op=over' mod='main' ac='goods' />
	    <item id="4" name='宝贝分类' url='?mod=main&ac=cat' mod='main' ac='cat' />
	  </node>
	  <node name='品牌特卖' id="2">
	  	<item id="1" name='添加品牌' url='?mod=main&ac=brand&op=add' mod='main' ac='brand' />
	  	<item id="2" name='品牌管理' url='?mod=main&ac=brand&op=list' mod='main' ac='brand' />
	  	<item id="3" name='添加宝贝' url='?mod=main&ac=goods&op=badd' mod='main' ac='goods' />
	  	<item id="4" name='品牌宝贝' url='?mod=main&ac=goods&op=blist' mod='main' ac='goods' />
	  </node>
	  <node name='试用管理' id="3">
	  	 <item id="1" name='添加试用' url='?mod=main&ac=try&op=add' mod='main' ac='try' />
	  	 <item id="2" name='试用礼品' url='?mod=main&ac=try&op=list' mod='main' ac='try' />	
	  	 <item id="3" name='试用设置' url='?mod=main&ac=try&op=set' mod='main' ac='try' />
	  </node>
	  <node name='兑换管理' id="4">
	  	 <item id="1" name='添加兑换' url='?mod=main&ac=exc&op=add' mod='main' ac='exc' />
	  	 <item id="2" name='兑换礼品' url='?mod=main&ac=exc&op=list' mod='main' ac='exc' />	
	  	 <item id="3" name='兑换设置' url='?mod=main&ac=exc&op=set' mod='main' ac='exc' />
	   </node>
	</menu>
	
	<menu name='报名管理' id="5">
	  <node name='报名管理' id="1">
	  	<item id="1" name='待审核宝贝' url='?mod=apply&ac=goods' mod='apply' ac='goods' />
	  	<item id="2" name='待审核试用' url='?mod=apply&ac=try' mod='apply' ac='try' />
	  	<item id="3" name='待审核兑换' url='?mod=apply&ac=exc' mod='apply' ac='exc' />
	  	<item id="4" name='被举报宝贝' url='?mod=apply&ac=report' mod='apply' ac='report' />
	  	<item id="5" name='商家黑名单' url='?mod=apply&ac=black' mod='apply' ac='list' />
	  </node>
	</menu>
	
	<menu name='广告管理' id="6">
	  <node name='广告管理' id="1">
	  	<item id="1" name='广告管理' url='?mod=advertise&ac=ad' mod='advertise' ac='ad' />
	  	<item id="2" name='首页幻灯' url='?mod=advertise&ac=slides' mod='advertise' ac='slides' />
	  	<item id="3" name='友情链接' url='?mod=advertise&ac=link' mod='advertise' ac='link' />
	  </node>
	</menu>
	
	<menu name='文章管理' id="7"> 
	  <node name='文章管理' id="1">
	  	<item id="1" name='栏目管理' url='?mod=article&ac=cat' mod='article' ac='cat' />
	  	<item id="2" name='文章列表' url='?mod=article&ac=list' mod='article' ac='list' />
	  </node>
	</menu>
	
	<menu name='插件应用' id="8">
	  <node name='我的插件' id="1">
	  	<item id="1" name='我的插件' url='?mod=plugin&ac=myself' mod='plugin' ac='myself' />
	  </node>
	  <node name='扩展功能' id="2">
	  	<item id="1" name='插件商城' url='?mod=plugin&ac=center' mod='plugin' ac='center' />
	  </node>
	</menu>
</root> 
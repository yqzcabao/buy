<?php exit(); ?>
<root>
	<menu name='卖家管理' id="5" cover="true">
	  <node name='基本管理' id="1">
	  	<item name='基本设置' url='?mod=extend&ac=do&identifier=seller&pmod=baseset' mod='seller' ac='baseset' />
	  	<item name='活动设置' url='?mod=extend&ac=do&identifier=seller&pmod=activity' mod='seller' ac='activity' />
	  	<item name='报名指南' url='?mod=extend&ac=do&identifier=seller&pmod=help' mod='seller' ac='help' />
	  	<item name='举报管理' url='?mod=extend&ac=do&identifier=seller&pmod=report' mod='seller' ac='report' />
	  	<item name='黑名单管理' url='?mod=extend&ac=do&identifier=seller&pmod=black' mod='seller' ac='list' />
	  </node>
	  <node name='卖家管理' id="2">
	  	<item name='卖家列表' url='?mod=extend&ac=do&identifier=seller&pmod=user' mod='seller' ac='user' />
	  	<item name='充值记录' url='?mod=extend&ac=do&identifier=seller&pmod=log&op=recharge' mod='seller' ac='log' />
	  	<item name='提现记录' url='?mod=extend&ac=do&identifier=seller&pmod=log&op=withdraw' mod='seller' ac='log' />
	  	<item name='保证金记录' url='?mod=extend&ac=do&identifier=seller&pmod=log&op=deposit' mod='seller' ac='log' />
	  </node>
	  <node name='报名管理' id="3">
	  	<item name='商品报名' url='?mod=extend&ac=do&identifier=seller&pmod=apply&op=goods' mod='seller' ac='apply' />
	  	<item name='专题报名' url='?mod=extend&ac=do&identifier=seller&pmod=apply&op=album' mod='seller' ac='apply' />
	  	<item name='专场报名' url='?mod=extend&ac=do&identifier=seller&pmod=apply&op=special' mod='seller' ac='apply'/>
	  	<item name='试用报名' url='?mod=extend&ac=do&identifier=seller&pmod=apply&op=try' mod='seller' ac='apply' />
	  	<item name='兑换报名' url='?mod=extend&ac=do&identifier=seller&pmod=apply&op=exchange' mod='seller' ac='apply' />
	  </node>
	</menu>
</root>
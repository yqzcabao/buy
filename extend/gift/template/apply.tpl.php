<?php require tpl_extend("pub/header.tpl");?>
<link href="<?=PATH_APP;?>/static/css/address.css" type="text/css" rel="stylesheet"/>
<div class="area">
  <div class="address clear">
    <h2>收货人信息</h2>
    <div class="toptxt">
    	<ul class="masteraddr-addr">
    	<?php if(!empty($address)){ ?>
    		<li class="on masteraddr-def" data-address=<?=json_encode($address);?>>
    			<em></em>
    			<span>
    				<b><?=$address['province'];?></b>&nbsp;<b><?=$address['city'];?></b>&nbsp;<b><?=$address['county'];?></b>&nbsp;
    				<b><?=$address['addr'];?>&nbsp;<?=$address['truename'];?></b>&nbsp;&nbsp;&nbsp;
    				<b><?=$address['mobile'];?></b>
    			</span>
    			<!--<i class="masteraddr-removeaddr">删除</i>-->
    			<i class="masteraddr-modifyaddr" onclick="edit_address(this);">修改</i>
    			<!--<i class="masteraddr-defaddr">[默认地址]</i>-->
    		</li>
    	<?php } ?>
    	</ul>
    </div>
    <div class="masteraddr-content" <?php if(!empty($address)){ ?>style="display:none"<?php } ?>>
	    <div><em>*</em><label>收货人：</label><input name="address[truename]" type="text" class="name_input"></div>	    
	    <div class="masteraddr-aarea"><em>*</em><label>地&nbsp;&nbsp;区：</label>
	    		<select id="s_province" name="address[province]"></select>
	    		<select id="s_city" name="address[city]"></select>
	    		<select id="s_county" name="address[county]"></select></div>
	    <div class="masteraddr-address"><em>*</em><label>收货地址：</label><input name="address[addr]" type="text" class="address_input"></div>
	    <div><em>*</em><label>手&nbsp;&nbsp;机：</label><input name="address[mobile]" type="text" class="phone_input"></div>
	    <div><em>*</em><label>邮&nbsp;&nbsp;编：</label><input name="address[postcode]" type="text" class="postcode_input"></div>
    	<div class="masteraddr-btn">
    		<a class="masteraddr-cf" href="javascript:void(0)" onclick="save_address();">确认</a>
    		<span></span>
    	</div>
    </div>
  </div>
  
  <!--//配送说明-->
  <div class="paycls">
    <h2><span></span>兑换说明</h2>
    <p>
      <strong>1.</strong>为了更好的回馈<?=$_webset['site_title'];?>会员，所有礼品不收取任何费用，我们包邮为您送到家<br>
      <strong>2.</strong>由于参与兑换的人数较多，工作人员会在兑换成功后的3个工作日内将礼品发出<br>
      <strong>3.</strong>兑换成功后您可以到 <strong>个人中心</strong> &gt; <strong>积分兑换</strong> 中根据快递单号查看您的订单配送情况
    </p>
  </div>
  
  <div class="confcls">
	    <h2>确认订单信息</h2>
	    <form accept-charset="UTF-8" action="<?=u(MODNAME,'apply');?>" method="post" onsubmit="return exc_apply('<?=INTEGRAL;?>');">
	      <input type="hidden" name="userintegral" value="<?=$user['integral'];?>">
	      <input type="hidden" name="needintegral" value="<?=$exchangeinfo['needintegral'];?>">
	      <div class="gift">
	        <p><span>礼品详情</span><span>花费<?=INTEGRAL;?></span></p>
	        <div class="clear">
	          <dl class="ginfo">
	            <dt><a href="<?=u(MODNAME,'detail',array('id'=>$exchangeinfo['id']));?>" target="_blank"><img src="<?=get_img($exchangeinfo['pic'],'100');?>"></a></dt>
	            <dd>
	              <span class="maxh40"><a target="_blank" href="<?=u(MODNAME,'detail',array('id'=>$exchangeinfo['id']));?>"><?=$exchangeinfo['title'];?></a></span>
	              <span>价值:<?=$exchangeinfo['price'];?>元</span>
	              <input id="id" name="id" type="hidden" value="<?=$exchangeinfo['id'];?>">
	            </dd>
	          </dl>
	          <dl class="jifn">
	          	<dt><em><?=$exchangeinfo['needintegral'];?></em></dt>
	            <dd>提示：兑换礼品后您将减少<?=$exchangeinfo['needintegral'];?><?=INTEGRAL;?>，一旦兑换成功，<?=INTEGRAL;?>将不退还！请确定喜欢此礼品再兑换</dd>
	          </dl>
	        </div>
	      </div>
	      <div class="jadinfo">
		        <span>
		          备注信息：
		          <input name="remark" type="text">
		          <em class="tsinfo">提示：若兑换Q币请备注QQ号，若兑换集分宝请备注支付宝账号，以便进行发放</em>
		        </span>
		        <input type="hidden" name="formhash" value="<?=formhash();?>">
		        <input class="welfare_btn" name="appaly" type="submit" value="&nbsp;">
		        <em class="errortip"></em>
		        <p class="clear"/>
	      </div>
	</form>  
	</div>
</div>
<script type="text/javascript" src="static/js/area.js"></script>
<script type="text/javascript">_init_area();</script>
<?php require tpl_extend("pub/footer.tpl");?>
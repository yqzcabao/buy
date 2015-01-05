<?php include(PATH_TPL."/public/header.tpl.php");?>
<!--//START-->
<form method="post" action="<?=$_extend_url;?>&pmod=baseset">
	<!--//网站设置->基本设置-->
	<div class="box-content">
	<table class="table-font"><tbody>
		<tr>
		    <th class="w120">二级域名：</th>
		    <td>
		    	<input type="text" class="textinput w270" name="base[seller_domain]" value="<?=$_webset['seller_domain'];?>" placeholder="如:b.coubei.com">
		    	<span class="tip" style="margin-left:0px">如:b.coubei.com;不填写表示不适用二级域名</span>
		    </td>
		</tr>
		<tr>
            <th>开启邮箱验证：</th>
            <td>
            	<input type="radio" name="base[extend_seller_emaik_activation]" value="1" id="extend_seller_emaik_activation_1">
	         		<label for="extend_seller_emaik_activation_1" class="mr10">开启</label>
	         	<input type="radio" name="base[extend_seller_emaik_activation]" value="0" id="extend_seller_emaik_activation_0">
	         		<label for="extend_seller_emaik_activation_0" class="mr10">关闭</label>
	         	<script type="text/javascript">
	         	$("#extend_seller_emaik_activation_"+<?=intval($_webset['extend_seller_emaik_activation']);?>).attr("checked","checked");
	         	</script>
            </td>
        </tr>
        <tr class="line mt5 mb5"><td colspan="2"></td></tr>
	    <tr>
            <th class="w120">保证金认证：</th>
            <td>
            	<input type="radio" name="base[extend_seller_status]" value="1" id="extend_seller_status_1">
	         		<label for="extend_seller_status_1" class="mr10">开启</label>
	         	<input type="radio" name="base[extend_seller_status]" value="0" id="extend_seller_status_0">
	         		<label for="extend_seller_status_0" class="mr10">关闭</label>
	         	<script type="text/javascript">
	         	$("#extend_seller_status_"+<?=intval($_webset['extend_seller_status']);?>).attr("checked","checked");
	         	</script>
            </td>
        </tr>
        <tr>
            <th>保证金金额：</th>
            <td>
            	<p style="margin-bottom: 10px;"><input type="text" class="textinput w60" name="base[extend_seller_tbdeposit]" value="<?=$_webset['extend_seller_tbdeposit'];?>">&nbsp;(元)淘宝</p>
            	<p style="margin-bottom: 10px;"><input type="text" class="textinput w60" name="base[extend_seller_tmdeposit]" value="<?=$_webset['extend_seller_tmdeposit'];?>">&nbsp;(元)天猫</p>
            </td>
        </tr>
        <tr>
            <th>保证金冻结：</th>
            <td><input type="text" class="textinput" name="base[extend_seller_freeze]" value="<?=$_webset['extend_seller_freeze'];?>">&nbsp;天</td>
        </tr>
        <tr class="line mt5 mb5"><td colspan="2"></td></tr>
        <tr>
            <th>最小充值金额：</th>
            <td><input type="text" class="textinput" name="base[extend_seller_minrecharge]" value="<?=$_webset['extend_seller_minrecharge'];?>">&nbsp;元</td>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <td>
            	<input type="checkbox" name="base[extend_seller_auditrecharge]" id="extend_seller_auditrecharge" value="1" <?php if($_webset['extend_seller_auditrecharge']==1){ ?>checked<?php } ?>>
            	<label for="extend_seller_auditrecharge">审核充值</label>
            </td>
        </tr>
        <tr>
            <th>收款支付宝：</th>
            <td><input type="text" class="textinput" name="base[extend_seller_alipay]" value="<?=$_webset['extend_seller_alipay'];?>"></td>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <td>
            	<input type="checkbox" name="base[extend_seller_apirecharge]" id="extend_seller_apirecharge" value="1" <?php if($_webset['extend_seller_apirecharge']==1){ ?>checked<?php } ?>>
            	<label for="extend_seller_apirecharge">支付宝充值</label>
            </td>
        </tr>
        <tr>
            <th>支付宝手续费：</th>
            <td><input type="text" class="textinput" name="base[extend_seller_FEE]" value="<?=$_webset['extend_seller_FEE'];?>">&nbsp;%</td>
        </tr>
        <tr>
            <th>合作身份者id：</th>
            <td><input type="text" class="textinput w360" name="base[extend_seller_apiID]" value="<?=$_webset['extend_seller_apiID'];?>"></td>
        </tr>
        <tr>
            <th>支付宝api安全码：</th>
            <td><input type="text" class="textinput w360" name="base[extend_seller_apikey]" value="<?=$_webset['extend_seller_apikey'];?>"></td>
        </tr>
        <tr>
            <th>api商家支付宝：</th>
            <td><input type="text" class="textinput" name="base[extend_seller_apialipay]" value="<?=$_webset['extend_seller_apialipay'];?>"></td>
        </tr>
        
        <tr class="line mt5 mb5"><td colspan="2"></td></tr>
        <tr>
            <th>免费报名：</th>
            <td>
            	<input type="text" class="textinput" name="base[extend_seller_freetimes]" value="<?=$_webset['extend_seller_freetimes'];?>">&nbsp;个/每月(0表示不限制)
            </td>
        </tr>
		<tr>
            <th>付费限制：</th>
            <td>
            	<input type="text" class="textinput" name="base[extend_seller_tolltimes]" value="<?=$_webset['extend_seller_tolltimes'];?>">&nbsp;个/每月(0表示不限制)
            </td>
        </tr>
        <tr>
            <th>连续拒绝：</th>
            <td>
            	<input type="text" class="textinput" name="base[extend_seller_rejecttimes]" value="<?=$_webset['extend_seller_rejecttimes'];?>">&nbsp;次/当月不能报名(0表示不限制)
            </td>
        </tr>   
	</tbody></table>
	<div class="box-footer">
        <div class="box-footer-inner">
        	<input type="hidden" name="formhash" value="<?=formhash();?>">
        	<input type="submit" name="baseset" value="保存更改">
        </div>
    </div>
	</div>
</form>
<!--//END-->
<?php include(PATH_TPL."/public/footer.tpl.php");?>
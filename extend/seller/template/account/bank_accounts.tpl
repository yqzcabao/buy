<h3>收款信息</h3>
<div class="payinfo">
  <h3>您尚未设置收款信息哦!</h3>
  <p>收款信息用于提取现金使用，设置收款信息后才能申请提取现金哦!</p>
  <div class="submit"><a class="btn btn-red" href="/users/bank_accounts/verify_set_bank_account_info">设置收款信息</a></div>
</div>



    <h3>收款信息</h3>
    <div class="payinfo">
      <ul class="bankinfo clear">
        <li><label>银行开户名：</label><span>周博</span></li>
        <li><label>开户银行：  </label><span>招商银行</span></li>
        <li><label>银行开户地：</label><span>陕西省 西安市 </span></li>
        <li><label>开户行支行：</label><span>白沙路支行</span></li>
        <li><label>银行账号：  </label><span>************5251</span></li>
      </ul>
      <div class="submit banksub"><a class="btn btn-red" href="/users/bank_accounts/verify_set_bank_account_info">修改收款信息</a></div>
    </div>
    
    <div class="payinfo">
      <form accept-charset="UTF-8" action="/users/bank_accounts" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="✓"><input name="authenticity_token" type="hidden" value="vwSL958s7LbsLqDJs11xILG+Sng+6z1DOOckrxkGzoA="></div>
        <div class="details">
        <div class="process">
          <p><span>验证身份</span><span class="mid on">设置信息</span><span>完成</span></p>
          <p class="bar modify"></p>
        </div>
        <ul class="bankinfo clear">
          <li><label>银行开户名：</label>
          <span class="js_kaihuming">
              <select id="bank_account_bank_account_name" name="bank_account[bank_account_name]"><option value="-1">请选择</option>
<option value="周博">周博</option></select>
          </span>
          <span class="tip error"></span>
          </li>
          <li><label>选择开户银行：</label>
            <span>
              <select class="banktype" id="bank_account_bank_id" name="bank_account[bank_id]"><option value="-1">请选择银行</option>
<option value="2">中国工商银行</option>
<option value="4">中国农业银行</option>
<option value="6">中国建设银行</option>
<option value="8">招商银行</option>
<option value="10">中国银行</option>
<option value="12">中国邮政储蓄银行</option>
<option value="14">交通银行</option>
<option value="16">中信银行</option>
<option value="18">中国民生银行</option>
<option value="20">中国光大银行</option>
<option value="22">兴业银行</option>
<option value="24">浦发银行</option>
<option value="26">广发银行</option>
<option value="28">平安银行</option>
<option value="30">华夏银行</option>
<option value="32">北京银行</option>
<option value="34">上海银行</option>
<option value="36">江苏银行</option>
<option value="-2">手动输入</option></select>
            </span>
            <span class="tip error"></span>
          </li>
          <li class="hidden">
            <label>&nbsp;</label>
            <span><input id="bank_account_bank_name" name="bank_account[bank_name]" class="int1" value="" valer=""></span><span class="tip error"></span>
          </li>
          <span class="tip error"></span>
          
          <li id="js_selectcity">
            <label>银行开户地：</label>
            <span>
              <select class="bankloca prov" id="bank_account_area_id" name="bank_account[area_id]"><option value="-1">请选择</option>
<option value="110000">北京市</option>
<option value="120000">天津市</option>
<option value="130000">河北省</option>
<option value="140000">山西省</option>
<option value="150000">内蒙古自治区</option>
<option value="210000">辽宁省</option>
<option value="220000">吉林省</option>
<option value="230000">黑龙江省</option>
<option value="310000">上海市</option>
<option value="320000">江苏省</option>
<option value="330000">浙江省</option>
<option value="340000">安徽省</option>
<option value="350000">福建省</option>
<option value="360000">江西省</option>
<option value="370000">山东省</option>
<option value="410000">河南省</option>
<option value="420000">湖北省</option>
<option value="430000">湖南省</option>
<option value="440000">广东省</option>
<option value="450000">广西壮族自治区</option>
<option value="460000">海南省</option>
<option value="500000">重庆市</option>
<option value="510000">四川省</option>
<option value="520000">贵州省</option>
<option value="530000">云南省</option>
<option value="540000">西藏自治区</option>
<option value="610000">陕西省</option>
<option value="620000">甘肃省</option>
<option value="630000">青海省</option>
<option value="640000">宁夏回族自治区</option>
<option value="650000">新建维吾尔自治区</option></select>
            </span>
            <span>
                <select class="citys" id="bank_account_city_id" name="bank_account[city_id]"><option value="-1">请选择</option></select>
            </span>
          <span class="tip error"></span>
          </li>
          <li><label>开户行支行：</label>
          <span>
            <input type="text" class="int1 bankname" name="bank_account[bank_location_detail]" value="">
          </span>
          <span class="tip error"></span>
          <p>请填写正确的开户行支行名称，否则无法提现，如不确定可咨询银行客服人员</p>
          </li>
          <li><label>银行账号：</label>
          <span>
            <input type="text" class="int1 banknumber" name="bank_account[bank_account_num]" value="">
        </span><span class="tip error"></span><p>开户名必须为“<b>周博</b>”，否则提现会失败</p></li>
        </ul>
        <div class="submit commit"><a href="#" class="btn btn-red">保存</a></div>
      </div>
</form>
</div>


    <h3>收款信息</h3>
    <div class="payinfo">
      <div class="details">
        <div class="process">
          <p><span>验证身份</span><span class="mid">设置信息</span><span class="on">完成</span></p>
          <p class="bar over"></p>
        </div>
        <div class="sucinfo">恭喜，您已成功设置收款信息！新增提现申请时将启用！</div>
      </div>
    </div>

<div id="accountinfopop" class="diglog-wrapper" style="top: 401.5px; left: 491.5px;"><a href="javascript:void(0)" title="关闭窗口"><span class="close"></span></a><div class="diginfo">	<h3><span>确认收款信息</span></h3>		<div class="item">		    <ul>		        <li><label>银行开户名：</label><p>周博</p></li>		        <li><label>开户银行：</label><p>招商银行</p></li>		        <li><label>银行开户地：</label><p>陕西省&nbsp;西安市</p></li>		        <li><label>开户行支行：</label><p>白沙路支行</p></li>		        <li><label>银行账号：</label><p>6225881296315251</p></li>		    </ul>		</div>		<div class="tips">请确认银行开户名和账号在银行登记的开户名一致，否则无法提取任何现金</div>		<div class="submit"><a class="btn btn-red" href="#">确认</a><a class="btn btn2" href="#">取消</a></div>	</div></div>
<div class="dialog-overlay" style="width: 100%; height: 1159px; opacity: 0.5; position: absolute; overflow: hidden; left: 0px; top: 0px; z-index: 99999; background: rgb(0, 0, 0);"></div>
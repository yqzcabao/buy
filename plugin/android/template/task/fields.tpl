<script type="text/javascript" src="static/js/date.js"></script>
<script type="text/javascript" src="static/js/area.js"></script>
<div class="email-con">
<form action="<?=$_webset['site_url'];?>/?mod=android&ac=task&op=fields" method="POST" id="infoform">
    <ul>
        <li>
            <label>支付宝：</label>
            	<input type="text" class="txt" placeholder="支付宝" name="info[alipay]" value="<?=$user_field['alipay'];?>">
	            <a class="icon-btn" id="m_true" style="display:none;" href="javascript:;">
	            	<img src="<?=PATH_APP;?>/static/images/apptask/true.png" alt="" width="18" height="18"></a>
	            <a class="icon-btn" id="m_cancel" style="display:none;" href="javascript:;">
	            	<img src="<?=PATH_APP;?>/static/images/apptask/cancel.png" alt="" width="18" height="18"></a>
        </li>
        <li>
            <label>性&nbsp;&nbsp;别：</label>
            <div class="txt" style="line-height: 36px;">
	            <input type="radio" name="info[sex]" value="1" id="sex_1" class="left_f">男
	            <input type="radio" name="info[sex]" value="-1" id="sex_-1" class="left_f">女
	            <script type="text/javascript">
				$("#sex_<?=$user_field['sex'];?>").attr("checked","true");
				</script>
			</div>
        </li>
        <li>
            <label>Q　　Q：</label><input type="text" class="txt" placeholder="qq" name="info[qq]" value="<?=$user_field['qq'];?>">
            <a class="icon-btn" id="m_true" style="display:none;" href="javascript:;">
            	<img src="<?=PATH_APP;?>/static/images/apptask/true.png" alt="" width="18" height="18"></a>
            <a class="icon-btn" id="m_cancel" style="display:none;" href="javascript:;">
            	<img src="<?=PATH_APP;?>/static/images/apptask/cancel.png" alt="" width="18" height="18"></a>
        </li>
        <li class="clearfix_f">
			 <label>生&nbsp;&nbsp;日：</label>
			 <div class="txt" style="line-height: 36px;">
				<select class="h30" name="info[year]"></select>
				 <select class="h30" name="info[month]"></select>
				 <select class="h30" name="info[day]"></select>
				<script>
				new YMDselect('info[year]','info[month]','info[day]','<?=$user_field['year'];?>','<?=$user_field['month'];?>','<?=$user_field['day'];?>');
				</script>
			</div>
		</li>
		<li class="clearfix_f">
			 <label class="fl">所在地：</label>
			 <div class="txt" style="line-height: 36px;">
				 <select id="s_province" class="h30"  name="info[province]"></select>
				 <select id="s_city" class="h30" name="info[city]" ></select>
				 <select id="s_county" class="h30" name="info[county]"></select>
				<script type="text/javascript">_init_area('<?=$user_field['province'];?>','<?=$user_field['city'];?>','<?=$user_field['county'];?>');</script>
			</div>
		</li>
	     <div id="phone_success">
	        <li class="btn-go">
	        	<input type="hidden" name="infosubmit" value="1">
	        	<input type="hidden" name="formhash" value="<?=formhash();?>">
	        	<input type="hidden" name="token" value="<?=$tokenstr;?>">
	            <input type="hidden" name="uid" value="<?=$uid;?>">
	        	<a class="icon-btn01" isclick="yes" href="javascript:void(0);" id="sumitInfo">保存</a>  
	        </li>
	    </div>
        <li class="no-border"><p></p></li>
    </ul>
</form>
</div>
<script type="text/javascript">
$("#sumitInfo").click(function(){
	<?php if(!$set_allow){ ?>
	$(".no-border p").html("操作错误");
	<?php }else{ ?>
	var info=$("#infoform").serialize();
	console.log(info);
	//保存信息
	$.getJSON('<?=$_webset['site_url'];?>/?mod=android&ac=task&op=fields&callback=?',info,function(result){
		$(".no-border p").html(result.info);
	}).error(function(){});
	<?php } ?>
})
</script>
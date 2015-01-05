<div class="email-con">
    <ul>
        <li>
            <label>常用邮箱：</label><input type="text" class="txt"  placeholder="邮箱验证之后将不能更改" name="email" value="<?=$user_field['email'];?>">
            <a class="icon-btn" id="m_true"  style="display:none;" href="javascript:;">
            	<img src="<?=PATH_APP;?>/static/images/apptask/true.png" alt="" width="18" height="18" /></a>
            <a class="icon-btn" id="m_cancel" style="display:none;" href="javascript:;">
            	<img src="<?=PATH_APP;?>/static/images/apptask/cancel.png" alt="" width="18" height="18" /></a>
        </li>
	     <div id="phone_success" >
	        <li class="btn-go">
	        	<a class="icon-btn01" isclick="yes" href="javascript:void(0);" id="checkEmail">发送验证邮件</a>  
	        </li>
	        <li class="phone-num">
	            <label>验证码：</label><input type="text" class="txt" name="emailcode" placeholder="输入邮件中的验证码">
	            <input type="hidden" name="token" value="<?=$tokenstr;?>">
	            <input type="hidden" name="uid" value="<?=$uid;?>">
	            <a class="icon-btn05" href="javascript:void(0);" id="checkEmailCode">确定</a>
	        </li>
	    </div>
        <li class="no-border"><p>(仅用于账号寻回和活动通知使用,不会公开)</p></li>
    </ul>
</div>
<script type="text/javascript">
$("#checkEmail").click(function(){
	<?php if(!$set_allow){ ?>
	$(".no-border p").html("操作错误");
	<?php }else{ ?>
	var pregEmail = /^[a-z|A-Z|0-9]+([\.|\-|_][a-z|A-Z|0-9]+)*@[a-z|A-Z|0-9]+([\.|\-][a-z|A-Z|0-9]+)*(\.[a-z|A-Z]+)+$/i;
	var email=$("input[name='email']").val();
	var uid=$("input[name='uid']").val();
	if(pregEmail.test(email) != true){
		$(".no-border p").html("邮箱格式错误");
	}else{
		$("#m_true").show();
		$("#m_cancel").hide();
		//发送邮箱验证码
		$.getJSON('<?=$_webset['site_url'];?>/?mod=android&ac=task&op=send&callback=?',{email:email,uid:uid},function(result){
			$(".no-border p").html(result.info);
		}).error(function(){});
	}
	<?php } ?>
})
//提交验证
$("#checkEmailCode").click(function(){
	$(".email-icon a").hide();
	<?php if(!$set_allow){ ?>
	$(".no-border p").html("操作错误");
	<?php }else{ ?>
	var email=$("input[name='email']").val();
	var uid=$("input[name='uid']").val();
	var emailcode=$("input[name=emailcode]").val();
	var token=$("input[name=token]").val();
	if(emailcode==''){
		$(".no-border p").html("验证码不能为空");
	}else{
		//发送邮箱验证码
		$.getJSON('<?=$_webset['site_url'];?>/?mod=android&ac=task&op=checked&callback=?',{email:email,uid:uid,emailcode:emailcode,token:token},function(result){
			$(".no-border p").html(result.info);
		}).error(function(){});
	}
	<?php } ?>
})
</script>
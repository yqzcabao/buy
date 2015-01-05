<!--//START-->
<form method="post" action="<?=$_extend_url;?>&pmod=user&op=task">
	<!--//网站设置->基本设置-->
	<div class="box-content">
	<table class="table-font"><tbody>
        <tr>
            <th class="w180">积分名称：</th>
            <td><input type="text" class="textinput w60" name="user[base_integralName]" value="<?=$_webset['base_integralName'];?>"></td>
        </tr>
        <tr>
            <th class="w180">注册赠送积分：</th>
            <td>
            	<input type="text" class="textinput w120" name="user[reward_register]" value="<?=$_webset['reward_register'];?>">&nbsp;积分
            </td>
        </tr>
        <tr>
            <th class="w180">签到赠送积分：</th>
            <td>
            <input type="text" class="textinput w60" name="user[reward_sign_day]" value="<?=$_webset['reward_sign_day'];?>">&nbsp;积分,
            连续<input type="text" class="textinput w60" name="user[reward_continuous_day]" value="<?=$_webset['reward_continuous_day'];?>">天-
            递增<input type="text" class="textinput w60" name="user[reward_plus]" value="<?=$_webset['reward_plus'];?>">，
            每日最多获取<input type="text" class="textinput w60" name="user[reward_daymax]" value="<?=$_webset['reward_daymax'];?>">&nbsp;积分
            </td>
        </tr>
        <tr>
            <th class="w180">邀请赠送积分：</th>
            <td>
            	<input type="text" class="textinput w60" name="user[reward_invite]" value="<?=$_webset['reward_invite'];?>">&nbsp;积分/人,
            	每日最多获取<input type="text" class="textinput w60" name="user[reward_invite_daymax]" value="<?=$_webset['reward_invite_daymax'];?>">&nbsp;积分
            </td>
        </tr>
        <tr>
            <th class="w180">晒单赠送积分：</th>
            <td><input type="text" class="textinput w120" name="user[reward_showsingle]" value="<?=$_webset['reward_showsingle'];?>">&nbsp;积分</td>
        </tr>
        <tr>
            <th class="w180">评论赠送积分：</th>
            <td>
            	<input type="text" class="textinput w120" name="user[reward_comment]" value="<?=$_webset['reward_comment'];?>">
            	积分,
            	每日最多获取
            	<input type="text" class="textinput w60" name="user[reward_comment_daymax]" value="<?=$_webset['reward_comment_daymax'];?>">&nbsp;积分
            </td>
        </tr>     
        <tr class="line mt5 mb5"><td colspan="2"></td></tr>
        <tr>
            <th>完善注册信息奖励：</th>
            <td><input type="text" class="textinput w120" name="user[reward_user_perfect]" value="<?=$_webset['reward_user_perfect'];?>">&nbsp;积分</td>
        </tr>
        <tr>
            <th>认证电子邮箱奖励：</th>
            <td><input type="text" class="textinput w120" name="user[reward_auth_email]" value="<?=$_webset['reward_auth_email'];?>">&nbsp;积分</td>
        </tr>
        <tr>
            <th>绑定第三方登录奖励：</th>
            <td><input type="text" class="textinput w120" name="user[reward_quick_login]" value="<?=$_webset['reward_quick_login'];?>">&nbsp;积分</td>
        </tr>
        <!--<tr class="line mt5 mb5"><td colspan="2"></td></tr>
        <tr>
            <th>关注空间任务：</th>
            <td></td>
        </tr>
        <tr>
            <th>关注微信任务：</th>
            <td></td>
        </tr>-->
	</tbody></table>
	<div class="box-footer">
        <div class="box-footer-inner">
        	<input type="hidden" name="formhash" value="<?=formhash();?>">
        	<input type="submit" name="userset" value="保存更改">
        </div>
    </div>
	</div>
</form>
<!--//END-->
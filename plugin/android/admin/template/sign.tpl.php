<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php include(PATH_PLUGIN.'/admin/template/menu.tpl');?>
<div class="box-content">
<form method="post" action="<?=$_plugin_url;?>&pmod=sign">
	<p class="line mt10 mb10"></p>
    <table class="table-font"><tbody>
        <tr>
            <th class="w180">每天奖励：</th>
            <td>
            	<input type="text" class="textinput w60" name="android[android_reward_sign_day]" value="<?=$_webset['android_reward_sign_day'];?>">
            	积分
            </td>
        </tr>
        <tr>
            <th class="w180">连续天数：</th>
            <td>
            	<input type="text" class="textinput w60" name="android[android_reward_continuous_day]" value="<?=$_webset['android_reward_continuous_day'];?>">
            	天
            	递增
            	<input type="text" class="textinput w60" name="android[android_reward_plus]" value="<?=$_webset['android_reward_plus'];?>">
            	积分
            </td>
        </tr>
        <tr>
            <th class="w180">每日最多获取：</th>
            <td>
            	<input type="text" class="textinput w60" name="android[android_reward_daymax]" value="<?=$_webset['android_reward_daymax'];?>">
            	积分
            </td>
        </tr>
    </tbody></table>
    <p class="line mt10 mb10"></p>
<div class="box-footer">
    <div class="box-footer-inner">
    	<input type="hidden" name="formhash" value="<?=formhash();?>">
    	<input type="submit" name="signset" value="保存更改">
    </div>
</div>
</form>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
<?php include(PATH_TPL."/public/header.tpl.php");?>
<!--//START-->
<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>">
	<!--//网站设置->基本设置-->
	<div class="box-content">
	<table class="table-font"><tbody>
		<tr>
		    <th class="w120">是否显示详细页:</th>
		    <td>
		    	<input type="radio" name="taobao[taoke_showinfo]" value="1" id="taoke_showinfo_1">
		    		<label for="taoke_showinfo_1" class="mr10">显示详细页</label>
		    	<input type="radio" name="taobao[taoke_showinfo]" value="0" id="taoke_showinfo_0">
		    		<label for="taoke_showinfo_0" class="mr10">不显示详细页</label>
		    	<script type="text/javascript">
	         	$("#taoke_showinfo_"+<?=intval($_webset['taoke_showinfo']);?>).attr("checked","checked");
	         	</script>
	         	<span class="tip">用户点击商品列表时跳转方式</span>
		    </td>
		</tr>
		<tr>
		    <th>跳转方式:</th>
		    <td>
		    	<input type="radio" name="taobao[taoke_jump]" value="1" id="taoke_jump_1">
		    		<label for="taoke_jump_1" class="mr10">不经过爱淘宝</label>
		    	<input type="radio" name="taobao[taoke_jump]" value="0" id="taoke_jump_0">
		    		<label for="taoke_jump_0" class="mr10">经过爱淘宝</label>
		    	<script type="text/javascript">
	         	$("#taoke_jump_"+<?=intval($_webset['taoke_jump']);?>).attr("checked","checked");
	         	</script>
	         	<span class="tip">此项有违背阿里妈妈规定，慎重选择</span>
		    </td>
		</tr>                
		<tr>
		    <th style="vertical-align: top;">淘点金代码：</th>
		    <td>
		    	<textarea name="taobao[taoke_dianjin]" style="width: 360px;height: 250px;float:left"><?=$_webset['taoke_dianjin'];?></textarea>
		    	<span class="tip fl">
		    	1、首次开通淘点金代码，大约需要2小时生效！（<a href="http://www.alimama.com" class="red" target="_blank">前往阿里妈妈</a>）<br/>
				2、淘点金代码必须在你申请淘点金的域名下才可使用<br/>
				3、<a href="http://bbs.wangyue.cc/forum.php?mod=viewthread&tid=31&extra=page%3D1" class="red" target="_blank">淘点金代码获取教程</a>
		    	</span>
		    </td>
		</tr>
	</tbody></table>
	</div>
	<div class="box-footer">
        <div class="box-footer-inner">
        	<input type="hidden" name="formhash" value="<?=formhash();?>">
        	<input type="submit" name="taobaoset" value="保存更改">
        </div>
    </div>
</form>
<!--//END-->
<?php include(PATH_TPL."/public/footer.tpl.php");?>
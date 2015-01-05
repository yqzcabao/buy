<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"';?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="<?=$_extend_url;?>&pmod=user&op=list">卖家列表</a></li>
	<li <?=$active['add'];?>><a href="<?=$_extend_url;?>&pmod=user&op=add">添加卖家</a></li>
</ul>
<div class="box-content">
<?php if($op=='list'){ ?>
	<div class="table">
	<form method="POST">
	  	<div class="th">
			用户搜索:
			<input type="text" name="keyword" value="<?=request('keyword','');?>" placeholder="用户名/email">
			<input type="submit" value="搜索">
	    </div>
	</form>
	</div>
	<form method="POST" action="<?=$_extend_url;?>&pmod=del" onsubmit="return confirmdel();">
		<div class="table">
	    <table class="admin-tb"><tbody>
		    <tr>
		    	<th width="10" class="text-center">
		    		<input type="checkbox" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
		    	</th>
		    	<th width="200">用户</th>
		        <th width="50">邮箱</th>
		    	<th width="100" class="text-center">注册时间</th>
		    	<th width="100" class="text-center">登录时间</th>
		    	<th width="50" class="text-center">qq</th>
		    	<th width="50" class="text-center">手机</th>
		    	<th width="50" class="text-center">支付宝</th>
		        <th width="80" class="text-center">操作</th>
		    </tr>
		    <?php foreach ($userlist as $key=>$value){ ?>
		    <tr>
		    	<td class="text-center">
		    		<input type="checkbox" name="id[]" value="<?=$value['uid'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
		    	</td>
		        <td class="text-left">
		        	<img src="../<?=avatar($value['uid'],'small');?>" style="vertical-align: middle;width: 30px;height: 30px;">
		        	<?=$value['uname'];?>
		        	<?php if(!empty($value['api'])){ ?>
		        		(<?=$value['api'];?>快捷登录)
		        	<?php } ?>
		        </td>
		        <td class="text-center"><?=$value['email'];?></td>
		        <td class="text-center">
		        		<?php if(empty($value['regtime'])){ ?>
		        		--
		        		<?php }else{ ?>
		        		<?=date('Y-m-d H:i:s',$value['regtime']);?>
		        		<?php } ?>
		        		</td>
		        <td class="text-center">
		        		<?php if(empty($value['logintime'])){ ?>
		        		--
		        		<?php }else{ ?>
		        		<?=date('Y-m-d H:i:s',$value['logintime']);?>
		        		<?php } ?>
		        </td>
		        <td class="text-center"><?=$value['qq'];?></td>
		        <td class="text-center"><?=$value['mobile'];?></td>
		        <td class="text-center"><?=$value['alipay'];?></td>
		        <td class="text-center">
		        	[<a href="<?=$_extend_url;?>&pmod=user&op=add&uid=<?=$value['uid'];?>">修改</a>] &nbsp;
		        </td>
		    </tr>
		    <?php } ?>
	    </tbody></table>
		</div>
		<div class="box-footer">
			<!--//分页-->
			<?php include(PATH_TPL."/public/pages.tpl");?>       
		    <div class="box-footer-inner">
		    	<input type="hidden" name="op" value="user">
		    	<input type="hidden" name="gomod" value="user">
		        <input type="submit" value="删除">
		    </div>
		</div>
	</form>
<?php }elseif ($op=='add'){ ?>
	<form method="post" action="<?=$_extend_url;?>&pmod=user&op=add">
	    <table class="table-font"><tbody>
	        <tr>
	            <th class="w120">用户昵称：</th>
	            <td>
	            	<input type="text" class="textinput w270" name="user_field[user_name]" value="<?=$seller['user_name'];?>">
	            </td>
	        </tr>
	        <tr>
	            <th class="w120">邮箱：</th>
	            <td><input type="text" class="textinput w270" name="user_field[email]" value="<?=$seller['email'];?>"></td>
	        </tr>
	        <tr>
	            <th class="w120">密码：</th>
	            <td><input type="password" class="textinput w270" name="user_field[userpwd]" value=""></td>
	        </tr>
	        <tr>
	            <th class="w120">确认密码：</th>
	            <td><input type="password" class="textinput w270" name="user_field[reuserpwd]" value=""></td>
	        </tr>
	        <tr>
	            <th>激活：</th>
	            <td>
	            	<input type="radio" name="user_field[sta]" value="1" id="sta_1"><label for="sta_1">是</a>&nbsp;
	            	<input type="radio" name="user_field[sta]" value="0" id="sta_0"><label for="sta_0">否</a>&nbsp;
	            	<script type="text/javascript">
		         	$("#sta_<?=intval($seller['sta']);?>").attr("checked","checked");
		         	</script>
	            </td>
	        </tr>
	        <tr>
	            <th>手机：</th>
	            <td><input type="text" class="textinput w270" name="user_field[mobile]" value="<?=$seller['mobile'];?>"></td>
	        </tr>
	        <tr>
	            <th>QQ号码：</th>
	            <td><input type="text" class="textinput w270" name="user_field[qq]" value="<?=$seller['qq'];?>"></td>
	        </tr>
	        <tr>
	            <th>支付宝：</th>
	            <td><input type="text" class="textinput w270" name="user_field[alipay]" value="<?=$seller['alipay'];?>"></td>
	        </tr>
	        <tr>
	            <th>金额：</th>
	            <td><input type="text" class="textinput w270" name="user_field[money]" value="<?=$seller['money'];?>"></td>
	        </tr>
	    </tbody></table>
		<div class="box-footer">
		    <div class="box-footer-inner">
		    	<input type="hidden" name="formhash" value="<?=formhash();?>">
		    	<input type="hidden" name="user_field[uid]" value="<?=$seller['uid'];?>">
		    	<input type="submit" name="selleradd" value="添加">
		    </div>
		</div>
	</form>
<?php } ?>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
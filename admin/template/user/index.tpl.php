<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=list">会员列表</a></li>
	<li <?=$active['adduser'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=adduser">添加会员</a></li>
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
	<form method="POST" action="?mod=public&ac=del" onsubmit="return confirmdel();">
		<div class="table">
	    <table class="admin-tb"><tbody>
		    <tr>
		    	<th width="10" class="text-center">
		    		<input type="checkbox" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
		    	</th>
		    	<th width="60">用户</th>
		        <th width="50">邮箱</th>
		    	<th width="25" class="text-center">积分</th>
		    	<th width="100" class="text-center">注册时间</th>
		    	<th width="100" class="text-center">登录时间</th>
		    	<th width="50" class="text-center">qq</th>
		    	<th width="50" class="text-center">手机</th>
		    	<th width="50" class="text-center">支付宝</th>
                <th width="50" class="text-center">注册IP</th>
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
		        <td class="text-center"><?=$value['integral'];?></td>
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
                <td class="text-center"><?=$value['regip'];?></td>
		        <td class="text-center">
		        	[<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=adduser&uid=<?=$value['uid'];?>">修改</a>] &nbsp;
                    [<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=addintegral&uid=<?=$value['uid'];?>">积分</a>] &nbsp;
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
		    	<input type="hidden" name="gomod" value="<?=MODNAME;?>">
		    	<input type="hidden" name="goac" value="<?=ACTNAME;?>">
		    	<input type="hidden" name="goop" value="<?=$op;?>">
		        <input type="submit" value="删除">
		    </div>
		</div>
	</form>
<?php }elseif ($op=='adduser'){ ?>
	<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=adduser">
	    <table class="table-font"><tbody>
	        <tr>
	            <th class="w120">用户昵称：</th>
	            <td>
	            	<input type="text" class="textinput w270" name="user_field[user_name]" value="<?=$user_field['user_name'];?>">
	            </td>
	        </tr>
	        <tr>
	            <th class="w120">邮箱：</th>
	            <td><input type="text" class="textinput w270" name="user_field[email]" value="<?=$user_field['email'];?>"></td>
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
	            <th>积分：</th>
	            <td><input type="text" class="textinput w270" name="user_field[integral]" value="<?=$user_field['integral'];?>"></td>
	        </tr>
	        <tr>
	            <th>激活：</th>
	            <td>
	            	<input type="radio" name="user_field[sta]" value="1" id="sta_1" checked><label for="sta_1">是</a>&nbsp;
	            	<input type="radio" name="user_field[sta]" value="0" id="sta_0"><label for="sta_0">否</a>&nbsp;
	            	<?php if(!empty($user_field['uid'])){ ?>
		            	<script type="text/javascript">
			         	$("#sta_"+<?=intval($user_field['sta']);?>).attr("checked","checked");
			         	</script>
		         	<?php } ?>
	            </td>
	        </tr>
	        <tr>
	            <th>手机：</th>
	            <td><input type="text" class="textinput w270" name="user_field[mobile]" value="<?=$user_field['mobile'];?>"></td>
	        </tr>
	        <tr>
	            <th>QQ号码：</th>
	            <td><input type="text" class="textinput w270" name="user_field[qq]" value="<?=$user_field['qq'];?>"></td>
	        </tr>
	        <tr>
	            <th>支付宝：</th>
	            <td><input type="text" class="textinput w270" name="user_field[alipay]" value="<?=$user_field['alipay'];?>"></td>
	        </tr>
	    </tbody></table>
		<div class="box-footer">
		    <div class="box-footer-inner">
		    	<input type="hidden" name="user_field[uid]" value="<?=$user_field['uid'];?>">
		    	<input type="submit" value="添加">
		    </div>
		</div>
	</form>
<?php }elseif ($op=='addintegral'){ ?>
    <form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=addintegral">
        <table class="table-font"><tbody>
            <tr>
                <th class="w120">用户昵称：</th>
                <td>
                    <input type="text" class="textinput w270" name="user_field[user_name]" disabled value="<?=$user_field['user_name'];?>">
                </td>
            </tr>
            <tr>
                <th class="w120">邮箱：</th>
                <td><input type="text" class="textinput w270" name="user_field[email]" disabled value="<?=$user_field['email'];?>"></td>
            </tr>
            <tr>
                <th>当前积分：</th>
                <td>
                    <input type="text" class="textinput w270"  disabled value="<?=$user_field['integral'];?>">
                    <input type="hidden"name="user_field[integral]" value="<?=$user_field['integral'];?>">
                </td>
            </tr>
            <tr>
                <th>修改积分：</th>
                <td><input type="text" class="textinput w270" name="user_field[addintegral]" value=""></td>
            </tr>
            <tr>
                <th>积分详情：</th>
                <td><textarea readonly class="textinput w450 h150" style="height: 150px;"><?php
                        foreach($userlog as $key =>$value){
                            echo date('Y-m-d',$value['addtime']).' : ['.$value['integ'].'] '.$value['exp']."\r\n";
                        }
                        ?></textarea></td>
            </tr>

            </tbody></table>
        <div class="box-footer">
            <div class="box-footer-inner">
                <input type="hidden" name="user_field[uid]" value="<?=$user_field['uid'];?>">
                <input type="submit" value="修改">
            </div>
        </div>
    </form>
<?php } ?>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=list">管理员</a></li>
    <li <?=$active['listadd'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=listadd">添加管理组</a></li>       
</ul>
 <div class="box-content">
<?php if($op=='list'){ ?>
  <form method="POST" action="?mod=public&ac=del" onsubmit="return confirmdel();">
  <div class="table">
        <table class="admin-tb">
        <tbody>
        <tr>
        	<th width="60" class="text-center">
        		<input type="checkbox" name="all" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
        	</th>
            <th width="100">管理员</th>
            <th width="100">邮箱</th>
            <th></th>
            <th width="161">操作</th>
        </tr>
        <?php foreach ($managelist as $key=>$value){ ?>
		<tr>
	        <td class="text-center">
	        	<input type="checkbox" name="id[]" value="<?=$value['uid'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
	        </td>
	        <td class="text-center"><?=$value['user_name'];?></td>
	        <td class="text-center"><?=$value['email'];?></td>
	        <td class="text-center">--</td>
	        <td class="text-center">
	        	[<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=listadd&uid=<?=$value['uid'];?>">修改</a>]
	        </td>
        </tr>
        <?php } ?>                            
        </tbody></table>
        </div>
        <div class="box-footer">
	        <div class="box-footer-inner">
	        	<input type="hidden" name="op" value="manager">
	        	<input type="hidden" name="gomod" value="<?=MODNAME;?>">
	        	<input type="hidden" name="goac" value="<?=ACTNAME;?>">
	        	<input type="hidden" name="goop" value="<?=$op;?>">
	            <input type="submit" value="删除">&nbsp;&nbsp;
	        </div>
	    </div>
    </form>
	<?php }elseif($op=='listadd'){ ?>
	<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=listadd">   
        <table class="table-font"><tbody>
        	<tr>
                <th class="w120">登陆名：</th>
                <td><?=$manager['user_name'];?>
                  <input type="<?php if(!empty($manager['user_name'])){ ?>hidden<?php }else{ ?>text<?php } ?>" class="textinput w270" name="manager[user_name]" value="<?=$manager['user_name'];?>">
                </td>
            </tr>
            <tr>
                <th class="w120">邮箱：</th>
                <td>
                <?=$manager['email'];?>
                <input type="<?php if(!empty($manager['email'])){ ?>hidden<?php }else{ ?>text<?php } ?>" class="textinput w270" name="manager[email]" value="<?=$manager['email'];?>">
                </td>
            </tr>
            <tr>
                <th class="w120">密码：</th>
                <td><input type="password" class="textinput w270" name="manager[userpwd]" value=""></td>
            </tr>
            <tr>
                <th class="w120">确认密码：</th>
                <td><input type="password" class="textinput w270" name="manager[reuserpwd]" value=""></td>
            </tr>
        </tbody></table>
	    <div class="box-footer">
	        <div class="box-footer-inner">
	        	<input type="hidden" name="manager[uid]" value="<?=$manager['uid'];?>">
	        	<input type="submit" value="添加">
	        </div>
	    </div>
    </form>
    <?php } ?>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['navlist'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=navlist">导航列表</a></li>
	<li <?=$active['navadd'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=navadd">添加导航</a></li>       
</ul>
<p class="line"></p>
<div class="box-content">
<?php if($op=='navlist'){ ?>
<form method="POST" action="?mod=public&ac=del" onsubmit="return confirmdel();">
	<div class="table">
		<table class="admin-tb"><tbody>
		    <tr>
		    	<th width="10" class="text-center">
		    		<input type="checkbox" name="all" class="allbox"  onclick="checkAll($(this),$('.checkbox'));">
		    	</th>
		        <th width="200">导航名称</th>
		        <th width="100">模型</th>
		        <th width="100">行为</th>
		        <th width="100">短标示</th>
		        <th width="100">目标</th>
		    	<th width="100">是否隐藏</th>
		    	<th width="100">排序</th>
		        <th width="161">操作</th>
		    </tr>
		    <?php foreach ($_nav as $key=>$value){ ?>
			<tr>
		        <td class="text-center">
		        	<input type="checkbox" name="id[]" value="<?=$value['id'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
		        </td>
		        <td class="text-center"><?=$value['name'];?></td>
		        <td class="text-center"><?=$value['mod'];?></td>
		        <td class="text-center"><?=$value['ac'];?></td>
		        <td class="text-center"><?=$value['tag'];?></td>
		        <td class="text-center"><?php if(!empty($value['target'])){ ?>新窗口<?php }else{ ?>--<?php } ?></td>
		        <td class="text-center"><?php if(!empty($value['hide'])){ ?>是<?php }else{ ?>否<?php } ?></td>
		        <td class="text-center"><?=$value['sort'];?></td>
		        <td class="text-center">
		        	[<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=navadd&id=<?=($value['mod'].'/'.$value['ac']);?>">修改</a>]
		        </td>
		    </tr>
		    <?php } ?>                               
		</tbody></table>
	</div>
	<div class="box-footer">
	    <div class="box-footer-inner">
	    	<input type="hidden" name="gomod" value="<?=MODNAME;?>">
	    	<input type="hidden" name="goac" value="<?=ACTNAME;?>">
	    	<input type="hidden" name="goop" value="<?=$op;?>">
	    	<input type="hidden" name="op" value="nav">
	        <input type="submit" value="删除">&nbsp;&nbsp;
	    </div>
	</div>
</form>
<?php }elseif ($op=='navadd'){ ?>
<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=navadd">
	<table class="table-font"><tbody>
        <tr>
            <th class="w120">导航名称：</th>
            <td><input type="text" class="textinput w270" name="nav[name]" value="<?=$nav['name'];?>"></td>
        </tr>
        <tr>
            <th class="w120">模型：</th>
            <td><input type="text" class="textinput w270" name="nav[mod]" value="<?=$nav['mod'];?>"></td>
        </tr>
        <tr>
            <th class="w120">行为：</th>
            <td><input type="text" class="textinput w270" name="nav[ac]" value="<?=$nav['ac'];?>"></td>
        </tr>
        <tr>
            <th class="w120">短标示：</th>
            <td><input type="text" class="textinput w270" name="nav[tag]" value="<?=$nav['tag'];?>"></td>
        </tr>
        <tr>
            <th>自定义链接：</th>
            <td>
            	<input type="text" class="textinput w270" name="nav[url]" value="<?=$nav['url'];?>">
            	<span class="tip">自定义连接： 以http://开头，添加绝对地址</span>
            </td>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <td>
            	<input type="checkbox" name="nav[target]" value="1" <?php if($nav['target']==1){ ?>checked<?php } ?> id="target1">
            	<label for="target1">是否在新窗口打开</label></td>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <td>
            	<input type="checkbox" name="nav[hide]" value="1" <?php if($nav['hide']==1){ ?>checked<?php } ?> id="hide1">
            	<label for="hide1">是否隐藏</label>
            </td>
        </tr>
        <tr>
            <th>排序：</th>
            <td>
            	<input type="text" class="textinput w70" name="nav[sort]" value="<?=$nav['sort'];?>">
            	<span class="tip">数字越大越靠前,0为最小值</span>
            </td>
        </tr>
        <tr>
            <th style="vertical-align: top;">简介：</th>
            <td>
            <textarea class="w360 h80" name="nav[remark]"><?=$nav['remark'];?></textarea>
            </td>
        </tr>
    </tbody></table>
    <div class="box-footer">
	    <div class="box-footer-inner">
	    	<input type="hidden" name="nav[id]" value="<?=$nav['id'];?>">
	    	<input type="hidden" name="formhash" value="<?=formhash();?>">
	    	<input type="submit" name="navadd" value="添加">
	    </div>
	</div>
</form>
<?php } ?>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
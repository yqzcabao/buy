<?php include(PATH_TPL."/public/header.tpl.php");?>
<ul class="nav">
	<li <?=$active['linkList'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=linkList">友情链接</a></li>
    <li <?=$active['linkAdd'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=linkAdd">添加友链</a></li>       
</ul>
<div class="box-content">
<?php if(request('op','linkList')=='linkList'){ ?>
	<form method="POST" action="?mod=public&ac=del" onsubmit="return confirmdel();">
	<div class="table">
        <table class="admin-tb"><tbody>
        <tr>
        	<th width="60" class="text-center">
        		<input type="checkbox" name="all" class="allbox" onclick="checkAll($(this),$('.checkbox'));" >
        	</th>
            <th width="100">友情链接标题</th>
            <th width="150">图片</th>
            <th width="150">链接</th>
            <th width="100">首页显示</th>
            <th width="100">排序</th>
            <th width="100">操作</th>
        </tr>
        <?php if(!empty($_link) && is_array($_link)){ ?>
        <?php foreach ($_link as $key=>$value){ ?>
		<tr>
	        <td class="text-center">
	        	<input type="checkbox" name="id[]" value="<?=$value['id'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
	        </td>
	        <td class="text-center"><?=$value['title'];?></td>
	        <td class="text-center"><?=$value['pic'];?></td>
	        <td class="text-center"><?=$value['url'];?></td>
	        <td class="text-center"><?=$value['isindex']==1?"是":"否";?></td>
	        <td class="text-center"><?=$value['sort'];?></td>
	        <td class="text-center">
	        	[<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=linkAdd&id=<?=$value['id'];?>">修改</a>]&nbsp;&nbsp;
	        </td>
        </tr>
        <?php } ?>
        <?php } ?>                               
        </tbody></table>
    </div>
    <div class="box-footer">
	    <div class="box-footer-inner">
	    	<input type="hidden" name="gomod" value="<?=MODNAME;?>">
	    	<input type="hidden" name="goac" value="<?=ACTNAME;?>">
	    	<input type="hidden" name="goop" value="<?=$op;?>">
	    	<input type="hidden" name="op" value="link">
	        <input type="submit" value="删除">
	    </div>
	</div>
    </form>
<?php }elseif(request('op')=='linkAdd'){ ?>
	<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>">
        <table class="table-font"><tbody>
            <tr>
                <th class="w120">网站标题：</th>
                <td><input type="text" class="textinput w270" name="link[title]" value="<?=$link['title'];?>"></td>
            </tr>
            <tr>
                <th class="w120">网址：</th>
                <td><input type="text" class="textinput w270" name="link[url]" value="<?=$link['url'];?>"></td>
            </tr>
            <tr>
                <th class="w120">图片：</th>
                <td>
                	<input type="text" class="textinput w270" name="link[pic]" value="<?=$link['pic'];?>">
                	<input id="fileupload" type="file" name="linkpic" action="../?mod=ajax&ac=operat&op=ajaxfile"> 
					<script type="text/javascript">
					ajaxFileUpload("fileupload",'setlinkpic');
					</script>
                </td>
            </tr>
            <tr>
                <th class="w120">首页显示：</th>
                <td>
                	<?=showRadio('link[isindex]',array('0'=>'否','1'=>'是'),intval($link['isindex']),'isindex');?>
                </td>
            </tr>
            <tr>
                <th>排序：</th>
                <td>
                	<input type="text" class="textinput w70" name="link[sort]" value="<?=$link['sort'];?>">
                </td>
            </tr>
        </tbody></table>
    <div class="box-footer">
        <div class="box-footer-inner">
        	<input type="hidden" name="link[id]" value="<?=$link['id'];?>">
        	<input type="submit" value="添加">
        </div>
    </div>
    </form>
<?php } ?>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
<?php include(PATH_TPL."/public/header.tpl.php");?>
	<ul class="nav">
   		<li <?=$active['list'];?>><a href="?mod=article&ac=list&op=list">文章管理</a></li>
   	    <li <?=$active['articleAdd'];?>><a href="?mod=article&ac=list&op=articleAdd">添加文章</a></li>       
   </ul>
<div class="box-content">
   <?php if(request('op','list')=='list'){ ?>
   <div class="table">
      <form method="POST" action="?mod=public&ac=del" onsubmit="return confirmdel();">
	        <table class="admin-tb">
	        <tbody>
	        <tr>
	        	<th width="10" class="text-center">
	        		<input type="checkbox" name="all" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
	        	</th>
	        	<th width="20">ID</th>
	            <th width="200">标题</th>
	            <th width="100">分类</th>
	            <th width="100">自定义链接</th>
	            <th width="100">时间</th>
	            <th width="161">操作</th>
	        </tr>
	        <?php foreach ($articlelist as $key=>$value){ ?>
			<tr>
		        <td class="text-center">
		        	<input type="checkbox" name="id[]" value="<?=$value['id'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
		        </td>
		         <td class="text-center"><?=$value['id'];?></td>
		        <td class="text-center"><?=$value['title'];?></td>
		        <td class="text-center"><?=$catlist['cid_'.$value['cid']]['title'];?></td>
		        <td class="text-center"><?=$value['url'];?></td>
		        <td class="text-center"><?=date('Y-m-d H:i',$value['addtime']);?></td>
		        <td class="text-center">
		        	[<a href="?mod=article&ac=list&op=articleAdd&id=<?=$value['id'];?>">修改</a>]
		        </td>
	        </tr>
	        <?php } ?>                               
	        </tbody></table>
	        <div class="box-footer">
	        	<?php include(PATH_TPL."/public/pages.tpl");?>
		        <div class="box-footer-inner">
		        	<input type="hidden" name="op" value="article">
	    			<input type="hidden" name="gomod" value="<?=MODNAME;?>">
	    			<input type="hidden" name="goac" value="<?=ACTNAME;?>">
	    			<input type="hidden" name="goop" value="<?=$op;?>">
			        <input type="submit" value="删除">
		        </div>
		    </div>
	    </form>
    </div>
	<?php }elseif(request('op')=='articleAdd'){ ?>
	<?php include(PATH_TPL."/public/KindEditor.tpl");?>
	<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=articleAdd">
        <table class="table-font"><tbody>
            <tr>
                <th class="w120">栏目分类：</th>
                <td>
                <select name="article[cid]">                	
                <?php foreach ($catlist as $key=>$value){ ?>
                <option value="<?=$value['id'];?>" <?php if($value['id']==$article['cid']){ ?>selected<?php } ?>><?=str_pad('',$value['level']-1,"-=",STR_PAD_LEFT);?><?=$value['title'];?></option>
                <?php } ?>
                </select>
                </td>
            </tr>
            <tr>
                <th class="w120">文章标题：</th>
                <td><input type="text" class="textinput w270" name="article[title]" value="<?=$article['title'];?>"></td>
            </tr>
            <tr>
                <th>自定义链接：</th>
                <td>
                	<input type="text" class="textinput w270" name="article[url]" value="<?=$article['url'];?>">
                </td>
            </tr>
            <tr>
                <th class="w120" style="vertical-align: top;">内容：</th>
                <td><textarea style="width:700px;height:400px" id="content" name="article[content]"><?=$article['content'];?></textarea></td>
            </tr>
        </tbody></table>
	    <div class="box-footer">
	        <div class="box-footer-inner">
	        	<input type="hidden" name="article[id]" value="<?=$id;?>">
	        	<input type="submit" value="添加">
	        </div>
	    </div>
    </form>
	<?php } ?>  
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
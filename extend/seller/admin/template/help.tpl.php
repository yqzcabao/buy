<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="<?=$_extend_url;?>&pmod=help&op=list">报名指南</a></li>
	<li <?=$active['add'];?>><a href="<?=$_extend_url;?>&pmod=help&op=add">添加指南</a></li>       
</ul>
<div class="box-content">
   <?php if($op=='list'){ ?>
   <div class="table">
      <form method="POST" action="<?=$_extend_url;?>&pmod=del" onsubmit="return confirmdel();">
	        <table class="admin-tb">
	        <tbody>
	        <tr>
	        	<th width="10" class="text-center">
	        		<input type="checkbox" name="all" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
	        	</th>
	            <th width="200">标题</th>
	            <th width="100">自定义链接</th>
	            <th width="100">时间</th>
	            <th width="100">排序</th>
	            <th width="161">操作</th>
	        </tr>
	        <?php foreach ($guide_list as $key=>$value){ ?>
			<tr>
		        <td class="text-center">
		        	<input type="checkbox" name="id[]" value="<?=$value['gid'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
		        </td>
		        <td class="text-center"><?=$value['title'];?></td>
		        <td class="text-center"><?=$value['url'];?></td>
		        <td class="text-center"><?=date('Y-m-d H:i',$value['addtime']);?></td>
		        <td class="text-center"><?=$value['sort'];?></td>
		        <td class="text-center">
		        	[<a href="<?=$_extend_url;?>&pmod=help&op=add&gid=<?=$value['gid'];?>">修改</a>]
		        </td>
	        </tr>
	        <?php } ?>                               
	        </tbody></table>
	        <div class="box-footer">
		        <div class="box-footer-inner">
		        	<input type="hidden" name="op" value="help">
					<input type="hidden" name="gomod" value="help">
			        <input type="submit" value="删除">
		        </div>
		    </div>
	    </form>
    </div>
	<?php }elseif($op=='add'){ ?>
	<?php include(PATH_TPL."/public/KindEditor.tpl");?>
	<form method="post" action="<?=$_extend_url;?>&pmod=help&op=add">
        <table class="table-font"><tbody>
            <tr>
                <th class="w120">文章标题：</th>
                <td><input type="text" class="textinput w270" name="guide[title]" value="<?=$guide['title'];?>"></td>
            </tr>
            <tr>
                <th>自定义链接：</th>
                <td>
                	<input type="text" class="textinput w270" name="guide[url]" value="<?=$guide['url'];?>">
                </td>
            </tr>
            <tr>
                <th>排序：</th>
                <td>
                	<input type="text" class="textinput w60" name="guide[sort]" value="<?=$guide['url'];?>">
                </td>
            </tr>
            <tr>
                <th class="w120" style="vertical-align: top;">内容：</th>
                <td><textarea style="width:700px;height:400px" id="content" name="guide[content]"><?=$guide['content'];?></textarea></td>
            </tr>
        </tbody></table>
	    <div class="box-footer">
	        <div class="box-footer-inner">
	        	<input type="hidden" name="guide[gid]" value="<?=$guide['gid'];?>">
	        	<input type="hidden" name="formhash" value="<?=formhash();?>">
	        	<input type="submit" name="guide_form" value="添加">
	        </div>
	    </div>
    </form>
	<?php } ?>  
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
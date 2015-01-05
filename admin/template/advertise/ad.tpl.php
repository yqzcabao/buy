<?php 
include(PATH_TPL."/public/header.tpl.php");
include(PATH_TPL."/public/timepicker.tpl");
?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['adList'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=adList">广告列表</a></li>
    <li <?=$active['adAdd'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=adAdd">添加广告</a></li>       
</ul>
<div class="box-content">
<?php if(request('op','adList')=='adList'){ ?>
<form method="POST" action="?mod=public&ac=del" onsubmit="return confirmdel();">
	<div class="table">
    <table class="admin-tb"><tbody>
        <tr>
        	<th width="60" class="text-center">
        		<input type="checkbox" name="all" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
        	</th>
        	<th width="40">ID</th>
            <th width="100">名字</th>
            <th width="100">代码</th>
            <th width="200">说明</th>
            <th width="100">开始时间</th>
             <th width="100">结束时间</th>
            <th width="100">操作</th>
        </tr>
        <?php if(!empty($_ad['ad_0'])){ ?>
        <?php foreach ($_ad['ad_0'] as $key=>$value){ ?>
		<tr>
	        <td class="text-center">
	        	<input type="checkbox" name="id[]" value="<?=$value['id'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
	        </td>
	        <td class="text-center"><?=$value['id'];?></td>
	        <td class="text-center"><?=$value['title'];?></td>
	        <td class="text-center"><input type="text" value="<?='<?=A('.$value['id'].');?>';?>"/></td>
	        <td class="text-center"><?=$value['remark'];?></td>
	        <td class="text-center">
	        	<?php if(empty($value['start'])){?>-<?php }else{ ?><?=date('Y-m-d H:i:s',$value['start']);?><?php } ?></td>
	        <td class="text-center">
	        	<?php if(empty($value['end'])){?>-<?php }else{ ?><?=date('Y-m-d H:i:s',$value['end']);?><?php } ?></td>
	        <td class="text-center">
	        	[<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=adAdd&id=<?=$value['id'];?>">修改</a>]&nbsp;&nbsp;
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
    		<input type="hidden" name="op" value="advertise">
            <input type="submit" value="删除">
        </div>
    </div>
</form>
<?php }elseif(request('op')=='adAdd'){ ?>
<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=adAdd">
<table class="table-font"><tbody>
    <tr>
        <th class="w120">广告标题：</th>
        <td><input type="text" class="textinput w270" name="ad[title]" value="<?=$ad['title'];?>"></td>
    </tr>
    <tr>
        <th class="w120">链接：</th>
        <td><input type="text" class="textinput w270" name="ad[url]" value="<?=$ad['url'];?>"></td>
    </tr>
    <tr>
        <th class="w120">图片：</th>
        <td>
        	<input type="text" class="textinput w270" name="ad[pic]" id="adpic" value="<?=$ad['pic'];?>">
        	<input id="fileupload" type="file" name="adpic" action="../?mod=ajax&ac=operat&op=ajaxfile"> 
			<script type="text/javascript">
			ajaxFileUpload("fileupload",'setadpic');
			</script>
        </td>
    </tr>
    <tr>
        <th class="w120">宽度：</th>
        <td>
        	<input type="text" class="textinput w270" name="ad[width]" value="<?=$ad['width'];?>">px
        </td>
    </tr>
    <tr>
        <th class="w120">高度：</th>
        <td>
        	<input type="text" class="textinput w270" name="ad[height]" value="<?=$ad['height'];?>">px
        </td>
    </tr>
    <tr>
        <th class="w120">边距：</th>
        <td>
        	（上）<input type="text" class="textinput w70" name="ad[top]" value="<?=$ad['top'];?>" style="margin-bottom:5px">px<br/>
        	（下）<input type="text" class="textinput w70" name="ad[bottom]" value="<?=$ad['bottom'];?>" style="margin-bottom:5px">px<br/>
        	（左）<input type="text" class="textinput w70" name="ad[left]" value="<?=$ad['left'];?>" style="margin-bottom:5px">px<br/>
        	（右）<input type="text" class="textinput w70" name="ad[right]" value="<?=$ad['right'];?>" style="margin-bottom:5px">px<br/>
        </td>
    </tr>
    <tr>
        <th class="w120" style="vertical-align: top;">自定义代码：</th>
        <td>
        	<textarea name="ad[content]" class="w270" style="width:270px; height:100px;"><?=$ad['content'];?></textarea>
        </td>
    </tr>
    <tr>
        <th class="w120">开始时间：</th>
        <td>
        	<input type="text" class="textinput w270 timepicker" name="ad[start]" 
					value="<?php if(!empty($ad['start'])){echo date('Y-m-d H:i:s',$ad['start']);}?>">
        </td>
    </tr>
    <tr>
        <th class="w120">结束时间：</th>
        <td>
        	<input type="text" class="textinput w270 timepicker" name="ad[end]" 
					value="<?php if(!empty($ad['end'])){echo date('Y-m-d H:i:s',$ad['end']);}?>">
        </td>
    </tr>
    <tr>
        <th class="w120" style="vertical-align: top;">备注：</th>
        <td>
        	<textarea name="ad[remark]" cols="40" rows="5" style="width:270px; height:60px;"><?=$ad['remark'];?></textarea>
        </td>
    </tr>
</tbody></table>
<div class="box-footer">
    <div class="box-footer-inner">
    	<input type="hidden" name="ad[id]" value="<?=$ad['id'];?>">
    	<input type="hidden" name="formhash" value="<?=formhash();?>">
    	<input type="submit" name="addad" value="添加">
    </div>
</div>
</form>
<?php } ?>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
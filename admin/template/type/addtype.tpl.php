<form method="post" action="?mod=<?=MODNAME;?>&ac=cat&op=add">
    <table class="table-font">
        <tbody><tr>
            <th class="w120">分类名称：</th>
            <td><input type="text" class="textinput w270" name="cat[title]" value="<?=$cat['title'];?>"></td>
        </tr>
        <tr>
            <th>上级分类：</th>
            <td>
            	<select name="cat[pid]">
                <option value="0">顶级分类</option>
                <?php foreach ($catlist as $key=>$value){ ?>
                       <option value="<?=$value['id'];?>" <?php if($cat['pid']==$value['id']){ ?>selected<?php } ?>><?=str_pad('',$value['level']-1,"-=",STR_PAD_LEFT);?><?=$value['title'];?></option>
                <?php } ?>
               </select>
            </td>
        </tr>
        <tr>
            <th>分类排序：</th>
            <td><input type="text" class="textinput" name="cat[sort]" value="<?=$cat['sort'];?>"></td>
        </tr>
        <?php if(MODNAME=='main' && ACTNAME=='cat'){ ?>
        <tr>
        	<th style="vertical-align: top;">
            	精品采集设置:
            </th>
            <td>
            	<ul id="source_cat" style="width: 300px;border: 1px #D8D8D8 solid;padding: 10px 20px;overflow-y: auto;float:left;">
            		<li><img src="static/images/loading.gif"></li>
            	</ul>
	            <script type="text/javascript">
	            	//当前id
	            	var cat='<?=intval($cat['id']);?>';
	            	//已经设置过的对应
	            	var hadeset=<?=$hadeset;?>;
					/*数据来源*/
					<?=system::source_jscat('set_source_cat'); ?>
				</script>
            </td>
        </tr>
        <?php } ?>
    </tbody></table>
	<div class="box-footer">
	    <div class="box-footer-inner">
	    	<input type="hidden" name="cat[id]" value="<?=$cat['id'];?>">
	    	<input type="submit" value="添加">
	    </div>
	</div>
</form>
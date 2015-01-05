<script type="text/javascript">
<?=system::getgoods_js(); ?>
</script>
<?php include(PATH_TPL."/public/timepicker.tpl");?>
<form method="post" action="?mod=main&ac=exc&op=add">
    <table class="table-font"><tbody>
        <tr>
            <th class="w120">宝贝链接：</th>
            <td>
            	<input type="text" class="textinput w270" name="url" value="<?php if(!empty($exc['num_iid'])){ ?>http://item.taobao.com/item.htm?id=<?=$exc['num_iid'];?><?php } ?>" id="url">
            	<input type="button" value="一键获取" onclick="getexc($('#url').val())">
            </td>
        </tr>
        <tr>
            <th class="w120">宝贝ID：</th>
            <td><input type="text" class="textinput w70" name="exc[num_iid]" value="<?=$exc['num_iid'];?>"></td>
        </tr>
        <tr>
            <th class="w120">宝贝标题：</th>
            <td><input type="text" class="textinput w270" name="exc[title]" value="<?=$exc['title'];?>"></td>
        </tr>
         <tr>
            <th class="w120">活动时间：</th>
            <td>
            	<input type="text" class="textinput w70 timepicker" name="exc[start]" 
					   value="<?=date('Y-m-d H:i',empty($exc['start'])?strtotime('today'):$exc['start']);?>">
            	&nbsp;-&nbsp;
            	<input type="text" class="textinput w70 timepicker" name="exc[end]" 
					   value="<?=date('Y-m-d H:i',empty($exc['end'])?strtotime('today')+7*24*3600:$exc['end']);?>">
            </td>
        </tr>
        <tr>
            <th class="w120">宝贝图片：</th>
            <td>
            <input type="text" class="textinput w270" name="exc[pic]" value="<?=$exc['pic'];?>">
			<input id="fileupload" type="file" name="excpic" action="../?mod=ajax&ac=operat&op=ajaxfile&type=goods"> 
			<script type="text/javascript">
			ajaxFileUpload("fileupload",'setexcpic');
			</script>
			</td>
        </tr>
        <tr>
            <th class="w120">宝贝价格：</th>
            <td><input type="text" class="textinput" name="exc[price]" value="<?=$exc['price'];?>"></td>
        </tr>
        <tr>
            <th class="w120">宝贝优惠价：</th>
            <td><input type="text" class="textinput" name="exc[promotion_price]" value="<?=$exc['promotion_price'];?>"></td>
        </tr>
        <tr>
            <th>商家旺旺：</th>
            <td><input type="text" class="textinput" name="exc[nick]" value="<?=$exc['promotion_price'];?>"></td>
        </tr>
        <tr>
            <th>提供数量：</th>
            <td><input type="text" class="textinput" name="exc[num]" value="<?=$exc['num'];?>"></td>
        </tr>
        <tr>
            <th>所需积分：</th>
            <td><input type="text" class="textinput" name="exc[needintegral]" value="<?=$exc['needintegral'];?>"></td>
        </tr>
        <!--
        <tr>
            <th>兑换人数：</th>
            <td><input type="text" class="textinput" name="exc[apply]" value="<?=$exc['apply'];?>"></td>
        </tr>-->     
        <tr>
            <th>排序：</th>
            <td><input type="text" class="textinput" name="exc[sort]" value="<?=$exc['sort'];?>"></td>
        </tr>
        <tr>
            <th>兑换说明：</th>
            <td>
            	<textarea id="remark" class="w270" name="exc[remark]"><?=$exc['remark'];?></textarea>
            	<input type="hidden" name="exc[site]" value="<?=$exc['site'];?>">
            	<input type="hidden" name="exc[id]" value="<?=$exc['id'];?>">
            </td>
        </tr>
    </tbody></table>
     <div class="img">
     	<img src="<?php if(!empty($exc['pic'])){ ?><?=get_img($exc['pic']);?><?php }else{ ?><?=DEF_GD_LOGO;?><?php } ?>" style="max-width:290px;">
     </div>
	<div class="box-footer">
	    <div class="box-footer-inner">
	    	<input type="submit" value="添加">
	    </div>
	</div>
</form>
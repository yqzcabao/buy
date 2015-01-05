<script type="text/javascript">
<?=system::getgoods_js(); ?>
</script>
<?php include(PATH_TPL."/public/timepicker.tpl");?>
<form method="post" action="?mod=main&ac=try&op=add">
    <table class="table-font"><tbody>
        <tr>
            <th class="w120">宝贝链接：</th>
            <td>
            	<input type="text" class="textinput w270" name="url" 
					   value="<?php if(!empty($try['num_iid'])){ ?>http://item.taobao.com/item.htm?id=<?=$try['num_iid'];?><?php } ?>" id="url">
            	<input type="button" value="一键获取" onclick="gettry($('#url').val())">
            </td>
        </tr>
        <tr>
            <th class="w120">宝贝ID：</th>
            <td><input type="text" class="textinput w70" name="try[num_iid]" value="<?=$try['num_iid'];?>"></td>
        </tr>
        <tr>
            <th class="w120">宝贝标题：</th>
            <td><input type="text" class="textinput w270" name="try[title]" value="<?=$try['title'];?>"></td>
        </tr>
         <tr>
            <th class="w120">活动时间：</th>
            <td>
            	<input type="text" class="textinput w70 timepicker" name="try[start]" 
					   value="<?=date('Y-m-d H:i',empty($try['start'])?strtotime('today'):$try['start']);?>">
            	&nbsp;-&nbsp;
            	<input type="text" class="textinput w70 timepicker" name="try[end]" 
					   value="<?=date('Y-m-d H:i',empty($try['end'])?strtotime('today')+7*24*3600:$try['end']);?>">
            </td>
        </tr>
        <tr>
            <th class="w120">宝贝图片：</th>
            <td>
            <input type="text" class="textinput w270" name="try[pic]" value="<?=$try['pic'];?>">
			<input id="fileupload" type="file" name="trypic" action="../?mod=ajax&ac=operat&op=ajaxfile&type=goods"> 
			<script type="text/javascript">
			ajaxFileUpload("fileupload",'settrypic');
			</script>
			</td>
        </tr>
        <tr>
            <th class="w120">宝贝价格：</th>
            <td><input type="text" class="textinput" name="try[price]" value="<?=$try['price'];?>"></td>
        </tr>
        <tr>
            <th class="w120">宝贝优惠价：</th>
            <td><input type="text" class="textinput" name="try[promotion_price]" value="<?=$try['promotion_price'];?>"></td>
        </tr>
        <tr>
            <th>商家旺旺：</th>
            <td><input type="text" class="textinput" name="try[nick]" value="<?=$try['promotion_price'];?>"></td>
        </tr>
        <tr>
            <th>提供数量：</th>
            <td><input type="text" class="textinput" name="try[num]" value="<?=$try['num'];?>"></td>
        </tr>
        <tr>
            <th>所需积分：</th>
            <td><input type="text" class="textinput" name="try[needintegral]" value="<?=$try['needintegral'];?>"></td>
        </tr>
        <!--
        <tr>
            <th>申请人数：</th>
            <td><input type="text" class="textinput" name="try[apply]" value="<?=$try['apply'];?>"></td>
        </tr>
        <tr>
            <th>中奖名额：</th>
            <td><input type="text" class="textinput" name="try[payment]" value="<?=$try['payment'];?>"></td>
        </tr>-->          
        <tr>
            <th>排序：</th>
            <td><input type="text" class="textinput" name="try[sort]" value="<?=$try['sort'];?>"></td>
        </tr>
        <tr>
            <th style="vertical-align: top;">试用说明：</th>
            <td>
            	<textarea id="remark" class="w270" name="try[remark]"><?=$try['remark'];?></textarea>
            	<input type="hidden" name="try[site]" value="<?=$try['site'];?>">
            	<input type="hidden" name="try[id]" value="<?=$try['id'];?>">
            </td>
        </tr>
    </tbody></table>
     <div class="img">
     	<img src="<?php if(!empty($try['pic'])){ ?><?=get_img($try['pic']);?><?php }else{ ?><?=DEF_GD_LOGO;?><?php } ?>" style="max-width:290px;">
     </div>
	<div class="box-footer">
	    <div class="box-footer-inner">
	    	<input type="submit" value="添加">
	    </div>
	</div>
</form>
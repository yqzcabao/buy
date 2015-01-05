<script type="text/javascript">
<?=system::getgoods_js(); ?>
var check_img_url='';
<?=system::get_goodsimg_js();?>
//设置
$(function(){
	$(".imglit li img").click(function(){
		$("input[name='good[cat]']").val($(this).attr("bid"));
		//设置时间
		$("input[name='good[start]']").val($(this).attr("start"));
		$("input[name='good[end]']").val($(this).attr("end"));
		$(".imglit li").removeClass("hover");
		$(this).parent().addClass("hover");
	})
})
</script>
<?php 
//分类
$brandlist=brandlist(array('start<='.$_timestamp.' and end>='.$_timestamp));
?>
<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=badd">
    <table class="table-font"><tbody>
        <tr>
            <th class="w120">宝贝链接：</th>
            <td>
            	<input type="text" class="textinput w270" name="url" 
					   value="<?php if(!empty($good['num_iid'])){ ?>http://item.taobao.com/item.htm?id=<?=$good['num_iid'];?><?php } ?>" id="url">
            	<input type="button" value="一键获取" onclick="getgoods($('#url').val())">
            </td>
        </tr>
        <tr>
            <th class="w120">宝贝ID：</th>
            <td><input type="text" class="textinput w70" name="good[num_iid]" value="<?=$good['num_iid'];?>"></td>
        </tr>
        <tr>
            <th class="w120">宝贝标题：</th>
            <td><input type="text" class="textinput w270" name="good[title]" value="<?=$good['title'];?>"></td>
        </tr>
        <tr class="brand" style="">
            <th>品牌：</th>
            <td>
            	<input type="hidden" name="good[cat]" value="<?=$good['cat'];?>">
            	<ul class="imglit">
            	<?php foreach ($brandlist['data'] as $key=>$value){ ?>
            	    <li <?php if($value['bid']==$good['cat']){ ?>class="hover"<?php } ?>>
            			<img src="<?=get_img($value['logo']);?>" bid="<?=$value['bid'];?>" style="max-width:70px;max-height:30px" start="<?=date('Y-m-d H:i',$value['start']);?>" end="<?=date('Y-m-d H:i',$value['end']);?>">
            		</li>
            	<?php } ?>
            	</ul>
            </td>
        </tr>
         <tr>
            <th class="w120">活动时间：</th>
            <td>
            	<input type="text" class="textinput w70 timepicker" name="good[start]" 
					   value="<?=date('Y-m-d H:i',empty($good['start'])?strtotime('today'):$good['start']);?>">
            	&nbsp;-&nbsp;
            	<input type="text" class="textinput w70 timepicker" name="good[end]" 
					   value="<?=date('Y-m-d H:i',empty($good['end'])?strtotime('today')+7*24*3600:$good['end']);?>">
            </td>
        </tr>
        <tr>
            <th class="w120">宝贝图片：</th>
            <td>
            	<input type="hidden" class="textinput w270" name="good[taopic]" value="<?=$good['taopic'];?>">
            	<input type="text" class="textinput w270" name="good[pic]" value="<?=$good['pic'];?>" readonly>
				<input id="fileupload" type="file" name="goodpic" action="../?mod=ajax&ac=operat&op=ajaxfile&type=goods"> 
				<script type="text/javascript">
				ajaxFileUpload("fileupload",'setgoodspic');
				</script>
				<ul class="taoimglist mt10"></ul>
            	<?php if(!empty($good['num_iid'])){ ?>
            	<script type="text/javascript">
            		var check_img_url='<?=$good['pic'];?>'
            		system_getgoodsimg('<?=$good['num_iid'];?>');
            	</script>
            	<?php } ?>
            </td>
        </tr>
        <tr>
            <th class="w120">宝贝价格：</th>
            <td><input type="text" class="textinput" name="good[price]" value="<?=$good['price'];?>"></td>
        </tr>
        <tr>
            <th class="w120">促销价：</th>
            <td><input type="text" class="textinput" name="good[promotion_price]" value="<?=$good['promotion_price'];?>"></td>
        </tr>
        <tr>
            <th>商家旺旺：</th>
            <td><input type="text" class="textinput" name="good[nick]" value="<?=$good['nick'];?>"></td>
        </tr>            
        <tr>
            <th>排序：</th>
            <td><input type="text" class="textinput" name="good[sort]" value="<?=$good['sort'];?>"></td>
        </tr>
        <tr>
            <th>&nbsp;&nbsp;</th>
            <td><?=showCheckbox('good[ispost]',array('1'=>'&nbsp;&nbsp;是否包邮'),$good['ispost'],'ispost','','style="vertical-align:middle;"');?></td>
        </tr>
        <tr>
            <th>&nbsp;&nbsp;</th>
            <td><?=showCheckbox('good[isvip]',array('1'=>'&nbsp;&nbsp;VIP价格'),$good['isvip'],'isvip','','style="vertical-align:middle;"');?></td>
        </tr>
        <tr>
            <th>&nbsp;&nbsp;</th>
            <td><?=showCheckbox('good[ispaigai]',array('1'=>'&nbsp;&nbsp;拍改'),$good['ispaigai'],'ispaigai','','style="vertical-align:middle;"');?></td>
        </tr>
         <tr>
            <th>&nbsp;&nbsp;</th>
            <td><?=showCheckbox('good[isrec]',array('1'=>'&nbsp;&nbsp;是否推荐'),$good['isrec'],'isrec','','style="vertical-align:middle;"');?></td>
        </tr>
        <tr>
		    <th style="vertical-align:top;">备注说明：</th>
		    <td>
		        <textarea id="remark" class="w270" name="good[remark]"><?=$good['remark'];?></textarea>
		        <input type="hidden" name="good[volume]" value="<?=$good['volume'];?>">
		        <input type="hidden" name="good[site]" value="<?=$good['site'];?>">
		        <input type="hidden" name="good[id]" value="<?=$good['id'];?>">
		        <input type="hidden" name="good[channel]" value="<?=brandNid();?>">
		    </td>
		</tr>
    </tbody></table>
     <div class="img">
     	<img src="<?php if(!empty($good['pic'])){ ?><?=get_img($good['pic']);?><?php }else{ ?><?=DEF_GD_LOGO;?><?php } ?>" style="max-width:290px;">
     	<div class="item-commission"></div>
     </div>
	<div class="box-footer">
	    <div class="box-footer-inner">
	    	<input type="submit" value="添加">
	    </div>
	</div>
</form>
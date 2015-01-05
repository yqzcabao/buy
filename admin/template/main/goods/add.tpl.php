<script type="text/javascript">
<?=system::getgoods_js(); ?>
var check_img_url='';
<?=system::get_goodsimg_js();?>
</script>
<?php 
//分类
$catlist=getgoodscat();
//导航频道
$goodnav=navList();
include(PATH_TPL."/public/timepicker.tpl");
?>
<form method="post" action="?mod=main&ac=goods&op=add">
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
        <tr>
            <th>所属频道：</th>
            <td>
            	<select name="good[channel]">
            	<?php foreach ($goodnav as $key=>$value){ ?>
                	<option value="<?=$value['id'];?>" <?php if($value['id']==$good['channel']){ ?>selected<?php } ?>><?=$value['name'];?></option>
                <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>宝贝分类：</th>
            <td>
            	<select name="good[cat]">
				<?php foreach ($catlist as $key=>$value){ ?>
				<option value="<?=$value['id'];?>" <?php if($value['id']==$good['cat']){ ?>selected<?php } ?>>
				<?=str_pad('',$value['level']-1,"-=",STR_PAD_LEFT);?><?=$value['title'];?>
				</option>
				<?php } ?>
                </select>
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
        <!--
        <tr>
            <th class="w120">长方形图片：</th>
            <td>
            	<input type="text" class="textinput w270" name="good[pic]" value="<?=$good['pic'];?>">
				<input id="fileupload" type="file" name="goodpic" action="../?mod=ajax&ac=operat&op=ajaxfile&type=goods"> 
				<script type="text/javascript">
				ajaxFileUpload("fileupload",'setgoodspic');
				</script>
            </td>
        </tr>
        -->
        <tr>
            <th class="w120">宝贝图片：</th>
            <td>
            	<input type="hidden" class="textinput w270" name="good[taopic]" value="<?=$good['taopic'];?>">
            	<input type="text" class="textinput w270" name="good[pic]" value="<?=$good['pic'];?>">
            	<input id="fileupload" type="file" name="goodpic" action="../?mod=ajax&ac=operat&op=ajaxfile&type=goods"> 
            	<script type="text/javascript">
				ajaxFileUpload("fileupload",'setgoodspic');
				</script>
            	<ul class="taoimglist"></ul>
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
            <td>
            	<input type="text" class="textinput" name="good[nick]" value="<?=$good['nick'];?>">
            	<span class="tip">不添加昵称前台详细页面见无法获取评论或打开</span>
            </td>
        </tr>            
        <tr>
            <th>排序：</th>
            <td><input type="text" class="textinput" name="good[sort]" value="<?=$good['sort'];?>"></td>
        </tr>
        <tr>
            <th>&nbsp;&nbsp;</th>
            <td><?=showCheckbox('good[ispost]',array('1'=>'&nbsp;&nbsp;是否包邮'),$good['ispost'],'ispost','');?></td>
        </tr>
        <tr>
            <th>&nbsp;&nbsp;</th>
            <td><?=showCheckbox('good[isvip]',array('1'=>'&nbsp;&nbsp;VIP价格'),$good['isvip'],'isvip','');?></td>
        </tr>
        <tr>
            <th>&nbsp;&nbsp;</th>
            <td><?=showCheckbox('good[ispaigai]',array('1'=>'&nbsp;&nbsp;拍下改价'),$good['ispaigai'],'ispaigai','');?></td>
        </tr>
         <tr>
            <th>&nbsp;&nbsp;</th>
            <td><?=showCheckbox('good[isrec]',array('1'=>'&nbsp;&nbsp;是否推荐'),$good['isrec'],'isrec','');?></td>
        </tr>
        <tr>
		    <th style="vertical-align:top;">备注说明：</th>
		    <td>
		        <textarea id="remark" class="w270 h80" name="good[remark]"><?=$good['remark'];?></textarea>
		        <input type="hidden" name="good[volume]" value="<?=$good['volume'];?>">
		        <input type="hidden" name="good[site]" value="<?=$good['site'];?>">
		        <input type="hidden" name="good[id]" value="<?=$good['id'];?>">
		    </td>
		</tr>
    </tbody></table>
     <div class="img">
     	<img src="<?php if(!empty($good['pic'])){ ?><?=get_img($good['pic'],290);?><?php }elseif (!empty($good['taopic'])){ ?><?=get_img($good['taopic'],290);?><?php }else{ ?><?=DEF_GD_LOGO;?><?php } ?>" style="max-width:290px;">
     </div>
	<div class="box-footer">
	    <div class="box-footer-inner">
	    	<input type="submit" value="添加">
	    </div>
	</div>
</form>
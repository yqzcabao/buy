<?php include(PATH_TPL."/public/header.tpl.php");?>
<script src="<?=PATH_STATIC;?>/js/common.js" type="text/javascript"></script>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="<?=$_extend_url;?>&pmod=activity&op=list">报名活动</a></li>
	<li <?=$active['add'];?>><a href="<?=$_extend_url;?>&pmod=activity&op=add">添加活动</a></li>           
</ul>
<div class="box-content">
<?php if($op=='list'){ ?>
	<form method="POST" action="<?=$_extend_url;?>&pmod=del" onsubmit="return confirmdel();">
	<div class="table">
        <table class="admin-tb"><tbody>
        <tr>
        	<th width="10" class="text-center">
        		<input type="checkbox" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
        	</th>
            <th width="200">活动名称</th>
        	<th width="30" class="text-center">免费</th>
        	<th width="100" class="text-center">付费</th>
        	<th width="50" class="text-center">类型</th>
        	<th width="50" class="text-center">图片尺寸</th>
        	<th width="50" class="text-center">排序</th>
        	<th width="150" class="text-center">说明</th>
            <th width="100" class="text-center">操作</th>
        </tr>
        <?php foreach ($activity_list as $key=>$value){ ?>
        <tr id="data_<?=$value['id'];?>">
        	<td class="text-center">
        		<input type="checkbox" name="id[]" value="<?=$value['aid'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
        	</td>
            <td><?=$value['title'];?></td>
        	<td class="text-center">
        		<?php if($value['free']==1){ ?><img src="static/images/tick.gif"><?php }else{ ?><img src="static/images/cross.gif"><?php } ?>	
        	</td>
        	<td class="text-center">
        		<?php if($value['pay']==1){ ?>
        		<?php foreach ($value['paydetail']['title'] as $k=>$val){ ?>
        			<p><?=$val;?>:<?=$value['paydetail']['money'][$k];?></p>
        		<?php } ?>
        		<?php }else{ ?><img src="static/images/cross.gif"><?php } ?>
        	</td>
        	<td class="text-center"><?=$apply_type[$value['type'].'_'.$value['tid']];?></td>
        	<td class="text-center">
        		<?php if(!empty($value['width']) && !empty($value['height'])){ ?>	
        		<?=$value['width'];?>x<?=$value['height'];?>
        		<?php } ?>
        	</td>
        	<td class="text-center"><?=$value['sort'];?></td>
        	<td class="text-center"><?=$value['explain'];?></td>
        	<td class="text-center">
            	[<a href="<?=$_extend_url;?>&pmod=activity&op=add&aid=<?=$value['aid'];?>">修改</a>]
            </td>
        </tr>
        <?php } ?>
        </tbody></table>
	</div>
	<div class="box-footer">
		<!--//分页-->
		<?php include(PATH_TPL."/public/pages.tpl");?>
	    <div class="box-footer-inner">
	    	<input type="hidden" name="op" value="activity">
			<input type="hidden" name="gomod" value="activity">
	        <input type="submit" value="删除">
	    </div>
	</div>
	</form>
<?php }else{ ?>
	<!--//START-->
	<form method="post" action="<?=$_extend_url;?>&pmod=activity&op=add">
		<!--//网站设置->基本设置-->
		<div class="box-content">
		<table class="table-font"><tbody>
	        <tr>
	            <th class="w120">活动名称：</th>
	            <td><input type="text" class="textinput" name="activity[title]" value="<?=$activity['title'];?>"></td>
	        </tr>
	        <tr>
	            <th>活动类型：</th>
	            <td>
	            	<select name="activity[type]">
	            		<?php foreach ($apply_type as $key=>$val){ ?>
	            		<option value="<?=$key;?>" <?php if($key==$activity['type'].'_'.$activity['tid']){ ?>selected<?php } ?>>
	            			<?=$val;?>
	            		</option>
	            		<?php } ?>
	            	</select>
	            </td>
	        </tr>
	        <tr class="line mt5 mb5"><td colspan="2"></td></tr>
	        <tr>
	            <th>付费类型：</th>
	            <td>
	            	<input type="checkbox" name="activity[free]" value="1" <?php if($activity['free']==1){ ?>checked<?php } ?> id="activity_free"><label for="activity_free">免费</label>
	            	<input type="checkbox" name="activity[pay]" value="1" <?php if($activity['pay']==1){ ?>checked<?php } ?> id="activity_pay"><label for="activity_pay">付费</label>
	            </td>
	        </tr>
	        <tr style="<?php if(intval($activity['pay'])==0){ ?>display:none<?php } ?>">
	            <th>收费明细：</th>
	            <td>
	            	<?php if(intval($activity['pay'])==0){ ?>
	            	<p style="margin-bottom: 5px;">
		            	<input type="text" class="textinput" name="activity[paydetail][title][]" value="" placeholder="如:首页三天">&nbsp;
		            	<input type="text" class="textinput w60" name="activity[paydetail][money][]" value="">&nbsp;元
	            	</p>
	            	<?php }else{ ?>
		            	<?php foreach ($activity['paydetail']['title'] as $k=>$val){ ?>
		            		<p style="margin-bottom: 5px;">
				            	<input type="text" class="textinput" name="activity[paydetail][title][]" value="<?=$val;?>" placeholder="如:首页三天">&nbsp;
				            	<input type="text" class="textinput w60" name="activity[paydetail][money][]" value="<?=$activity['paydetail']['money'][$k];?>">&nbsp;元
			            	</p>
		            	<?php } ?>
	            	<?php } ?>
	            	<a href="javascript:void(0);" class="tip addpay" style="margin-left:0px">+添加明细</a>  
	            </td>
	        </tr>
	        <tr>
	            <th class="w120">图片尺寸：</th>
	            <td>
	            	<input type="text" class="textinput w60" name="activity[width]" value="<?=$activity['width'];?>">
	            	x
	            	<input type="text" class="textinput w60" name="activity[height]" value="<?=$activity['height'];?>">
	            	<span class="tip">长x高(单位px)</span>
	            </td>
	        </tr>
	        <tr>
	            <th class="w120">排序：</th>
	            <td><input type="text" class="textinput w60" name="activity[sort]" value="<?=$activity['sort'];?>"></td>
	        </tr>
	        
	        <tr class="line mt5 mb5"><td colspan="2"></td></tr>
	        <tr>
	            <th>活动要求：</th>
	            <td><textarea class="w360 h80 fl" name="activity[explain]"><?=$activity['explain'];?></textarea></td>
	        </tr>
		</tbody></table>
		<div class="box-footer">
	        <div class="box-footer-inner">
	        	<input type="hidden" name="activity[aid]" value="<?=$activity['aid'];?>">
	        	<input type="hidden" name="formhash" value="<?=formhash();?>">
	        	<input type="submit" name="activityadd" value="保存更改">
	        </div>
	    </div>
		</div>
	</form>
<?php } ?>
</div>	
<?php include(PATH_TPL."/public/footer.tpl.php");?>
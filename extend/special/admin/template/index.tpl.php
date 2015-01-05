<?php include(PATH_TPL."/public/header.tpl.php");?>
<script src="<?=PATH_STATIC;?>/js/common.js" type="text/javascript"></script>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="<?=$_extend_url;?>&pmod=index&op=list">专场管理</a></li>
	<li <?=$active['add'];?>><a href="<?=$_extend_url;?>&pmod=index&op=add">添加专场</a></li>           
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
            <th width="200" class="text-left">专场名称</th>
        	<th width="30" class="text-center">专场介绍</th>
        	<th width="150" class="text-center">添加时间</th>
            <th width="100" class="text-center">操作</th>
        </tr>
        <?php foreach ($special_list as $key=>$value){ ?>
        <tr id="data_<?=$value['id'];?>">
        	<td class="text-center">
        		<input type="checkbox" name="id[]" value="<?=$value['sid'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
        	</td>
            <td><?=$value['title'];?></td>
        	<td class="text-center"><?=$value['summary'];?></td>
        	<td class="text-center"><?=date('Y-m-d H:i:s',$value['addtime']);?></td>
        	<td class="text-center">
            	[<a href="<?=$_extend_url;?>&pmod=index&op=add&sid=<?=$value['sid'];?>">修改</a>]
            </td>
        </tr>
        <?php } ?>
        </tbody></table>
	</div>
	<div class="box-footer">
		<!--//分页-->
		<?php include(PATH_TPL."/public/pages.tpl");?>
	    <div class="box-footer-inner">
	    	<input type="hidden" name="op" value="special">
			<input type="hidden" name="gomod" value="index">
			<input type="hidden" name="goop" value="<?=$op;?>">
	        <input type="submit" value="删除">
	    </div>
	</div>
	</form>
<?php }else{ ?>
	<?php include(PATH_TPL."/public/KindEditor.tpl");?>
	<?php include(PATH_TPL."/public/timepicker.tpl");?>
	<!--//START-->
	<form method="post" action="<?=$_extend_url;?>&pmod=index&op=add">
		<!--//网站设置->基本设置-->
		<div class="box-content">
		<table class="table-font"><tbody>
	        <tr>
	            <th class="w120">专场名称：</th>
	            <td><input type="text" class="textinput w360" name="special[title]" value="<?=$special['title'];?>"></td>
	        </tr>
	        <tr>
	            <th class="w120">专场简介：</th>
	            <td><textarea name="special[summary]" class="w360 fl" style="height:100px"><?=$special['summary'];?></textarea></td>
	        </tr>
	        <tr>
	            <th class="w120">活动时间：</th>
	            <td>
	            	<input type="text" class="textinput w70 timepicker" name="special[endtime]" 
						   value="<?php if($special['endtime']) echo date('Y-m-d H:i',$special['endtime']);?>">
	            </td>
	        </tr>
	       <tr class="line mt5 mb5"><td colspan="2"></td></tr>
	       <tr>
	            <th class="w120">专场展位：</th>
	            <td>
	            <style type="text/css">
				textarea::-webkit-input-placeholder::after {
				    display:block;
				    color:red !important;
				    content:"如:首页A1展位|500|1|1\A或:首页A1展位|500|1";
				}
			    </style>
	            <textarea name="special[position]" class="w360 fl" style="height:200px" placeholder="格式:展位名称|价格|数量|剩余数量"><?php $tag=''; foreach ($special['position'] as $k=>$val){ ?><?=$tag;?><?=$val['name'];?>|<?=$val['price'];?>|<?=$val['num'];?>|<?=$val['remain'];?><?php $tag="\n";} ?></textarea>
	            <span class="tip fl">
		    	1、格式:展位名称|价格|数量|剩余数量[≥0]<br>
		    	2、<span class="red">剩余数量不填写表示表示当前展位没有每购买过</span>
		    	</span>
	            </td>
	        </tr>
	       <tr class="line mt5 mb5"><td colspan="2"></td></tr>
	       <tr>
	            <th class="w120">专场描述：</th>
	            <td>
	            <textarea style="width:700px;height:400px" id="content" name="special[introduce]"><?=$special['introduce'];?></textarea>
	            </td>
	        </tr>
		</tbody></table>
		<div class="box-footer">
	        <div class="box-footer-inner">
	        	<input type="hidden" name="special[sid]" value="<?=$special['sid'];?>">
	        	<input type="hidden" name="formhash" value="<?=formhash();?>">
	        	<input type="submit" name="specialadd" value="保存更改">
	        </div>
	    </div>
		</div>
	</form>
<?php } ?>
</div>	
<?php include(PATH_TPL."/public/footer.tpl.php");?>
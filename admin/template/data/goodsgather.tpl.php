<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=list">采集规则</a></li>
	<li <?=$active['addtask'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=addtask">添加规则</a></li>
</ul>
<p class="line"></p>
<?php if(request('op','list')=='list'){ ?>
<form method="POST" action="?mod=public&ac=del" onsubmit="return confirmdel();">
<div class="box-content">
	<div class="top_box">采集规则说明： 以下采集产品均为本公司客服从各大导购平台,淘宝,淘宝优站等平台进行 佣金评估,产品性价比评估等精心筛选而来！</div>
	<div class="table">
	    <table class="admin-tb">
	    <tbody>
	    <tr>
	    	<th width="10" class="text-center">
	    		<input type="checkbox" name="all" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
	    	</th>
	        <th width="200">规则名</th>
	        <th width="100">频道</th>
	        <th width="200" class="text-center">采集分类</th>
	        <th width="161">操作</th>
	    </tr>
	    <?php foreach ($tasklist as $key=>$value){ ?>
		<tr>
	        <td class="text-center">
	        	<input type="checkbox" name="id[]" value="<?=$value['tid'];?>" class="checkbox" onclick="checkoption($('.allbox'));"></td>
	        <td class="text-left"><?=$value['title'];?></td>
	        <td class="text-center"><?=$goodnav[$value['nav']]['name'];?></td>
	        <td class="text-center">
	        	<?php foreach ($value['rule']['cat'] as $k=>$v){ ?>
	        		<?=$catlist['cid_'.$v]['title'];?>&nbsp;
	        	<?php } ?>
	        </td>
	        <td class="text-center">
	        	[<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=do&tid=<?=$value['tid'];?>">采集</a>]&nbsp;&nbsp;
	        	[<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=addtask&tid=<?=$value['tid'];?>">修改</a>]
	        </td>
	    </tr>
	    <?php } ?>                               
	    </tbody></table>
	</div>
	<div class="box-footer">
	    <div class="box-footer-inner">
	    	<input type="hidden" name="formhash" value="<?=formhash();?>">
	        <input type="hidden" name="op" value="task">
	    	<input type="hidden" name="gomod" value="<?=MODNAME;?>">
	    	<input type="hidden" name="goac" value="<?=ACTNAME;?>">
	        <input type="submit" value="删除" name="del">&nbsp;&nbsp;
	        <input type="button" value="一键采集" onclick="allgather();">&nbsp;&nbsp;
	    </div>
	</div>
</div>
</form>
<?php }elseif(request('op')=='addtask'){ ?>
<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=addtask">
<div class="box-content">
    <table class="table-font"><tbody>
        <tr>
            <th class="w120">规则名称：</th>
            <td><input type="text" class="textinput w270" name="task[title]" value="<?=$task['title'];?>"></td>
        </tr>
        <tr>
            <th class="w120">频道：</th>
            <td>
            <select name="task[nav]">
          	   <?php foreach ($goodnav as $key=>$value){ ?>
               <option value="<?=$value['id'];?>" <?php if($task['nav']==$value['id']){ ?>selected<?php } ?>><?=$value['name'];?></option>
               <?php } ?>
             </select>
            </td>
        </tr>
        <tr>
            <th class="w120">源数据：</th>
            <td><select name="task[rule][nav]"></select>
            <script type="text/javascript">
            /*数据来源*/
            var select_nav='<?=intval($task['rule']['nav']);?>';
            <?=system::source_jsnav('set_source_nav'); ?>
			</script>						
            </td>
        </tr>
        <tr>
            <th class="w120" style="vertical-align: top;">分类筛选：</th>
            <td>
            <ul style="width: 300px;height: 200px;border: 1px #D8D8D8 solid;padding: 10px 20px;overflow-y: auto;float:left;">
            	<li>
            		<input type="checkbox" value="16" style="vertical-align: -2px;margin-right: 2px;" 
						id="allcat" 
						<?php if(empty($task['tid'])){ ?>checked<?php } ?>
						onclick="checkAll($(this),$('.taskcat'));">
            		<label style="color: #2C9CD8;font-weight: bold;">全部</label></li>
            	<?php foreach ($catlist as $key=>$value){ ?>
            	<li>
            		<input name="task[rule][cat][]" type="checkbox" value="<?=$value['id'];?>" id="cat_<?=$value['id'];?>" 
						class="taskcat" 
						onclick="checkoption($('#allcat'));"
						<?php if((isset($task['rule']['cat']) && in_array($value['id'],$task['rule']['cat'])) || empty($task['tid'])){ ?>checked<?php } ?>
						style="vertical-align: -2px;margin-right: 2px;">
            		<label for="cat_<?=$value['id'];?>"><?=$value['title'];?></label>
            	</li>
            	<?php } ?>
            </ul>
            </td>
        </tr>
    </tbody></table>
</div>
<div class="box-footer">
    <div class="box-footer-inner">
    	<input type="hidden" name="task[tid]" value="<?=$task['tid'];?>">
    	<input type="submit" value="添加">
    </div>
</div>
</form>
<?php }elseif(request('op')=='do'){ ?>
<div class="box-content">
	<div class="table">
		<div id="notice"></div>
		<div id="schedule"><b></b><span></span></div>
	</div>
	<!--//采集-->
	<script type="text/javascript">
	var cidtocat=<?=boutiquecidtocat();?>;//系统对应分类
	var parameter=<?=system::boutiqueparameter($task);?>;//采集参数
	var datainfo=<?=json_encode(array('status'=>1,'addtime'=>$_timestamp,'type'=>'batch'));?>;//补全数据
	<?=system::boutique_jsgather(); ?>
	</script>
</div>
<div class="box-footer">
    <div class="box-footer-inner">
    	<input type="button" value="开始采集" name="start">
		<!--<input type="button" value="暂停采集" name="stop">-->
    </div>
</div>
<?php } ?>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
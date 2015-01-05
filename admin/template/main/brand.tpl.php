<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=list">品牌列表</a></li>
	<li <?=$active['add'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=add">添加品牌</a></li>
</ul>
<div class="box-content">
<?php if($op=='list'){ ?>
	<div class="table">
  	<form method="GET">
      	<div class="th">
              <input type="text" name="keyword" value="" placeholder="品牌/描述/昵称">
              <input type="hidden" name="mod" value="goods">
              <input type="hidden" name="ac" value="brand">
              <input type="hidden" name="op" value="brandlist">
              <input type="submit" value="搜索">
        </div>
    </form>
    </div>
    
    <form method="POST" action="?mod=public&ac=del" onsubmit="return confirmdel();">
    	<div class="table">
        <table class="admin-tb">
        <tbody>
        <tr>
        	<th width="10" class="text-center">
        		<input type="checkbox" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
        	</th>
        	<th width="55">品牌图片</th>
            <th width="100">品牌名称</th>
        	<th width="100" class="text-center">昵称</th>
        	<th width="100" class="text-center">地址</th>
        	<th width="100">活动时间</th>
        	<th width="100">添加时间</th>
        	<th width="100">排序</th>
            <th width="100" class="text-center">操作</th>
        </tr>
        <?php foreach ($brandlist as $key=>$value){ ?>
	        <tr id="data_<?=$value['bid'];?>">
	        	<td class="text-center">
	        		<input type="checkbox" name="id[]" value="<?=$value['bid'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
	        	</td>        	
	        	<td class="text-center">
	        		<img onerror="this.onerror=null;this.src='.<?=DEF_GD_LOGO;?>'" src="<?=get_img($value['logo']);?>" style="width:80px;height:40px">
	        	</td>
	            <td>
	            	<a href="<?=$value['url'];?>" target="_blank">
	            	<?=$value['brand'];?>
	            	</a>
	            </td>
	        	<td class="text-center"><?=$value['nick'];?></td>
	        	<td class="text-center"><?=$value['url'];?></td>
	        	<td class="text-center"><?=date('m-d H:i',$value['start']);?><br/><?=date('m-d H:i',$value['end']);?></td>
	        	<td class="text-center"><?=date('m-d H:i',$value['addtime']);?></td>
	        	<td class="text-center"><input type="text" class="w30" value="<?=$value['sort'];?>"></td>
	        	<td class="text-center">
	        		[<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=add&bid=<?=$value['bid'];?>">修改</a>]&nbsp;
	        		[<a href="?mod=<?=MODNAME;?>&ac=goods&op=badd&bid=<?=$value['bid'];?>">添加</a>]&nbsp;
	        		[<a href="?mod=<?=MODNAME;?>&ac=goods&op=blist&bid=<?=$value['bid'];?>">宝贝</a>]&nbsp;
	            </td>
	        </tr>
	        <?php if($value['status']==-1){ ?>
	        <!--//拒绝理由-->
	        <tr><td colspan="14">拒绝理由:<?=$refuse[$value['id']]['refuse'];?></td></tr>
	        <?php } ?>
	        <?php } ?>
        </tbody></table>
		</div>
		<div class="box-footer">
			<?php include(PATH_TPL."/public/pages.tpl");?>
		    <div class="box-footer-inner">
		    	<input type="hidden" name="op" value="brand">
		    	<input type="hidden" name="gomod" value="<?=MODNAME;?>">
    			<input type="hidden" name="goac" value="<?=ACTNAME;?>">
        		<input type="hidden" name="goop" value="<?=$op;?>">
		        <input type="submit" value="删除">
		    </div>
		</div>
    </form>
<?php }elseif($op=='add'){ ?>
	<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=add">
    <table class="table-font"><tbody>
        <tr>
            <th class="w120">品牌名称：</th>
            <td><input type="text" class="textinput w270" name="brand[brand]" value="<?=$brand['brand'];?>"></td>
        </tr>
        <tr>
            <th class="w120">品牌logo：</th>
            <td>
            	<input type="text" class="textinput w270" name="brand[logo]" value="<?=$brand['logo'];?>">
				<input id="fileupload" type="file" name="brandlogo" action="../?mod=ajax&ac=operat&op=ajaxfile">
				<script type="text/javascript">
				ajaxFileUpload("fileupload",'setbrandlogo');
				</script>
            </td>
        </tr>
        
        <tr>
            <th class="w120">优惠信息：</th>
            <td><input type="text" class="textinput w270" name="brand[preferential]" value="<?=$brand['preferential'];?>"></td>
        </tr>
        
        <tr>
            <th class="w120">品牌店铺：</th>
            <td><input type="text" class="textinput w270" name="brand[url]" value="<?=$brand['url'];?>"></td>
        </tr>
        
        <tr>
            <th>商家旺旺：</th>
            <td><input type="text" class="textinput" name="brand[nick]" value="<?=$brand['nick'];?>"></td>
        </tr>
        <tr>
            <th class="w120">活动时间：</th>
            <td>
            	<input type="text" class="textinput w70 timepicker" name="brand[start]" 
					   value="<?=date('Y-m-d H:i',empty($brand['start'])?strtotime('today'):$brand['start']);?>">
            	&nbsp;-&nbsp;
            	<input type="text" class="textinput w70 timepicker" name="brand[end]" 
					   value="<?=date('Y-m-d H:i',empty($brand['end'])?strtotime('today')+7*24*3600:$brand['end']);?>">
            </td>
        </tr>
        <tr>
		    <th style="vertical-align:top;">排序：</th>
		    <td><input type="text" class="textinput" name="brand[sort]" value="<?=$brand['sort'];?>"></td>
		</tr>
        <tr>
		    <th style="vertical-align:top;">品牌说明：</th>
		    <td>
		        <textarea id="remark" class="w270" name="brand[remark]"><?=$brand['remark'];?></textarea>
		    </td>
		</tr>
		
		<tr>
            <th class="w120">品牌广告：</th>
            <td>
            	<input type="text" class="textinput w270" name="brand[pic]" value="<?=$brand['pic'];?>">
				<input id="fileuploadpic" type="file" name="brandpic" action="../?mod=ajax&ac=operat&op=ajaxfile"> 
				<script type="text/javascript">
				ajaxFileUpload("fileuploadpic",'setbrandpic');
				</script>
            </td>
        </tr>
    </tbody></table>
    <div class="img">
     	<img src="<?php if(!empty($brand['logo'])){ ?><?=get_img($brand['logo']);?><?php }else{ ?>.<?=DEF_GD_LOGO;?><?php } ?>" style="width:80px;height:40px">
     	<div class="item-commission"></div>
    </div>
	<div class="box-footer">
	    <div class="box-footer-inner">
	    	<input type="hidden" name="brand[bid]" value="<?=$brand['bid'];?>">
	    	<input type="submit" value="添加">
	    </div>
	</div>
<?php } ?>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['set'];?>><a href="<?=$_extend_url;?>&pmod=report&op=set">举报设置</a></li>
	<li <?=$active['list'];?>><a href="<?=$_extend_url;?>&pmod=report&op=list">举报处理</a></li>   		         
</ul>
<div class="box-content">
<?php if($op=='set'){ ?>
	<form method="post" action="<?=$_extend_url;?>&pmod=report">
		<!--//网站基本信息-->
	    <table class="table-font">
	    	<tbody>
	    	<tr>
	            <th>&nbsp;</th>
	            <td>
	            	<?=showCheckbox('repot[report_login]',array('1'=>'举报是否要求登录'),$_webset['report_login'],'report_login');?>
	            </td>
	        </tr>
	    	<tr>
	            <th>是否开启举报</th>
	            <td>
	            	<?=showRadio('repot[open_report]',array('1'=>'开启','0'=>'关闭'),$_webset['open_report'],'open_report');?>
	            </td>
	        </tr>
	    	<tr>
	            <th class="w120" style="vertical-align: top;">举报原因：</th>
	            <td>
	            	<textarea style="width:300px;height:200px" name="repot[report_reason]"><?=$_webset['report_reason'];?></textarea>
	            </td>
	        </tr>
	    </tbody></table>
		<div class="box-footer">
		    <div class="box-footer-inner">
		    	<input type="hidden" name="formhash" value="<?=formhash();?>">
		    	<input type="submit" name="repotset" value="保存更改">
		    </div>
		</div>
	</form>
<?php }elseif($op=='list'){ ?>
	<div class="table">
		<form method="POST" action="<?=$_extend_url;?>&pmod=report&op=list">
		<div class="th">
	        宝贝名称/举报原因:
	          <input type="text" name="keyword" value="<?=request('keyword','');?>" placeholder="ID/标题/卖家昵称">
	          <input type="submit" value="搜索">
		</div>
		</form>
	</div>
	<form method="POST" action="<?=$_extend_url;?>&pmod=del">
	<div class="table">
        <table class="admin-tb"><tbody>
	        <tr>
	        	<th width="10" class="text-center">
	        		<input type="checkbox" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
	        	</th>
	            <th width="100">宝贝名称</th>
	            <th width="100">举报原因</th>
	        	<th width="25" class="text-center">时间</th>
	        </tr>
	        <?php foreach ($reportlist as $key=>$value){ ?>
	        <tr>
	        	<td class="text-center">
	        	<input type="checkbox" name="id[]" value="<?=$value['rid'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
	        	</td>
	            <td>
	            <a href="../?mod=goods&ac=detail&gid=<?=$value['gid'];?>" target="_blank"><?=$value['good'];?></a></td>
	            <td class="text-center"><?=$value['report'];?></td>
	        	<td class="text-center"><?=date('Y-m-d H:i:s',$value['addtime']);?></td>
	        </tr>
	        <?php } ?>
        </tbody></table>
	 </div>
	 <div class="box-footer">
	 	<?php include(PATH_TPL."/public/pages.tpl");?>
        <div class="box-footer-inner">
        	<input type="hidden" name="gomod" value="report">
    		<input type="hidden" name="goop" value="<?=$op;?>">
    		<input type="radio" name="op" value="report">删除
        	<input type="radio" name="op" value="reportgoods" checked>同时删除宝贝
	        <input type="submit" value="提交">
        </div>
     </div>
    </form>
<?php } ?>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
<?php 
//分类
$brandlist=brandlist();
?>
<div class="table">
  	<form method="GET">
  	<div class="th">
         <select name="cat">
      	   <option value="">分类</option>
      	   <?php foreach ($catlist as $key=>$value){ ?>
           <option value="<?=$value['id'];?>" <?php if(request('cat','')==$value['id']){ ?>selected<?php } ?>>
           		<?=str_pad('',$value['level']-1,"-=",STR_PAD_LEFT);?><?=$value['title'];?>
           </option>
          <?php } ?>
          </select>
          <?=showSelect('ispost',array(''=>'是否包邮','1'=>'包邮','-1'=>'不包邮'),request('ispost',''));?>
          <?=showSelect('isrec',array(''=>'是否推荐','1'=>'推荐','-1'=>'不推荐'),request('isrec',''));?>
          <?=showSelect('ispaigai',array(''=>'是否拍改','1'=>'拍改','-1'=>'非拍改'),request('ispaigai',''));?>
          <?=showSelect('isvip',array(''=>'VIP价格','1'=>'是','-1'=>'否'),request('isvip',''));?>
          <?php if(ACTNAME=='index'){ ?>
          <!--//宝贝管理-->
          <?=showSelect('issteal',array(''=>'是否抢光','1'=>'抢光了','-1'=>'没有抢光'),request('issteal',''));?>
          <?=showSelect('type',array(''=>'状态','1'=>'进行中','-1'=>'已结束','2'=>'未开始'),request('type',''));?>
          <?php } ?>
          <input type="text" name="keyword" value="<?=request('keyword','');?>" placeholder="ID/标题/卖家昵称">
          <input type="hidden" name="mod" value="<?=MODNAME;?>">
          <input type="hidden" name="ac" value="<?=ACTNAME;?>">
           <input type="hidden" name="op" value="<?=$op;?>">
          <input type="submit" value="搜索">
    </div>
    </form>
</div>
<form method="POST" action="?mod=public&ac=del" onsubmit="return confirmdel();">
<div class="table">
    <table class="admin-tb"><tbody>
    <tr>
    	<th width="10" class="text-center">
    		<input type="checkbox" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
    	</th>
    	<th width="55">宝贝图片</th>
        <th width="200">宝贝名称</th>        
    	<th width="50" class="text-center">现/原价</th>
    	<th width="50">佣金</th>
    	<th width="30" class="text-center">卖家</th>
    	<th width="50" class="text-center">品牌</th>
    	<th width="25" class="text-center">推荐</th>
    	<th width="25" class="text-center">包邮</th>
    	<th width="25" class="text-center">vip</th>
    	<th width="25" class="text-center">拍改</th>
    	<th width="25" class="text-center">抢光</th>        	
    	<th width="25" class="text-center">排序</th>        	
    	<th width="100">活动时间</th>
    	<th width="50">状态</th>
        <th width="100" class="text-center">操作</th>
    </tr>
    <?php foreach ($goodslist as $key=>$value){ ?>
    <tr id="data_<?=$value['id'];?>">
    	<td class="text-center">
    		<input type="checkbox" name="id[]" value="<?=$value['id'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
    	</td>        	
    	<td class="text-center">
    		<img onerror="this.onerror=null;this.src='<?=DEF_GD_LOGO;?>'" src="<?=get_img($value['pic'],'290');?>" style="width:50px;margin:2px auto;">
    	</td>
        <td>
        	<img src="static/images/<?=$value['site'];?>.ico" style="vertical-align: middle;">
        	<a href="../?mod=goods&ac=detail&iid=<?=$value['num_iid'];?>" target="_blank">
        	<?=$value['title'];?>
        	</a>
        	<b style="color:red">[<?=$value['nick'];?>]</b>
        </td>
    	<td class="text-center"><?=$value['promotion_price'];?>/<?=$value['price'];?></td>
    	<td class="text-center">
    	<?php if(!empty($value['commission'])){ ?>
    	<?=$value['commission'];?>/<?=$value['commission_rate']/100;?>%
    	<?php }else{ ?>
    	--
    	<?php } ?>
    	</td>
    	<td class="text-center">
    		<a target="_blank" href="http://amos.alicdn.com/msg.aw?v=2&uid=<?=urlencode($value['nick']);?>&site=cntaobao&s=1&charset=utf-8"><img border="0" src="http://amos.im.alisoft.com/online.aw?v=2&uid=<?=urlencode($value['nick']);?>&site=cntaobao&s=2&charset=utf-8" alt="点击这里给我发消息"></a>
    	</td>
    	<td class="text-center">
    		<img src="<?=get_img($brandlist['data']['bid_'.$value['cat']]['logo']);?>"/>
    	</td>
    	<td class="text-center">
    		<?php if($value['isrec']==1){ ?>
    		<a href="javascript:;" title="点击设置" onclick="setgoodsstatus('<?=$value['id'];?>','isrec')">
    			<img src="static/images/tick.gif" id="isrec_<?=$value['id'];?>" status="<?=$value['isrec'];?>"></a>
    		<?php }else{ ?>
    		<a href="javascript:;" title="点击设置" onclick="setgoodsstatus('<?=$value['id'];?>','isrec')">
    			<img src="static/images/cross.gif" id="isrec_<?=$value['id'];?>" status="<?=$value['isrec'];?>"></a>
    		<?php } ?>	
    	</td>
    	<td class="text-center">
    		<?php if($value['ispost']==1){ ?>
    		<a href="javascript:;" title="点击设置" onclick="setgoodsstatus('<?=$value['id'];?>','ispost')">
    			<img src="static/images/tick.gif" id="ispost_<?=$value['id'];?>" status="<?=$value['ispost'];?>"></a>
    		<?php }else{ ?>
    		<a href="javascript:;" title="点击设置" onclick="setgoodsstatus('<?=$value['id'];?>','ispost')">
    			<img src="static/images/cross.gif" id="ispost_<?=$value['id'];?>" status="<?=$value['ispost'];?>"></a>
    		<?php } ?>
    	</td>
    	<td class="text-center">
    		<?php if($value['isvip']==1){ ?>
    		<a href="javascript:;" title="点击设置" onclick="setgoodsstatus('<?=$value['id'];?>','isvip')">
    			<img src="static/images/tick.gif" id="isvip_<?=$value['id'];?>" status="<?=$value['isvip'];?>"></a>
    		<?php }else{ ?>
    		<a href="javascript:;" title="点击设置" onclick="setgoodsstatus('<?=$value['id'];?>','isvip')">
    			<img src="static/images/cross.gif" id="isvip_<?=$value['id'];?>" status="<?=$value['isvip'];?>"></a>
    		<?php } ?>
    	</td>
    	<td class="text-center">
    		<?php if($value['ispaigai']==1){ ?>
    		<a href="javascript:;" title="点击设置" onclick="setgoodsstatus('<?=$value['id'];?>','ispaigai')">
    			<img src="static/images/tick.gif" id="ispaigai_<?=$value['id'];?>" status="<?=$value['ispaigai'];?>"></a>
    		<?php }else{ ?>
    		<a href="javascript:;" title="点击设置" onclick="setgoodsstatus('<?=$value['id'];?>','ispaigai')">
    			<img src="static/images/cross.gif" id="ispaigai_<?=$value['id'];?>" status="<?=$value['ispaigai'];?>"></a>
    		<?php } ?>
    	</td>
    	<!--//宝贝审核-->
    	<td class="text-center">
    		<?php if($value['issteal']==1){ ?>
    		<a href="javascript:;" title="点击设置" onclick="setgoodsstatus('<?=$value['id'];?>','issteal')">
    			<img src="static/images/tick.gif" id="issteal_<?=$value['id'];?>" status="<?=$value['issteal'];?>"></a>
    		<?php }else{ ?>
    		<a href="javascript:;" title="点击设置" onclick="setgoodsstatus('<?=$value['id'];?>','issteal')">
    			<img src="static/images/cross.gif" id="issteal_<?=$value['id'];?>" status="<?=$value['issteal'];?>"></a>
    		<?php } ?>
    	</td>
    	<td class="text-center">
    		<input type="text" class="w30" value="<?=$value['sort'];?>" onblur="changesort($(this),'<?=$value['id'];?>','goods');">
    	</td>
    	<td class="text-center"><?=date('m-d H:i',$value['start']);?><br/><?=date('m-d H:i',$value['end']);?></td>
    	<td class="text-center">        		
    		<?php if($value['end']<$_timestamp){ ?>
    		<b style="color: red;">已结束</b>
    		<?php }elseif($value['start']>$_timestamp){ ?>
    		<b style="color: green;">未开始</b>
    		<?php }elseif($value['start']<$_timestamp && $value['end']>$_timestamp){ ?>
    		<b style="color: orange;">进行中</b>
    		<?php } ?>
    	</td>
    	<td class="text-center">
        	[<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=badd&id=<?=$value['id'];?>">修改</a>]&nbsp;
        </td>
    </tr>
    <?php } ?>
    </tbody></table>
    </div>
    <div class="box-footer">
    	<?php include(PATH_TPL."/public/pages.tpl");?>  
	    <div class="box-footer-inner">
	    	<input type="hidden" name="op" value="goods">
    		<input type="hidden" name="gomod" value="<?=MODNAME;?>">
    		<input type="hidden" name="goac" value="<?=ACTNAME;?>">
    		<input type="hidden" name="goop" value="<?=$op;?>">
    		<input type="hidden" name="gobid" value="<?=$bid;?>">
	        <input type="submit" value="删除">
	    </div>
	</div>
</form>
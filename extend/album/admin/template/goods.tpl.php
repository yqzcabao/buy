<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['list'];?>><a href="<?=$_extend_url;?>&pmod=goods&op=list">宝贝列表</a></li>
	<li <?=$active['add'];?>><a href="<?=$_extend_url;?>&pmod=goods&op=add">添加宝贝</a></li>
</ul>
<div class="box-content">
<?php if($op=='list'){ ?>
<div class="table">
  	<form method="GET">
  	<div class="th">
             <select name="aid">
          	   <option value="">专题</option>
          	   <?php foreach ($album_list as $key=>$value){ ?>
                	<option value="<?=$value['aid'];?>" <?php if(request('aid',0)==$value['aid']){ ?>selected<?php } ?>><?=$value['title'];?></option>
                <?php } ?>
             </select>
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
              <input type="text" name="keyword" value="<?=request('keyword','');?>" placeholder="ID/标题/卖家昵称">
              <input type="hidden" name="mod" value="<?=MODNAME;?>">
              <input type="hidden" name="ac" value="<?=ACTNAME;?>">
              <input type="hidden" name="identifier" value="album">
              <input type="hidden" name="pmod" value="goods">
              <input type="submit" value="搜索">
    </div>
    </form>
</div>

<form method="POST" action="<?=$_extend_url;?>&pmod=del" onsubmit="return confirmdel();">
    <div class="table">
        <table class="admin-tb">
        <tbody>
        <tr>
        	<th width="10" class="text-center">
        		<input type="checkbox" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
        	</th>
        	<th width="55">宝贝图片</th>
            <th width="200">宝贝名称</th>        
        	<th width="50" class="text-center">现/原价</th>
        	<th width="50">佣金</th>
        	<th width="30" class="text-center">卖家</th>
        	<th width="100" class="text-center">专题</th>
        	<th width="50" class="text-center">分类</th>
        	<th width="25" class="text-center">推荐</th>
        	<th width="25" class="text-center">包邮</th>        	
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
        		<img onerror="this.onerror=null;this.src='.<?=DEF_GD_LOGO;?>'" src="<?=get_img($value['pic'],'290');?>" style="width:50px;margin:2px auto;">
        	</td>
            <td>
            	<img src="static/images/<?=$value['site'];?>.ico" style="vertical-align: middle;">
            	<a href="http://item.taobao.com/item.htm?id=<?=$value['num_iid'];?>" target="_blank">
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
        	<td class="text-center"><?=$album_list[$value['aid']]['title'];?><?php if(!empty($value['gid'])){ ?>【<?=$album_list[$value['aid']]['group'][$value['gid']];?>】<?php } ?></td>
        	<td class="text-center"><?=$catlist['cid_'.$value['cat']]['title'];?></td>
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
            	[<a href="<?=$_extend_url;?>&pmod=goods&op=add&id=<?=$value['id'];?>">修改</a>]&nbsp;
            </td>
        </tr>
        <?php } ?>
        </tbody></table>
    </div>
    <div class="box-footer">
    	<?php include(PATH_TPL."/public/pages.tpl");?>        
	    <div class="box-footer-inner">
	    	<input type="hidden" name="op" value="goods">
	    	<input type="hidden" name="gomod" value="goods">
    		<input type="hidden" name="goop" value="<?=$op;?>">
	        <input type="submit" value="删除">
	    </div>
	</div>
</form>
<?php }elseif ($op=='add'){ ?>
<script type="text/javascript">
<?=system::getgoods_js(); ?>
var check_img_url='';
<?=system::get_goodsimg_js();?>
</script>
<?php include(PATH_TPL."/public/timepicker.tpl");?>
<script src="<?=PATH_STATIC;?>/js/common.js" type="text/javascript"></script>
<form method="post" action="<?=$_extend_url;?>&pmod=goods&op=add">
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
            <th>所属专题：</th>
            <td>
            	<select name="good[aid]" onchange="choice_album(this);">
            	<?php foreach ($album_list as $key=>$value){ ?>
                <option value="<?=$value['aid'];?>" tpl-name="<?=$value['name'];?>" group=<?=json_encode($value['group']);?> <?php if($value['aid']==$good['aid']){ ?>selected<?php } ?>><?=$value['title'];?></option>
                <?php } ?>
                </select>
            </td>
        </tr>
        <tr style="<?php if(empty($album_list[$good['aid']]['group'])){ ?>display:none<?php } ?>">
            <th>专题分组：</th>
            <td><div id="goodgid">
            	<?php if(!empty($album_list[$good['aid']]['group'])){ ?>
            	<select name="good[gid]">
            	<?php foreach ($album_list[$good['aid']]['group'] as $k=>$val){ ?>
            	<option value="<?=$k;?>" <?php if($good['gid']==$k){ ?>selected<?php } ?>><?=$val;?></option>
            	<?php } ?>
            	</select>
            	<?php } ?>
            </div></td>
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
     	<img src="<?php if(!empty($good['pic'])){ ?><?=get_img($good['pic']);?><?php }else{ ?><?=DEF_GD_LOGO;?><?php } ?>" style="max-width:290px;">
     </div>
	<div class="box-footer">
	    <div class="box-footer-inner">
	    	<input type="submit" value="添加">
	    </div>
	</div>
</form>
<?php } ?>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
<?php include(PATH_TPL."/header.tpl.php");?>
<link href="<?=PATH_TPL;?>/static/css/business.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="<?=PATH_TPL;?>/static/js/business.js"></script>
<script type="text/javascript">
<?=system::getgoods_js(); ?>
</script>
<span class="businessCooperation area">
	<a href="<?=u('business','index');?>"><?=$_webset['site_name'];?></a>
	&nbsp;&gt;&nbsp;<a href="<?=u('business','index');?>">商家报名系统</a>
	&nbsp;&gt;&nbsp;报名<?=$typename;?>
</span>
<?php if(!empty($_id_nav[$nid]['remark'])){ ?>
<div class="gonggao_notice area">
	<strong><?=$_id_nav[$nid]['name'];?>报名提示：</strong>
	<?=$_id_nav[$nid]['remark'];?>
</div>
<?php } ?>
<div class="goods_url area">
	<div class="item msg_zt3">
		<strong class="fl">淘宝商品URL：</strong>
		<input type="text" id="goodsirl" class="t_g_url">
		<input id="getcid" class="btn" type="button" value="抓取商品信息" onclick="get<?=$type;?>($('#goodsirl').val());">
		<p>什么是商品链接：<i>http://item.taobao.com/item.htm?id=xxxxxxxxx</i></p>
	</div>
	
	<div class="blockB" <?php if(empty($good)){ ?>style="display:none"<?php } ?>>
		<h2>活动商品信息</h2>
		<form action="<?=u('business','apply');?>" method="POST" onsubmit="return apply('<?=$type;?>');">
		  <ul>
		    <li class="item">
		      <label>商品名称：</label>
		      <span id="goods_title"><?=$good['title'];?></span>
		    </li>
		    <li style="display:none">
		      <label>商品链接：</label>
		      <span id="productlink" class="readonly item_span">http://item.taobao.com/item.htm?id=23433328387</span>
		    </li>
		    <li>
		      <label>商品原价：</label>
		      <span id="price"><?=$good['price'];?></span> 元
		    </li>
		    <?php if($type=='goods'){ ?>
		    <li>
		      <label><em>*</em>所属分类：</label>
		      <select name="data[cat]" class="type_select">
		      <?php foreach ($catlist as $key=>$value){ ?>
		      <option value="<?=$value['id'];?>" <?php if($good['cat']==$value['id']){ ?>selected<?php } ?>><?=$value['title'];?></option>
		      <?php } ?>
		      </select>
		    </li>
		    <li class="item">
		      <label><em>*</em>活动价：</label>
		      <input class="inp activity_price" id="goods_promotion_price" name="data[promotion_price]" 
					 value="<?=$good['promotion_price'];?>" type="text"/>
		    </li>
		    <li class="item">
		      <label><em>*</em>邮费类型：</label>
		      <input type="checkbox" name="data[ispost]" value="1" class="input_check" id="goods_ispost" <?php if(!empty($good['ispost'])){ ?>checked<?php } ?>>包邮
		    </li>
		    <li class="item">
		      <label><em>*</em>优惠方式：</label>
		      <input type="checkbox" name="data[isvip]" value="1" class="input_check" id="goods_isvip"c <?php if(!empty($good['isvip'])){ ?>checked<?php } ?>>vip价格
		      <input type="checkbox" name="data[ispaigai]" value="1" class="input_check" id="goods_ispaigai" <?php if(!empty($good['ispaigai'])){ ?>checked<?php } ?>>拍改
		    </li>
		    <?php }elseif($type=='try' || $type=='exchange'){ ?>
		    <li class="item">
		      <label><em>*</em>优惠价格：</label>
		      <input class="inp activity_price" id="goods_promotion_price" name="data[promotion_price]" type="text" value="<?=$good['promotion_price'];?>"/>
		    </li>
		    <li class="item">
		      <label><em>*</em>提供数量：</label>
		      <input class="inp activity_price" id="goods_num" name="data[num]" type="text" value="<?=$good['num'];?>"/>
		    </li>
		    <?php } ?>
		    <li class="item recommand">
		      <label>推荐理由：</label>
		      <textarea name="data[remark]" id="goods_remark" class="block_textareal"><?=$good['remark'];?></textarea>
		    </li>
		    <li class="item recommand">
		      <label></label>
		      <input type="hidden" name="data[channel]" value="<?=$nid;?>">
		      <input type="hidden" name="data[id]" value="<?=$good['id'];?>">
		      <?php if(!empty($good['id'])){ ?>
		      <input type="hidden" name="type" value="<?=$type;?>">
		      <?php } ?>
		      <input type="submit" value="提交申请" class="subBtn">
		    </li>
		  </ul>
		  </form>
		  <div class="blockBB" id="preview1">
		  	<?php if(!empty($good)){ ?>
		  	<img id="imageurl" src="<?=$good['pic'];?>">
		  	<?php }else{ ?>
		    <img id="imageurl" src="<?=DEF_GD_LOGO;?>" style="max-width:290px;">
		    <?php } ?>
		      <p>
		        <em>图片尺寸：<b style="color:red">310*310px</b> 支持jpg/png/gif格式图片</em>
		        图片要保证清晰美观，不变形；图片主题突出，不会让用户产生歧义，并且图片上不能出现任何形式的广告、水印
		        <a href="javascript:;" id="changetupian"></a>
				<input type="hidden" name="data[pic]" value="<?=$good['pic'];?>">
				<input type="file" value="更换图片" id="changeImg" class="profile-input" action="<?=u('ajax','operat',array('op'=>'ajaxfile','type'=>'goods'));?>" name="image">
				<span class="input_file"></span>
				<script type="text/javascript">
				ajaxFileUpload("changeImg",'setapply');
				</script>
		      </p>
		  </div>
	</div>
</div>
<?php include(PATH_TPL."/footer.tpl.php");?>
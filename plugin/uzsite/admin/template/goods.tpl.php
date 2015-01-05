<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php include(PATH_PLUGIN.'/admin/template/menu.tpl');?>
<?php if($op=='list'){ ?>
<div class="table">
  	<div class="th" style="margin-bottom: 5px;">
        <form method="GET">
             <select name="channel">
          	   <option value="">导航</option>
             </select>
             <select name="cat">
          	   <option value="">分类</option>
              </select>
              <input type="text" name="keyword" value="<?=request('keyword','');?>" placeholder="ID/标题/卖家昵称">
              <input type="hidden" name="mod" value="<?=MODNAME;?>">
              <input type="hidden" name="ac" value="<?=ACTNAME;?>">
              <input type="hidden" name="identifier" value="<?=$identifier;?>">
              <input type="hidden" name="pmod" value="<?=$pmod;?>">
              <input type="hidden" name="op" value="list">
              <input type="submit" value="搜索">
        </form>
    </div>
</div> 
<div class="box-content">
	<form method="POST" onsubmit="return delgoods();">
		<div class="table">
		    <table class="admin-tb"><tbody>
		    <tr>
		    	<th width="10" class="text-center">
		    		<input type="checkbox" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
		    	</th>
		    	<th width="60">宝贝图片</th>
		        <th width="200">宝贝名称</th>
		    	<th width="60" class="text-center">现/原价</th>
		    	<th width="100" class="text-center">活动时间</th>
		    	<th width="60" class="text-center">频道</th>
		    	<th width="60" class="text-center">分类</th>
		    	<th width="60" class="text-center">优惠方式</th>
		    	<th width="30" class="text-center">包邮</th>
		    	<th width="60" class="text-center">排序</th>
		    	<th width="60" class="text-center">操作</th>
		    </tr>
		    </tbody></table>
		    <div id="show">
		    	<img src="static/images/loading.gif">
		    </div>
		</div>
	   
	    <div class="box-footer">
	    	<div class="pages"></div>          
		    <div class="box-footer-inner">
		    	<input type="submit" value="删除">
		    	<input type="button" value="添加宝贝" onclick="location.href='<?=$_plugin_url;?>&pmod=goods&op=add'">
		    </div>
		</div>
	</form>
</div>
<?php }elseif ($op=='add' || $op=='edit'){ ?>
<?php include(PATH_TPL."/public/datepicker.tpl");?>
<script type="text/javascript">
<?=system::getgoods_js(); ?>
var check_img_url='';
<?=system::get_goodsimg_js();?>
</script>
<div class="box-content">
	<form class="addsitegoods" onsubmit="return send_goods();">
	    <table class="table-font"><tbody>
	        <tr>
	            <th class="w120">宝贝链接：</th>
	            <td>
	            	<input type="text" class="textinput w270" name="url" value="" id="url">
	            	<input type="button" value="一键获取" onclick="getgoods($('#url').val())">
	            </td>
	        </tr>
	        <tr>
	            <th class="w120">宝贝ID：</th>
	            <td><input type="text" class="textinput w70" name="num_iid" value=""></td>
	        </tr>
	        <tr>
	            <th class="w120">宝贝标题：</th>
	            <td><input type="text" class="textinput w270" name="title" value=""></td>
	        </tr>
	        <tr>
	            <th>所属频道：</th>
	            <td><select name="channel"></select></td>
	        </tr>
	        <tr>
	            <th>宝贝分类：</th>
	            <td><select name="cat"></select></td>
	        </tr>
	         <tr>
	            <th class="w120">活动时间：</th>
	            <td>
	            	<input type="text" class="textinput w70 datepicker" name="start" value="<?=$start;?>">
	            	&nbsp;-&nbsp;
	            	<input type="text" class="textinput w70 datepicker" name="end" value="<?=$end;?>">
	            </td>
	        </tr>
	        <tr style="display:none">
	            <th class="w120">长方形图片：</th>
	            <td style="position: relative;">
	            	<input type="text" class="textinput w270 goodstaobao_pic" name="pic" value="">
	            	<input type="hidden" name="imgid" class="goodstaobao_picid" value="">
	            	<input id="fileupload" type="file" name="uzpic" action=".<?=$_plugin_url;?>&pmod=goods&op=img">
	            	<script type="text/javascript">
					ajaxFileUpload("fileupload",'set_uzsite_logo');
					</script>
					<p>
					<span class="tip" style="margin-left:0px">部分用户由于空间配置不给力上传会失败(请提高空间配置)</span>
					</p>
	            </td>
	        </tr>
	        <tr>
	            <th class="w120">正方形图片：</th>
	            <td>
	            	<input type="text" class="textinput w270" name="taopic" value="">
	            </td>
	        </tr>
	        <tr>
	            <th class="w120">宝贝价格：</th>
	            <td><input type="text" class="textinput" name="price" value=""></td>
	        </tr>
	        <tr>
	            <th class="w120">促销价：</th>
	            <td><input type="text" class="textinput" name="promotion_price" value=""></td>
	        </tr>
	        <tr>
	            <th>商家旺旺：</th>
	            <td><input type="text" class="textinput" name="nick" value=""></td>
	        </tr>
	        <tr>
	            <th>销量：</th>
	            <td><input type="text" class="textinput" name="volume" value=""></td>
	        </tr>
	        <tr>
	            <th>所属网站：</th>
	            <td>
	            	<input type="radio" name="site" value="taobao" checked id="site_taobao"><label for="site_taobao">淘宝</label>
	            	<input type="radio" name="site" value="tmall" id="site_tmall"><label for="site_tmall">天猫</label>
	            </td>
	        </tr>
	        <tr>
	            <th>优惠方式：</th>
	            <td>
	            	<input type="radio" name="promotion" value="0" checked id="sale_0"><label for="sale_0">&nbsp;&nbsp;无</label>
	            	<input type="radio" name="promotion" value="1"  id="sale_1"><label for="sale_1">&nbsp;&nbsp;VIP价格</label>
	            	<input type="radio" name="promotion" value="2"  id="sale_2"><label for="sale_2">&nbsp;&nbsp;拍下改价</label>
	            </td>
	        </tr> 
	        <tr>
	            <th>&nbsp;&nbsp;</th>
	            <td><input type="checkbox" name="ispost" value="1" id="post"><label for="post">&nbsp;&nbsp;是否包邮</label></td>
	        </tr>
	        <tr>
	            <th>&nbsp;&nbsp;</th>
	            <td><input type="checkbox" name="isrec" value="1" id="isrec"><label for="rec">&nbsp;&nbsp;是否推荐</label></td>
	        </tr>
	        <tr>
	            <th>排序：</th>
	            <td><input type="text" class="textinput" name="sort" value=""></td>
	        </tr>
	        <tr>
			    <th>备注说明：</th>
			    <td>
			        <textarea id="remark" class="w270 h80" name="remark"></textarea>
			    </td>
			</tr>
	    </tbody></table>
	    <div class="img"></div>
	    <div class="taoimg" style="position: absolute;right: 50px;top: 150px;"></div>
		<div class="box-footer">
		    <div class="box-footer-inner">
		    	<input type="submit" value="添加/修改">
		    </div>
		</div>
	</div>
</form>
<?php } ?>
<script type="text/javascript">
<?php if($op=='list'){ ?>
var channel='<?=$channel;?>'
var cat='<?=$cat;?>';
$(function(){
	//开始调用
	ajaxOperating('<?=$_webset['uz_site'];?>/d/get?m=goods&op=index&hash=<?=uzsecretkey();?>',{'page':'<?=$page;?>','cat':'<?=$cat;?>','channel':'<?=$channel;?>','q':'<?=$keyword;?>'},'GET','jsonp','jsonp');
})
//删除商品
function delgoods(){
	var idstr=tag='';
	$("input[name='id[]']:checked").each(function(){
		idstr+=tag+$(this).val();
		tag=',';
	})
	ajaxOperating('<?=$_webset['uz_site'];?>/d/get?m=goods&op=del&hash=<?=uzsecretkey();?>',{'idstr':idstr},'GET','jsonp','jsonp');
	return false;
}
//调用列表
function jsonp(json){
	if(json.op=='del'){
		if(json.sucess){
			var id=json.idstr.split(",");
			for(var i in id){
				$("#id_"+id[i]).remove();
			}
		}
		show_box("系统提示","删除成功");
	}else if(json.op=='index'){
		var html="<table class='admin-tb'><tbody>";
		//频道
		if(json.channel){
			var channelhtml='';
			for(var i in json.channel){
				tag='';
				if(channel==json.channel[i].id){
					tag=' selected';
				}
				channelhtml+='<option value="'+json.channel[i].id+'" '+tag+'>'+json.channel[i].name+'</option>';
			}
			$("select[name='channel']").html('<option value="">导航</option>'+channelhtml);
		}
		//分类
		if(json.cat){
			var cathtml='';
			for(var i in json.cat){
				tag='';
				if(cat==json.cat[i].cid){
					tag=' selected';
				}
				cathtml+='<option value="'+json.cat[i].cid+'" '+tag+'>'+json.cat[i].cname+'</option>';
			}
			$("select[name='cat']").html('<option value="">分类</option>'+cathtml);
		}
		if(!json.goods){
			html+="<tr><td colspan='10'>暂无数据</td></tr>";
		}else{
			for(var i in json.goods){
				var good=json.goods[i];
				if(good.site=='tmall'){
					good.url='http://detail.tmall.com/item.htm?id='+good.num_iid;
				}else{
					good.url='http://item.taobao.com/item.htm?id='+good.num_iid;
				}
				good.promotion_title='-';
				if(good.promotion==1){
					good.promotion_title='VIP价格';
				}
				if(good.promotion==2){
					good.promotion_title='拍下改价';
				}
				//活动时间
				var start = date('Y-m-d',good.start);
				var end = date('Y-m-d',good.end);
				//是否包邮
				if(good.ispost==1){
					good.ispost_html='<a href="javascript:void(0);" class="ispost"><img src="static/images/tick.gif"></a>';
				}else{
					good.ispost_html='<a href="javascript:void(0);" class="ispost"><img src="static/images/cross.gif"></a>';
				}
				good.sale_title='';
				if(good.promotion==1){
					good.sale_title='VIP价格';
				}else if(good.promotion==2){
					good.sale_title='拍下改价';
				}else{
					good.sale_title='--';
				}
				html+="<tr id='id_"+good.id+"'>";
				html+="<td width='10' class='text-center'><input type='checkbox' name='id[]' value='"+good.id+"' class='checkbox' onclick='checkoption($(\".allbox\"));'></td>";
				html+="<td width='60' class='text-center'><img src='"+good.pic+"_100x100.jpg' style='width:50px;margin:2px auto;'></td>";
				html+="<td width='200'><img src='static/images/"+good.site+".ico' style='vertical-align: middle;'><a href='"+good.url+"' target='_blank'>"+good.title+"</a><br/><b style='color:red'>["+good.nick+"]</b></td>";
				html+="<td width='60' class='text-center'>"+good.promotion_price+"/"+good.price+"</td>";
				html+="<td width='100' class='text-center'>"+date('Y-m-d',good.start)+"到"+date('Y-m-d',good.end)+"</td>";
				html+="<td width='60' class='text-center'>"+good.channel_title+"</td>";
				html+="<td width='60' class='text-center'>"+good.cat_title+"</td>";
				html+="<td width='60' class='text-center'>"+good.sale_title+"</td>";
				html+="<td width='30' class='text-center'>"+good.ispost_html+"</td>";
				html+="<td width='60' class='text-center'>"+good.sort+"</td>";
				html+="<td width='60' class='text-center'><a href='<?=$_plugin_url;?>&pmod=goods&op=edit&id="+good.id+"'>编辑</a></td>";
				html+="</tr>";
			}
		}
		html+='</tbody></table>';
		$("#show").html(html);
		//调用分页
		ajaxOperating('<?=$_plugin_url;?>&pmod=goods&op=page',{"num":json.num,"size":json.size,'page':json.page,'sid':'<?=$sid;?>','cat':'<?=$cat;?>','channel':'<?=$channel;?>','keyword':'<?=$keyword;?>'},'GET','jsonp','show_page');
	}
}
//显示分页
function show_page(json){
	$(".pages").html(json.html);
}
<?php }elseif ($op=='add' || $op=='edit'){ ?>
var id='<?=$id;?>';
$(function(){
	//u频道分类分类
	ajaxOperating('<?=$_webset['uz_site'];?>/d/get?m=goods&op=edit&hash=<?=uzsecretkey();?>',{'id':id},'GET','jsonp','jsonp');
})
function jsonp(json){
	if(json.op=='edit'){
		//设置频道
		if(json.nav_list){
			var html=tag='';
			for(var i in json.nav_list){
				html+=tag+'<option value="'+json.nav_list[i].id+'">'+json.nav_list[i].name+'</option>';
			}
			if(html){
				$("select[name='channel']").html(html);
			}
		}
		if(json.cat_list){
			var html=tag='';
			for(var i in json.cat_list){
				html+=tag+'<option value="'+json.cat_list[i].cid+'">'+json.cat_list[i].cname+'</option>';
			}
			if(html){
				$("select[name='cat']").html(html);
			}
		}
		//编辑情况下的宝数据
		if(id){
			$("select[name='channel'] option[value='"+json.channel+"']").attr("selected",true);
			$("select[name='cat'] option[value='"+json.cat+"']").attr("selected",true);
			$("input[name='num_iid']").val(json.num_iid);
			$("input[name='title']").val(json.title);
			$("input[name='start']").val(date('Y-m-d',json.start));
			$("input[name='end']").val(date('Y-m-d',json.end));
			$("input[name='pic']").val(json.pic);
			$("input[name='imgid']").val(json.imgid);
			$("input[name='taopic']").val(json.taopic);
			$("input[name='price']").val(json.price);
			$("input[name='promotion_price']").val(json.promotion_price);
			$("input[name='nick']").val(json.nick);
			$("input[name='volume']").val(json.volume);
			$("input[name='sort']").val(json.sort);
			$("textarea[name='remark']").val(json.remark);
			$("input[name='site'][value='"+json.site+"']").attr("checked",true);
			$("input[name='promotion'][value='"+json.promotion+"']").attr("checked",true);
			if(json.ispost==1){
				$("input[name='ispost']").attr("checked",true);
			}else{
				$("input[name='ispost']").removeAttr("checked");
			}
			if(json.isrec==1){
				$("input[name='isrec']").attr("checked",true);
			}else{
				$("input[name='isrec']").removeAttr("checked");
			}
			if(json.site=='tmall'){
				$("input[name='url']").val('http://detail.tmall.com/item.htm?id='+json.num_iid);
			}else{
				$("input[name='url']").val('http://item.taobao.com/item.htm?id='+json.num_iid);
			}
			//图片
			if(json.taopic){
				$(".taoimg").html("<img src='"+json.taopic+"_100x100.jpg'>");
			}
			if(json.pic){
				$(".img").html("<img src='"+json.pic+"_100x100.jpg'>");
			}
		}
	}
	//添加
	else if(json.op=='into'){
		if(json.sucess){
			show_box("添加宝贝","宝贝添加修改成功!",function(){location.href='<?=$_plugin_url;?>&pmod=goods';});
		}
	}
}
function setgoods(json){
	$("input[name='num_iid']").val(json.num_iid);
	$("input[name='title']").val(json.title);
	//$("input[name='pic']").val(json.pic_url);
	$("input[name='taopic']").val(json.pic_url);
	$(".taoimg").html("<img src='"+json.pic_url+"_100x100.jpg'>");
	$("input[name='price']").val(json.price);
	$("input[name='nick']").val(json.nick);
	$("input[name='volume']").val(json.volume);
	if(json.auction_point){
		$("input[name='site'][value='tmall']").attr("checked",true);
	}else{
		$("input[name='site'][value='taobao']").attr("checked",true);
	}
	if(json.freight_payer=='seller'){
		$("input[name='ispost']").attr("checked",true);
	}else{
		$("input[name='ispost']").removeAttr("checked");
	}
}
function send_goods(){
	var data=requestParamToJson($(".addsitegoods").serializeArray());
	//删除对象属性
	delete data.url;
	//判断
	if(!data.num_iid){
		show_box("添加宝贝","请设置宝贝ID");
		return false;
	}
	if(!data.title){
		show_box("添加宝贝","请设置标题")
		return false;
	}
	if(!data.ispost){data.ispost=0;}
	if(!data.isrec){data.isrec=0;}
	if(!data.promotion){data.promotion=0;}
	//判断系统时间
	if(!data.start || !data.end){
		show_box("添加宝贝","请设置活动时间")
		return false;
	}
	data.start=time_to_timestamp(data.start);
	data.end=time_to_timestamp(data.end);
	if(!data.pic && !data.taopic){
		show_box("添加宝贝","长方形和正方形图片至少设置一个")
		return false;
	}
	if(!data.price || !data.promotion_price){
		show_box("添加宝贝","请设置价格")
		return false;
	}
	if(!data.nick || !data.promotion_price){
		show_box("添加宝贝","请设置商家旺旺")
		return false;
	}
	ajaxOperating('<?=$_webset['uz_site'];?>/d/get?m=into&hash=<?=uzsecretkey();?>',{'goods':data},'GET','jsonp','jsonp');
	return false;
}
//上传处理
function set_uzsite_logo(json){
	if(json.success){
		$("input[name='imgid']").val(json.id);
		$("input[name='pic']").val(json.url);
		$(".img").html("<img src='"+json.url+"_100x100.jpg'>");
	}else{
		show_box("系统提示","上传失败");
	}
}
<?php } ?>
</script>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
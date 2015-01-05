<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php 
//分类
$catlist=getCatList('goods');
//导航频道
$goodnav=navList();
?>
<?php include(PATH_PLUGIN.'/admin/template/menu.tpl');?>
<div class="box-content">
   <div class="top_box">推送列表只显示开始时间≥当天并且未退送过的宝贝.</div>
   <div class="table">
      	<form method="GET">
      	<div class="th">
            <div>
                 <select name="channel">
              	   <option value="">导航</option>
              	   <?php foreach ($goodnav as $key=>$value){ ?>
                   <option value="<?=$value['id'];?>" <?php if(request('channel','')==$value['id']){ ?>selected<?php } ?>>
                   		<?=$value['name'];?>
                   	</option>
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
                  <?php if(ACTNAME=='index'){ ?>
                  <!--//宝贝管理-->
                  <?=showSelect('issteal',array(''=>'是否抢光','1'=>'抢光了','-1'=>'没有抢光'),request('issteal',''));?>
                  <?=showSelect('type',array(''=>'状态','1'=>'进行中','-1'=>'已结束','2'=>'未开始'),request('type',''));?>
                  <?php } ?>
                  <input type="text" name="keyword" value="<?=request('keyword','');?>" placeholder="ID/标题/卖家昵称">
                  <input type="hidden" name="mod" value="<?=MODNAME;?>">
                  <input type="hidden" name="ac" value="<?=ACTNAME;?>">
                  <input type="hidden" name="pmod" value="<?=$pmod;?>">
                  <input type="hidden" name="identifier" value="<?=$identifier;?>">
                  <input type="submit" value="搜索">
            </div>
        </div>
        </form>
      </div>
      <div class="table">
	    <table class="admin-tb">
	        <tbody>
	        <tr>
	        	<th width="10" class="text-center">
	        		<input type="checkbox" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
	        	</th>
	        	<th width="55">宝贝图片</th>
	            <th width="400">宝贝名称</th>        
	        	<th width="50" class="text-center">现/原价</th>
	        </tr>
	        <?php if(empty($goodslist)){ ?>
	        <tr><td colspan="4">暂无需要推送数据</td></tr>
	        <?php } ?>
	        <?php foreach ($goodslist as $key=>$value){ ?>
	        <tr data-goods='<?=json_encode($value);?>'>
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
	        </tr>
	        <?php } ?>
	        </tbody></table>
	        <div id="schedule"><b></b><span></span></div>
	</div>
	<div class="box-footer">
    	<?php include(PATH_TPL."/public/pages.tpl");?>
	    <div class="box-footer-inner">
	    	<input type="checkbox" class="allbox" onclick="checkAll($(this),$('.checkbox'));" style="margin:0px 15px">
	        <input type="button" value="开始推送" id="push" style="margin-top: 6px;">
	        <input type="button" value="一键推送全部" id="pushall" style="margin-top: 6px;">
	    </div>
	</div>
   <script type="text/javascript">
   var pushtype=1;
   var num=0;
   var hadenum=0
   //一键推送使用
   var goods=new Array();
   $(function(){
   		$("#push").click(function(){
   			num=$(".checkbox:checked").length;
   			push();
   		})
   		//一键推送所有的
   		$("#pushall").click(function(){
   			pushtype=2;
   			pushall();
   			$("#pushall").attr("disabled",true);
   		})
   })
   function push(){
		if(goods.length>0 || $(".checkbox:checked").length>0){
			$("#schedule").show().find("span").html(hadenum+'/'+num);
			//开始推送
			if(pushtype==2){
				var data_sen=goods[0];
				goods.remove(0);
			}else{
				var data_sen=$(".checkbox:checked").eq(0).parents("tr").attr("data-goods");
				eval('data_sen=('+data_sen+')');
			}
			if(data_sen.taopicl!='' || data_sen.taopic!=''){
				var data={};
				//整理数据
				data.title=data_sen.title;
				data.channel=data_sen.channel;
				data.cat=data_sen.cat;
				data.price=data_sen.price;
				data.promotion_price=data_sen.promotion_price;
				data.volume=data_sen.volume;
				data.nick=data_sen.nick;
				data.site=data_sen.site;
				data.num_iid=data_sen.num_iid;
				data.pic=data_sen.taopicl;
				data.sort=data_sen.sort;
				data.taopic=data_sen.taopic;
				data.start=data_sen.start;
				data.end=data_sen.end;
				data.ispost=data_sen.ispost==1?1:0;
				data.isrec=data_sen.isrec==1?1:0;
				data.promotion=0;
				if(data_sen.isvip==1){
					data.promotion=1;
				}
				if(data_sen.ispaigai==1){
					data.promotion=2;
				}
				data.start=data.start;
				data.end=data.end;
				data.remark=data.remark;
				data.imgid=data.imgid;
				//debu接收数据的地方
				ajaxOperating('<?=$_webset['uz_site'];?>/d/get?t=<?=$_timestamp;?>',{'hash':'<?=uzsecretkey();?>','m':'into','fromsite':1,'goods':data},'GET','jsonp','jsonp');
			}else{
				console.log("无图片跳过");
				pushtype==1 && $(".checkbox:checked").eq(0).parents("tr").remove();	
				ajaxOperating('<?=$_plugin_url;?>&pmod=push&op=sign',{"num_iid":json.num_iid,"status":1},'GET');
				push();
			}
		}else{
			if(pushtype==2){
				pushall();
			}else{
				show_box("系统提示","推送完成<br/><a href='<?=$_plugin_url;?>&pmod=push' style='color:red;'>继续推送</a>",function(){location.href='<?=$_plugin_url;?>&pmod=push'});
			}
		}
   }
   function jsonp(json){
   		if(hadenum<num){
	   		hadenum++;
	   		$("#schedule b").width((hadenum/num*100)+'%');
			$("#schedule span").html(hadenum+'/'+num);
   		}
   		//标记已经同步
   		if(json.sucess){
   			//标记为采集
   			ajaxOperating('<?=$_plugin_url;?>&pmod=push&op=sign',{"num_iid":json.num_iid,"status":0},'GET');
   			push();
   		}else{
   			ajaxOperating('<?=$_plugin_url;?>&pmod=push&op=sign',{"num_iid":json.num_iid,"status":1},'GET');
   			console.log("推送失败");
   		}
   		pushtype==1 && $(".checkbox:checked").eq(0).parents("tr").remove();	
   }
   //一键推送所有的
   function pushall(){
   		if(goods.length==0){
   			ajaxOperating('<?=$_plugin_url;?>&pmod=push','','GET','jsonp','pushall_ok');
   		}else{
   			push();
   		}
   }
   function pushall_ok(json){
   		if(num==0){
   			num=json.total;
   		}
   		if(json.goods.length>0){
   			goods=json.goods;
   			push();
   		}else{
   			num=hadenum=0;
   			show_box("系统提示","推送完成或无可推送数据");
   			return false;
   		}
   }
   //数组处理remove
	Array.prototype.remove = function (dx) {
		if (isNaN(dx) || dx > this.length) {
			return false;
		}
		for (var i = 0, n = 0; i < this.length; i++) {
			if (this[i] != this[dx]) {
				this[n++] = this[i];
			}
		}
		this.length -= 1;
	};
   </script>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
<?php include(PATH_TPL."/public/header.tpl.php");?>
<script type="text/javascript" src="static/js/jquery.cursor.js"></script>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['set'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=set">伪静态设置</a></li>
	<li <?=$active['page'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=page">页面关键词</a></li>
	<li <?=$active['add'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=add">添加页面</a></li>
</ul>
<p class="line"></p>
<div class="box-content">
<?php if($op=='set'){ ?>
<!--//伪静态设置-->
<div class="top_box">此功能仅在伪静态下可用。<br/>设置后如被搜索引擎收录，不可轻易更改，在data/rewirite下会生成对应的伪静态文件（注意要刷新ftp），根据主机选择可用。</div>
<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=set">
		<!--//网站基本信息-->
	    <table class="table-font">
	    	<tbody>
	    	<tr>
	            <td class="w120">是否开启伪静态:</td>
	            <td>
	            	<input type="radio" name="seo[rewrite_open]" value="1" id="taoke_showinfo_1">
	            		<label for="taoke_showinfo_1" class="mr10">开启</label>
	            	<input type="radio" name="seo[rewrite_open]" value="-1" id="taoke_showinfo_-1">
	            		<label for="taoke_showinfo_-1" class="mr10">关闭</label>
	            	<script type="text/javascript">
		         	$("#taoke_showinfo_"+<?=intval($_webset['rewrite_open']);?>).attr("checked","checked");
		         	</script>	 
	            </td>
	        </tr>
	    </tbody></table>
	<div class="box-footer">
	    <div class="box-footer-inner">
        	<input type="hidden" name="formhash" value="<?=formhash();?>">
        	<input type="submit" name="seoset" value="保存更改">
	    </div>
	</div>
</form>
<?php }elseif ($op=='page'){ ?>
<!--//页面关键词-->
<form method="POST" action="?mod=public&ac=del" onsubmit="return confirmdel();">
	<div class="table">
		<table class="admin-tb"><tbody>
        <tr>
        	<th width="10" class="text-center">
        		<input type="checkbox" name="all" class="allbox" onclick="checkAll($(this),$('.checkbox'));">
        	</th>
        	<th width="100">页面</th>
            <th width="100">模型</th>
            <th width="100">行为</th>
            <th width="200">标题</th>
            <th width="60">操作</th>
        </tr>
        <?php foreach ($_seo as $key=>$value){ ?>
		<tr>
	        <td class="text-center">
	        	<input type="checkbox" name="id[]" value="<?=$value['id'];?>" class="checkbox" onclick="checkoption($('.allbox'));">
	        </td>
	        <td class="text-left"><?=$value['name'];?></td>
	        <td class="text-center"><?=$value['mod'];?></td>
	        <td class="text-center"><?=$value['ac'];?></td>
	        <td class="text-left"><?=$value['title'];?></td>
	        <td class="text-center">
	        	[<a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=add&id=<?=$value['mod'];?>_<?=$value['ac'];?>">修改</a>]
	        </td>
        </tr>
        <?php } ?>                               
        </tbody></table>
     </div>
	<div class="box-footer">
	    <div class="box-footer-inner">
	    	<input type="hidden" name="op" value="page">
	    	<input type="hidden" name="gomod" value="<?=MODNAME;?>">
	    	<input type="hidden" name="goac" value="<?=ACTNAME;?>">
	    	<input type="hidden" name="goop" value="<?=$op;?>">
	    	<input type="submit" value="删除">
	    </div>
	</div>
</form>
<?php }elseif ($op=='add'){ ?>
<!--//添加页面-->
<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=add">
        <table class="table-font"><tbody>
        	<tr>
                <th class="w120">名字：</th>
                <td><input type="text" class="textinput w270" name="seo[name]" value="<?=$seo['name'];?>"></td>
            </tr>
            <tr>
                <th class="w120">模型：</th>
                <td><input type="text" class="textinput w270" name="seo[mod]" value="<?=$seo['mod'];?>"></td>
            </tr>
            <tr>
                <th class="w120">行为：</th>
                <td><input type="text" class="textinput w270" name="seo[ac]" value="<?=$seo['ac'];?>"></td>
            </tr>
            <tr>
                <th class="w120">标题：</th>
                <td><input type="text" class="textinput w270" name="seo[title]" value="<?=$seo['title'];?>"></td>
            </tr>
         <?php if(!empty($seo['tag'])){ ?>
            <tr>
                <td class="w120">&nbsp;</td>
                <td>
                <?php foreach ($seo['tag'] as $key=>$value){ ?>
                	<a href="javascript:void(0);" data="<?=$value[0];?>" onclick="set_seo($(this),'title')" style="color:blue;margin: 0 10px;"><?=$value[1];?></a>
                <?php } ?>
                </td>
            </tr>
         <?php } ?>
         	<tr>
                <th class="w120">关键词：</th>
                <td><input type="text" class="textinput w270" name="seo[keyword]" value="<?=$seo['keyword'];?>"></td>
            </tr>
            <?php if(!empty($seo['tag'])){ ?>
           <tr>
                <td class="w120">&nbsp;</td>
                <td>
                <?php foreach ($seo['tag'] as $key=>$value){ ?>
                	<a href="javascript:void(0);" data="<?=$value[0];?>" onclick="set_seo($(this),'keyword')"  style="color:blue;margin: 0 10px;"><?=$value[1];?></a>
                <?php } ?>
                </td>
            </tr>
           <?php } ?>
            <tr>
                <th class="w120">描述：</th>
                <td><input type="text" class="textinput w270" name="seo[desc]" value="<?=$seo['desc'];?>"></td>
            </tr>
            <?php if(!empty($seo['tag'])){ ?>
            <tr>
                <td class="w120">&nbsp;</td>
                <td>
                <?php foreach ($seo['tag'] as $key=>$value){ ?>
                	<a href="javascript:void(0);" data="<?=$value[0];?>" onclick="set_seo($(this),'desc')"  style="color:blue;margin: 0 10px;"><?=$value[1];?></a>
                <?php } ?>
                </td>
             </tr>
            <?php } ?>
        </tbody></table>
    <div class="box-footer">
        <div class="box-footer-inner">
        	<input type="hidden" name="seo[id]" value="<?=$seo['id'];?>">
        	<input type="hidden" name="formhash" value="<?=formhash();?>">
        	<input type="submit" name="pageadd" value="添加">
        </div>
    </div>
</form>
<?php } ?>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
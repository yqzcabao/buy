<?php include(PATH_TPL."/public/header.tpl.php");?>
<?php $active[$op]='class="active"'; ?>
<ul class="nav">
	<li <?=$active['sys'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=sys">系统设置</a></li>
	<li <?=$active['sensitive'];?>><a href="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=sensitive">敏感词设置</a></li>       
</ul>
<p class="line"></p>
<div class="box-content">
<?php if($op=='sys'){ ?>
<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=sys">
	<table class="table-font"><tbody>
		<tr>
            <th class="w120">客服qq：</th>
            <td>
            <input type="text" class="textinput" name="sys[site_service]" value="<?=$_webset['site_service'];?>">
            </td>
        </tr>
       <tr>
            <th class="w120">新浪微博uid：</th>
            <td>
            <input type="text" class="textinput" name="sys[site_weibo_sina]" value="<?=$_webset['site_weibo_sina'];?>">
            </td>
        </tr>
        <tr>
            <th>腾讯微博昵称：</th>
            <td>
            <input type="text" class="textinput" name="sys[site_weibo_tencent]" value="<?=$_webset['site_weibo_tencent'];?>">
            </td>
        </tr>
        <tr>
            <th>腾讯企业qq空间：</th>
            <td>
            <input type="text" class="textinput w270" name="sys[site_qzone]" value="<?=$_webset['site_qzone'];?>">
            </td>
        </tr>
        <tr>
            <th>微信号：</th>
            <td>
            <input type="text" class="textinput w270" name="sys[site_weixin]" value="<?=$_webset['site_weixin'];?>">
            </td>
        </tr>
        <tr>
            <th>微信二维码：</th>
            <td>
            	<input type="text" class="textinput w270" name="sys[site_weixinpic]" value="<?=$_webset['site_weixinpic'];?>">
            	<input id="fileuploadweixin" type="file" name="site_weixinpic" action="../?mod=ajax&ac=operat&op=ajaxfile">
            	<script type="text/javascript">
				ajaxFileUpload("fileuploadweixin",'site_weixinpic');
				</script>
            </td>
        </tr>
        <tr>
            <th class="w180">友链要求文章id：</th>
            <td>
            	<input type="text" class="textinput w60" name="sys[link_rule]" value="<?=$_webset['link_rule'];?>">
            	<a href="?mod=article&ac=list&op=articleAdd&id=<?=$_webset['link_rule'];?>" class="tip red">点击修改</a>
            </td>
        </tr>
        <tr>
            <th class="w180">报名准备文章id：</th>
            <td>
            	<input type="text" class="textinput w60" name="sys[base_business_rule]" value="<?=$_webset['base_business_rule'];?>">
            	<a href="?mod=article&ac=list&op=articleAdd&id=<?=$_webset['base_business_rule'];?>" class="tip red">点击修改</a>
            </td>
        </tr>
	</tbody></table>
	
	<div class="box-footer">
        <div class="box-footer-inner">
        	<input type="hidden" name="formhash" value="<?=formhash();?>">
        	<input type="submit" name="sysset" value="保存更改">
        </div>
    </div>
</form>
<?php }elseif ($op=='sensitive'){ ?>
<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=sensitive">
	<table class="table-font"><tbody>
        <tr>
            <th class="w70" style="vertical-align:top;">关键词：</th>
            <td>
            <textarea class="w360 h80" name="sensitive"><?=$sensitive;?></textarea>
            </td>
        </tr>
    </tbody></table>
  	<div class="box-footer">
        <div class="box-footer-inner">
        	<input type="hidden" name="formhash" value="<?=formhash();?>">
        	<input type="submit" name="sensitiveset" value="保存更改">
        </div>
    </div>
</form>
<?php } ?>
</div>
<?php include(PATH_TPL."/public/footer.tpl.php");?>
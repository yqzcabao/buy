<?php include(PATH_TPL."/header.tpl.php");?>
<div class="notredeemed area">
	<div class="redm_c">
		<p class="title"><?=$title;?>!</p>
		<div class="icon <?php if($code==0){ ?>ok<?php }elseif($code==1){ ?>warning<?php }elseif($code==2){ ?>error<?php }else{ ?>warning<?php } ?> fl"></div>
		<p class="mess fl"><?=$msg;?></p>
		<p class="jumpmsg fl"><?=$jumpmsg;?></p>
		<p class="link fl">
			<a href="<?=u('index','index');?>">返回首页</a>
			<a href="javascript:history.go(-1);">返回上一页</a>
		</p>
	</div>
</div>
<script lang='javascript'>
var pgo=0;
function JumpUrl(){ 
	if(pgo==0){
		var url='<?=$gourl;?>'
		//判断是不是js
		if(url.substr(0,11)=='javascript:'){
			eval(url.substr(11));
		}else{
			location=url;
		} 
		pgo=1;  
	} 
}
<?=$jstmp;?>
</script>
<?php include(PATH_TPL."/footer.tpl.php");?>
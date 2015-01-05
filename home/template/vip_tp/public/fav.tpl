<div class="index_collection" style="display:none">
	<div class="top">
    	<div class="area">
        	<p class="fr" onclick="$('.index_collection').hide();">关闭</p>
            按 
            <strong>Ctrl+D</strong>
            ，把<?=$_webset['site_name'];?>放入收藏夹，折扣信息一手掌握！
            <span><a  href="javascript:void(0)" onclick="noalert();">不再提醒</a></span>
        </div>
    </div>
</div>
<script type="text/javascript">
//不再提醒
function noalert(){
	$.cookie("noalert",'1',{expires: 365,path: '/'});
	$('.index_collection').hide();
}
function showalert(){
	var noalert=$.cookie("noalert");
	if(!noalert){
		$(".index_collection").show();
	}
}
showalert();
</script>
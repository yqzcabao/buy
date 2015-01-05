<!--//后台页脚-->
</body>
</html>
<script type="text/javascript">
show_win();
$(parent.window).resize(function(){
	show_win();
})
function show_win(){
	var height=$(parent.window).height();
	if($(".nav").length>0){height=height-$(".nav").height();}
	if($(".box-footer").length>0){height=height-$(".box-footer").height();}
	if(window.attachEvent){ 
		$(".box-content").height(height-112);
	}else{
		$(".box-content").height(height-125);
	}
}
</script>
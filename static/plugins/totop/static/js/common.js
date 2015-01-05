$(function() {
	var e = $("#rocket-to-top"),
	t = $(document).scrollTop(),
	n,
	i = !0;
	$(window).scroll(function() {
		var t = $(document).scrollTop();
		var postop=$(".about").offset().top;
		if(window.pageYOffset>=postop-600){
			e.css({"position":"absolute",'top':(postop-154)+'px'});
			return false;
		}else{
			e.css({"position":"fixed",'bottom':'20px',"top":"auto"});
		}
		t == 0 ? e.css("background-position") == "0px 0px" ? e.fadeOut("slow") : i && (i = !1, e.delay(100).animate({
			marginTop: "-1000px"
		},
		"normal",
		function() {
			e.css({
				"margin-top": "-125px",
				display: "none"
			}),
			i = !0
		})) : e.fadeIn("slow")
	}),
	$(".rightnfixda2").hover(function(){
		$(".rightnfixdspan1").show();
	},function(){
		$(".rightnfixdspan1").hide();
	})
	$(".rightnfixda1").click(function() {
		function t() {
			if (e.css("display") == "none" || i == 0) {
				clearInterval(n);
				return
			}
		}
		if (!i) return;
		n = setInterval(t, 50),
		$("html,body").animate({scrollTop: 0},"slow");
	});
});
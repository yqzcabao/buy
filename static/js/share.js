_Share = {
	api : {},
	detail : {
		url : "",
		title : "",
		summary : "",
	    text : "",
	    pic : ""
	},
	setApi : function(json){
		this.api = json;
	},
	doShare : function(type,detail){
		if(!type) return false;
		var api = '';
		var url = this.isString(detail.url) ? detail.url : location.href;
		var tit = this.isString(detail.title) ? detail.title : document.title;
		var sum = this.isString(detail.summary) ? detail.summary : document.getElementsByName("description")[0].content;
		var pic = this.isString(detail.pic) ? detail.pic : "";
		var txt = this.isString(detail.text) ? detail.text : "";
		api = this.api[type].apiurl;
		if(api.indexOf("?") < 0) api += "?";
		else if(api.slice(api.length - 1, api.length) != "&") api += "&";
		api = api + (this.isString(this.api[type].url) ? this.api[type].url + "=" + url : "") + (this.isString(this.api[type].title) ? "&" + this.api[type].title + "=" + tit : "") + (this.isString(this.api[type].summary) ? "&" + this.api[type].summary + "=" + sum : "") + (this.isString(this.api[type].pic) ? "&" + this.api[type].pic + "=" + pic : "") + (this.isString(this.api[type].text) ? "&" + this.api[type].text + "=" + txt : "");
		//api = encodeURI(api);
		window.open(api);
	},
	isString : function(str){
		if(typeof str == "string") return true;
		else return false;
	}
}
//分享代码
share = _Share;
share.setApi({
	qzone : { 
		apiurl : "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey",
		url : "url",
		title : "title",
		pic :"pics"
	},
	renren : {
		apiurl : "http://share.renren.com/share/buttonshare",
		url : "link",
		title : "title"
	},
	t_sina : {
		apiurl : "http://v.t.sina.com.cn/share/share.php",
		url : "url",
		title : "title",
		pic : "pic"
	},
	pengyou : {
		apiurl : "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?to=pengyou",
		url : "url",
		title : "title"
	},
	douban : {
		apiurl : "http://www.douban.com/recommend/",
		url : "url",
		title : "title",
		text : "comment"
	},
	t_qq : {
		apiurl : "http://v.t.qq.com/share/share.php",
		url : "url",
		title : "title",
		pic : "pic"
	},
	kaixin : {
		apiurl : "http://www.kaixin001.com/repaste/bshare.php",
		url : "rurl",
		title : "rtitle",
		summary : "rcontent"
	},
	itieba : {
		apiurl : "http://tieba.baidu.com/i/app/open_share_api",
		url : "link",
		title : "title"
	}
});
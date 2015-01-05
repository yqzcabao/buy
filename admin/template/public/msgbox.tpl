<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
    *{margin:0;padding:0;color:#333;font-size:12px;}
    .ct2{ font-size:12px; }
    .ct2 a{ font-size:12px; }
 </style>
<base target='_self' />
<title> <?=$title;?> </title>
</head>
<body>
    <div style="padding:5px;width:426px; height:127px;margin:50px auto; background:url(static/images/success.png) no-repeat">
        <div style="">
            <h2 style="font-size:14px;height:28px; line-height:28px;padding:0 10px;font-family: 微软雅黑;">
            <?=$title;?>
            </h2>
            <div style="padding:20px 0; text-align:center;">
                <h4 style="font-size:13px;line-height:24px;margin-bottom:10px;font-family:微软雅黑">
                <?=$msg;?>
                </h4>
                <?=$jumpmsg;?>
            </div>
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
</body>
</html>
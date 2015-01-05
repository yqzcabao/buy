<?php webtitle();?>
<?php require tpl_extend(WAP_TPL.'/pub/comfun.tpl');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?=$_webset['site_url'];?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="<?=WAP_TPL_PATH;?>/static/css/common.css" />
<script type="text/javascript" src="static/js/jquery-1.10.2.min.js"></script>
<title><?=$_webset['site_title'];?></title>
<meta name="keywords" content="<?=$_webset['site_metakeyword'];?>" />
<meta name="description" content="<?=$_webset['site_metadescrip'];?>" />
</head>
<body>
<div class="content">
	<div class="content_c mg0">
		<div class="head">
			<?php if(ACTNAME=='index' && empty($keyword)){ ?>
	    	<div class="header_top" style="background-color:rgba(219,59,15,1); border-bottom:1px solid rgba(228,117,31,1)">
	            <span class="find fl">
	                <i><img src="<?=WAP_TPL_PATH;?>/static/images/ss1.png" width="29px"/></i>
	            </span>
	            <span class="name">
	                <i><img src="<?=WAP_LOGO;?>" width="52px" /></i>
	            </span>
	            <span class="user fr" id="user">
	                <a href="<?=u(MODNAME,'sign');?>"><i><img src="<?=WAP_TPL_PATH;?>/static/images/jd1.png" width="20px" />签到</i></a>
	            </span>
	        </div>
	        <?php }else{ ?>
	        <div class="header_top" style="background-color:rgba(219,59,15,1); border-bottom:1px solid rgba(228,117,31,1)">
                <span class="t_find fl">
                	<a href="<?=u(MODNAME,'index');?>"><i><img src="<?=WAP_TPL_PATH;?>/static/images/homepage.png"/></i></a>
                </span>
                <span class="name_" style="line-height:46px">
                <?php if(!empty($keyword)){ ?>
                搜索结果
                <?php }elseif(ACTNAME=='deal'){ ?>
                <?=$_webset['site_name'];?>-专注独家折扣
                <?php }elseif(ACTNAME=='brands'){ ?>
                品牌折扣
                <?php }elseif(ACTNAME=='tomorrow'){ ?>
                明日预告
                <?php }elseif(ACTNAME=='login'){ ?>
                用户登录
                <?php }elseif(ACTNAME=='regist'){ ?>
                用户注册
                <?php }elseif(ACTNAME=='center'){ ?>
                用户中心
                <?php } ?>
                </span>
                <span class="user fr"></span>
            </div>
            <?php } ?>
	        <?php if(!empty($keyword)){ ?>
            <div class="view" style="background:none">
            <form method="GET">
            	<div class="serach_box">
                	<div class="search_c fl">
                        <input class="search_input" type="text" x-webkit-speech  placeholder="请输入商品关键字" autocomplete="off"/>
                    </div>
                </div>
                <input type="hidden" name="mod" value="wap">
                <input type="hidden" name="ac" value="index">
                <button type="submit" class="serrch_sub fr">
                	<i class="search_i">
                    	<img src="<?=WAP_TPL_PATH;?>/static/images/search-w.png" />
                        <img class="active hidden" src="<?=WAP_TPL_PATH;?>/static/images/search-o.png" />
                    </i>
                </button>
             </form>
             </div>
             <?php }else{ ?>
			<div class="view"  style="display:none;">
				<form method="GET">
					<div class="serach_box">
						<div class="search_c fl">
					        <input class="search_input" type="text" name="keyword" x-webkit-speech  placeholder="请输入商品关键字" autocomplete="off"/>
					    </div>
					</div>
					<input type="hidden" name="mod" value="wap">
					<input type="hidden" name="ac" value="index">
					<button type="submit" class="serrch_sub fr">
						<i class="search_i">
					    	<img src="<?=WAP_TPL_PATH;?>/static/images/search-w.png" />
					        <img class="active hidden" src="<?=WAP_TPL_PATH;?>/static/images/search-o.png" />
					    </i>
					</button>
				</form>
			</div>
			<ul class="nav_list" style="display:none;">
				<?php foreach ($catlist as $key=>$value){ ?>
				<a href="<?=u(MODNAME,'index',array('cat'=>$value['id']));?>"><li class="fl"><?=$value['title'];?></li></a>
				<?php } ?>
			</ul>
			<?php if(ACTNAME=='index' || ACTNAME=='tomorrow'){ ?>
	        <ul class="head_nav">
	        	<li class="fl <?php  if(ACTNAME=='index'){?>on<?php } ?>" style="width:33.33%">
	        		<a href="<?=u(MODNAME,'index');?>">首页</a></li>
	        	<li class="fl <?php  if(ACTNAME=='tomorrow'){?>on<?php } ?>" style=" width:33.33%"><a href="<?=u(MODNAME,'tomorrow');?>">明日预告</a></li>
	        	<li class="fl <?php  if(ACTNAME=='brands'){?>on<?php } ?>" style=" width:33.33%"><a href="<?=u(MODNAME,'brands');?>">品牌团</a></li>
	        </ul>
	        <?php } ?>
           <?php } ?>
	    </div>
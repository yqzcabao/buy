<?php webtitle();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="<?=$_webset['site_tpl_style'];?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$_webset['site_title'];?></title>
<meta name="keywords" content="<?=$_webset['site_metakeyword'];?>" />
<meta name="description" content="<?=$_webset['site_metadescrip'];?>" />
<base href="<?=$_webset['site_url'];?>/" />
<link type="image/x-icon" rel="shortcut icon"  href="favicon.ico" media="screen"/>
<link href="<?=PATH_TPL;?>/static/css/common.css" type="text/css" rel="stylesheet"/>
<?php if(!empty($_webset['site_tpl_style']) && $_webset['site_tpl_style']!='default'){ ?>
<link href="<?=PATH_TPL;?>/style/<?=$_webset['site_tpl_style'];?>/s.css" type="text/css" rel="stylesheet"/>
<?php } ?>
<script type="text/javascript" src="static/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="static/js/common.js"></script>
<script type="text/javascript" src="<?=PATH_TPL;?>/static/js/common.js"></script>
<script type="text/javascript" src="static/js/share.js"></script>
<script type="text/javascript" src="static/js/jquery.cookie.js"></script>
</head>
<body>
	<?php include(PATH_TPL."/public/fav.tpl");?>
    <?php include(PATH_TPL."/public/top.tpl");?>
    <div class="header">
    	<div class="area">
        	<h1 class="fl">
            	<a href="<?=u('index','index');?>">
                	<img src="<?php if(!empty($_webset['site_logo'])){?><?=$_webset['site_logo'];?><?php }else{ ?><?=PATH_TPL;?>/static/images/logo.png<?php } ?>" width="243px" height="47px"/>
                </a>
            </h1>
            <div class="search fr">
            <form action="<?=u('index','index');?>" method="GET">
            	<input type="text" name="keyword" class="txt fl" placeholder="搜索你想要的宝贝" value="" title="">
            	<input type="hidden" name="mod" value="index">
            	<input type="hidden" name="ac" value="index">
                <input type="submit" class="smt fl" value="&nbsp;">
            </form>
            </div>
            <div class="links fr">
            	<i class="fl tmall"></i>
            	<i class="fl lowest"></i>
            	<i class="fl check"></i>
            </div>
        </div>
    </div>
<?php webtitle();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="<?=$_webset['site_tpl_style'];?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$_webset['site_title'];?></title>
<meta name="keywords" content="<?=$_webset['site_metakeyword'];?>" />
<meta name="description" content="<?=$_webset['site_metadescrip'];?>" />
<base href="<?=$_webset['site_url'];?>/" />
<link href="<?=PATH_TPL;?>/static/css/common.css" type="text/css" rel="stylesheet"/>
<link href="<?=PATH_APP;?>/static/css/common.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="static/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="static/js/common.js"></script>
<script type="text/javascript" src="<?=PATH_APP;?>/static/js/common.js"></script>
</head>
<body>
<div class="header">
	<div class="area">
    	<h1 class="fl">
        	<a href="<?=u('index','index');?>">
            	<img src="<?=SELLER_LOGO;?>" width="300" height="60px"/>
            </a>
        </h1>
        <div class="links fr" style="margin-right:0px;background: url('<?=SELLER_SUB_LOGO;?>') no-repeat;"></div>
    </div>
</div>
<?php require tpl_extend("pub/nav.tpl");?>
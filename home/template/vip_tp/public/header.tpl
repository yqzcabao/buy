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
<script type="text/javascript" src="static/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="static/js/common.js"></script>
<script type="text/javascript" src="<?=PATH_TPL;?>/static/js/common.js"></script>
<script type="text/javascript" src="static/js/share.js"></script>
<script type="text/javascript" src="static/js/jquery.cookie.js"></script>
</head>
<body>
<?php include(PATH_TPL."/public/fav.tpl");?>
<?php include(PATH_TPL."/public/top.tpl");?>
<div class="head">
	<div class="area" id="logo">
		<div class="logo fl"><h2><a href="./" title="<?=$_webset['site_name'];?>" style="background: url('<?php if(!empty($_webset['site_logo'])){?><?=$_webset['site_logo'];?><?php }else{ ?><?=PATH_TPL;?>/static/images/logo.png<?php } ?>') no-repeat;"><?=$_webset['site_name'];?></a></h2></div>
		<div class="search fr">
			<form action="<?=u('index','index');?>" method="GET">
				<div class="sort dropdown">
					<a class="pro first" href="javascript:void(0);">宝贝</a>
				</div>
				<p>
					<input type="hidden" value="show" name="action">
					<input type="text" name="keyword" class="Int tipcolor" placeholder="懒得找了，我搜~~" value="" autocomplete="off">
					<input type="hidden" name="mod" value="index">
	            	<input type="hidden" name="ac" value="index">
					<a href="javascript:;" class="Btn" rel="nofollow"></a>
				</p>
			</form>
		</div>
		<div class="links fr"></div>
	</div>
	<?php include(PATH_TPL."/public/nav.tpl");?>
</div>
<?php webtitle();?>
<?php require tpl_extend(WAP_TPL.'/pub/comfun.tpl');?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?=$_webset['site_title'];?></title>
	<meta name="keywords" content="<?=$_webset['site_metakeyword'];?>" />
	<meta name="description" content="<?=$_webset['site_metadescrip'];?>" />
	<base href="<?=$_webset['site_url'];?>/" />
    <link href="<?=WAP_TPL_PATH;?>/static/css/common.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="static/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="<?=WAP_TPL_PATH;?>/static/js/common.js"></script>
</head>
<body>
<div class="index2_head">
	<?php if(empty($user['uid'])){ ?>
    <a href="<?=u(MODNAME,'login');?>" class="login">登录</a>
    <?php }else{ ?>
    <a href="<?=u(MODNAME,'logout');?>" class="login">退出</a>
    <?php } ?>
    <a href="<?=u(MODNAME,'index');?>" class="log"><img src="<?=WAP_LOGO;?>"></a>
    <ul>
    	<li><a href="<?=u(MODNAME,'sign');?>">签到</a></li>
    	<?php if(!empty($user['uid'])){ ?>
    	<li><a>|</a></li>
        <li><a href="<?=u(MODNAME,'credits');?>">我的积分</a></li>
        <?php } ?>
    </ul>
</div>
<!--//幻灯-->

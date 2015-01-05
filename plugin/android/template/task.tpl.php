<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1" media="(device-height: 568px)">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="yes">
	<meta name="full-screen" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link href="<?=PATH_APP;?>/static/css/common.css" rel="stylesheet" type="text/css" />
	<script src="static/js/jquery-1.10.2.min.js" type="text/javascript"></script>
    <title>验证</title>
</head>
<body>
<div class="main">
<div class="app">
<?php require tpl_plugin('task/'.$op.'.tpl');?>
</div>
</div>
</body>
</html>
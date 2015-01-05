<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$_webset['site_title'];?></title>
<meta name="keywords" content="<?=$_webset['site_metakeyword'];?>" />
<meta name="description" content="<?=$_webset['site_metadescrip'];?>" />
<base href="<?=$_webset['site_url'];?>/" />
<script type="text/javascript" src="static/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="static/js/share.js"></script>
<script type="text/javascript">
var qzone_url='http://<?=$_webset['qzone_domain'];?>';
</script>
<script type="text/javascript" src="<?=PATH_APP;?>/static/js/common.js"></script>
<link href="<?=PATH_APP;?>/static/css/common.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" charset="utf-8" src="http://fusion.qq.com/fusion_loader?appid=<?=$appid;?>&platform=<?=$platform;?>"></script>
<?php if(empty($user['uid'])){ ?>
<script type="text/javascript">
fusion2.dialog.relogin();
</script>
<?php } ?>
</head>
<body>
	<!--//关注-->
	<?php if(!empty($_webset['qzone_qq'])){ ?>
	<div id="followwidget">
	  <iframe scrolling="no" class="iframeload onloaded" frameborder="0" style="width:112px;height:24px;border:none;overflow:hidden" border="0" allowtransparency="true" src="http://open.qzone.qq.com/like?url=http%3A%2F%2Fuser.qzone.qq.com%2F<?=$_webset['qzone_qq'];?>&amp;type=button_num&amp;width=115&amp;height=24&amp;style=3"></iframe>
	</div>
	<?php } ?>
	<!--//添加到控制面板-->
	<?php if($_webset['qzone_add_widget'] && empty($user['addwidget'])){ ?>
	<div id="addwidget" class="show" style="top: 130px;"><em></em></div>
	<?php } ?>
	
	<div id="header" class="header" data-pop="no" data-focus="0" data-add="0">
	    <img src="<?=$_webset['site_qzone_bg'];?>">
	    <?php if(!empty($user['uid'])){ ?>
	  	<div class="r login">
	  		<img src="<?=$user['figureurl'];?>">&nbsp;
	  		<div class="us">
	  			<span><a href="javascript:void(0)" target="_self"><?=$user['user_name'];?></a></span>
	  			<em id="user_integral"><i></i><?=$user['integral'];?></em>
	  			<div><dl><dt><a href="javascript:void(0)" class="sign"></a></dt></dl></div>
	  		</div>
	  	</div>
	  	<?php } ?>
	</div>
	
	
	
	<div id="placeh" style="height:80px;display:block;"><div id="head_nav" class="" style="top: 0px; left: 0px; position: relative; z-index: 888;" data-followed="yes" data-widget="3" data-ajax-url="http://qqtemplate.app.zhe800.com/">
	    <div class="area">
	      <span><a href="<?=u('qzone','index');?>" <?php if($channel==0){ ?>class="on"<?php } ?>>首页</a></span>
	      <?php foreach ($_nav as $key=>$value){ ?>
	      	<?php if($value['hide']!=1 && $value['mod']=='goods'){ ?>
	      	<span><a href="<?=u('qzone','index',array('channel'=>$value['id']));?>" <?php if($channel==$value['id']){ ?>class="on"<?php } ?>><?=$value['name'];?></a></span>
	      	<?php } ?>
	      <?php } ?>
	      <?php if($user['lastsign']<strtotime('today')){ ?>
	      <?php $integral=get_qzone_integral("today");?>
	      <div class="jifenpop" style="display: block;">恭喜您获得了<u><?=$integral['integral'];?>金币</u>，签到领取<em></em></div>
	      <?php } ?>
	    </div>
	  </div>
	  <div id="subnav"><div class="area">
	  	<?php $active['cat_'.$cat]="on";?>
		<a href="<?=u('qzone','index');?>" class="<?=$active['cat_0'];?>">全部</a>
		<?php foreach ($catlist as $key=>$value){ ?>
	    <a href="<?=u('qzone','index',array('cat'=>$value['id']));?>" title="<?=$value['title'];?>" class="<?=$active['cat_'.$value['id']];?>"><?=$value['title'];?></a>
	    <?php } ?>
	    </div></div>
	</div>
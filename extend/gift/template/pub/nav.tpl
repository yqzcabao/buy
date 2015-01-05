<?php $active[ACTNAME]="on";?>
<div class="head_nav">
	<div class="head_nav_c area">
    	<div class="fl nav_list">
    		<a class="fl" href="<?=u('index','index');?>">首页<i></i></a>
    		<a class="fl <?=$active['index'];?>" href="<?=u(MODNAME,'index');?>">积分商城<i></i></a>
    		<a class="fl <?=$active['exc'];?>" href="<?=u(MODNAME,'exc');?>">积分兑换<i></i></a>
    		<a class="fl <?=$active['task'];?>" href="<?=u(MODNAME,'task');?>">赚取积分</a>
        </div>
    </div>
</div>
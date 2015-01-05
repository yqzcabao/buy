<form action="<?=u('user','base',array('op'=>$op));?>" method="POST">
	<div class="account_c">
		<p class="title"></p>
		<ul>
		<?php foreach ($otherlogon as $key=>$value){ ?>
			<li class="fl">
				<?php if(isset($bind[$key])){?>
				<img alt="延长时间" src="<?=PATH_TPL;?>/static/images/user/bind_<?=$key;?>.png"/>
				<span class="li_span">
					<a href="<?=u('user','base',array('op'=>'bind','api'=>$key));?>">延长时间</a>
					<em>|</em>
					<a href="<?=u('user','base',array('op'=>'unbind','api'=>$key));?>">解除绑定</a>
				</span>
				<?php }else{ ?>
				<img alt="绑定" src="<?=PATH_TPL;?>/static/images/user/bind_<?=$key;?>_gray.png"/>
				<span class="li_span">
					<a href="<?=u('user','base',array('op'=>'bind','api'=>$key));?>" target="_blank">立即绑定</a>
				</span>
				<?php } ?>
			</li>
		 <?php } ?>
		</ul>
	</div>
</form>
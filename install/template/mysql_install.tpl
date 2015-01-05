<div class="setup step4" style="margin-top: -123px;">
	<h2>安装数据库</h2>
	<p>正在执行数据库安装</p>
</div>

<div class="stepstat">
	<ul>
		<li class="">检查安装环境</li>
		<li class="">设置运行环境</li>
		<li class="">创建数据库</li>
		<li class="current last">安装</li>
	</ul>
	<div class="stepstatbg stepstat1"></div>
</div>
<div class="main">
		<script type="text/javascript">
		function showmessage(message) {
			document.getElementById('notice').innerHTML += message + '<br />';
			document.getElementById('notice').scrollTop = 100000000;
		}
		function initinput() {
			window.location='index.php?method=ext_info';
		}
		</script>
		<div id="notice"></div>
		<div class="btnbox margintop marginbot">
			<input type="button" name="submit" value="正在安装..." disabled="disabled" id="laststep" onclick="initinput()">
		</div>
</div>
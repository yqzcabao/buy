<?php exit(); ?>
<apps:qzone name="管理中心" allowapp="qzone" auttype="session" login_control="?mod=qzone&ac=login">
    <!-- //公开的控制器，不需登录就能访问 -->
    <ctl:public>*</ctl:public>
</apps:qzone>
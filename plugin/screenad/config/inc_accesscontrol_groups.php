<?php exit(); ?>
<apps:screenad name="管理中心" allowapp="screenad" auttype="cookie" login_control="?mod=screenad&ac=login">
    <!-- //公开的控制器，不需登录就能访问 -->
    <ctl:public>*</ctl:public>
</apps:screenad>
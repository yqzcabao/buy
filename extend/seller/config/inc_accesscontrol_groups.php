<?php exit(); ?>
<apps:seller name="管理中心" allowapp="seller" auttype="cookie" login_control="?mod=seller&ac=login">
    <!-- //公开的控制器，不需登录就能访问 -->
    <ctl:public>seller-login,seller-register,seller-forget,seller-index,seller-help,seller-fastlogin,seller-callback,seller-check</ctl:public>
    <!-- //保护的控制器，当前池会员登录后都能访问 -->
    <ctl:protected></ctl:protected>
    <!-- //私有控制器，只有特定组才能访问 -->
    <ctl:private>
        <seller name="卖家组">*</seller>
    </ctl:private>
</apps:seller>
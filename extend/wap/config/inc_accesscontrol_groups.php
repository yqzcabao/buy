<?php exit(); ?>
<apps:home name="手机网站" allowapp="home" auttype="cookie" login_control="?mod=wap&ac=login">
    <!-- //公开的控制器，不需登录就能访问 -->
    <ctl:public>wap-index,wap-login,wap-register,wap-tomorrow,wap-brands,wap-forget,wap-agreement,wap-jump,wap-fastlogin</ctl:public>
    <!-- //保护的控制器，当前池会员登录后都能访问 -->
    <ctl:protected></ctl:protected>
    <!-- //私有控制器，只有特定组才能访问 -->
    <ctl:private>
        <home name="卖家组">*</home>
    </ctl:private>
</apps:home>
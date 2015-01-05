<?php exit(); ?>
<apps:home name="网站首页" allowapp="home" auttype="cookie" login_control="?mod=user&ac=login">
    <!-- //公开的控制器，不需登录就能访问 -->
    <ctl:public>gift-index,gift-exc,gift-detail,gift-task</ctl:public>
    <!-- //保护的控制器，当前池会员登录后都能访问 -->
    <ctl:protected></ctl:protected>
    <!-- //私有控制器，只有特定组才能访问 -->
    <ctl:private>
        <home name="普通会员">*</home>
    </ctl:private>
</apps:home>
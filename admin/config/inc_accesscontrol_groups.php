<?php exit(); ?>
<apps:admin name="管理中心" allowapp="admin" auttype="session" login_control="?mod=index&ac=login">
    <!-- //公开的控制器，不需登录就能访问 -->
    <ctl:public>index-login</ctl:public>
    <!-- //保护的控制器，当前池会员登录后都能访问 -->
    <ctl:protected></ctl:protected>
    <!-- //私有控制器，只有特定组才能访问 -->
    <ctl:private>
        <admin name="管理员组">*</admin>
    </ctl:private>
</apps:admin>
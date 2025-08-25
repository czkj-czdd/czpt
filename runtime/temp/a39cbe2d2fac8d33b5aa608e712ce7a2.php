<?php /*a:1:{s:51:"D:\phpEnv\www\cz_pay\view\index\privacy_policy.html";i:1728201382;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>隐私政策</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/privacy_policy.css">

	<body class="uni-body pages-user-agreement" style="overflow: visible;">
        <header header-type="default">
            <div class="header" style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);">
                <div class="header-hd" onclick="window.history.back()">
                    <div class="header-btn">
                        <i class="uni-btn-icon" style="color: rgb(0, 0, 0); font-size: 27px;"></i>
                    </div>
                    <div class="header-ft"></div>
                </div>
                <div class="header-bd">
                    <div class="header__title" style="font-size: 16px; opacity: 1;">
                        隐私政策
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <div class="container">
            <div class="main">
                <?php echo (isset($config['privacy_policy']) && ($config['privacy_policy'] !== '')?$config['privacy_policy']:''); ?>
            </div>
        </div>
	</body>
</html>
<?php /*a:1:{s:44:"D:\phpEnv\www\cz_pay\view\error_message.html";i:1728670288;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title><?php echo htmlentities($msg); ?></title>
    <meta charset="utf-8" />
    <meta name="description" content="<?php echo htmlentities($msg); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link href="/static/admin/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/static/admin/css/style.bundle.css" rel="stylesheet" type="text/css" />
</head>
<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
<script>let defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }</script>
<div class="d-flex flex-column flex-root">
    <style>body { background-image: url('/static/admin/media/auth/bg1.jpg'); } [data-theme="dark"] body { background-image: url('/static/admin/media/auth/bg1-dark.jpg'); }</style>
    <div class="d-flex flex-column flex-center flex-column-fluid">
        <div class="d-flex flex-column flex-center text-center p-10">
            <div class="card card-flush w-lg-650px py-5">
                <div class="card-body py-15 py-lg-20">
                    <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">Oops!</h1>
                    <div class="fw-semibold fs-6 text-gray-500 mb-7"><?php echo htmlentities($msg); ?></div>
                    <div class="mb-3">
                        <img src="/static/admin/media/auth/404-error.png" class="mw-100 mh-300px theme-light-show" alt="" />
                    </div>
                    <div class="mb-0">
                        <a href="<?php echo htmlentities((isset($url) && ($url !== '')?$url:'Javascript:history.back()')); ?>" class="btn btn-sm btn-primary">返回上一页</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

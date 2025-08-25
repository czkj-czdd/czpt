<?php /*a:2:{s:59:"/www/wwwroot/122.51.23.115/view/index/account_settings.html";i:1737019431;s:56:"/www/wwwroot/122.51.23.115/view/layout/index_footer.html";i:1736872451;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>设置</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/account_settings.css">

	</head>
	<body class="uni-body pages-user-set">
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
                        设置
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <div class="container">
            <div class="list">
                <a class="item flexJA flexSb" href="/information">
                    <div class="title">个人资料</div>
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/25.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image>
                </a>
                <div class="item flexJA flexSb">
                    <div class="title">个人ID</div>
                    <div class="text"><?php echo htmlentities((isset($user_info['id']) && ($user_info['id'] !== '')?$user_info['id']:'')); ?></div>
                </div>
            </div>
            <div class="list">
                <a class="item flexJA flexSb" href="/password">
                    <div class="title">修改登录密码</div>
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/25.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image>
                </a>
                <div class="item flexJA flexSb">
                    <div class="title">注册手机号</div>
                    <div class="text"><?php echo htmlentities((isset($user_info['mobile']) && ($user_info['mobile'] !== '')?$user_info['mobile']:'')); ?></div>
                </div>
                <a class="item flexJA flexSb" href="/wallet_address">
                    <div class="title">钱包地址</div>
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/25.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image>
                </a>
                <!-- <a class="item flexJA flexSb" href="oil_card_list">
                    <div class="title">油卡管理</div>
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/25.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image> 
                </a> 
                <div class="item flexJA flexSb">
                    <div class="title">电卡管理</div>
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/25.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image>
                </div> -->
            </div>
            <div class="list">
                <div class="item flexJA flexSb">
                    <div class="title">清除缓存</div>
                    <div class="text flexJA flexFs">
                        <div>0KB</div>
                        <div class="red">清除</div>
                    </div>
                </div>
                <a class="item flexJA flexSb" href="/agreement">
                    <div class="title">用户协议</div>
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/25.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image>
                </a>
                <a class="item flexJA flexSb" href="/privacy_policy">
                    <div class="title">隐私政策</div>
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/25.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image>
                </a>
            </div>
            <a class="btn flexJA" href="/logout">退出登录</a>
        </div>
        <script src="/static/index/js/jquery.min.js"></script>
<script>
    out_order();
    function out_order() {
        $.ajax({
            url: "/footer_post/out_order",
            method: 'POST',
            dataType: 'json',
            success: function(res) {
                if (res.code === 200) {
                    let startTime = getLocalStorage('startTime_' + res.data);
                    let currentTime = new Date().getTime();
                    let timeDifference = (currentTime - startTime) / (1000 * 60);

                    if (timeDifference > 20) {
                        var utterThis = new window.SpeechSynthesisUtterance('审核池有'+res.data+'笔订单带确认');
                        utterThis.pitch=1
                        utterThis.rate=1.2
                        utterThis.voiceURI='BaiduMandarinMale'
                        window.speechSynthesis.speak(utterThis);
                        setLocalStorage('startTime_' + res.data, new Date().getTime());
                    } else {
                        return 0;
                    }
                    setTimeout(function (){
                        out_order();
                    },10000);
                }else{
                    setTimeout(function (){
                        out_order();
                    },3000);
                }
            }
        });
    };
    audio.addEventListener('ended', function() {
        isPlaying = false;
    });


    // 存储数据到本地缓存
    function setLocalStorage(key, value) {
        localStorage.setItem(key, JSON.stringify(value));
    }
    // 从本地缓存获取数据
    function getLocalStorage(key) {
        let data = localStorage.getItem(key);
        return data ? JSON.parse(data) : null;
    }
</script>

	</body>
</html>
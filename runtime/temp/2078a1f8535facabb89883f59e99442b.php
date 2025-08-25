<?php /*a:2:{s:46:"/www/wwwroot/lxth.lat/view/index/password.html";i:1736872451;s:51:"/www/wwwroot/lxth.lat/view/layout/index_footer.html";i:1736872451;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>个人资料</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/password.css">

        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-user-changePassword" style="overflow: visible;">
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
                        个人资料
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <div class="container">
            <div class="main">
                <div class="h1">请输入原密码进行修改</div>
                <div class="tips">如果忘记，请联系在线客服处理</div>
                <div class="list">
                    <div class="item">
                        <div class="title">原登录密码</div>
                        <div class="input">
                            <div class="uni-input-wrapper">
                                <input maxlength="20" step="" enterkeyhint="done" autocomplete="off" type="password" class="uni-input-input" placeholder="请输入原登录密码" id="old_password">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="title">新登录密码</div>
                        <div class="input">
                            <div class="uni-input-wrapper">
                                <input maxlength="20" step="" enterkeyhint="done" autocomplete="off" type="password" class="uni-input-input" placeholder="请输入新登录密码" id="password_one">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="title">确认新密码</div>
                        <div class="input">
                            <div class="uni-input-wrapper">
                                <input maxlength="20" step="" enterkeyhint="done" autocomplete="off" type="password" class="uni-input-input" placeholder="请输入确认新密码" id="password_two">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button flexJA" onclick="submit()">确认修改</div>
        </div>

        <script src="/static/index/js/jquery.min.js"></script>
        <script type="text/javascript">
            function submit() {
                $.ajax({
                    url: "/account_settings_post/password",
                    method: 'POST',
                    data: {
                        old_password: $('#old_password').val(),
                        password_one: $('#password_one').val(),
                        password_two: $('#password_two').val(),
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            toast({time: 3000, msg: res.message});
                            setTimeout(function (){
                                window.location.reload();
                            },1500);
                        }else{
                            toast({time: 3000, msg: res.message});
                        }

                    }
                });
            }
        </script>
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
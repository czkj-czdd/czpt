<?php /*a:1:{s:46:"/www/wwwroot/pay1888.top/view/index/login.html";i:1736927272;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo htmlentities((isset($config['name']) && ($config['name'] !== '')?$config['name']:'')); ?></title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/login.css">
        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->

	</head>
	<body class="uni-body pages-register-login">
        <div class="container">
            <div class="logo">
                <div style="background-image: url(/static/index/image/20.png); background-position: center center; background-size: cover; background-repeat: no-repeat;width: 100%; height: 100%;"></div>
            </div>
            <div class="main">
                <div class="flexJA flexFs">
                    <div class="home">继续逛逛</div>
                    <div class="icon">
                        <div style="background-image: url(/static/index/image/21.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;width: 100%; height: 100%;"></div>
                    </div>
                </div>
                <div class="h1"><?php echo htmlentities((isset($config['name']) && ($config['name'] !== '')?$config['name']:'')); ?></div>
                <div class="h2">登录可享受更多服务，快进行登录吧</div>
                <div class="bar flexJA flexFs">
                    <div class="text">+86</div>
                    <input type="number" class="uni-input-input" maxlength="11" placeholder="请输入手机号" value="<?php echo htmlentities((isset($mobile) && ($mobile !== '')?$mobile:'')); ?>" id="mobile">
                </div>
                <div class="bar flexJA flexFs">
                    <input type="password" class="uni-input-input" placeholder="请输入密码" value="<?php echo htmlentities((isset($remember_password) && ($remember_password !== '')?$remember_password:'')); ?>" id="password">
                </div>
                <div class="check">
                    <uni-checkbox-group class="flexJA flexFs">
                        <uni-checkbox style="transform: scale(0.6);">
                            <div class="uni-checkbox-wrapper">
                                <div class="uni-checkbox-input"></div>
                            </div>
                        </uni-checkbox>记住密码
                    </uni-checkbox-group>
                </div>
                <div class="button flexJA" onclick="login()">登录</div>
                <div class="tips flexJA">
                    <div class="text">还未创建账户？</div>
                    <a class="btn" href="/register">立即前往创建</a>
                </div>
                <div class="bottom">
                    <div class="text">忘记密码？请联系我们客服人员进行处理</div>
                    <div class="flexJA flexSb">
                        <div>TG：<?php echo htmlentities((isset($config['mailing_address']) && ($config['mailing_address'] !== '')?$config['mailing_address']:'')); ?></div>
                        <div class="copy" onclick="copyToClipboard()">复制</div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="remember_password" value="0">
        <script src="/static/index/js/jquery.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var checkbox = document.querySelector('.uni-checkbox-input');
                checkbox.addEventListener('click', function() {
                    if (checkbox.classList.contains('uni-checkbox-input-checked')) {
                        checkbox.classList.remove('uni-checkbox-input-checked');
                        $("#remember_password").val(0);
                    } else {
                        checkbox.classList.add('uni-checkbox-input-checked');
                        $("#remember_password").val(1);
                    }
                });
            });

            function login() {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/login_post/login",
                    timeout: 10000,
                    data: {
                        mobile: $('#mobile').val(),
                        password: $('#password').val(),
                        remember_password: $('#remember_password').val(),
                    },
                    success: function(res) {
                        if (res.code === 200) {
                            toast({time: 3000, msg: res.message});
                            setTimeout(function (){
                                window.location.href = '/'
                            },2000);
                        }else{
                            toast({time: 3000, msg: res.message});
                        }  
                    },
                })
            }
            
            function copyToClipboard() {
                var tempTextArea = document.createElement("textarea");
                tempTextArea.value = "<?php echo htmlentities((isset($config['mailing_address']) && ($config['mailing_address'] !== '')?$config['mailing_address']:'')); ?>";
                document.body.appendChild(tempTextArea);
                tempTextArea.select();
                document.execCommand("copy");
                document.body.removeChild(tempTextArea);
                toast({time: 3000, msg: '复制成功'});
            }
        </script>
	</body>
</html>
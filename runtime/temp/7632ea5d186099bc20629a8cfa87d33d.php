<?php /*a:1:{s:43:"/www/wwwroot/lxth.lat/view/index/login.html";i:1740298720;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo htmlentities((isset($config['name']) && ($config['name'] !== '')?$config['name']:'')); ?></title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/login.css">
        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <link rel="stylesheet" href="/static/index/css/layui.css" media="all">
        <link rel="stylesheet" href="/static/index/css/login-1.css">
        <link rel="stylesheet" href="/static/index/css/tooltips.css">
        <script type="text/javascript" src="/static/index/layui/layui.js"></script>
        <script type="text/javascript" src="/static/index/jquery.min.js"></script>
        <script type="text/javascript" src="/static/index/jquery.pure.tooltips.js"></script>
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
        <style>
        body {
            	margin:0;
            	padding:0;
            	overflow:hidden;
            	background:#2d9b95;
            	height: 1050px;
            	background:-moz-radial-gradient(center,ellipse cover,#2d9b95 0%,#0e1329 100%) !important;
            	background:-webkit-radial-gradient(center,ellipse cover,#2d9b95 0%,#0e1329 100%) !important;
            	background:-o-radial-gradient(center,ellipse cover,#2d9b95 0%,#0e1329 100%) !important;
            	background:-ms-radial-gradient(center,ellipse cover,#2d9b95 0%,#0e1329 100%) !important;
            	background:radial-gradient(ellipse at center,#2d9b95 0%,#0e1329 100%) !important;
            	filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#2d9b95',endColorstr='#0e1329',GradientType=1 );
            	background:-webkit-gradient(radial,center center,0px,center center,100%,color-stop(0%,#2d9b95),color-stop(100%,#0e1329)) !important;
            }
            .box {background:#000000;z-index:3;opacity: 0.6;}
            .box-login{width:100%; height:295px;margin-top:-10%;top:50%;}
            .box-register{width:100%; height:385px;margin-top:-8%;top:46%;}
            .box-reset{width:100%; height:385px;margin-top:-8%;top:46%;}
            #register {display:none;}
            #reset{display:none;}
        </style>
        
	</head>
	<body class="uni-body pages-register-login" style="overflow-y:auto;">
        <div class="container">
            <div class="logo">
                <div style="background-image: url(/static/index/image/20.png); background-position: center center; background-size: cover; background-repeat: no-repeat;width: 100%; height: 360px;"></div>
            </div>
            <!--<div class="main">-->
            <!--    <div class="flexJA flexFs">-->
            <!--        <div class="home">继续逛逛</div>-->
            <!--        <div class="icon">-->
            <!--            <div style="background-image: url(/static/index/image/21.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;width: 100%; height: 100%;"></div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="h1"><?php echo htmlentities((isset($config['name']) && ($config['name'] !== '')?$config['name']:'')); ?></div>-->
            <!--    <div class="h2">登录可享受更多服务，快进行登录吧</div>-->
            <!--    <div class="bar flexJA flexFs">-->
            <!--        <div class="text">+86</div>-->
            <!--        <input type="number" class="uni-input-input" maxlength="11" placeholder="请输入手机号" value="<?php echo htmlentities((isset($mobile) && ($mobile !== '')?$mobile:'')); ?>" id="mobile">-->
            <!--    </div>-->
            <!--    <div class="bar flexJA flexFs">-->
            <!--        <input type="password" class="uni-input-input" placeholder="请输入密码" value="<?php echo htmlentities((isset($remember_password) && ($remember_password !== '')?$remember_password:'')); ?>" id="password">-->
            <!--    </div>-->
            <!--    <div class="check">-->
            <!--        <uni-checkbox-group class="flexJA flexFs">-->
            <!--            <uni-checkbox style="transform: scale(0.6);">-->
            <!--                <div class="uni-checkbox-wrapper">-->
            <!--                    <div class="uni-checkbox-input"></div>-->
            <!--                </div>-->
            <!--            </uni-checkbox>记住密码-->
            <!--        </uni-checkbox-group>-->
            <!--    </div>-->
            <!--    <div class="button flexJA" onclick="login()">登录</div>-->
            <!--    <div class="tips flexJA">-->
            <!--        <div class="text">还未创建账户？</div>-->
            <!--        <a class="btn" href="/register">立即前往创建</a>-->
            <!--    </div>-->
            <!--    <div class="bottom">-->
            <!--        <div class="text">忘记密码？请联系我们客服人员进行处理</div>-->
            <!--        <div class="flexJA flexSb">-->
            <!--            <div>TG：<?php echo htmlentities((isset($config['mailing_address']) && ($config['mailing_address'] !== '')?$config['mailing_address']:'')); ?></div>-->
            <!--            <div class="copy" onclick="copyToClipboard()">复制</div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="beg-login-box box box-login layui-anim-up" id="login">
            	<header style="margin-top:12%;">
            		<h1 style="color:#FFFFFF">欢迎登录</h1>
            	</header>
            	<div class="beg-login-main">
            		<form action="" class="layui-form" method="post"><input name="__RequestVerificationToken" type="hidden" value="fkfh8D89BFqTdrE2iiSdG_L781RSRtdWOH411poVUWhxzA5MzI8es07g6KPYQh9Log-xf84pIR2RIAEkOokZL3Ee3UKmX0Jc8bW8jOdhqo81">		
            			<div class="layui-form-item">
            			</label>
            				<input id="mobile" type="number" name="mobile" lay-verify="mobile" autocomplete="off" placeholder="请输入手机号" class="layui-input" maxlength="11" value="<?php echo htmlentities((isset($mobile) && ($mobile !== '')?$mobile:'')); ?>">
            			</div>
            			<div class="layui-form-item">
            			</label>
            				<input id="password" type="password" name="password" lay-verify="password" autocomplete="off" placeholder="请输入密码" class="layui-input" value="<?php echo htmlentities((isset($remember_password) && ($remember_password !== '')?$remember_password:'')); ?>" >
            			</div>
            			<div class="layui-form-item">
            			
            				<div class="beg-pull-left beg-login-remember" style="color:#FFFFFF;margin-top: 1%;">
            					<label  style="margin-top: 3.5%;">记住帐号？</label>
            					<input type="checkbox" name="close" lay-skin="switch" lay-text="ON|OFF" checked=""><div class="layui-unselect layui-form-switch layui-form-onswitch"><i></i></div>
            				</div>
            				<div class="beg-clear"></div>
            			</div>
            		
            			<div class="layui-form-item">
            				<div class="beg-pull-left beg-login-remember" style="color:#FFFFFF;margin-top: -2%;">
            					<button type="button" class="layui-btn layui-btn-radius layui-btn-primary" onclick="window.location.href='/register';return false;">
            					 注册
            				</button></div>
            				
            				<div class="beg-pull-right">
            					<button type="button"  class="layui-btn layui-btn-radius" style="margin-top: 4%;" onclick="login();return false;">
            					 登录
            				    </button>
            				</div>
            			</div>
            			
            		</form>
            	
            	</div>
            	<div class="bottom" style="color:#FFFFFF;width:90%;margin-top:50px;">
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
            $('.layui-unselect').on('click', function () {
                // $(this).toggleClass('layui-form-onswitch');
            });

            document.addEventListener('DOMContentLoaded', function() {
                var checkbox = document.querySelector('.layui-unselect');
                checkbox.addEventListener('click', function() {
                    if (checkbox.classList.contains('layui-form-onswitch')) {
                        checkbox.classList.remove('layui-form-onswitch');
                        $("#remember_password").val(0);
                    } else {
                        checkbox.classList.add('layui-form-onswitch');
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
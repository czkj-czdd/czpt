<?php /*a:1:{s:46:"/www/wwwroot/lxth.lat/view/index/register.html";i:1740299980;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo htmlentities((isset($config['name']) && ($config['name'] !== '')?$config['name']:'')); ?></title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/register.css">
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
            </style>
	</head>
	<body class="uni-body pages-register-register" style="overflow-y:auto;">
        <div class="logo">
            <div style="background-image: url(/static/index/image/20.png); background-position: center center; background-size: cover; background-repeat: no-repeat;width: 100%;height: 360px;"></div>
        </div>
        <!--<div class="main">-->
        <!--    <div class="flexJA flexFs">-->
        <!--        <a class="home" href="/">继续逛逛</a>-->
        <!--        <div class="icon">-->
        <!--            <div style="background-image: url(/static/index/image/21.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;width: 100%;height: 100%;"></div>-->
        <!--        </div>-->
        <!--    </div>-->

        <!--    <div class="h1"><?php echo htmlentities((isset($config['name']) && ($config['name'] !== '')?$config['name']:'')); ?></div>-->
        <!--    <div class="h2">创建帐户，以便获得更多权益</div>-->
        <!--    <div class="bar flexJA flexFs">-->
        <!--        <div class="text">+86</div>-->
        <!--        <input type="number" class="uni-input-input" maxlength="11" placeholder="请输入手机号" id="mobile">-->
        <!--    </div>-->
        <!--    <div class="bar flexJA flexFs">-->
        <!--        <input type="password" class="uni-input-input" placeholder="请输入8-20个字母及数字组成的密码" id="password">-->
        <!--    </div>-->
        <!--    <div class="bar mb50 flexJA flexFs">-->
        <!--        <input type="text" class="uni-input-input" maxlength="8" placeholder="邀请码（必填）" id="invite_code" value="<?php echo htmlentities((isset($_REQUEST['code']) && ($_REQUEST['code'] !== '')?$_REQUEST['code']:'')); ?>">-->
        <!--    </div>-->
        <!--    <div class="button flexJA" onclick="Register()">注册并登录</div>-->
        <!--    <div class="tips flexJA">-->
        <!--        <div class="text">已经有账户了？</div>-->
        <!--        <a class="btn" href="/login">前往登录</a>-->
        <!--    </div>-->
        <!--    <div class="bottom flexJA">-->
        <!--        <div class="text">登录注册即代表已阅读并同意</div>-->
        <!--        <div class="btn" onclick="agreement(1)">《用户协议》</div>-->
        <!--        <div class="btn" onclick="agreement(2)">《隐私政策》</div>-->
        <!--    </div>-->
        <!--</div>-->
        <div class="beg-login-box box box-register" id="register">
        	<header style="margin-top:12%;">
        		<h1 style="color:#FFFFFF">欢迎注册</h1>
        	</header>
        	<div class="beg-login-main">
        		<form action="" class="layui-form" method="post"><input name="__RequestVerificationToken" type="hidden" value="fkfh8D89BFqTdrE2iiSdG_L781RSRtdWOH411poVUWhxzA5MzI8es07g6KPYQh9Log-xf84pIR2RIAEkOokZL3Ee3UKmX0Jc8bW8jOdhqo81" />		
        			<div class="layui-form-item">
        			
        				<input id="mobile" type="text" name="number" lay-verify="mobile" autocomplete="off" placeholder="请输入手机号" class="layui-input" maxlength="11">
        			</div>
        			<div class="layui-form-item">
        				<input id="password" type="password" name="password" lay-verify="password" autocomplete="off" placeholder="请输入8-20个字母及数字组成的密码" class="layui-input">
        			</div>
        			<div class="layui-form-item">
        				<input id="invite_code" type="text" name="invite_code" lay-verify="invite_code" autocomplete="off" placeholder="邀请码（必填）" class="layui-input" value="<?php echo htmlentities((isset($_REQUEST['code']) && ($_REQUEST['code'] !== '')?$_REQUEST['code']:'')); ?>">
        			</div>
        			<div class="layui-form-item">
        				<div class="beg-pull-left beg-login-remember" style="color:#FFFFFF;margin-top: 6%;">
        					<button type="button"  class="layui-btn" onclick="Register();return false;">
        					注册
        				</div>
        				
        				<div class="beg-pull-right">
        					<button type="button"  class="layui-btn layui-btn layui-btn-primary" style="margin-top: 18%;" onClick="window.location.href='/login';return false;">
        					返回登录
        				</button>
        				</div>
        			</div>
        		</form>
        	</div>
    	    <div class="bottom flexJA" style="margin-top:40%;width: 100%;color: wheat;">
                <div class="text" style="font-size: 15px;">登录注册即代表已阅读并同意</div>
                <div class="btn" style="font-size: 15px;color: #2979ff;" onclick="agreement(1)">《用户协议》</div>
                <div class="btn" style="font-size: 15px;color: #2979ff;" onclick="agreement(2)">《隐私政策》</div>
            </div>
        </div>


        <div class="wrap">
            <div class="layer-bottom">
                <div class="uni-popup__wrapper bottom" style="background-color: transparent;">
                    <div class="popup">
                        <div class="title flexJA flexSb">
                            <div class="icon"></div>
                            <div class="text" id="title">用户协议</div>
                            <div class="icon" onclick="closeFun()">
                                <div style="background-image: url(/static/index/image/22.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;" onclick="closeFun()"></div>
                            </div>
                        </div>
                        <div class="desc">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/static/index/js/jquery.min.js"></script>
        <script src="/static/index/js/mSlider.min.js"></script>
        <script>
            function Register() {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/register_post/register",
                    timeout: 10000,
                    data: {
                        mobile: $('#mobile').val(),
                        password: $('#password').val(),
                        invite_code: $('#invite_code').val(),
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
            var mSlider =  new mSlider({
                    dom: ".layer-bottom",
                    direction: "bottom"
                })
            
            function agreement(type) {
                if(type == 1){
                    $("#title").html('用户协议');
                    $(".desc").html(`<?php echo (isset($config['agreement']) && ($config['agreement'] !== '')?$config['agreement']:''); ?>`);
                }else{
                    $("#title").html('隐私政策');
                    $(".desc").html(`<?php echo (isset($config['privacy_policy']) && ($config['privacy_policy'] !== '')?$config['privacy_policy']:''); ?>`);
                }

               mSlider.open();
            }
            function closeFun() {
                console.log('aaaa')
                mSlider.close();
            }
            window.onload = function () {
                //移动端使用touchend
                var event = navigator.userAgent.match(/(iPhone|iPod|Android|ios)/i) ? 'touchend' : 'click';
                // 选择器
                var Q = function (id) {
                    return document.getElementById(id)
                };
            }
        </script>
	</body>
</html>
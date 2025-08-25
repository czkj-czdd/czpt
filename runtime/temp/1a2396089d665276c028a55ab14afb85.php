<?php /*a:1:{s:55:"D:\phpEnv\www\cz_pay\view\index\withdrawal_confirm.html";i:1728308940;}*/ ?>
<!DOCTYPE html>
<!-- saved from url=(0067)https://xl.baililai.xyz/h5#/pages/user/confirmWithdrawal?amount=100 -->
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>确认订单</title>
		<script>var coverSupport = 'CSS' in window && typeof CSS.supports === 'function' && (CSS.supports('top: env(a)') || CSS.supports('top: constant(a)'))
            document.write('<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0' + (coverSupport ? ', viewport-fit=cover' : '') + '" />')</script>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/withdrawal_confirm.css">
        
        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->

	</head>
	<body class="uni-body pages-user-confirmWithdrawal">
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
                        确认订单
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <div class="container">
            <div class="above">
                <div class="item flexJA flexSb">
                    <div class="text1">提现数量</div>
                    <div class="text2"><?php echo htmlentities($_REQUEST['amount']); ?> USDT</div>
                </div>
                <div class="item flexJA flexSb">
                    <div class="text1">提现手续费</div>
                    <div class="text2">-<?php echo htmlentities($config['withdrawal_fee']); ?> USDT</div>
                </div>
                <div class="item flexJA flexSb">
                    <div class="text3">实际到账数量</div>
                    <div class="num"><?php echo htmlentities($_REQUEST['amount'] - $config['withdrawal_fee']); ?></div>
                    <div class="unit">USDT</div>
                </div>
            </div>
            <div class="below">
                <div class="title">我的钱包地址</div>
                <div class="tips">请再次核对您的汇款地址</div>
                <div class="num flexJA"><?php echo htmlentities($user_info['trc20']); ?></div>
                <div class="flexJA">
                    <div class="btn flexJA" onclick="copyToClipboard()">复制钱包地址</div>
                </div>
            </div>
            <div class="button flexJA" onclick="submit()">提交订单</div>
        </div>
        <script src="/static/index/js/jquery.min.js"></script>
        <script>
            function submit() {
                $.ajax({
                    url: "/withdrawal_confirm_post/submit",
                    method: 'POST',
                    data: {
                        amount: "<?php echo htmlentities($_REQUEST['amount']); ?>",
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            toast({time: 3000, msg: res.message});
                            setTimeout(function (){
                                window.location.href = '/recharge_withdrawal';
                            },2000);
                        }else{
                            toast({time: 3000, msg: res.message});
                        }

                    }
                });
            }
            function copyToClipboard() {
                var tempTextArea = document.createElement("textarea");
                tempTextArea.value = "<?php echo htmlentities($user_info['trc20']); ?>";
                document.body.appendChild(tempTextArea);
                tempTextArea.select();
                document.execCommand("copy");
                document.body.removeChild(tempTextArea);
                toast({time: 3000, msg: '复制成功'});
            }
        </script>
	</body>
</html>
<?php /*a:2:{s:71:"/www/wwwroot/www.czysqcrxw.site/5555/view/index/withdrawal_confirm.html";i:1728755166;s:66:"/www/wwwroot/www.czysqcrxw.site/5555/view/layout/index_footer.html";i:1728755148;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>确认订单</title>
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
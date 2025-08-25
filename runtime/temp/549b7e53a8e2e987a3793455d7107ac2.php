<?php /*a:2:{s:73:"/www/wwwroot/www.czysqcrxw.site/5555/view/index/bank_card_add_modify.html";i:1728755292;s:66:"/www/wwwroot/www.czysqcrxw.site/5555/view/layout/index_footer.html";i:1728755148;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>新增支付</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="/static/index/css/bank_card_add_modify.css">

        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-user-addBankCard">
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
                        新增支付
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <div class="container">
            <div class="list">
                <div class="item">
                    <div class="title ">姓名</div>
                    <div class="input">
                        <div class="uni-input-wrapper">
                            <input type="text" class="uni-input-input" placeholder="姓名/姓名需和收款人一致" value="<?php echo htmlentities((isset($BankCard_info['name']) && ($BankCard_info['name'] !== '')?$BankCard_info['name']:'')); ?>" id="name">
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="title ">预留手机号</div>
                    <div class="input">
                        <div class="uni-input-wrapper">
                            <input type="number" class="uni-input-input" placeholder="请输入手机号或微信号" value="<?php echo htmlentities((isset($BankCard_info['mobile']) && ($BankCard_info['mobile'] !== '')?$BankCard_info['mobile']:'')); ?>" id="mobile">
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="title">微信</div>
                    <div class="input">
                        <div class="uni-input-wrapper">
                            <input type="text" class="uni-input-input" placeholder="请输人微信号" value="<?php echo htmlentities((isset($BankCard_info['wx_account']) && ($BankCard_info['wx_account'] !== '')?$BankCard_info['wx_account']:'')); ?>" id="wx_account">
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="title">支付宝</div>
                    <div class="input">
                        <div class="uni-input-wrapper">
                            <input type="text" class="uni-input-input" placeholder="请输人支付宝账号" value="<?php echo htmlentities((isset($BankCard_info['zfb_account']) && ($BankCard_info['zfb_account'] !== '')?$BankCard_info['zfb_account']:'')); ?>" id="zfb_account">
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn button flexJA" onclick="submit()">保存</div>
        </div>
        <script src="/static/index/js/jquery.min.js"></script>
        <script type="text/javascript">
            function submit() {
                $.ajax({
                    url: "/bank_card_post/submit",
                    method: 'POST',
                    data: {
                        bank_card_id: "<?php echo htmlentities((isset($BankCard_info['id']) && ($BankCard_info['id'] !== '')?$BankCard_info['id']:'')); ?>",
                        name: $('#name').val(),
                        mobile: $('#mobile').val(),
                        wx_account: $('#wx_account').val(),
                        zfb_account: $('#zfb_account').val(),
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
<?php /*a:2:{s:59:"/www/wwwroot/lxth.lat/view/index/transaction_sale_edit.html";i:1736872451;s:51:"/www/wwwroot/lxth.lat/view/layout/index_footer.html";i:1736872451;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>编辑</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="/static/index/css/transaction_sale_edit.css">

        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-transaction-saleEdit">
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
                        编辑
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <div class="container">
            <div class="above">
                <div class="bar flexJA flexFs">
                    <div class="icon">
                        <div style="background-image: url(/static/index/image/58.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="text">我的资产</div>
                </div>
                <div class="num"><?php echo htmlentities($user_info['balance']); ?> USDT</div>
            </div>
            <div class="middle">
                <div class="box">
                    <div class="title flexJA flexFs">
                        <div>挂单总数量</div>
                        <div class="tips">出售的资产将转移冻结状态</div>
                    </div>
                    <div class="title" style="color: rgb(255, 0, 0); margin-top: -10px;">最低挂单数量 <?php echo htmlentities((isset($config['transaction_mini_quantity']) && ($config['transaction_mini_quantity'] !== '')?$config['transaction_mini_quantity']:'')); ?></div>
                    <div class="bar1 flexJA flexFs">
                        <div class="input">
                            <div class="uni-input-wrapper">
                                <input maxlength="140" step="0.000000000000000001" enterkeyhint="done" autocomplete="off" type="number" class="uni-input-input" placeholder="0.00" value="<?php echo htmlentities((isset($TransactionProduct_info['sell_account']) && ($TransactionProduct_info['sell_account'] !== '')?$TransactionProduct_info['sell_account']:'')); ?>" id="sell_account">
                            </div>
                        </div>
                        <div class="text">USDT</div>
                        <div class="icon">
                            <div style="background-image: url(/static/index/image/59.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="bar flexJA flexFs">
                    <div class="icon">
                        <div style="background-image: url(/static/index/image/63.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="text">1 USDT ≈ <span class="cny">0</span> CNY</div>
                </div>
                <div class="box mb40">
                    <div class="title flexJA flexFs">单价价格</div>
                    <div class="bar1 flexJA flexFs">
                        <div class="input">
                            <div class="uni-input-wrapper">
                                <input maxlength="140" step="0.000000000000000001" enterkeyhint="done" pattern="[0-9]*" autocomplete="off" type="number" class="uni-input-input" placeholder="0.00" value="<?php echo htmlentities((isset($TransactionProduct_info['unit_price']) && ($TransactionProduct_info['unit_price'] !== '')?$TransactionProduct_info['unit_price']:'')); ?>" id="unit_price" oninput="unit_price();">
                            </div>
                        </div>
                        <div class="flexJA flexFs">
                            <div class="text">CNY</div>
                            <div class="icon">
                                <div style="background-image: url(/static/index/image/60.png); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="title flexJA flexFs">额度限制</div>
                    <div class="bar2 flexJA flexSb">
                        <div class="input">
                            <div class="uni-input-wrapper">
                                <input maxlength="140" step="0.000000000000000001" enterkeyhint="done" pattern="[0-9]*" autocomplete="off" type="number" class="uni-input-input" placeholder="最小额度" value="<?php echo htmlentities((isset($TransactionProduct_info['min_limit']) && ($TransactionProduct_info['min_limit'] !== '')?$TransactionProduct_info['min_limit']:'')); ?>" id="min_limit">
                            </div>
                        </div>
                        <div class="input">
                            <div class="uni-input-wrapper">
                                <input maxlength="140" step="0.000000000000000001" enterkeyhint="done" pattern="[0-9]*" autocomplete="off" type="number" class="uni-input-input" placeholder="最大额度" value="<?php echo htmlentities((isset($TransactionProduct_info['max_limit']) && ($TransactionProduct_info['max_limit'] !== '')?$TransactionProduct_info['max_limit']:'')); ?>" id="max_limit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="below">
                <a class="bar flexJA flexSb" href="/bank_card">
                    <div class="icon" style="width: 65px; height: 21px;">
                        <div style="background-image: url(/static/index/image/118.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="title">微信/支付宝转账</div>
                    <div class="arrows">
                        <div style="background-image: url(/static/index/image/62.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                </a>
                <div class="box">
                    <div class="text2">
                        <uni-text>
                            <span class="name"></span>
                        </uni-text>
                        <uni-text>
                            <span>+86</span>
                        </uni-text>
                        <uni-text>
                            <span class="mobile"></span>
                        </uni-text>
                    </div>
                    <div class="text1 text3 wx_account"></div>
                    <div class="text3 zfb_account"></div>
                </div>
            </div>
            <div class="button flexJA" onclick="submit()">保存</div>
        </div>
        <script src="/static/index/js/jquery.min.js"></script>
        <script>
            function submit() {
                $.ajax({
                    url: "/transaction_sale_edit_post/submit",
                    method: 'POST',
                    data: {
                        id: "<?php echo htmlentities((isset($TransactionProduct_info['id']) && ($TransactionProduct_info['id'] !== '')?$TransactionProduct_info['id']:'')); ?>",
                        sell_account: $('#sell_account').val(),
                        unit_price: $('#unit_price').val(),
                        min_limit: $('#min_limit').val(),
                        max_limit: $('#max_limit').val(),
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

            function unit_price() {
                $('.cny').html($('#unit_price').val())
            }
            
            window.onload = function() {
                $.ajax({
                    url: "/transaction_sale_edit_post/bank_card",
                    method: 'POST',
                    data: {},
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            $('.name').html(res.data.name);
                            $('.mobile').html(res.data.mobile);
                            $('.wx_account').html(`微信号 ` + res.data.wx_account);
                            $('.zfb_account').html(`支付宝 ` + res.data.zfb_account);

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
<?php /*a:2:{s:65:"/www/wwwroot/lxth.lat/view/index/transaction_trading_details.html";i:1740219577;s:51:"/www/wwwroot/lxth.lat/view/layout/index_footer.html";i:1736872451;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>订单详情</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="/static/index/css/transaction_trading_details.css">
        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-transaction-tradingDetails">
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
                        订单详情
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <?php if($user_info['id'] == $TransactionOrder_info['uid']): ?>
        <!-- 买家页面 -->
        <div class="container">
            <div class="buyer">
                <div class="above">
                    <div class="bar flexJA flexSb">
                        <div class="left">
                            <div class="num">订单：<?php echo htmlentities((isset($TransactionOrder_info['order_number']) && ($TransactionOrder_info['order_number'] !== '')?$TransactionOrder_info['order_number']:'')); ?></div>
                            <div class="date">创建于<?php echo htmlentities((isset($TransactionOrder_info['create_time']) && ($TransactionOrder_info['create_time'] !== '')?$TransactionOrder_info['create_time']:'')); ?></div>
                        </div>
                        <?php if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 0): ?>
                        <div class="state">待汇款</div>
                        <?php endif; if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 1): ?>
                        <div class="state">已汇款</div>
                        <?php endif; if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 2): ?>
                        <div class="state red">已取消</div>
                        <?php endif; if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 3): ?>
                        <div class="state">已完成</div>
                        <?php endif; ?>
                    </div>
                    <?php if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 0): ?>
                        <div class="time">请在<uni-text><span id="countdown">0分 0秒</span></uni-text>
                            完成汇款进行提交，以防订单自动失效所填信息信息有误
                        </div>
                        <div class="flexJA flexFe" onclick="cancel()">
                            <div class="cancel flexJA">取消订单</div>
                        </div>
                    <?php endif; if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 1): ?>
                    <div class="text">
                        <div class="tips">于<?php echo htmlentities($TransactionOrder_info['submit_time']); ?> 提交汇款</div>
                        <div>已成功提交汇款，请等待卖家核实验收。如订单存在争议可申请客服介入</div>
                    </div>
                    <?php endif; if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 2): ?>
                    <div class="text">于<?php echo htmlentities($TransactionOrder_info['cancel_time']); ?> 取消订单</div>
                    <?php endif; if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 3): ?>
                    <div class="text">
                        <div class="tips">于<?php echo htmlentities($TransactionOrder_info['submit_time']); ?> 买家提交汇款</div>
                        <div class="tips">于<?php echo htmlentities($TransactionOrder_info['complete_time']); ?> 卖家验收完成</div>
                        <div>卖家已操作验收，订单已完成</div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="middle">
                    <div class="title">卖家收款账户</div>
                    <div class="text">请根据卖家所提供汇款地址进行汇款，如有问题可联系客服</div>
                    <div class="item flexJA flexSb">
                        <div class="text"><?php echo htmlentities((isset($TransactionOrder_info['bank_card_info']['name']) && ($TransactionOrder_info['bank_card_info']['name'] !== '')?$TransactionOrder_info['bank_card_info']['name']:'')); ?></div>
                        <div class="copy" onclick="copy_name()">复制</div>
                    </div>
                    <div class="item flexJA flexSb">
                        <div class="text">添加微信：<?php echo htmlentities((isset($TransactionOrder_info['bank_card_info']['zfb_account']) && ($TransactionOrder_info['bank_card_info']['zfb_account'] !== '')?$TransactionOrder_info['bank_card_info']['zfb_account']:'')); ?></div>
                        <div class="copy" onclick="copy_zfb_account()">复制</div>
                    </div>
                </div>
                <div class="below <?php if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] != 2): ?>mb208<?php endif; ?>">
                    <div class="bar flexJA flexSb">
                        <div class="text1">购买数量</div>
                        <div class="text2"><?php echo htmlentities((isset($TransactionOrder_info['pay_amount']) && ($TransactionOrder_info['pay_amount'] !== '')?$TransactionOrder_info['pay_amount']:'')); ?> USDT</div>
                    </div>
                    <div class="bar flexJA flexSb">
                        <div class="text1">交易手续费</div>
                        <div class="text2"><?php echo htmlentities((isset($TransactionOrder_info['transaction_fees']) && ($TransactionOrder_info['transaction_fees'] !== '')?$TransactionOrder_info['transaction_fees']:'')); ?> USDT</div>
                    </div>
                    <div class="bar flexJA flexSb">
                        <div class="text1">单价</div>
                        <div class="text2">1 USDT ≈ <?php echo htmlentities((isset($TransactionOrder_info['unit_price']) && ($TransactionOrder_info['unit_price'] !== '')?$TransactionOrder_info['unit_price']:'')); ?> CNY</div>
                    </div>
                    <div class="bar flexJA flexSb">
                        <div class="text1">我要支付</div>
                        <div class="text2"><?php echo htmlentities((isset($TransactionOrder_info['payment_amount']) && ($TransactionOrder_info['payment_amount'] !== '')?$TransactionOrder_info['payment_amount']:'')); ?> CNY</div>
                    </div>
                    <div class="bar flexJA flexSb special">
                        <div class="text2">实际到账数量</div>
                        <div class="text3"><?php echo htmlentities((isset($TransactionOrder_info['usdt_amount']) && ($TransactionOrder_info['usdt_amount'] !== '')?$TransactionOrder_info['usdt_amount']:'')); ?>
                            <uni-text>
                                <span>USDT</span>
                            </uni-text>
                        </div>
                    </div>
                    <?php if(!empty($TransactionOrder_info) && !$TransactionOrder_info['voucher_image']): ?>
                    <div class="voucher_image">
                        <div class="box flexJA" id="upload">
                            <input type="file" id="voucher_image_upload" accept=".png, .jpg, .jpeg" style="display: none;" />
                            <div class="icon">
                                <div style="background-image: url(/static/index/image/64.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;">
                                </div>
                            </div>
                            <div class="text">上传汇款凭证(选填)</div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="image flexJA" style="height: 308px;">
                        <div style="background-image: url(<?php echo htmlentities((isset($TransactionOrder_info['voucher_image']) && ($TransactionOrder_info['voucher_image'] !== '')?$TransactionOrder_info['voucher_image']:'')); ?>);background-size: 100% 100%;background-repeat: no-repeat;height: 100%; width: 100%;"></div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 0): ?>
                <div class="bottom flexJA flexSb">
                    <a class="btn1 flexJA" href="https://kf.lxth.lat/chat/index?noCanClose=1&token=136c03b1bddcc41561a9be2bba55e477">联系客服</a>
                    <div class="btn2 flexJA" onclick="confirm()">我已汇款</div>
                </div>
                <?php endif; if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 1): ?>
                <div class="bottom flexJA flexSb">
                    <a class="btn1 flexJA" href="https://kf.lxth.lat/chat/index?noCanClose=1&token=136c03b1bddcc41561a9be2bba55e477">联系客服</a>
                    <div class="btn2 flexJA">等待卖方确认验收</div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php else: ?>
        <!-- 卖家页面 -->
        <div class="container">
            <div class="buyer">
                <div class="above">
                    <div class="bar flexJA flexSb">
                        <div class="left">
                            <div class="num">订单：<?php echo htmlentities((isset($TransactionOrder_info['order_number']) && ($TransactionOrder_info['order_number'] !== '')?$TransactionOrder_info['order_number']:'')); ?></div>
                            <div class="date">创建于<?php echo htmlentities((isset($TransactionOrder_info['create_time']) && ($TransactionOrder_info['create_time'] !== '')?$TransactionOrder_info['create_time']:'')); ?></div>
                        </div>
                        <?php if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 0): ?>
                        <div class="state">待汇款</div>
                        <?php endif; if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 1): ?>
                        <div class="state">已汇款</div>
                        <?php endif; if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 2): ?>
                        <div class="state red">已取消</div>
                        <?php endif; if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 3): ?>
                        <div class="state">已完成</div>
                        <?php endif; ?>
                    </div>
                    <?php if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 0): ?>
                    <div class="time">等待买家提交汇款</div>
                    <?php endif; if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 1): ?>
                    <div class="text">
                        <div class="tips">于<?php echo htmlentities($TransactionOrder_info['submit_time']); ?> 买家提交汇款</div>
                        <div>请尽快确认是否收到款项，确认后进行放款</div>
                    </div>
                    <?php endif; if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 2): ?>
                    <div class="text">于<?php echo htmlentities($TransactionOrder_info['cancel_time']); ?> 买家取消订单</div>
                    <?php endif; if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 3): ?>
                    <div class="text">
                        <div class="tips">于<?php echo htmlentities($TransactionOrder_info['submit_time']); ?> 买家提交汇款</div>
                        <div class="tips">于<?php echo htmlentities($TransactionOrder_info['complete_time']); ?> 卖家验收完成</div>
                        <div>已操作验收，订单已完成</div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="middle">
                    <div class="title">买家信息</div>
                    <div class="item flexJA flexSb">
                        <div class="text">汇款人姓名：<?php echo htmlentities((isset($TransactionOrder_info['remittance_user_name']) && ($TransactionOrder_info['remittance_user_name'] !== '')?$TransactionOrder_info['remittance_user_name']:'')); ?></div>
                        <div class="copy" onclick="remittance_user_name()">复制</div>
                    </div>
                </div>
                <div class="below <?php if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] != 2): ?>mb208<?php endif; ?>">
                    <div class="bar flexJA flexSb">
                        <div class="text1">购买数量</div>
                        <div class="text2"><?php echo htmlentities((isset($TransactionOrder_info['pay_amount']) && ($TransactionOrder_info['pay_amount'] !== '')?$TransactionOrder_info['pay_amount']:'')); ?> USDT</div>
                    </div>
                    <div class="bar flexJA flexSb">
                        <div class="text1">交易手续费</div>
                        <div class="text2"><?php echo htmlentities((isset($TransactionOrder_info['transaction_fees']) && ($TransactionOrder_info['transaction_fees'] !== '')?$TransactionOrder_info['transaction_fees']:'')); ?> USDT</div>
                    </div>
                    <div class="bar flexJA flexSb">
                        <div class="text1">单价</div>
                        <div class="text2">1 USDT ≈ <?php echo htmlentities((isset($TransactionOrder_info['unit_price']) && ($TransactionOrder_info['unit_price'] !== '')?$TransactionOrder_info['unit_price']:'')); ?> CNY</div>
                    </div>
                    <div class="bar flexJA flexSb">
                        <div class="text1">我将收到</div>
                        <div class="text2"><?php echo htmlentities((isset($TransactionOrder_info['payment_amount']) && ($TransactionOrder_info['payment_amount'] !== '')?$TransactionOrder_info['payment_amount']:'')); ?> CNY</div>
                    </div>
                    <div class="bar flexJA flexSb special">
                        <div class="text2">实际到账数量</div>
                        <div class="text3"><?php echo htmlentities((isset($TransactionOrder_info['usdt_amount']) && ($TransactionOrder_info['usdt_amount'] !== '')?$TransactionOrder_info['usdt_amount']:'')); ?>
                            <uni-text>
                                <span>USDT</span>
                            </uni-text>
                        </div>
                    </div>
                    <?php if(!empty($TransactionOrder_info) && $TransactionOrder_info['voucher_image']): ?>
                    <div class="image flexJA" style="height: 308px;">
                        <div style="background-image: url(<?php echo htmlentities((isset($TransactionOrder_info['voucher_image']) && ($TransactionOrder_info['voucher_image'] !== '')?$TransactionOrder_info['voucher_image']:'')); ?>);background-size: 100% 100%;background-repeat: no-repeat;height: 100%; width: 100%;"></div>
                    </div>
                    <?php endif; if(!empty($TransactionOrder_info) && $TransactionOrder_info['status'] == 1): ?>
                    <div class="bottom flexJA flexSb">
                        <a class="btn1 flexJA" href="https://kf.lxth.lat/chat/index?noCanClose=1&token=136c03b1bddcc41561a9be2bba55e477">联系客服</a>
                        <div class="btn2 flexJA" onclick="acepted()">已验收，确认放款</div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="wrap" style="display: none;">
            <div class="layer-bottom">
                <div class="uni-popup__wrapper bottom" style="background-color: transparent; padding: 0px;">
                    <div class="popup">
                        <div class="box">
                            <div class="title">为了您的账号安全，本次操作需输入密码</div>
                            <div class="tips">请输入您的账号登录密码</div>
                            <div class="input">
                                <div class="uni-input-wrapper">
                                    <input maxlength="140" step="" enterkeyhint="done" autocomplete="off" type="password" class="uni-input-input" placeholder="请输入登录密码" id="password">
                                </div>
                            </div>
                        </div>
                        <div class="button flexJA" onclick="acepted_submit()">确认</div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <script src="/static/index/js/jquery.min.js"></script>
        <script src="/static/index/js/mSlider.min.js"></script>
        <script>
            function confirm() {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/transaction_trading_details_post/confirm",
                    data: {
                        id: "<?php echo htmlentities((isset($TransactionOrder_info['id']) && ($TransactionOrder_info['id'] !== '')?$TransactionOrder_info['id']:'')); ?>",
                    },
                    success: function(res) {
                        if (res.code === 200) {
                            toast({time: 3000, msg: res.message});
                            setTimeout(function (){
                                window.location.reload();
                            },2000);
                        }else{
                            toast({time: 3000, msg: res.message});
                        }  
                    },
                })
            }
            function cancel() {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/transaction_trading_details_post/cancel",
                    data: {
                        id: "<?php echo htmlentities((isset($TransactionOrder_info['id']) && ($TransactionOrder_info['id'] !== '')?$TransactionOrder_info['id']:'')); ?>",
                    },
                    success: function(res) {
                        if (res.code === 200) {
                            toast({time: 3000, msg: res.message});
                            setTimeout(function (){
                                window.location.reload();
                            },2000);
                        }else{
                            toast({time: 3000, msg: res.message});
                        }  
                    },
                })
            }
            var countDownDate = new Date("<?php echo htmlentities((isset($TransactionOrder_info['create_time']) && ($TransactionOrder_info['create_time'] !== '')?$TransactionOrder_info['create_time']:'')); ?>").getTime() + (20 * 60 * 1000);
            var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementById("countdown").innerHTML =  minutes + " 分 " + seconds + " 秒 ";
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("countdown").innerHTML = "0分 0秒";
                }
            }, 1000);

            function remittance_user_name() {
                var tempTextArea = document.createElement("textarea");
                tempTextArea.value = "<?php echo htmlentities((isset($TransactionOrder_info['bank_card_info']['zfb_account']) && ($TransactionOrder_info['bank_card_info']['zfb_account'] !== '')?$TransactionOrder_info['bank_card_info']['zfb_account']:'')); ?>";
                document.body.appendChild(tempTextArea);
                tempTextArea.select();
                document.execCommand("copy");
                document.body.removeChild(tempTextArea);
                toast({time: 3000, msg: '复制成功'});
            }

            document.getElementById('upload').addEventListener('click', function() {
                document.getElementById('voucher_image_upload').click();
            });
            let input_2 = document.getElementById("voucher_image_upload");
            input_2.addEventListener('change',voucher_image_upload,false);
            function voucher_image_upload(){
                let file = this.files[0]; 
                if(!/image\/\w+/.test(file.type)){
                    alert("请确保文件为图像类型"); 
                    return false; 
                }
                let reader = new FileReader(); 
                reader.readAsDataURL(file); 
                console.log();
                reader.onload = function(e){ 
                    $.ajax({
                        url: "/upload_post",
                        method: 'POST',
                        data: {
                            result: this.result,
                        },
                        success: function(res) {
                            if (res.code === 200) {
                                $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: "/transaction_trading_details_post/image",
                                    timeout: 10000,
                                    data: {
                                        id: "<?php echo htmlentities((isset($TransactionOrder_info['id']) && ($TransactionOrder_info['id'] !== '')?$TransactionOrder_info['id']:'')); ?>",
                                        voucher_image: res.data,
                                    },
                                    success: function(res_b) {
                                        if (res_b.code === 200) {
                                            $('.voucher_image').html(`
                                            <div class="image flexJA" style="height: 308px;">
                                                <div style="background-image: url(${res.data});background-size: 100% 100%;background-repeat: no-repeat;height: 100%; width: 100%;"></div>
                                            </div>`);
                                            toast({time: 3000, msg: res.message});
                                        }else{
                                            toast({time: 3000, msg: res.message});
                                        }  
                                    },
                                })
                            } else {
                                toast({time: 3000, msg: res.message});
                            }
                        }
                    });
                }
            }
        </script>
        <script>
            function acepted_submit() {
                $.ajax({
                    url: "/transaction_trading_details_post/acepted_submit",
                    method: 'POST',
                    data: {
                        password: $('#password').val(),
                        id: "<?php echo htmlentities((isset($TransactionOrder_info['id']) && ($TransactionOrder_info['id'] !== '')?$TransactionOrder_info['id']:'')); ?>",
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
            
            function acepted() {
                new mSlider({
                    dom: ".layer-bottom",
                    direction: "bottom"
                }).open();
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
        <?php if(empty($TransactionOrder_info)): ?>
        <script>
            toast({time: 3000, msg: "订单号不存在"});
        </script>
        <?php endif; ?>
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
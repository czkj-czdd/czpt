<?php /*a:1:{s:52:"D:\phpEnv\www\cz_pay\view\index\transaction_buy.html";i:1728665793;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + 0px); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>购买</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="/static/index/css/transaction_buy.css">

        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-transaction-buy">
        <div class="container">
            <div class="bg">
                <div style="background-image: url(/static/index/image/23.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
            </div>
            <div class="fixation">
                <div class="tab flexJA flexSb">
                    <div class="icon" onclick="window.history.back()">
                        <div style="background-image: url(/static/index/image/32.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="title black">购买</div>
                    <div class="icon"></div>
                </div>
                <div class="info flexJA flexDc">
                    <div class="icon">
                        <div style="background-image: url(<?php echo htmlentities((isset($sell_uid_info['avatar']) && ($sell_uid_info['avatar'] !== '')?$sell_uid_info['avatar']:'/static/index/image/user_avatar.jpg')); ?>); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;    border-radius: 50%;"></div>
                    </div>

                    <div class="name"><?php echo htmlentities((isset($sell_uid_info['nickname']) && ($sell_uid_info['nickname'] !== '')?$sell_uid_info['nickname']:'未设置')); ?></div>
                </div>
                <div class="sell flexJA flexSb">
                    <div class="item">
                        <div class="num"><?php echo htmlentities((isset($TransactionProduct_info['sell_account']) && ($TransactionProduct_info['sell_account'] !== '')?$TransactionProduct_info['sell_account']:'')); ?></div>
                        <div class="text">出售数量</div>
                    </div>
                    <div class="item">
                        <div class="num"><?php echo htmlentities((isset($TransactionProduct_info['min_limit']) && ($TransactionProduct_info['min_limit'] !== '')?$TransactionProduct_info['min_limit']:'')); ?>-<?php echo htmlentities((isset($TransactionProduct_info['max_limit']) && ($TransactionProduct_info['max_limit'] !== '')?$TransactionProduct_info['max_limit']:'')); ?></div>
                        <div class="text">额度限制</div>
                    </div>
                    <div class="item">
                        <div class="num tr"><?php echo htmlentities((isset($TransactionProduct_info['unit_price']) && ($TransactionProduct_info['unit_price'] !== '')?$TransactionProduct_info['unit_price']:'')); ?></div>
                        <div class="text">单价CNY</div>
                    </div>
                </div>
                <div class="buy">
                    <div class="box flexJA flexSb">
                        <div class="left">
                            <div class="title">我要购买</div>
                            <div class="input">
                                <div class="uni-input-wrapper">
                                    <input maxlength="140" step="0.000000000000000001" enterkeyhint="done" pattern="[0-9]*" autocomplete="off" type="number" class="uni-input-input" placeholder="0.00" id="pay_amount" oninput="convert();">
                                </div>
                            </div>
                        </div>
                        <div class="right flexJA flexFs">
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
                        <div class="text">1 USDT ≈ 7.04 CNY</div>
                    </div>
                    <div class="box flexJA flexSb">
                        <div class="left">
                            <div class="title">我要支付</div>
                            <div class="input">
                                <div class="uni-input-wrapper">
                                    <input disabled="disabled" maxlength="140" step="" enterkeyhint="done" autocomplete="off" type="" class="uni-input-input" value="0.00" id="payment_amount">
                                </div>
                            </div>
                        </div>
                        <div class="right flexJA flexFs">
                            <div class="text">CNY</div>
                            <div class="icon">
                                <div style="background-image: url(/static/index/image/01.jpeg); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;border-radius: 50%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="above flexJA flexFs">
                        <div class="icon" style="width: 65px; height: 21px;">
                            <div style="background-image: url(/static/index/image/118.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                        </div>
                        <div class="title">微信/支付宝转账</div>
                    </div>
                    <div class="below">
                        <div class="text">汇款信息完善</div>
                        <uni-input class="input">
                            <div class="uni-input-wrapper">
                                <input maxlength="140" step="" enterkeyhint="done" autocomplete="off" type="" class="uni-input-input" placeholder="请输入您的真实姓名" id="remittance_user_name">
                            </div>
                        </uni-input>
                    </div>
                </div>
                <div class="button flexJA" onclick="submit()">确认</div>
            </div>
        </div>
        <script src="/static/index/js/jquery.min.js"></script>
        <script>
            function submit() {
                $.ajax({
                    url: "/transaction_buy_post/submit",
                    method: 'POST',
                    data: {
                        pay_amount: $('#pay_amount').val(),
                        remittance_user_name: $('#remittance_user_name').val(),
                        transact_id: "<?php echo htmlentities((isset($TransactionProduct_info['id']) && ($TransactionProduct_info['id'] !== '')?$TransactionProduct_info['id']:'')); ?>",
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            toast({time: 3000, msg: res.message});
                            setTimeout(function (){
                                window.location.href = `/transaction_trading_details/${res.data}`
                            },1500);
                        }else{
                            toast({time: 3000, msg: res.message});
                        }
                    }
                });
            }
            function convert() {
                var pay_amount = $('#pay_amount').val();
                var unit_price = "<?php echo htmlentities((isset($TransactionProduct_info['unit_price']) && ($TransactionProduct_info['unit_price'] !== '')?$TransactionProduct_info['unit_price']:'')); ?>"; // 获取单价
                var payment_amount = (pay_amount * unit_price).toFixed(2); // 将结果保留两位小数
                $('#payment_amount').val(payment_amount);
            }
        </script>
        <?php if(empty($TransactionProduct_info)): ?>
        <script>
            toast({time: 3000, msg: "售卖交易已下架或取消"});
        </script>
        <?php endif; ?>
	</body>
</html>
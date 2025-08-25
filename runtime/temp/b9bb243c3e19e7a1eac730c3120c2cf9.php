<?php /*a:2:{s:57:"/www/wwwroot/lxth.lat/view/index/recharge_withdrawal.html";i:1736872451;s:51:"/www/wwwroot/lxth.lat/view/layout/index_footer.html";i:1736872451;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + 0px); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>充值提现</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/recharge_withdrawal.css">
        
        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-user-paymentManagement">
        <div class="container">
            <div class="bg">
                <div style="background-image: url(/static/index/image/23.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
            </div>
            <div class="fixation">
                <div class="tab flexJA flexSb">
                    <div class="icon" onclick="window.history.back()">
                        <div style="background-image: url(/static/index/image/32.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="title black">支付管理</div>
                    <div class="icon"></div>
                </div>
                <div class="btn flexJA flexSb">
                    <div class="btn1 flexJA">充值</div>
                    <div class="btn1 flexJA activate">提现</div>
                </div>
                <div class="asset" style="display: none;">
                    <div class="bar flexJA flexFs">
                        <div class="icon">
                            <div style="background-image: url(/static/index/image/28.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                        </div>
                        <div class="text">我的资产</div>
                    </div>
                    <div class="num"><?php echo htmlentities($user_info['balance']); ?> USDT</div>
                </div>
                <div class="sum">
                    <div class="extract" style="display: none;">
                        <div class="title">请输入提现数量</div>
                        <div class="text">提现需收取手续费：<?php echo htmlentities($config['withdrawal_fee']); ?> USDT</div>
                        <div class="text">单笔最小提现金额：<?php echo htmlentities($config['mini_withdrawal_amount']); ?> USDT</div>
                    </div>
                    <div class="tips">请输入充值金额</div>
                    <div class="bar flexJA flexSb">
                        <div class="symbol">$</div>
                        <uni-input class="input">
                            <div class="uni-input-wrapper">
                                <input enterkeyhint="done" pattern="[0-9]*" type="number" class="uni-input-input" placeholder="100.00" id="amount" oninput="e_pay_amount();">
                            </div>
                        </uni-input>
                        <div class="text">USDT</div>
                        <div class="icon">
                            <div style="background-image: url(/static/index/image/31.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="address">
                    <div class="bar flexJA flexSb" style="padding: 0px 0 16px; border-bottom: 1px solid #f4f4f4;">
                        <div class="title">选择支付类型</div>
                        <a class="go flexJA flexFs" style="width: 50%;">
                            <div class="change" style="width: 100%;">
                                <div class="flexJA flexFs">
                                    <uni-radio style="transform: scale(0.6);" onclick="pay_type(1)">
                                        <div class="uni-radio-wrapper">
                                            <div class="uni-radio-input u_pay uni-radio-input-checked"></div>
                                        </div>
                                    </uni-radio>
                                    <div class="default" onclick="pay_type(1)">U支付</div>
                                    <uni-radio style="transform: scale(0.6);" onclick="pay_type(2)">
                                        <div class="uni-radio-wrapper">
                                            <div class="uni-radio-input e_pay"></div>
                                        </div>
                                    </uni-radio>
                                    <div class="default" onclick="pay_type(2)">人民币</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="bar flexJA flexSb u_pay_info">
                        <div class="title">我的钱包地址</div>
                        <a class="go flexJA flexFs" href="/wallet_address">
                            <div class="change">更改</div>
                            <div class="icon">
                                <div style="background-image: url(/static/index/image/29.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                            </div>
                        </a>
                    </div>
                    <div class="text u_pay_info"><?php echo htmlentities((isset($user_info['trc20']) && ($user_info['trc20'] !== '')?$user_info['trc20']:'未设置')); ?></div>
                    
                    <div class="bar flexJA flexSb e_pay_info" style="display: none; ">
                        <div class="title">人民币换算金额</div>
                        <a class="go flexJA flexFs e_pay_amount">0 元</a>
                    </div>
                    
                    
                    <div class="bar flexJA flexSb e_pay_info" style="display: none;">
                        <div class="title">选择支付方式</div>
                        <a class="go flexJA flexFs" style="width: 50%;">
                            <div class="change" style="width: 100%;">
                                <div class="flexJA flexFs">
                                    <uni-radio style="transform: scale(0.6);" onclick="epay_type(1)">
                                        <div class="uni-radio-wrapper">
                                            <div class="uni-radio-input ali_epay_type uni-radio-input-checked"></div>
                                        </div>
                                    </uni-radio>
                                    <div class="default" onclick="epay_type(1)">支付宝</div>
                                    <uni-radio style="transform: scale(0.6);" onclick="epay_type(2)">
                                        <div class="uni-radio-wrapper">
                                            <div class="uni-radio-input wx_epay_type"></div>
                                        </div>
                                    </uni-radio>
                                    <div class="default" onclick="epay_type(2)">微信</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    
                </div>
                <div class="submit">
                    <div class="button flexJA" onclick="submit_recharge()">确认</div>
                </div>
                <div class="list recharge_list">
                    <div class="title">● 充值明细</div>
                    <?php foreach($recharge_list as $key=>$vo): ?>
                    <div class="item" onclick="window.location.href='/recharge/<?php echo htmlentities($vo['order_number']); ?>'">
                        <div class="bar flexJA flexSb">
                            <?php if($vo['status'] == 0): ?><div class="text">充值待提交</div><?php endif; if($vo['status'] == 1): ?><div class="text">充值待确认</div><?php endif; if($vo['status'] == 2): ?><div class="text">充值已取消</div><?php endif; if($vo['status'] == 3): ?><div class="text">充值成功已到账</div><?php endif; ?>
                            <div class="num"><?php echo htmlentities($vo['amount']); ?></div>
                            <div class="unit">USDT</div>
                        </div>
                        <div class="bar flexJA flexSb">
                            <div class="date"><?php echo htmlentities($vo['create_time']); ?></div>
                            <?php if($vo['status'] == 0): ?><div class="state">需汇款提交</div><?php endif; if($vo['status'] == 1): ?><div class="state">等待核实确认</div><?php endif; if($vo['status'] == 2): ?><div class="state red">订单取消</div><?php endif; if($vo['status'] == 3): ?><div class="state">充值成功</div><?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="list withdrawal_list" style="display: none;">
                    <div class="title">● 提现明细</div>
                    <?php foreach($withdrawal_list as $key=>$vo): ?>
                    <div class="item">
                        <div class="bar flexJA flexSb">
                            <?php if($vo['status'] == 0): ?><div class="text">提现处理中</div><?php endif; if($vo['status'] == 1): ?><div class="text">提现成功</div><?php endif; if($vo['status'] == 2): ?><div class="text">提现失败</div><?php endif; ?>
                            <div class="num"><?php echo htmlentities($vo['amount']); ?></div>
                            <div class="unit">USDT</div>
                        </div>
                        <div class="bar flexJA flexSb">
                            <div class="date"><?php echo htmlentities($vo['create_time']); ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div data-v-0af76499="" class="uni-load-more more">
                    <uni-text data-v-0af76499="" class="uni-load-more__text" style="color: rgb(119, 119, 119);">
                        <span>没有更多数据了</span>
                    </uni-text>
                </div>
            </div>
        </div>
        
        <input type="hidden" id="pay_type" value="1">
        <input type="hidden" id="epay_type" value="1">
        <script src="/static/index/js/jquery.min.js"></script>
        <script>
            function pay_type(type) {
                $('#pay_type').val(type);
                if(type == 1){
                    $(".u_pay").addClass('uni-radio-input-checked');
                    $(".e_pay").removeClass('uni-radio-input-checked');
                    $('.u_pay_info').attr('style', '');
                    $('.e_pay_info').attr('style', 'display: none;');
                    
                }else{
                    $(".u_pay").removeClass('uni-radio-input-checked');
                    $(".e_pay").addClass('uni-radio-input-checked');
                    $('.u_pay_info').attr('style', 'display: none;');
                    $('.e_pay_info').attr('style', '');
                }
            }
        
            function epay_type(type) {
                $('#epay_type').val(type);
                if(type == 1){
                    $(".wx_epay_type").removeClass('uni-radio-input-checked');
                    $(".ali_epay_type").addClass('uni-radio-input-checked');
                }else{
                    $(".wx_epay_type").addClass('uni-radio-input-checked');
                    $(".ali_epay_type").removeClass('uni-radio-input-checked');
                }
            }
        
            function e_pay_amount() {
                var amount =  $('#amount').val();
                var result = amount * <?php echo htmlentities($config['rate']); ?>;
                var resultFixed = result.toFixed(2);
                $('.e_pay_amount').html(resultFixed + ' 元');
            }
        
            function submit_recharge() {
                if($('#pay_type').val() == 1){
                    $.ajax({
                        url: "/recharge_withdrawal_post/recharge",
                        method: 'POST',
                        data: {
                            amount: $('#amount').val(),
                            pay_type: $('#pay_type').val(),
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res.code === 200) {
                                window.location.href = res.data;
                            }else{
                                toast({time: 3000, msg: res.message});
                            }
                        }
                    });
                }else{
                    $.ajax({
                        url: "/recharge_withdrawal_post/recharge_epay",
                        method: 'POST',
                        data: {
                            amount: $('#amount').val(),
                            pay_type: $('#pay_type').val(),
                            epay_type: $('#epay_type').val(),
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res.code === 200) {
                                window.location.href = res.data;
                            }else{
                                toast({time: 3000, msg: res.message});
                            }
    
                        }
                    });
                }
            }
            function submit_withdrawal() {
                $.ajax({
                    url: "/recharge_withdrawal_post/withdrawal",
                    method: 'POST',
                    data: {
                        amount: $('#amount').val(),
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            window.location.href = res.data;
                        }else{
                            toast({time: 3000, msg: res.message});
                        }

                    }
                });
            }
            
            const btns = document.querySelectorAll('.btn1');
            btns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // 将所有按钮添加 'activate' 类
                    btns.forEach(b => b.classList.add('activate'));
                    // 移除当前点击按钮的 'activate' 类
                    this.classList.remove('activate');

                    if(this.textContent == '充值'){
                        $(".tips").show();
                        $(".recharge_list").show();
                        $(".asset").hide();
                        $(".extract").hide();
                        $(".withdrawal_list").hide();
                        $(".submit").html(`<div class="button flexJA" onclick="submit_recharge()">确认</div>`);
                    }
                    if(this.textContent == '提现'){
                        $(".tips").hide();
                        $(".recharge_list").hide();
                        $(".asset").show();
                        $(".extract").show();
                        $(".withdrawal_list").show();
                        
                        $(".submit").html(`<div class="button flexJA" onclick="submit_withdrawal()">确认</div>`);
                    }
                });
            });
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
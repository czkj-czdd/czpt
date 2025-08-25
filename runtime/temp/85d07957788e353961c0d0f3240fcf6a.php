<?php /*a:2:{s:45:"/www/wwwroot/122.51.23.115/view/index/my.html";i:1737118735;s:56:"/www/wwwroot/122.51.23.115/view/layout/index_footer.html";i:1736872451;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + 0px); --window-bottom: calc(50px + env(safe-area-inset-bottom));">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo htmlentities((isset($config['name']) && ($config['name'] !== '')?$config['name']:'')); ?></title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/my.css">

	</head>
	<body class="uni-body pages-user-index">
        <div class="container">
            <div class="above">
                <div class="user flexJA flexSb">
                    <div class="flexJA flexFs">
                        <uni-image class="photo">
                            <div style="background-image: url('<?php echo htmlentities((isset($user_info['avatar']) && ($user_info['avatar'] !== '')?$user_info['avatar']:"/static/index/image/user_avatar.jpg")); ?>'); background-position: center center; background-size: cover; background-repeat: no-repeat;"></div>
                        </uni-image>
                        <div class="name banLine">
                            <?php if(!empty($user_info)): ?>
                                <?php echo htmlentities((isset($user_info['nickname']) && ($user_info['nickname'] !== '')?$user_info['nickname']:'未设置')); else: ?>
                            未登录
                            <?php endif; ?>
                        </div>
                    </div>
                    <a class="btn flexJA" href="/account_settings">
                        <div class="icon">
                            <div style="background-image: url('/static/index/image/account_settings.png'); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                        </div>
                        <div class="text">账户设置</div>
                    </a>
                </div>
            </div>
            <div class="archives flexJA flexSb">
                <div class="list">
                    <div class="title">缴费订单</div>
                    <div class="flexJA flexSb">
                        <div class="num"><?php echo htmlentities((isset($order_cz_count) && ($order_cz_count !== '')?$order_cz_count:'0')); ?></div>
                        <a class="btn flexJA" href="/order">查看</a>
                    </div>
                </div>
                <div class="list">
                    <div class="title">查询订单</div>
                    <div class="flexJA flexSb">
                        <div class="num"><?php echo htmlentities((isset($order_cx_count) && ($order_cx_count !== '')?$order_cx_count:'0')); ?></div>
                        <a class="btn flexJA" href="/order_cx">查看</a>
                    </div>
                </div>
            </div>
            <div class="property">
                <div class="card">
                    <div class="bar flexJA flexSb">
                        <uni-image class="icon">
                            <div style="background-image: url(/static/index/image/68.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                        </uni-image>
                        <div class="text">资产信息</div>
                        <a class="btn1 flexJA" href="/wallet_details">账单明细</a>
                        <a class="btn2 flexJA" href="/recharge_withdrawal">充值提现</a>
                    </div>
                </div>
                <div class="quadrilateral"></div>
                <div class="balance flexJA flexSb">
                    <a class="item" style="text-decoration: none;" href="/wallet_details">
                        <div class="num flexJA flexFs" >
                            <div class="text1">$</div>
                            <div class="text2"><?php echo htmlentities($user_info['balance']); ?></div>
                        </div>
                        <div class="text">可用余额</div>
                    </a>
                    <a class="item" style="text-decoration: none;" href="/wallet_details_data?type=1&title=冻结金额">
                        <div class="num flexJA flexFs">
                            <div class="text1">$</div>
                            <div class="text2"><?php echo htmlentities($freeze_amount); ?></div>
                        </div>
                        <div class="text flexJA flexFe">冻结中</div>
                    </a>
                </div>
            </div>
            <a class="deal flexJA flexSb" href="/transaction_index">
                <div class="left">
                    <div class="title">USDT</div>
                    <div class="text">在线数字货币交易平台</div>
                </div>
                <div class="right flexJA">查看</div>
            </a>
            <div class="menu flexJA flexFs flexWw">
                <a class="item flexJA flexDc" href="/invite_friends">
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/14.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image>
                    <div class="text">推广海报</div>
                </a>
                <a class="item flexJA flexDc" href="/wallet_address">
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/11.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image>
                    <div class="text">钱包地址</div>
                </a>
                <a class="item flexJA flexDc" href="/agency_center">
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/119.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image>
                    <div class="text">代理中心</div>
                </a>
                <a class="item flexJA flexDc" href="/bank_card">
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/67.jpg); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image>
                    <div class="text">支付管理</div>
                </a>
                <a class="item flexJA flexDc" href="/chat_message">
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/15.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image>
                    <div class="text">在线客服</div>
                    <div class="uni-badge--x badge"></div>
                </a>
                <a class="item flexJA flexDc" href="/transaction_my_sale">
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/65.jpg); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image>
                    <div class="text">出售管理</div>
                    <div class="uni-badge--x badge"></div>
                </a>
                <a class="item flexJA flexDc" href="/transaction_order">
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/66.jpg); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image>
                    <div class="text">交易订单</div>
                    <?php if(!empty($TransactionOrder_count)): ?>
                    <div class="uni-badge--x badge">
                        <div class="uni-badge  uni-badge--error uni-badge--small ">
                            <span><?php echo htmlentities($TransactionOrder_count); ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                </a>
                <a class="item flexJA flexDc" href="/APP下载">
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/12.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image>
                    <div class="text">APP下载</div>
                </a>
            </div>
             </div>
         <footer class="footer-bottom">
      <div class="footer" style="background-color: rgb(255, 255, 255); backdrop-filter: none;">
        <div class="footer-border" style="background-color: rgba(0, 0, 0, 0.33);"></div>
        <div class="footer__item">
            <div class="footer__bd" style="height: 50px;">
                <a href="/index" style="display: block; width: 100%; height: 100%; text-decoration: none; color: inherit;">
                    <div class="footer__icon" style="width: 24px; height: 24px;">
                        <img src="/static/index/image/2.png">
                    </div>
                    <div class="footer__label" style="color: rgb(153, 153, 153); font-size: 10px; line-height: normal; margin-top: -5px;">
                        首页
                    </div>
                </a>
            </div>
        </div>
        <div class="footer__item">
                    <a class="footer__bd" style="height: 50px;" href="/order_cz">
                        <div class="footer__icon" style="width: 24px; height: 24px;">
                            <img src="/static/index/image/9.png">
                        </div>
                        <div class="footer__label" style="color: rgb(153, 153, 153); font-size: 10px; line-height: normal; margin-top: 3px;">
                            在线订单
                        </div>
                    </a>
                </div>
                <div class="footer__item">
                    <a class="footer__bd" style="height: 50px;" href="/out_order">
                        <div class="footer__icon" style="width: 24px; height: 24px;">
                            <img src="/static/index/image/outOrder0.png">
                        </div>
                        <div class="footer__label" style="color: rgb(153, 153, 153); font-size: 10px; line-height: normal; margin-top: 3px;">
                            审核池
                        </div>
                    </a>
                </div>
                <div class="footer__item">
                    <a class="footer__bd" style="height: 50px;" href="/order">
                        <div class="footer__icon" style="width: 24px; height: 24px;">
                            <img src="/static/index/image/5.png">
                        </div>
                        <div class="footer__label" style="color: rgb(153, 153, 153); font-size: 10px; line-height: normal; margin-top: 3px;">
                            生活缴费
                        </div>
                    </a>
                </div>
                <div class="footer__item">
                    <a class="footer__bd" style="height: 50px;" href="/my">
                        <div class="footer__icon" style="width: 24px; height: 24px;">
                            <img src="/static/index/image/7.png">
                        </div>
                        <div class="footer__label" style="color: rgb(56, 117, 244); font-size: 10px; line-height: normal; margin-top: 3px;">
                            我的
                        </div>
                </div>
            </a>
        </div>
    </div>
</footer>
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
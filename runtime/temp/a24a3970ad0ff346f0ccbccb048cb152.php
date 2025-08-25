<?php /*a:2:{s:52:"/www/wwwroot/lxth.lat/view/index/wallet_details.html";i:1736917110;s:51:"/www/wwwroot/lxth.lat/view/layout/index_footer.html";i:1736872451;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + 0px); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>账单明细</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="/static/index/css/wallet_details.css">

        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-user-walletDetails1">
        <div class="container">
            <div class="bg">
                <div style="background-image: url(/static/index/image/my_bg.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
            </div>
            <div class="fixation">
                <div class="tab flexJA flexSb">
                    <div class="icon" onclick="window.history.back()">
                        <div style="background-image: url(/static/index/image/33.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="title white">钱包明细</div>
                    <div class="icon"></div>
                </div>
                <div class="info">
                    <div class="uni-date" style="margin: 9px auto;">
                        <div class="uni-date-editor" onclick="dateMulti()">
                            <div class="uni-date-editor--x uni-date-x--border">
                                <div class="uni-date-x uni-date-range">
                                    <uni-text class="uni-icons icon-calendar uniui-calendar" style="color: rgb(192, 196, 204); font-size: 22px;">
                                        <svg t="1728306059912" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6216" width="18" height="18"><path d="M175.36 960C125.696 960 64 894.016 64 840.64V320h896v513.024c1.152 54.592-65.152 126.976-116.16 126.976H175.424zM768 0v128h-128l-0.256-128H384v128H256V0H169.92C75.904 0 0 90.496 0 202.24v619.52C0 933.568 75.904 1024 169.92 1024h684.096C948.096 1024 1024 933.632 1024 821.76V202.24C1024 91.904 948.032 0 854.016 0H768zM192 832h128v-128H192v128z m0-256h128V448H192v128z m256 0h128V448H448v128z m256 0h128V448h-128v128z m0 256h128v-128h-128v128z m-256 0h128v-128H448v128z" fill="#b8c6df" p-id="6217"></path></svg>
                                        
                                    </uni-text>
                                    <div class="uni-date__x-input text-center start_time"><?php echo date("Y-m-01"); ?></div>
                                    <div class="range-separator">-</div>
                                    <div class="uni-date__x-input text-center end_time"><?php echo date("Y-m-d"); ?></div>
                                </div>
                            </div>
                            <input type="hidden" id="start_time" value="<?php echo date("Y-m-01"); ?>">
                            <input type="hidden" id="end_time" value="<?php echo date("Y-m-d", strtotime(date("Y-m-d") . " +1 day")); ?>">
                        </div>
                        <div class="uni-date-mask--pc" style="display: none;"></div>
                        <div class="uni-calendar"></div>
                    </div>
                    <div class="title">我的资产(USDT)</div>
                    <div class="num"><?php echo htmlentities($user_info['balance']); ?></div>
                </div>
                
                <div class="card">
                    <div class="title">总计收入 <span class="total_income"></span></div>
                    <div class="list flexJA flexSb flexWw">
                        <a class="item" style="text-decoration: none;" href="/wallet_details_data?type=5&title=充值U币">
                            <div class="text">充值U币</div>
                            <div class="bar flexJA flexSb">
                                <div class="num recharge_amount">0.00</div>
                                <div class="btn">查看</div>
                            </div>
                        </a>
                        <a class="item" style="text-decoration: none;" href="/wallet_details_data?type=7&title=交易买入">
                            <div class="text">交易买入</div>
                            <div class="bar flexJA flexSb">
                                <div class="num transaction_order_u_amount">0.00</div>
                                <div class="btn">查看</div>
                            </div>
                        </a>
                        <a class="item" style="text-decoration: none;" href="/wallet_details_data?type=6&title=代理分润">
                            <div class="text">代理分润</div>
                            <div class="bar flexJA flexSb">
                                <div class="num rebate_record_amount"></div>
                                <div class="btn">查看</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="card">
                    <div class="title red">总计支出 <span class="total_expenditure"></span></div>
                    <div class="list flexJA flexSb flexWw">
                        <a class="item" style="text-decoration: none;" href="/wallet_details_data?type=4&title=提现U币">
                            <div class="text">提现U币</div>
                            <div class="bar red flexJA flexSb">
                                <div class="num withdrawal_amount">0.00</div>
                                <div class="btn">查看</div>
                            </div>
                        </a>
                        <a class="item" style="text-decoration: none;" href="/wallet_details_data?type=8&title=交易卖出">
                            <div class="text">交易卖出</div>
                            <div class="bar red flexJA flexSb">
                                <div class="num transaction_order_t_amount">0.00</div>
                                <div class="btn">查看</div>
                            </div>
                        </a>
                        <a class="item" style="text-decoration: none;" href="/wallet_details_data?type=3&title=查询业务">
                            <div class="text">查询业务</div>
                            <div class="bar red flexJA flexSb">
                                <div class="num query_business">0.00</div>
                                <div class="btn">查看</div>
                            </div>
                        </a>
                        <?php foreach($product_cz_list as $key=>$vo): ?>
                        <a class="item" style="text-decoration: none;" href="/wallet_details_data?type=product_<?php echo htmlentities($vo['id']); ?>&title=<?php echo htmlentities($vo['name']); ?>">
                            <div class="text"><?php echo htmlentities($vo['name']); ?></div>
                            <div class="bar red flexJA flexSb">
                                <div class="num product_<?php echo htmlentities($vo['id']); ?>">0.00</div>
                                <div class="btn">查看</div>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="card">
                    <div class="title orange">其它</div>
                    <div class="list flexJA flexSb flexWw">
                        <a class="item" style="text-decoration: none;" href="/wallet_details_data?type=1&title=冻结金额">
                            <div class="text">冻结金额</div>
                            <div class="bar orange flexJA flexSb">
                                <div class="num freeze_amount">0.00</div>
                                <div class="btn">查看</div>
                            </div>
                        </a>
                        <a class="item" style="text-decoration: none;" href="/wallet_details_data?type=2&title=订单退款">
                            <div class="text">订单退款</div>
                            <div class="bar orange flexJA flexSb">
                                <div class="num refund_amount">0.00</div>
                                <div class="btn">查看</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script src="/static/index/js/jquery.min.js"></script>
        <script type="text/javascript" src="/static/index/js/dateMultiFunc.js"></script>
        <script>
            wallet_details();
            function wallet_details() {
                $.ajax({
                    url: "/wallet_details_post/wallet_details",
                    method: 'POST',
                    data: {
                        start_time: $('#start_time').val(),
                        end_time: $('#end_time').val(),
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            $(".recharge_amount").html(`${res.data.recharge_amount}`);
                            $(".query_business").html(`${res.data.query_business}`);
                            $(".withdrawal_amount").html(`${res.data.withdrawal_amount}`);
                            $(".freeze_amount").html(`${res.data.freeze_amount}`);
                            $(".refund_amount").html(`${res.data.refund_amount}`);
                            $(".rebate_record_amount").html(`${res.data.rebate_record_amount}`);
                            
                            $(".transaction_order_u_amount").html(`${res.data.transaction_order_u_amount}`);
                            $(".transaction_order_t_amount").html(`${res.data.transaction_order_t_amount}`);
                            
                            <?php foreach($product_cz_list as $key=>$vo): ?>
                            $(".product_<?php echo htmlentities($vo['id']); ?>").html(res.data.product_<?php echo htmlentities($vo['id']); ?>);
                            <?php endforeach; ?>

                            $(".total_income").html(`${res.data.total_income}`);
                            $(".total_expenditure").html(`${res.data.total_expenditure}`);
                        }else{
                            toast({time: 3000, msg: res.message});
                        }
                    }
                });
            }


            function dateMulti() {
                var dateMulti = new dateMultiFunc({
                    type: 2,
                    maxTime: 0,
                    cancelFunc: function () {
                        console.log("取消")
                    },
                    confirmFunc: function (res) {
                        listCon(res)
                    }
                });
                dateMulti.show();
            };
            function listCon(res) {
                var start_time = `${res.statrTime.year}-${res.statrTime.month}-${checkIfOneDigit(res.statrTime.today)}`;
                var end_time = `${res.endTime.year}-${res.endTime.month}-${checkIfOneDigit(res.endTime.today)}`;
                $(".start_time").html(start_time);
                $(".end_time").html(end_time);

                var start_time = `${res.statrTime.year}-${res.statrTime.month}-${checkIfOneDigit(res.statrTime.today)}`;
                var end_time = `${res.endTime.year}-${res.endTime.month}-${checkIfOneDigit(res.endTime.today+1)}`;
                $("#start_time").val(start_time);
                $("#end_time").val(end_time);


                wallet_details();
            };
            function checkIfOneDigit(num) {
                if (num >= 0 && num < 10) {
                    return "0" + num;
                } else {
                    return num;
                }
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
<?php /*a:2:{s:61:"/www/wwwroot/115.159.39.230/view/index/transaction_order.html";i:1736872451;s:57:"/www/wwwroot/115.159.39.230/view/layout/index_footer.html";i:1736872451;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>交易订单</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="/static/index/css/transaction_order.css">

	</head>
	<body class="uni-body pages-transaction-tradingOrder">
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
                        交易订单
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <div class="container">
            <div class="tab flexJA flexSb">
                <div class="item flexJA check" data-value="null">全部</div>
                <div class="item flexJA" data-value="0">待汇款</div>
                <div class="item flexJA" data-value="1">待验收</div>
                <div class="item flexJA" data-value="2">已取消</div>
                <div class="item flexJA" data-value="3">已完成</div>
            </div>
            <div class="list" id="transaction_order_list"></div>
            <a class="bottom flexJA" href="/transaction_my_sale">
                <div class="button flexJA">出售管理</div>
            </a>
        </div>
        <input type="hidden" id="status">
        <script src="/static/index/js/jquery.min.js"></script>
		<script src="/static/index/js/layui/layui.js"></script>
        <script>
             document.addEventListener("DOMContentLoaded", function() {
                const items = document.querySelectorAll('.item');
                setTimeout(function() {
                    if(items.length > 0){
                        items[0].click();
                    }
                }, 300);
                items.forEach(item => {
                    item.addEventListener('click', function() {
                        items.forEach(i => i.classList.remove('check'));
                        this.classList.add('check');
                        const status = this.getAttribute('data-value');
                        $("#status").val(status);
                        order_list();
                    });
                });
            });
            
            function order_list() {
                $.post("/transaction_order_list",{
                    status: $('#status').val(),
                },function(res){
                    let list = res.data.list,html =  "";
                    if (list.length > 0) {
                        $.each(list, function (index, item) {
                            if(item.status == 0){
                                var status = `订单待汇款`;
                            }else if(item.status == 1){
                                var status = `已汇款，等待卖家确认验收`;
                            }else if(item.status == 2){
                                var status = `订单已取消`;
                            }else if(item.status == 3){
                                var status = `订单已完成`;
                            }

                            
                            html += `
                            <div class="item" onclick="window.location.href='/transaction_trading_details/${item.order_number}'">
                                <div class="num">订单号：${item.order_number}</div>
                                <div class="bar flexJA flexSb">
                                    <div class="flexJA flexFs">
                                        <div class="text1">${item.payment_amount}</div>
                                        <div class="text2">CNY</div>
                                    </div>
                                    <div class="flexJA flexFs">
                                        <div class="text1">${item.pay_amount}</div>
                                        <div class="text2">USDT</div>
                                    </div>
                                </div>
                                <div class="tag flexJA flexSb">
                                    <div class="icon">
                                        <div style="background-image: url(/static/index/image/01.jpeg); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;"></div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="text">${item.unit_price}CNY ≈ 1USDT</div>
                                    <div class="line"></div>
                                    <div class="usdt">
                                        <div style="background-image: url(/static/index/image/49.png); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="state flexJA">${status}</div>
                                </div>
                            </div>`;
                        })
                    }else{
                        html += `
                        <div class="uni-load-more">
                            <uni-text class="uni-load-more__text" style="color: rgb(119, 119, 119);">
                                <span>没有更多数据了</span>
                            </uni-text>
                        </div>`;
                    }
                    $("#transaction_order_list").html(html);
                },'json')
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
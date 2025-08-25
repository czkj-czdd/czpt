<?php /*a:2:{s:65:"/www/wwwroot/45.207.213.41/5555/view/index/transaction_index.html";i:1728755201;s:61:"/www/wwwroot/45.207.213.41/5555/view/layout/index_footer.html";i:1728755148;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>在线交易</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="/static/index/css/transaction_index.css">

	</head>
	<body class="uni-body pages-transaction-index">
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
                        在线交易
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <div class="container">
            <div class="head">
                <div class="button flexJA flexSa">
                    <a class="text" href="/transaction_my_sale">
                        <span>我的出售</span>
                        <uni-text class="text1">
                            <span class="TransactionProduct_count">(0)</span>
                        </uni-text>
                    </a>
                    <a class="text" href="/transaction_order">
                        <span>交易订单</span>
                        <uni-text class="text1">
                            <span class="TransactionOrder_count">(0)</span>
                        </uni-text>
                    </a>
                </div>
                <div class="bar flexJA flexSb">
                    <div class="icon">
                        <div style="background-image: url(/static/index/image/49.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="text">USDT</div>
                    <div class="tips">在线数字货币交易平台</div>
                </div>
            </div>
            <div class="tab flexJA flexFs" style="top: 44px;">
                <div class="title">数量/限额</div>
                <div class="item flexJA flexFs">
                    <div class="icon">
                        <div style="background-image: url(/static/index/image/51.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="text">CNY</div>
                </div>
                <div class="item flexJA flexFs" onclick="toggleValue()">
                    <div class="text">价格</div>
                    <div class="sort flexJA flexDc upper_lower">
                        <div class="arrows">
                            <div style="background-image: url(/static/index/image/upper_a.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                        </div>
                        <div class="arrows">
                            <div style="background-image: url(/static/index/image/lower_a.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="text" id="my" onclick="toggleActivate()">我的</div>
            </div>
            <div class="list" id="transaction_index_list"></div>
        </div>
        <input type="hidden" id="upper_lower" value="0">
        <input type="hidden" id="user_status" value="0">
        <script src="/static/index/js/jquery.min.js"></script>
		<script src="/static/index/js/layui/layui.js"></script>
        <script>
            let clickCount = 0;
            function toggleValue() {
                if (clickCount === 0) {
                    $("#upper_lower").val(1);
                    $(".upper_lower").html(`
                    <div class="arrows">
                        <div style="background-image: url(/static/index/image/upper_b.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="arrows">
                        <div style="background-image: url(/static/index/image/lower_b.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                    </div>`);
                    clickCount = 1;
                } else {
                    $("#upper_lower").val(0);
                    $(".upper_lower").html(`
                    <div class="arrows">
                        <div style="background-image: url(/static/index/image/upper_a.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="arrows">
                        <div style="background-image: url(/static/index/image/lower_a.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                    </div>`);
                    clickCount = 0;
                }
                order_list();
            }

            function toggleActivate() {
                var element = document.getElementById('my');
                element.classList.toggle('activate');
                if (element.classList.contains('activate')) {
                    $("#user_status").val(1);
                } else {
                    $("#user_status").val(0);
                }
                order_list();
            }

            window.onload = function() {
                order_list();
            }

            function order_list() {
                $.post("/transaction_index_list",{
                    upper_lower: $('#upper_lower').val(),
                    user_status: $('#user_status').val(),
                },function(res){
                    let list = res.data.list,html =  "";
                    $(".TransactionProduct_count").html(`(${res.TransactionProduct_count})`);
                    $(".TransactionOrder_count").html(`(${res.TransactionOrder_count})`);
                    if (list.length > 0) {
                        $.each(list, function (index, item) {
                            html += `
                            <div class="item">
                                <div class="above flexJA flexSb">
                                    <div class="icon">
                                        <div style="background-image: url(${item.user_info.avatar||'/static/index/image/user_avatar.jpg'}); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;border-radius: 50%;"></div>
                                    </div>
                                    <div class="name">${item.user_info.nickname||'未命名'}</div>
                                </div>
                                <div class="middle flexJA flexSb">
                                    <div class="nape">
                                        <div class="num">${item.sell_account}</div>
                                        <div class="text">出售数量</div>
                                    </div>
                                    <div class="nape">
                                        <div class="num">${item.min_limit}-${item.max_limit}</div>
                                        <div class="text">额度限制</div>
                                    </div>
                                    <div class="nape">
                                        <div class="num tr">${item.unit_price}</div>
                                        <div class="text">单价CNY</div>
                                    </div>
                                </div>
                                <div class="below flexJA flexSb">
                                    <div class="left">
                                        <div class="text mb16">成功交易: ${item.TransactionOrder_count}单</div>
                                        <div class="text">交易数量: ${item.pay_amount_s}</div>
                                    </div>
                                    <a class="button flexJA" href="/transaction_buy?id=${item.id}">购买</a>
                                </div>
                            </div>`;
                        })
                    }else{
                        html += `
                        <div class="uni-load-more">
                            <svg width="24" height="24" viewBox="25 25 50 50" class="uni-load-more__img uni-load-more__img--android-H5" style="width: 24px; height: 24px;">
                                <circle cx="50" cy="50" r="20" fill="none" stroke-width="3" style="color: rgb(119, 119, 119);"></circle>
                            </svg>
                            <uni-text class="uni-load-more__text" style="color: rgb(119, 119, 119);">
                                <span>没有更多数据了</span>
                            </uni-text>
                        </div>`;
                    }
                    $("#transaction_index_list").html(html);
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
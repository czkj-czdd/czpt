<?php /*a:2:{s:46:"/www/wwwroot/lxth.lat/view/index/order_cx.html";i:1736917303;s:51:"/www/wwwroot/lxth.lat/view/layout/index_footer.html";i:1736872451;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>查询订单</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/order_cx.css">
	</head>
	<body class="uni-body pages-archives-orderList" style="overflow: visible;">
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
                        查询订单
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <div class="container">
            <div class="tab">
                <div class="search flexJA flexSb">
                    <div class="left flexJA flexFs">
                        <div class="icon">
                            <div style="background-image: url(/static/index/image/74.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                        </div>
                        <uni-input class="text">
                            <div class="uni-input-wrapper">
                                <input maxlength="140" type="text" class="uni-input-input" id="content" placeholder="请输入卡号/订单号搜索">
                            </div>
                        </uni-input>
                    </div>
                    <div class="btn flexJA" onclick="order_list()">搜索</div>
                </div>
                <div class="menu flexJA flexSb">
                    <div class="item flexJA check" data-value="4">全部 </div>
                    <div class="item flexJA" data-value="1">进行中 </div>
                    <div class="item flexJA" data-value="2">已完成 </div>
                    <div class="item flexJA" data-value="3">已取消 </div>
                </div>
            </div>
            <div class="list" id="order_list"></div>
        </div>
        <div class="wrap">
            <div class="layer-bottom">
                <div class="uni-popup__wrapper bottom" style="background-color: transparent;">
                    <div class="popup">
                        <div class="box" id="order_info">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="status">
        <script src="/static/index/js/jquery.min.js"></script>
        <script src="/static/index/js/mSlider.min.js"></script>
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
                $.post("/order_cx_list",{
                    status: $('#status').val(),
                    content: $('#content').val(),
                },function(res){
                    let list = res.data.list,html =  "";
                    if (list.length > 0) {
                        $.each(list, function (index, item) {
                            var operate = ``;
                            if(item.status == 0){
                                var status = `<div class="btn1 flexJA primary">待查询</div>`;
                            }else if(item.status == 1){
                                var status = `<div class="btn1 flexJA warning">进行中</div>`;
                            }else if(item.status == 2){
                                var status = `<div class="btn1 flexJA success">已完成</div>`;
                                var operate = `<div class="btn2 flexJA" onclick="results('${item.results}')">查看结果</div>`;
                            }else if(item.status == 3){
                                var status = `<div class="btn1 flexJA danger">已取消</div>`;
                            }
                            html += `
                            <div class="property">
                                <div class="card">
                                    <div class="bar flexJA flexSb">
                                        <uni-image class="icon">
                                            <div style="background-image: url(/static/index/image/117.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                                        </uni-image>
                                        <div class="text">${item.product_info.name}</div>
                                        ${status}
                                    </div>
                                </div>
                                <div class="quadrilateral"></div>
                                <div class="balance flexJA flexSb">
                                    <div class="item">
                                        <div class="num flexJA flexFs">
                                            <div class="text2">$${item.cny_amount} USDT</div>
                                        </div>
                                        <div class="text">支付金额</div>
                                    </div>
                                    <div class="item">
                                        <div class="text flexJA flexFe">
                                            ${operate}
                                            <div class="btn3 flexJA" onclick="info(${item.id})">查看详情</div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        })
                    }else{
                        html += `
                            <div class="uni-load-more more">
                                <uni-text class="uni-load-more__text" style="color: rgb(119, 119, 119);">
                                    <span>没有更多数据了</span>
                                </uni-text>
                            </div>`;
                    }
                    $("#order_list").html(html);
                },'json')
            }


            function info(id) {
                $.ajax({
                    url: "/order_post/info",
                    method: 'POST',
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            $('#order_info').html(`${res.data}`);
                            new mSlider({
                                dom: ".layer-bottom",
                                direction: "bottom"
                            }).open();
                        }else{
                            toast({time: 3000, msg: res.message});
                        }

                    }
                });
            }


            function results(results) {
                $('#order_info').html(`
                    <article class="upload-piclist upload-piclist_4">
                        <div class="upload-Picitem upload-Picitem_4">
                            <img src="${results}" alt="pic">
                        </div>
                    </article>`);
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
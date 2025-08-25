<?php /*a:1:{s:48:"/www/wwwroot/www.biand.xyz/view/index/order.html";i:1736822904;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: calc(50px + env(safe-area-inset-bottom));">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>订单列表</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="/static/index/css/order.css">

        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-order-index">
        <header header-type="default">
            <div class="header" style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);">
                <div class="header-hd">
                    <div class="header-btn" style="display: none;">
                        <i class="uni-btn-icon" style="color: rgb(0, 0, 0); font-size: 27px;"></i>
                    </div>
                    <div class="header-ft"></div>
                </div>
                <div class="header-bd">
                    <div class="header__title" style="font-size: 16px; opacity: 1;">
                        订单列表
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <div class="tab">
            <div class="bar flexJA">
                <div class="item flexJA active" data-value="0">全部</div>
                <div class="item flexJA" data-value="1">话费订单</div>
                <div class="item flexJA" data-value="2">油卡订单</div>
                <div class="item flexJA" data-value="3">国网电费</div>
            </div>
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
                <div class="item flexJA check" data-value="4">全部</div>
                <div class="item flexJA" data-value="0">待充值</div>
                <div class="item flexJA" data-value="1">充值中</div>
                <div class="item flexJA" data-value="2">已完成</div>
                <div class="item flexJA" data-value="3">已取消</div>
            </div>
        </div>
        <div class="list" id="order_list"></div>
       <footer class="footer-bottom">
    <div class="footer" style="background-color: rgb(255, 255, 255); backdrop-filter: none;">
        <div class="footer-border" style="background-color: rgba(0, 0, 0, 0.33);"></div>
        <div class="footer__item">
            <div class="footer__bd" style="height: 50px;">
                <a href="/index" style="display: block; width: 100%; height: 100%; text-decoration: none; color: inherit;">
                    <div class="footer__icon" style="width: 24px; height: 24px;">
                        <img src="/static/index/image/2.png">
                    </div>
                    <div class="footer__label" style="color: rgb(153, 153, 153); font-size: 10px; line-height: normal; margin-top: 1px;">
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
                        <div class="footer__label" style="color: rgb(56, 117, 244); font-size: 10px; line-height: normal; margin-top: 3px;">
                            生活缴费
                        </div>
                    </a>
                </div>
                <div class="footer__item">
                    <a class="footer__bd" style="height: 50px;" href="/my">
                        <div class="footer__icon" style="width: 24px; height: 24px;">
                            <img src="/static/index/image/7.png">
                        </div>
                        <div class="footer__label" style="color: rgb(153, 153, 153); font-size: 10px; line-height: normal; margin-top: 3px;">
                            我的
                        </div>
                </div>
            </a>
        </div>
    </div>
</footer>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="uni-popup__wrapper center" style="background-color: transparent;">
                    <div class="popup">
                        <div class="title flexJA">温馨提示</div>
                        <div class="bar flexJA">是否删除该订单？</div>
                        <input type="hidden" id="del_id">
                        <div class="bottom flexJA flexSb">
                            <div class="btn1 flexJA close">取消</div>
                            <div class="btn2 flexJA" onclick="del_yes()">确认</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="product_type">
        <input type="hidden" id="status">
        <script src="/static/index/js/jquery.min.js"></script>
		<script src="/static/index/js/layui/layui.js"></script>
        <script src="/static/index/js/mSlider.min.js"></script>
        <script>
            function order_list() {
                $.post("/order_list",{
                    status: $('#status').val(),
                    product_type: $('#product_type').val(),
                    content: $('#content').val(),
                },function(res){
                    let list = res.data.list,html =  "";
                    if (list.length > 0) {
                        $.each(list, function (index, item) {
                            if(item.status == 0){
                                var ys = 'success';
                                var status = `<div class="right flexJA success">待充值</div>`;
                            }else if(item.status == 1){
                                var ys = 'cancel';
                                var status = `<div class="right flexJA success">充值中</div>`;
                            }else if(item.status == 2){
                                var ys = 'cancel';
                                var status = `<div class="right flexJA success">已完成</div>`;
                            }else if(item.status == 3){
                                var ys = 'cancel';
                                var status = `<div class="right flexJA cancel">已取消</div>`;
                            }
                            html += `
                            <div class="item" >
                                <div class="above flexJA flexSb">
                                    <div class="sign flexJA ${ys}">单个充值</div>
                                    <div class="left">
                                        <div class="bar flexJA flexFs" onclick="copyToClipboard('${item.order_number}')">
                                            <div class="num">订单：${item.order_number}</div>
                                        </div>
                                        <div class="time">下单时间：${item.create_time}</div>
                                    </div>
                                    ${status}
                                </div>
                                <div class="centre flexJA flexSb flexAis">
                                    <uni-image class="icon">
                                        <div style="background-image: url(${item.product_info.image}); background-position: center center; background-size: cover; background-repeat: no-repeat;"></div>
                                    </uni-image>
                                    <div class="right">
                                        <div class="bar flexJA flexFs">
                                            <div class="type">${item.product_info.name}</div>
                                            <div class="discount">(折扣${item.discount||'0'} 优惠-${item.discount_amount}元)</div>
                                        </div>
                                        <div class="sum flexJA flexFs">
                                            <div>充值</div>
                                            <div class="unit">
                                                <span style="margin-right: 5px;">${item.amount_money}</span>
                                                <span>元</span>
                                            </div>
                                        </div>
                                        ${item.order_info}
                                    </div>
                                </div>
                                <div class="below flexJA flexSb">
                                    <div class="left">
                                        <div class="rate">汇率：${item.rate}</div>
                                        <div class="total">总计：$ ${item.cny_amount} USDT</div>
                                    </div>
                                    <div class="right flexJA">
                                        <div class="btn1 flexJA" onclick="del(${item.id})">删除订单</div>
                                        <a class="btn2 flexJA" href="/order_info?order_number=${item.order_number}">查看详情</a>
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

            
            function del_yes(id) {
                $.ajax({
                    url: "/order_post/order_del",
                    method: 'POST',
                    data: {
                        del_id: $('#del_id').val(),
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
            function del(id) {
                $("#del_id").val(id);
                document.getElementById('myModal').style.display = "block";
            }

            var modal = document.getElementById('myModal');
            var btn = document.getElementById("myBtn");
            var span = document.querySelector('.close');
            span.onclick = function() {
                modal.style.display = "none";
            }
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            function copyToClipboard(text) {
                var tempTextArea = document.createElement("textarea");
                tempTextArea.value = text;
                document.body.appendChild(tempTextArea);
                tempTextArea.select();
                document.execCommand("copy");
                document.body.removeChild(tempTextArea);
                toast({time: 3000, msg: '复制成功'});
            }

            document.addEventListener("DOMContentLoaded", function() {
                const items = document.querySelectorAll('.bar .item');
                setTimeout(function() {
                    if(items.length > 0){
                        items[0].click();
                    }
                }, 300);
                items.forEach(item => {
                    item.addEventListener('click', function() {
                        items.forEach(i => i.classList.remove('active'));
                        this.classList.add('active');
                        const product_type = this.getAttribute('data-value');
                        $("#product_type").val(product_type);
                        order_list();
                    });
                });
            });


            document.addEventListener("DOMContentLoaded", function() {
                const items = document.querySelectorAll('.menu .item');
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

        </script>
	</body>
</html>
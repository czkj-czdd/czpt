<?php /*a:2:{s:47:"/www/wwwroot/lxth.xyz/view/index/out_order.html";i:1737015316;s:51:"/www/wwwroot/lxth.xyz/view/layout/index_footer.html";i:1736872451;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: calc(50px + env(safe-area-inset-bottom));">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>审核池</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
    <link rel="stylesheet" href="/static/index/css/out_order.css">
    <link rel="stylesheet" href="/static/index/css/base.css">
    <script src="/static/index/js/message.js"></script>
</head>
<body class="uni-body pages-order-outOrder">
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
                    审核池
                </div>
            </div>
            <div class="header-ft"></div>
        </div>
        <div class="uni-placeholder"></div>
    </header>
    <div class="container">
        <div class="tab">
            <div class="menu flexJA flexSa">
                <div class="item flexJA check" data-value="1">待确认</div>
                <div class="item flexJA" data-value="3">未收到</div>
            </div>
        </div>
        <div class="list" id="out_order_list"></div>
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
                    <div class="footer__label" style="color: rgb(56, 117, 244); font-size: 10px; line-height: normal; margin-top: 3px;">
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
                    <div class="footer__label" style="color: rgb(153, 153, 153); font-size: 10px; line-height: normal; margin-top: 3px;">
                        我的
                    </div>
                </a>
            </div>
        </div>
    </footer>
        <input type="hidden" id="confirm_status">
        <script src="/static/index/js/jquery.min.js"></script>
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
                        const confirm_status = this.getAttribute('data-value');
                        $("#confirm_status").val(confirm_status);
				
						out_order_list();
                    });
                });
            });


            function out_order_list() {
                $.post("/out_order_list",{
                    confirm_status: $('#confirm_status').val(),
                    // product_id: $('#product_id').val(),
                },function(res){
                    let list = res.data.list,html =  "";
                    if (list.length > 0) {
                        $.each(list, function (index, item) {
                            var operate = ``;
                            if(item.confirm_status == 1){
                                var confirm_status = `<div class="btn1 flexJA primary">待确认</div>`;
                                var operate = `
                                <div class="quadrilateral"></div>
                                <div class="balance flexJA flexSb">
                                    <div class="item" style="width: 100%;">
                                        <div class="text flexJA">
											<div class="btn2 flexJA" onclick="received(${item.id}, 1)">未收到</div>
											<div class="btn3 flexJA" onclick="received(${item.id}, 2)">已收到</div>
                                        </div>
                                    </div>
                                </div>`;
                            }else if(item.confirm_status == 3){
                                var confirm_status = `<div class="btn1 flexJA danger">已取消</div>`;
                            }
                            html += `
                            <div class="property">
                                <div class="card">
                                    <div class="bar flexJA flexSb">
                                        <uni-image class="icon">
                                            <div style="background-image: url(${item.product_info.image}); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                                        </uni-image>
                                        <div class="text">${item.product_info.name}</div>
                                        ${confirm_status}
                                    </div>
                                </div>
                                <div class="quadrilateral"></div>
                                <div class="balance flexJA flexSb">
                                    <div class="item margin">
                                        <div class="text flexJA flexFs">订单号</div>
                                    </div>
                                    <div class="item margin">
                                        <div class="num flexJA flexFe">
                                            <div class="text3">${item.order_number}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="quadrilateral_a"></div>
                                <div class="balance flexJA flexSb">
                                    <div class="item margin">
                                        <div class="text flexJA flexFs">充值金额</div>
                                    </div>
                                    <div class="item margin">
                                        <div class="num flexJA flexFe">
                                            <div class="text3">${item.amount_money}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="quadrilateral_a"></div>
                                <div class="balance flexJA flexSb">
                                    <div class="item margin">
                                        <div class="text flexJA flexFs">完成时间</div>
                                    </div>
                                    <div class="item margin">
                                        <div class="num flexJA flexFe">
                                            <div class="text3">${item.complete_time}</div>
                                        </div>
                                    </div>
                                </div>
								${operate}
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
                    $("#out_order_list").html(html);
                },'json')
            }

			function received(id, confirm_status) {
                $.ajax({
                    url: "/out_order_post/received",
                    method: 'POST',
                    data: {
                        id: id,
                        confirm_status: confirm_status,
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
							out_order_list();
                            toast({time: 3000, msg: res.message});
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
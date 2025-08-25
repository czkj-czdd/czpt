<?php /*a:2:{s:46:"/www/wwwroot/lxth.lat/view/index/order_cz.html";i:1739273461;s:51:"/www/wwwroot/lxth.lat/view/layout/index_footer.html";i:1736872451;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: calc(50px + env(safe-area-inset-bottom));">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>在线充值订单</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/order_cz.css">

        <link rel="stylesheet" href="/static/index/css/swiper.min.css">
        <link rel="stylesheet" type="text/css" href="/static/index/css/product.upload.css"/><!-- 图片上传 -->
        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-order-rechargeOrderLis">
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
                        在线充值订单
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <div class="tab">
            <div class="bar flexJA flexSb">
                <div class="left" id="app">
                    <div class="flexJA btn1">
                        <uni-text>
                            <span>全部类型</span>
                        </uni-text>
                        <uni-image>
                            <div style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAABvklEQVRIS63Vv0scQRQH8O/bLN5BQAL+BzamCFZpYiEkhY2NWlwhNgdysxtyh3fYmGqa2IhccRw37yy1CUuC0cYUR/6KpAkhkBAYf5JmT81ddmRhD7bQc3fP7Qb2fXi8mfkOIcFXr9ef5PP5pX6//6VcLv9MUAJK8pNSqkNErwBcENFsqVT6el9dUvgHEU1G2LkxZtZxnG/D8KTwCyI6AjAeYsaYMwAzjuN8vwtPBIfFzWbzpW3bhwAeR9gpgOdCiF+34YnhtHgqOMLnbNv+BCAfdXocBMG067on8c5Tw2ExM88D+AhgLML+dLvdZ9Vq9e8AzwSHxa1Wa9GyLA/Aowj7DeCpEKIbrjPDd+G+70/VarXLkeAIL1iW9T4237YQQowMM/MHAEsDOAiCddd1t0eCmXkXwMoANcY0tNZrUsogM6yU2iWiW9HMm8fMOwBWY522O53Oa8/z/mc+bszcAPAmhu5prYtSyn7mC5IUTTUKpdQWEa3HOvW01itSyn+ZQ4iZ3wJ4FztSB71er1CpVK5Hik2l1BkRTURZ/DmXyy0Ui8Wrhwj6DSLaBLDv+/5yeGWHoalmHD6o8fS6D74B4WfEF/snbsIAAAAASUVORK5CYII=&quot;); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                        </uni-image>
                    </div>
                </div>
                <div class="right flexJA">
                    <uni-text>
                        <span>一键操作在线</span>
                    </uni-text>
                    <div style="transform: scale(0.7);">
                        <div class="div-wrapper">
                            <div class="div-input <?php if($user_info['on_line_status']): ?>div-input-checked<?php endif; ?>" id="on_line_status"></div>
                        </div>
                    </div>
                </div>
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
                <div class="item flexJA check" data-value="0">待充值</div>
                <div class="item flexJA" data-value="1">充值中</div>
                <div class="item flexJA" data-value="2">已完成</div>
                <div class="item flexJA" data-value="3">已取消</div>
                <div class="item flexJA" data-value="4">全部</div>
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
                        <div class="footer__label" style="color: rgb(56, 117, 244); font-size: 10px; line-height: normal; margin-top: 3px;">
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
                        <div class="footer__label" style="color: rgb(153, 153, 153); font-size: 10px; line-height: normal; margin-top: 3px;">
                            我的
                        </div>
            </a>
        </div>
    </div>
</footer>
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
        <div class="select_box select_box1"></div>
        <input type="hidden" id="product_id">
        <input type="hidden" id="status">
        <script src="/static/index/js/jquery.min.js"></script>
		<script src="/static/index/js/layui/layui.js"></script>
        <script src="/static/index/js/mSlider.min.js"></script>

        <script src="/static/index/js/swiper.min.js"></script>
        <script src="/static/index/js/dySelect.js"></script>
        <script>

            const divInput = document.getElementById('on_line_status');
            divInput.addEventListener('click', function() {
                if (this.classList.contains('div-input-checked')) {
                    this.classList.remove('div-input-checked');
                    var on_line_status = 0;
                } else {
                    this.classList.add('div-input-checked');
                    var on_line_status = 1;
                }
                $.ajax({
                    url: "/order_post/user_on_line_status",
                    method: 'POST',
                    data: {
                        on_line_status: on_line_status,
                    },
                    dataType: 'json',
                    success: function(res) {
                    }
                });
            });

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
                $.post("/order_cz_list",{
                    status: $('#status').val(),
                    product_id: $('#product_id').val(),
                    content: $('#content').val(),
                },function(res){
                    let list = res.data.list,html =  "";
                    if (list.length > 0) {
                        $.each(list, function (index, item) {
                            var operate = ``;
                            if(item.status == 0){
                                var status = `<div class="btn1 flexJA primary">待充值</div>`;
                                var operate = `<div class="btn2 flexJA" onclick="cancel(${item.id})">取消充值</div>`;
                            }else if(item.status == 1){
                                var status = `<div class="btn1 flexJA warning">充值中</div>`;
                            }else if(item.status == 2){
                                var status = `<div class="btn1 flexJA success">已完成</div>`;
                                var operate = `<div class="btn2 flexJA" onclick="del(${item.id})">删除订单</div>`;
                            }else if(item.status == 3){
                                var status = `<div class="btn1 flexJA danger">已取消</div>`;
                            }
                            var on_line_status = ``;
                            if(item.on_line_status){
                                var on_line_status = 'div-input-checked';
                            }
                            html += `
                            <div class="property">
                                <div class="card">
                                    <div class="bar flexJA flexSb">
                                        <uni-image class="icon">
                                            <div style="background-image: url(${item.product_info.image}); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                                        </uni-image>
                                        <div class="text">${item.product_info.name}</div>
                                        ${status}
                                    </div>
                                </div>
                                <div class="quadrilateral"></div>
                                <div class="balance flexJA flexSb">
                                    <div class="item">
                                        <div class="num flexJA flexFs">
                                            <div class="text2">${item.amount_money}</div>
                                        </div>
                                        <div class="text">充值金额</div>
                                    </div>
                                    <div class="item">
                                        <div class="text flexJA flexFe">
                                            ${operate}
                                            <!-- div class="btn3 flexJA" onclick="info(${item.id})">查看详情</div -->
                                            <a class="btn3 flexJA" href="/order_info?order_number=${item.order_number}">查看详情</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="quadrilateral"></div>
                                <div class="balance flexJA flexSb">
                                    <div class="item">
                                        <div class="right flexJA">
                                            <uni-text>
                                                <span>当右上角开启在线，才进行充值</span>
                                            </uni-text>
                                            <div style="transform: scale(0.7);">
                                                <div class="div-wrapper">
                                                    <div class="div-input on_line_status ${on_line_status}" data-id="${item.id}"></div>
                                                </div>
                                            </div>
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


                    const divInputs = document.querySelectorAll('.on_line_status');
                    divInputs.forEach(divInput => {
                        divInput.addEventListener('click', function() {
                            if (this.classList.contains('div-input-checked')) {
                                this.classList.remove('div-input-checked');
                                var on_line_status = 0;
                            } else {
                                this.classList.add('div-input-checked');
                                var on_line_status = 1;
                            }
                            const id = this.getAttribute('data-id');
                            $.ajax({
                                url: "/order_post/order_on_line_status",
                                method: 'POST',
                                data: {
                                    id: id,
                                    on_line_status: on_line_status,
                                },
                                dataType: 'json',
                                success: function(res) {
                                }
                            });
                        });
                    });
                },'json')
            }

            function cancel(id) {
                $.ajax({
                    url: "/order_post/cancel",
                    method: 'POST',
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            toast({time: 3000, msg: res.message});
                            order_list();
                        }else{
                            toast({time: 3000, msg: res.message});
                        }

                    }
                });
            }

            
            function del(id) {
                $.ajax({
                    url: "/order_post/del",
                    method: 'POST',
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            toast({time: 3000, msg: res.message});
                            order_list();
                        }else{
                            toast({time: 3000, msg: res.message});
                        }

                    }
                });
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

            window.onload = function () {
                //移动端使用touchend
                var event = navigator.userAgent.match(/(iPhone|iPod|Android|ios)/i) ? 'touchend' : 'click';
                // 选择器
                var Q = function (id) {
                    return document.getElementById(id)
                };
            }

            var productDataString = "<?php echo htmlentities($product_list); ?>";
            productDataString = productDataString.replace(/&quot;/g, '"');
            productDataString = productDataString.replace(/&nbsp;/g, ' ');
            var productData = JSON.parse(productDataString);
            var hgS1 = new selectSwiper({
                el: '.select_box1',
                // mustSelect: true,
                data: productData,
                init: function (index) {
                    if (index !== -1) {
                        $('.btn1').html(this.data[index].name);
                    }
                },
                okFunUndefind: function () {
                    alert('必须选择一项');
                    return false;
                },
                okFun: function (index) {
                    if (this.data[index] && this.data[index].name) {
                        console.log();
                        $("#product_id").val(this.data[index].id);
                        order_list();
                        $('.btn1 span').html(`${this.data[index].name}`);
                    } else {
                        $("#product_id").val(0);
                        order_list();
                        $('.btn1 span').html(`全部类型`);
                    }
                },
                closeFun: function () {
                    console.log('取消');
                },
            });
            $('.btn1').on('click', function () {
                hgS1.openSelectSwiper();
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
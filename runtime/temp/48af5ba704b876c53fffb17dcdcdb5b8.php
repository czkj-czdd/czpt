<?php /*a:2:{s:62:"/www/wwwroot/www.biand.xyz/view/index/transaction_my_sale.html";i:1728755198;s:56:"/www/wwwroot/www.biand.xyz/view/layout/index_footer.html";i:1728755148;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>我的出售</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="/static/index/css/transaction_my_sale.css">
	</head>
	<body class="uni-body pages-transaction-mySale">
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
                        我的出售
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <div class="container">
            <div class="tab flexJA flexSb">
                <div class="item flexJA check" data-value="0">全部</div>
                <div class="item flexJA" data-value="1">上架中</div>
                <div class="item flexJA" data-value="2">已下架</div>
                <div class="item flexJA" data-value="3">已撤销</div>
            </div>
            <div class="list" id="order_list">
            </div>
            <a class="bottom flexJA" href="/transaction_sale_edit">
                <div class="button flexJA">我要出售</div>
            </a>
        </div>
        <input type="hidden" id="status" value="0">
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
                $.post("/transaction_my_sale_list",{
                    status: $('#status').val(),
                    product_id: $('#product_id').val(),
                    content: $('#content').val(),
                },function(res){
                    let list = res.data.list,html =  "";
                    if (list.length > 0) {
                        $.each(list, function (index, item) {
                            var status_operate = '';
                            if(item.status == 1){
                                var status = `<div class="btn1 flexJA success" onclick="status_operate(2, ${item.id})">上架中</div>`;
                                var status_operate = `
                                    <div class="btn2 flexJA" onclick="status_operate(3, ${item.id})">撤销挂单</div>
                                    <a class="btn3 flexJA" href="/transaction_sale_edit?id=${item.id}">编 辑</a>`;
                            }else if(item.status == 2){
                                var status = `<div class="btn1 flexJA warning" onclick="status_operate(1, ${item.id})">已下架</div>`;
                                var status_operate = `
                                    <div class="btn2 flexJA" onclick="status_operate(3, ${item.id})">撤销挂单</div>
                                    <a class="btn3 flexJA" href="/transaction_sale_edit?id=${item.id}">编 辑</a>`;
                            }else if(item.status == 3){
                                var status = `<div class="btn1 flexJA danger">已撤销</div>`;
                            }
                            html += `
                            <div class="property">
                                <div class="card">
                                    <div class="bar flexJA flexSb">
                                        <div class="text">挂单出售</div>
                                        ${status}
                                    </div>
                                </div>
                                <div class="quadrilateral"></div>
                                <div class="balance flexJA flexSb">
                                    <div class="item">
                                        <div class="num flexJA flexFs">
                                            <div class="text2">${item.sell_account}</div>
                                        </div>
                                        <div class="text">挂单数量</div>
                                    </div>
                                    <div class="item">
                                        <div class="num flexJA flexFs">
                                            <div class="text2">${item.unit_price}</div>
                                        </div>
                                        <div class="text">单价价格</div>
                                    </div>
                                    <div class="item">
                                        <div class="num flexJA flexFs">
                                            <div class="text2">${item.min_limit}</div>
                                        </div>
                                        <div class="text">最小额度</div>
                                    </div>
                                    <div class="item">
                                        <div class="num flexJA flexFs">
                                            <div class="text2">${item.max_limit}</div>
                                        </div>
                                        <div class="text">最大额度</div>
                                    </div>
                                </div>
                                <div class="quadrilateral"></div>
                                <div class="balance flexJA flexSb">
                                    <div class="item">
                                        <div class="text flexJA flexFe">
                                            ${status_operate}
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        })
                    }else{
                        html += `
                            <div class="uni-load-more">
                                <div class="uni-load-more__text" style="color: rgb(119, 119, 119);">
                                    <span>没有更多数据了</span>
                                </div>
                            </div>`;
                    }
                    $("#order_list").html(html);
                },'json')
            }


            

            function status_operate(status, id) {
                $.ajax({
                    url: "/transaction_my_sale_post/status_operate",
                    method: 'POST',
                    data: {
                        status: status,
                        id: id,
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            order_list();
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
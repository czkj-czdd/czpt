<?php /*a:1:{s:47:"D:\phpEnv\www\cz_pay\view\index\order_info.html";i:1729856128;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>订单详情</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="/static/index/css/order_info.css">

        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-order-orderDetails">
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
                        订单详情
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>

        <div class="container">
            <div class="above">
                <div class="bar flexJA flexSb">
                    <div class="sign flexJA">单个充值</div>
                    <div class="left">
                        <div class="num" onclick="copyToClipboard('<?php echo htmlentities($order_info['order_number']); ?>')">订单：<?php echo htmlentities($order_info['order_number']); ?></div>
                        <div class="time">于 <?php echo htmlentities($order_info['create_time']); ?></div>
                    </div>
                    <div class="title">支付成功</div>
                </div>
                <?php if($order_info['status'] == 0): ?>
                    <div class="state success">订单待充值</div>
                    <div class="tips">订单待充值，请耐心等待！</div>
                    <div class="text">如有疑问可联系咨询客服</div>
                <?php endif; if($order_info['status'] == 1): ?>
                    <div class="state success">订单充值中</div>
                    <div class="tips">订单充值中，请耐心等待！</div>
                    <div class="text">如有疑问可联系咨询客服</div>
                <?php endif; if($order_info['status'] == 2): ?>
                    <div class="state success">订单已充值成功</div>
                    <div class="tips">已成功充值到指定号码。因高峰期会出现延迟情况，最迟会在24小时-48小时到账,请耐心等候。</div>
                    <div class="text">如有疑问可联系咨询客服</div>
                <?php endif; if($order_info['status'] == 3): ?>
                    <div class="state cancel">订单已取消</div>
                    <div class="tips">您的订单已被您手动取消了</div>
                    <div class="text">如有疑问可联系咨询客服</div>
                <?php endif; ?>
            </div>
            <div class="centre">
                <?php echo $order_infos; ?>
            </div>
            <div class="below">
                <div class="title">支付信息</div>
                <div class="bar flexJA flexSb">
                    <div class="text">充值金额</div>
                    <div class="num"><?php echo htmlentities($order_info['amount_money']); ?> 元</div>
                </div>
                <div class="bar flexJA flexSb">
                    <div class="text">优惠信息</div>
                    <div class="discount">折扣<?php echo htmlentities($order_info['discount']); ?> 优惠-<?php echo htmlentities($order_info['discount_amount']); ?>元</div>
                </div>
                <div class="bar flexJA flexSb">
                    <div class="text">参考汇率</div>
                    <div class="num"><?php echo htmlentities($order_info['rate']); ?></div>
                </div>
                <div class="bar flexJA flexSb">
                    <div class="total">合计支付</div>
                    <div class="flexJA flexFs flexAib">
                        <div class="symbol">$</div>
                        <div class="sum"><?php echo htmlentities($order_info['cny_amount']); ?></div>
                        <div class="unit">USDT</div>
                    </div>
                </div>
            </div>
            <div class="bottoms">
                <div class="menu flexJA flexSb">
                    <div class="item flexJA flexDc" onclick="del()">
                        <uni-image class="icon">
                            <div style="background-image: url(/static/index/image/88.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                        </uni-image>
                        <div class="text1">删除订单</div>
                    </div>
                    <a class="item flexJA flexDc" href="<?php echo htmlentities((isset($config['contact_service_url']) && ($config['contact_service_url'] !== '')?$config['contact_service_url']:'')); ?>">
                        <uni-image class="icon" style="width: 24px;">
                            <div style="background-image: url(/static/index/image/90.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                        </uni-image>
                        <div class="text1">在线客服</div>
                    </a>
                    
                    <a class="item flexJA flexDc" href="/product/<?php echo htmlentities($order_info['product_id']); ?>">
                        <uni-image class="icon" style="width: 26px;">
                            <div style="background-image: url(/static/index/image/91.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                        </uni-image>
                        <div class="text1">继续充值</div>
                    </a>
                </div>
            </div>
        </div>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="uni-popup__wrapper center" style="background-color: transparent;">
                    <div class="popup">
                        <div class="title flexJA">温馨提示</div>
                        <div class="bar flexJA">是否删除该订单？</div>
                        <div class="bottom flexJA flexSb">
                            <div class="btn1 flexJA close">取消</div>
                            <div class="btn2 flexJA" onclick="del_yes()">确认</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="/static/index/js/jquery.min.js"></script>
		<script src="/static/index/js/layui/layui.js"></script>
        <script src="/static/index/js/mSlider.min.js"></script>
        <script>
            function del_yes() {
                $.ajax({
                    url: "/order_post/order_del",
                    method: 'POST',
                    data: {
                        del_id: "<?php echo htmlentities($order_info['id']); ?>",
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            toast({time: 3000, msg: res.message});
                            setTimeout(function (){
                                window.location.href = '/order'
                            },1500);
                        }else{
                            toast({time: 3000, msg: res.message});
                        }

                    }
                });
            }
            function del() {
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
        </script>

	</body>
</html>
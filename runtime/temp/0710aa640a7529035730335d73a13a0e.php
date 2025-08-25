<?php /*a:1:{s:51:"/www/wwwroot/lxth.lat/view/index/order_voucher.html";i:1736872451;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>付款凭证</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="/static/index/css/order_voucher.css">

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
                        付款凭证
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>

        <div class="container">
            <div class="above">
                <div class="bar flexJA flexSb">
                    <canvas id="myCanvas" style="width: 100%; height: 100%;"></canvas>
                </div>
            </div>
            
            <div class="fixation">
                <div class="btn flexJA flexSb">
                    <a class="btn1 flexJA" href="https://www.goodsunlc.com/status/screenshots/wxzd2022.html">制作内容</a>
                    <div class="btn1 flexJA activate" onclick="saveImage()">下载图片</div>
                </div>
            </div>
        </div>
        <script>
            const canvas = document.getElementById('myCanvas');
            const ctx = canvas.getContext('2d');
            const imageUrl = '/static/index/image/order_voucher.png';
            const image = new Image();
            image.src = imageUrl;
            
            const imageUrl2 = '/static/index/image/59.png';
            const image2 = new Image();
            image2.src = imageUrl2;
            
            const imageUrl3 = '/static/index/image/xcx.png';
            const image3 = new Image();
            image3.src = imageUrl3;
            image.onload = function() {
                canvas.width = image.width;
                canvas.height = image.height;
                ctx.drawImage(image, 0, 0);
                
                // 将第二张图片变成圆形并绘制在白色圆形背景内
                image2.onload = function() {
                    ctx.save();
                    ctx.beginPath();
                    ctx.arc(canvas.width - 340, 210, 40, 0, Math.PI * 2);
                    ctx.clip();
                    ctx.fillStyle = 'white';
                    ctx.fillRect(canvas.width - 380, 170, 80, 80);
                    ctx.drawImage(image2, canvas.width - 380, 170, 80, 80);
                    ctx.restore();
                };
                
                ctx.font = '30px Arial';ctx.fillStyle = 'white';ctx.textAlign = 'center';ctx.fillText('手机充值', canvas.width / 2, 300);
                
                ctx.font = '60px Arial';ctx.fillStyle = 'white';ctx.textAlign = 'center';ctx.fillText('- 900.00', canvas.width / 2, 380);
           
                ctx.font = '20px Arial';ctx.fillStyle = '#939393';ctx.textAlign = 'left';ctx.fillText('当前状态', 50, 480);
                ctx.font = '20px Arial';ctx.fillStyle = 'white';ctx.textAlign = 'left';ctx.fillText('支付成功', 200, 480);
           
                ctx.font = '20px Arial';ctx.fillStyle = '#939393';ctx.textAlign = 'left';ctx.fillText('支付时间', 50, 530);
                ctx.font = '20px Arial';ctx.fillStyle = 'white';ctx.textAlign = 'left';ctx.fillText('2025-1-13 00:00:00', 200, 530);
           
                ctx.font = '20px Arial';ctx.fillStyle = '#939393';ctx.textAlign = 'left';ctx.fillText('商品', 50, 580);
                ctx.font = '20px Arial';ctx.fillStyle = 'white';ctx.textAlign = 'left';ctx.fillText('9元手机话费充值', 200, 580);
           
                ctx.font = '20px Arial';ctx.fillStyle = '#939393';ctx.textAlign = 'left';ctx.fillText('自行修改', 50, 630);
                ctx.font = '20px Arial';ctx.fillStyle = 'white';ctx.textAlign = 'left';ctx.fillText('编辑修改', 200, 630);
           
                ctx.font = '20px Arial';ctx.fillStyle = '#939393';ctx.textAlign = 'left';ctx.fillText('收单机构', 50, 680);
                ctx.font = '20px Arial';ctx.fillStyle = 'white';ctx.textAlign = 'left';ctx.fillText('编辑修改', 200, 680);
           
                ctx.font = '20px Arial';ctx.fillStyle = '#939393';ctx.textAlign = 'left';ctx.fillText('支付方式', 50, 730);
                ctx.font = '20px Arial';ctx.fillStyle = 'white';ctx.textAlign = 'left';ctx.fillText('零钱', 200, 730);
           
                ctx.font = '20px Arial';ctx.fillStyle = '#939393';ctx.textAlign = 'left';ctx.fillText('交易单号', 50, 780);
                ctx.font = '20px Arial';ctx.fillStyle = 'white';ctx.textAlign = 'left';ctx.fillText('18484884848', 200, 780);
           
                ctx.font = '20px Arial';ctx.fillStyle = '#939393';ctx.textAlign = 'left';ctx.fillText('商户单号', 50, 830);
                ctx.font = '20px Arial';ctx.fillStyle = 'white';ctx.textAlign = 'left';ctx.fillText('编辑修改', 200, 830);
                
                ctx.font = '22px Arial';ctx.fillStyle = '#939393';ctx.textAlign = 'right';ctx.fillText('手机充值', 620, 960);
                const textWidth = ctx.measureText('手机充值').width;ctx.drawImage(image3, 620 - textWidth - 30, 960 - 20, 22, 22);
    
            };
            function saveImage() {
                const link = document.createElement('a');
                link.download = 'image_with_text.png';
                link.href = canvas.toDataURL('image/png').replace("image/png", "image/octet-stream");
                link.click();
            }
            
        </script>

	</body>
</html>
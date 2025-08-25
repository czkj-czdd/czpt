<?php /*a:2:{s:56:"/www/wwwroot/45.207.213.41/5555/view/index/recharge.html";i:1728755209;s:61:"/www/wwwroot/45.207.213.41/5555/view/layout/index_footer.html";i:1728755148;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>订单详情</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/recharge.css">
        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-user-topUpDetails">
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
                    <div class="left">
                        <div class="num">订单：<?php echo htmlentities($recharge['order_number']); ?></div>
                        <div class="date">创建于<?php echo htmlentities($recharge['create_time']); ?></div>
                    </div>
                    <?php if($recharge['status'] == 0): ?><div class="state blue">待汇款提交</div><?php endif; if($recharge['status'] == 1): ?><div class="state blue">已提交</div><?php endif; if($recharge['status'] == 2): ?><div class="state red">订单取消</div><?php endif; if($recharge['status'] == 3): ?><div class="state blue">订单完成</div><?php endif; ?>
                </div>
                <?php if($recharge['status'] == 0): ?>
                <div class="text">请在
                    <uni-text>
                        <span id="countdown">0分 0秒</span>
                    </uni-text>完成汇款进行提交，以防订单自动失效
                </div>
                <?php endif; if($recharge['status'] == 1): ?><div class="text">于<?php echo htmlentities((isset($recharge['submit_time']) && ($recharge['submit_time'] !== '')?$recharge['submit_time']:'')); ?> 提交汇款，等待核实确认</div><?php endif; if($recharge['status'] == 2): ?><div class="text">于<?php echo htmlentities((isset($recharge['cancel_time']) && ($recharge['cancel_time'] !== '')?$recharge['cancel_time']:'')); ?> 取消订单</div><?php endif; if($recharge['status'] == 3): ?><div class="text">于<?php echo htmlentities((isset($recharge['complete_time']) && ($recharge['complete_time'] !== '')?$recharge['complete_time']:'')); ?> 完成订单</div><?php endif; ?>
            </div>
            <div class="middle">
                <div class="title">平台指定汇款账户</div>
                <div class="tips">请根据下方所提供地址进行汇款，务必与充值金额一致</div>
                <div class="box flexJA flexDc">
                    <div class="code">
                        <div style="background-image: url('https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo htmlentities($config['payment_address']); ?>'); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="card">
                        <div class="text flexJA">请仔细核对， 与图片内地址一致方可充值</div>
                        <div class="text flexJA"><?php echo htmlentities($config['payment_address']); ?></div>
                    </div>
                    <div class="num flexJA"><?php echo htmlentities($config['payment_address']); ?></div>
                    <div class="btn flexJA" onclick="copyToClipboard()">复制钱包地址</div>
                </div>
            </div>
            <div class="below">
                <div class="bar flexJA flexSb">
                    <div class="title">订单充值金额</div>
                    <div class="num"><?php echo htmlentities($recharge['amount']); ?> USDT</div>
                </div>
                <div class="bar">
                    <div class="title">我的钱包地址</div>
                    <div class="text"><?php echo htmlentities($user_info['trc20']); ?></div>
                </div>
                <div class="bar">
                    <div class="title">汇款凭证</div>
                    <div class="tips">如超时未到账 请上传汇款凭证</div>
                    <div class="icon recharge_image">
                        <?php if(!$recharge['image']): ?>
                        <div style="background-image: url(/static/index/image/52.png); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;" id="upload">
                            <input type="file" id="picture_upload" accept=".png, .jpg, .jpeg" style="display: none;" />
                        </div>
                        <?php else: ?>
                        <div style="background-image: url('<?php echo htmlentities($recharge['image']); ?>'); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if($recharge['status'] == 0): ?>
            <div class="bottom flexJA flexSb">
                <div class="btn1 flexJA" onclick="cancel()">取消订单</div>
                <div class="btn2 flexJA" onclick="submit()">已汇款，提交订单</div>
            </div>
            <?php endif; ?>
        </div>
        <script src="/static/index/js/jquery.min.js"></script>
        <script>
            function cancel() {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/recharge_post/cancel",
                    data: {
                        id: "<?php echo htmlentities($recharge['id']); ?>",
                    },
                    success: function(res) {
                        if (res.code === 200) {
                            toast({time: 3000, msg: res.message});
                            setTimeout(function (){
                                window.location.reload();
                            },2000);
                        }else{
                            toast({time: 3000, msg: res.message});
                        }  
                    },
                })
            }

            function submit() {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/recharge_post/submit",
                    data: {
                        id: "<?php echo htmlentities($recharge['id']); ?>",
                    },
                    success: function(res) {
                        if (res.code === 200) {
                            toast({time: 3000, msg: res.message});
                            setTimeout(function (){
                                window.location.reload();
                            },2000);
                        }else{
                            toast({time: 3000, msg: res.message});
                        }  
                    },
                })
            }


            <?php if($recharge['status'] == 0): ?>
            var countDownDate = new Date("<?php echo htmlentities($recharge['create_time']); ?>").getTime() + (20 * 60 * 1000);
            var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementById("countdown").innerHTML =  minutes + " 分 " + seconds + " 秒 ";
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("countdown").innerHTML = "0分 0秒";
                }
            }, 1000);
            <?php endif; ?>
            
            function copyToClipboard() {
                var tempTextArea = document.createElement("textarea");
                tempTextArea.value = "<?php echo htmlentities($config['payment_address']); ?>";
                document.body.appendChild(tempTextArea);
                tempTextArea.select();
                document.execCommand("copy");
                document.body.removeChild(tempTextArea);
                toast({time: 3000, msg: '复制成功'});
            }

            
            document.getElementById('upload').addEventListener('click', function() {
                document.getElementById('picture_upload').click();
            });
            let input_2 = document.getElementById("picture_upload");
            input_2.addEventListener('change',picture_upload,false);
            function picture_upload(){
                let file = this.files[0]; 
                if(!/image\/\w+/.test(file.type)){
                    alert("请确保文件为图像类型"); 
                    return false; 
                }
                let reader = new FileReader(); 
                reader.readAsDataURL(file); 
                console.log();
                reader.onload = function(e){ 
                    $.ajax({
                        url: "/upload_post",
                        method: 'POST',
                        data: {
                            result: this.result,
                        },
                        success: function(res) {
                            if (res.code === 200) {
                                $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: "/recharge_post/image",
                                    timeout: 10000,
                                    data: {
                                        id: "<?php echo htmlentities($recharge['id']); ?>",
                                        image: res.data,
                                    },
                                    success: function(res) {
                                        if (res.code === 200) {
                                            $('.recharge_image').html(`
                                            <div style="background-image: url('${res.data}'); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;">`);
                                            toast({time: 3000, msg: res.message});
                                        }else{
                                            toast({time: 3000, msg: res.message});
                                        }  
                                    },
                                })
                            } else {
                                toast({time: 3000, msg: res.message});
                            }
                        }
                    });
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
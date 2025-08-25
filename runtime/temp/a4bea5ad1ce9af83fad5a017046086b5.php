<?php /*a:2:{s:62:"/www/wwwroot/www.biand.xyz/view/index/query_business_page.html";i:1732722664;s:56:"/www/wwwroot/www.biand.xyz/view/layout/index_footer.html";i:1728755148;}*/ ?>
<!DOCTYPE html>
<!-- saved from url=(0055)https://xl.baililai.xyz/h5#/pages/archives/select?id=57 -->
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>认购理财</title>
		<script>var coverSupport = 'CSS' in window && typeof CSS.supports === 'function' && (CSS.supports('top: env(a)') || CSS.supports('top: constant(a)'))
            document.write('<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0' + (coverSupport ? ', viewport-fit=cover' : '') + '" />')</script>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/query_business_page.css">
        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-archives-select">
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
                        认购理财
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <div class="container">
            <div class="info">
                <div class="top flexJA flexSb">
                    <div class="title"><?php echo htmlentities($product['name']); ?></div>
                    <a class="btn flexJA" href="/query_business">重新选择</a>
                </div>
                <div class="desc"><?php echo $product['describe']; ?></div>
                <div class="price flexJA flexSb">
                    <div>
                        <div>投资金额：<?php echo htmlentities($product['quiry_price']); ?> 元</div>
                        <div>参考汇率：<?php echo htmlentities((isset($config['rate']) && ($config['rate'] !== '')?$config['rate']:'未设置')); ?></div>
                    </div>
                    <div class="flexJA">
                        <div>实际支付：</div>
                        <uni-text>
                            <span><?php echo number_format($product['quiry_price'] / getConfig('rate')??0, 2); ?> USDT</span>
                        </uni-text>
                    </div>
                </div>
            </div>
            <div class="from">
                <div class="title">请填写受益人证件号码</div>
                <div class="textarea">
                    <uni-textarea>
                        <textarea maxlength="140" enterkeyhint="return" class="uni-textarea-textarea" style="overflow-y: auto;" placeholder="请输入" id="clue"></textarea>
                    </uni-textarea>
                </div>
                <div class="title">上传证件照片</div>
                <div class="bg flexJA flexFs">
                    <div class="image">
                        <div style="background-image: url(/static/index/image/52.png); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;" id="upload">
                        </div>
                        <input type="file" id="picture_upload" accept=".png, .jpg, .jpeg" style="display: none;" />
                    </div>
                    <input type="hidden" id="image"/>
                </div>
                <div class="button flexJA"  onclick="confirm_submit()">确认提交</div>
            </div>
        </div>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="uni-popup__wrapper center" style="background-color: transparent;">
                    <div class="popup">
                        <div class="title flexJA">确认支付</div>
                        <a class="btn" href="/recharge_withdrawal">充值</a>
                        <div class="bar flexJA">
                            <div class="icon">
                                <div style="background-image: url(/static/index/image/41.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                            </div>
                            <div class="text">我的资产</div>
                            <div class="sum"><span class="balance">0.00</span>USDT</div>
                        </div>
                        <div class="h2 flexJA">支付金额</div>
                        <div class="total flexJA">$<span class="price">0.00</span>USDT</div>
                        <div class="bottom flexJA flexSb">
                            <div class="btn1 flexJA close">取消</div>
                            <div class="btn2 flexJA" onclick="confirm_payment()">确认支付</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/static/index/js/jquery.min.js"></script>
        <script>
            function confirm_submit() {
                $.ajax({
                    url: "/query_business_page_post/confirm_submit",
                    method: 'POST',
                    data: {
                        product_id: "<?php echo htmlentities($product['id']); ?>",
                        clue: $('#clue').val(),
                        image: $('#image').val(),
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {

                            $(".balance").html(res.data.balance);
                            $(".price").html(res.data.price);

                            
                            document.getElementById('myModal').style.display = "block";
                        }else{
                            toast({time: 3000, msg: res.message});
                        }
                    }
                })
            }

            function confirm_payment() {
                var order_info = [];
                order_info.push('[理财信息]' + $('#clue').val());

                var image = $('#image').val();
                if(image){
                    order_info.push('[上传图片]' + image);
                }

                $.ajax({
                    url: "/query_business_page_post/confirm_payment",
                    method: 'POST',
                    data: {
                        product_id: "<?php echo htmlentities($product['id']); ?>",
                        order_info: JSON.stringify(order_info),
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            toast({time: 3000, msg: res.message});
                            setTimeout(function (){
                                window.location.href = '/order_cx'
                            },2000);
                        }else{
                            toast({time: 3000, msg: res.message});
                        }
                    }
                })
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
                reader.onload = function(e){ 
                    $.ajax({
                        url: "/upload_post",
                        method: 'POST',
                        data: {
                            result: this.result,
                        },
                        success: function(res) {
                            if (res.code === 200) {
                                $('.image').html(`
                                <div style="background-image: url('${res.data}'); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;">`);
                                
                                $("#image").val(res.data);

                                toast({time: 3000, msg: res.message});
                            } else {
                                toast({time: 3000, msg: res.message});
                            }
                        }
                    });
                }
            }
            



            // 获取弹窗
            var modal = document.getElementById('myModal');
            // 打开弹窗的按钮对象
            var btn = document.getElementById("myBtn");
            // 获取 <span> 元素，用于关闭弹窗
            var span = document.querySelector('.close');

            // 点击 <span> (x), 关闭弹窗
            span.onclick = function() {
                modal.style.display = "none";
            }
            // 在用户点击其他地方时，关闭弹窗
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
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
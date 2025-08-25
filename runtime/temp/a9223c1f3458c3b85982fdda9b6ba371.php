<?php /*a:2:{s:47:"/www/wwwroot/lxth.lat/view/index/bank_card.html";i:1736942298;s:51:"/www/wwwroot/lxth.lat/view/layout/index_footer.html";i:1736872451;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>支付管理</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="/static/index/css/bank_card.css">

        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-user-bankCard" style="overflow: visible;">
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
                        支付管理
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <div class="container">
            <div class="list">
                <?php foreach($BankCard_list as $key=>$vo): ?>
                <div class="item">
                    <a class="icon" href="/bank_card_add_modify?id=<?php echo htmlentities($vo['id']); ?>">
                        <div style="background-image: url(/static/index/image/26.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                    </a>
                    <div class="bar p20 flexJA flexSb">
                        <div class="text"><?php echo htmlentities($vo['name']); ?></div>
                        <div class="num"><?php echo htmlentities($vo['mobile']); ?></div>
                    </div>
                    <div class="bar p20 flexJA flexFs">
                        <div class="name">微信昵称 <?php echo htmlentities($vo['wx_account']); ?></div>
                    </div>
                    <div class="bar flexJA flexFs">
                        <div class="name">微信手机号 <?php echo htmlentities($vo['zfb_account']); ?></div>
                    </div>
                    <div class="bar p30 flexJA flexFs"></div>
                    <div class="bar flexJA flexFs">
                        <uni-radio id="<?php echo htmlentities($vo['id']); ?>" style="transform: scale(0.6);">
                            <div class="uni-radio-wrapper" >
                                <div class="uni-radio-input <?php if($vo['default_selection'] == 1): ?>uni-radio-input-checked<?php endif; ?>"></div>
                            </div>
                        </uni-radio>
                        <div class="default">选择</div>
                        <div class="del" onclick="del(<?php echo htmlentities($vo['id']); ?>)">删除</div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <a class="bottom" href="/bank_card_add_modify">
                <div class="button flexJA">新增</div>
            </a>
        </div>
        <script src="/static/index/js/jquery.min.js"></script>
        <script type="text/javascript">
            let uniRadios = document.querySelectorAll('uni-radio');
            uniRadios.forEach(uniRadio => {
                uniRadio.addEventListener('click', function() {
                    let radioInput = this.querySelector('.uni-radio-input');
                    document.querySelectorAll('.uni-radio-input').forEach(input => {
                        input.classList.remove('uni-radio-input-checked');
                    });
                    radioInput.classList.add('uni-radio-input-checked');

                    let bank_card_id = uniRadio.getAttribute('id');
                    $.ajax({
                        url: "/bank_card_post/default_selection",
                        method: 'POST',
                        data: {
                            bank_card_id: bank_card_id,
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
                });
            });





            function del(id) {
                $.ajax({
                    url: "/bank_card_post/del",
                    method: 'POST',
                    data: {
                        id: id,
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
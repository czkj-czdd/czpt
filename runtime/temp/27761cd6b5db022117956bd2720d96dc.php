<?php /*a:2:{s:44:"/www/wwwroot/dazhe.org/view/index/index.html";i:1732713002;s:52:"/www/wwwroot/dazhe.org/view/layout/index_footer.html";i:1728755148;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo htmlentities((isset($config['name']) && ($config['name'] !== '')?$config['name']:'')); ?></title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/index.css">
        
        <link rel="stylesheet" href="/static/index/css/swiper-bundle.min.css"><!-- 轮播 -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script><!-- 轮播 -->
	</head>
	<body class="uni-body pages-home-index">
        <div class="container">
            <div class="bg">
                <div class="title flexJA"><?php echo htmlentities((isset($config['name']) && ($config['name'] !== '')?$config['name']:'')); ?></div>
                <div class="tips"><?php echo (isset($config['notice']) && ($config['notice'] !== '')?$config['notice']:''); ?></div>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach($Slide_list as $key => $vo): ?>
                        <div class="swiper-slide" style="background-image: url('<?php echo htmlentities($vo['image']); ?>'); background-position: center center; background-size: cover; background-repeat: no-repeat;"></div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <script>
                    var swiper = new Swiper('.swiper-container', {
                        slidesPerView: 1,
                        spaceBetween: 30,
                        loop: true,
                        autoplay: {
                            delay: 5000000,
                            disableOnInteraction: false,
                        },
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                    });
                </script>
                <div class="main">
               
                    <div class="h1">选择充值类型</div>
                    <div class="type flexJA flexSb">
                        <a class="left picture1" style="background-image: url(<?php echo htmlentities((isset($config['b_recommend_image']) && ($config['b_recommend_image'] !== '')?$config['b_recommend_image']:'')); ?>);flex: 1 1 0%; margin-right: 13px;text-decoration: none;" href="/product/<?php echo htmlentities((isset($b_product['id']) && ($b_product['id'] !== '')?$b_product['id']:'')); ?>">
                            <div class="blue"><?php echo htmlentities((isset($b_product['name']) && ($b_product['name'] !== '')?$b_product['name']:'')); ?></div>
                            <div class="text"><?php echo htmlentities((isset($b_product['describe']) && ($b_product['describe'] !== '')?$b_product['describe']:'')); ?></div>
                            <div class="btn flexJA">充值</div>
                        </a>
                        <a class="left picture1" style="background-image: url(<?php echo htmlentities((isset($config['a_recommend_image']) && ($config['a_recommend_image'] !== '')?$config['a_recommend_image']:'')); ?>);flex: 1 1 0%; text-decoration: none;" href="/product/<?php echo htmlentities((isset($a_product['id']) && ($a_product['id'] !== '')?$a_product['id']:'')); ?>">
                            <div class="blue"><?php echo htmlentities((isset($a_product['name']) && ($a_product['name'] !== '')?$a_product['name']:'')); ?></div>
                            <div class="text"><?php echo htmlentities((isset($a_product['describe']) && ($a_product['describe'] !== '')?$a_product['describe']:'')); ?></div>
                            <div class="btn flexJA">充值</div>
                        </a>
                    </div>
                    <div class="list">
                        <div class="item flexJA flexSb">
                            <uni-image class="icon">
                                <div style="background-image: url('/static/index/image/117.png'); background-position: center center; background-size: cover; background-repeat: no-repeat;"></div>
                            </uni-image>
                            <div class="centre">
                                <div class="text1">理财中心</div>
                                <div class="text2">尽我所能为您提供资产管理</div>
                            </div>
                            <a class="btn flexJA" href="/query_business">前往</a>
                        </div>
                        <?php foreach($Product_list as $key => $vo): ?>
                        <div class="item flexJA flexSb">
                            <uni-image class="icon">
                                <div style="background-image: url('<?php echo htmlentities($vo['image']); ?>'); background-position: center center; background-size: cover; background-repeat: no-repeat;"></div>
                            </uni-image>
                            <div class="centre">
                                <div class="text1"><?php echo htmlentities($vo['name']); ?></div>
                                <div class="text2"><?php echo htmlentities($vo['describe']); ?></div>
                            </div>
                            <a class="btn flexJA" href="/product/<?php echo htmlentities($vo['id']); ?>">前往</a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer-bottom">
            <div class="footer" style="background-color: rgb(255, 255, 255); backdrop-filter: none;">
                <div class="footer-border" style="background-color: rgba(0, 0, 0, 0.33);"></div>
                <div class="footer__item">
                    <div class="footer__bd" style="height: 50px;">
                        <div class="footer__icon" style="width: 24px; height: 24px;">
                            <img src="/static/index/image/2.png">
                        </div>
                        <div class="footer__label" style="color: rgb(56, 117, 244); font-size: 10px; line-height: normal; margin-top: 3px;">
                            首页
                        </div>
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
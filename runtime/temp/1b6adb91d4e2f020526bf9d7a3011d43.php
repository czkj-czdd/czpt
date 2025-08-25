<?php /*a:2:{s:56:"/www/wwwroot/www.biand.xyz/view/index/agency_center.html";i:1732795080;s:56:"/www/wwwroot/www.biand.xyz/view/layout/index_footer.html";i:1728755148;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + 0px); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>代理中心</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/agency_center.css">

        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-agency-index" style="overflow: visible;">
        <div class="container">
            <div class="uni-navbar" style="width: 100%; position: fixed;">
                <div class="uni-navbar__content" style="background-color: transparent; border-bottom-color: rgb(51, 51, 51);">
                    <div class="uni-status-bar" style="height: 0px;"></div>
                    <div class="uni-navbar__header" style="color: rgb(51, 51, 51); background-color: transparent; height: 44px;">
                        <div class="uni-navbar__header-btns uni-navbar__header-btns-left" style="width: 60px;" onclick="window.history.back()">
                            <div class="uni-navbar__content_view">
                                <uni-text class="uni-icons uniui-back" style="color: rgb(51, 51, 51); font-size: 20px;">
                                    <span>
                                        <svg t="1728376672073" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4239" width="20" height="20">
                                            <path d="M631.04 161.941333a42.666667 42.666667 0 0 1 63.061333 57.386667l-2.474666 2.730667-289.962667 292.245333 289.706667 287.402667a42.666667 42.666667 0 0 1 2.730666 57.6l-2.474666 2.752a42.666667 42.666667 0 0 1-57.6 2.709333l-2.752-2.474667-320-317.44a42.666667 42.666667 0 0 1-2.709334-57.6l2.474667-2.752 320-322.56z" fill="#111111" p-id="4240"></path>
                                        </svg>
                                    </span>
                                </uni-text>
                            </div>
                        </div>
                        <div class="uni-navbar__header-container "></div>
                        <div class="uni-navbar__header-btns uni-navbar__header-btns-right" style="width: 60px;"></div>
                    </div>
                </div>
            </div>
            <div class="agency pb150">
                <div class="above">
                    <div class="user flexJA flexFs">
                        <div class="photo">
                            <div style="background-image: url(<?php echo htmlentities((isset($user_info['avatar']) && ($user_info['avatar'] !== '')?$user_info['avatar']:"/static/index/image/user_avatar.jpg")); ?>); background-position: center center; background-size: cover; background-repeat: no-repeat;    border-radius: 50%;height: 100%;"></div>
                        </div>
                        <div class="name"><?php echo htmlentities((isset($user_info['nickname']) && ($user_info['nickname'] !== '')?$user_info['nickname']:'未设置')); ?></div>
                    </div>
                </div>
                <div class="below">
                    <div class="info flexJA flexSb">
                        <div class="left">
                            <div class="flexJA flexFs">
                                <div class="mr flexJA flexDc flexAis">
                                    <div class="text">今日奖励</div>
                                    <div class="sum"><?php echo htmlentities($rebate_jr); ?></div>
                                </div>
                                <div class="flexJA flexDc flexAis">
                                    <div class="text">累计奖励</div>
                                    <div class="sum"><?php echo htmlentities($rebate_s); ?></div>
                                </div>
                            </div>
                            
                            <!-- <div class="tips">未成为代理，奖励为冻结状态</div> -->
                        </div>
                        <a class="right flexJA" href="/wallet_details_data?type=6&title=代理分润">
                            <div class="text">查看明细</div>
                            <div class="icon">
                                <div style="background-image: url(/static/index/image/77.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                            </div>
                        </a>
                    </div>
                    <div class="tab  <?php if(empty($user_info['agent_status'])): ?>mask<?php endif; ?>">
                        <div class="scroll">
                            <div class="uni-scroll-view">
                                <div class="uni-scroll-view" style="overflow: auto hidden;">
                                    <div class="uni-scroll-view-content">
                                        <div id="1" class="item activate">1</div>
                                        <div id="2" class="item">2</div>
                                        <div id="3" class="item">3</div>
                                        <div id="4" class="item">4</div>
                                        <div id="5" class="item">5</div>
                                        <div id="6" class="item">6</div>
                                        <div id="7" class="item">7</div>
                                        <div id="8" class="item">8</div>
                                        <div id="9" class="item">9</div>
                                        <div id="10" class="item">10</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($user_info['agent_status'] == 1): ?>
                        <div class="list agency_center_list">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if(empty($user_info['agent_status'])): ?>
            <div class="not flexJA">
                <div class="bottom ">
                    <?php echo (isset($config['agent_jieshao']) && ($config['agent_jieshao'] !== '')?$config['agent_jieshao']:''); ?>
                    <div class="flexJA" onclick="agency()">
                        <div class="btn flexJA">立即激活</div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
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
                            <div class="sum"><span class="balance"><?php echo htmlentities($user_info['balance']); ?></span>USDT</div>
                        </div>
                        <div class="h2 flexJA">支付金额</div>
                        <div class="total flexJA">$<span class="cnyAmount"><?php echo htmlentities((isset($config['agent_money']) && ($config['agent_money'] !== '')?$config['agent_money']:'0.00')); ?></span>USDT</div>
                        <div class="bottom flexJA flexSb">
                            <div class="btn1 flexJA close">取消</div>
                            <div class="btn2 flexJA" onclick="confirm_payment()">确认支付</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/static/index/js/jquery.min.js"></script>
		<script src="/static/index/js/layui/layui.js"></script>
        <script>
            function agency() {
                document.getElementById('myModal').style.display = "block";
            }
            function confirm_payment() {
                $.ajax({
                    url: "/agency_center_post/confirm_payment",
                    method: 'POST',
                    data: {
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            toast({time: 3000, msg: res.message});
                            setTimeout(function (){
                                window.location.reload();
                            },2000);
                        }else{
                            toast({time: 3000, msg: res.message});
                        }
                    }
                })
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


            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    if(items.length > 0){
                        items[0].click();
                    }
                }, 100);
                const items = document.querySelectorAll('.item');
                items.forEach(item => {
                    item.addEventListener('click', () => {
                        items.forEach(item => item.classList.remove('activate'));
                        item.classList.add('activate');
                        item.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        // 返回选择的ID
                        console.log('选择的ID为:', item.id);


                        $.post("/agency_center_list",{
                            type: item.id,
                        },function(res){
                            let list = res.data.list,html =  "";
                            if (list.length > 0) {
                                $.each(list, function (index, item) {
                                    html += `
                                    <div class="item flexJA flexFs flexAis">
                                        <div class="icon">
                                            <div style="background-image: url(${item.avatar||'/static/index/image/user_avatar.jpg'}); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;"></div>
                                        </div>
                                        <div class="right">
                                            <div class="bar flexJA flexSb">
                                                <div class="title">${item.name||'未设置'}</div>
                                                <div class="unit"></div>
                                            </div>
                                            <div class="bar flexJA flexSb">
                                                <div class="text">${item.create_time}</div>
                                                <div class="unit"></div>
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
                            $(".agency_center_list").html(html);

                        },'json')


                    });
                });
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
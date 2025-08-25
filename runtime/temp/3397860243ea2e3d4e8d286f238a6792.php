<?php /*a:2:{s:53:"/www/wwwroot/dazhe.org/view/index/invite_friends.html";i:1728755257;s:52:"/www/wwwroot/dazhe.org/view/layout/index_footer.html";i:1728755148;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + 0px); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>推广海报</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="/static/index/css/invite_friends.css">

        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-user-inviteFriends" style="overflow: visible;">
        <div class="container">
            <div class="fixation">
                <div class="tab flexJA flexSb">
                    <div class="icon" onclick="window.history.back()">
                        <div style="background-image: url(/static/index/image/33.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="title white">邀请好友</div>
                    <div class="icon"></div>
                </div>
            </div>
            <div class="lime-painter">
                <div style="height: 829px;background-image: url(/static/index/image/43.png); background-size: 100% 100%;">
                </div>
            </div>
            <div class="code flexJA">
                <div class="icon">
                    <div style="background-image: url(https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo url('/')->domain(true); ?>register?code=<?php echo htmlentities($user_info['invite_code']); ?>); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                </div>
            </div>
            <div class="invite_title flexJA">邀请二维码</div>
            <div class="invite_code flexJA">邀请码：<?php echo htmlentities($user_info['invite_code']); ?></div>
            <div class="copy flexJA" onclick="copy_code()">
                <div class="btn flexJA">复制邀请码</div>
            </div>
            <div class="bar flexJA">
                <div class="tips">查看我的邀请人数</div>
                <div class="icon">
                    <div style="background-image: url(/static/index/image/47.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                </div>
            </div>
            <div class="bottom flexJA">
                <div class="icon" onclick="copy_image()">
                    <div style="background-image: url(/static/index/image/44.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                </div>
                <div class="icon" onclick="copy_url()">
                    <div style="background-image: url(/static/index/image/45.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                </div>
            </div>
        </div>
        <script src="/static/index/js/jquery.min.js"></script>
        <script>
            function copy_image() {
                toast({time: 3000, msg: '请长按二维码保存图片'});
            }
            function copy_code() {
                var tempTextArea = document.createElement("textarea");
                tempTextArea.value = "<?php echo htmlentities($user_info['invite_code']); ?>";
                document.body.appendChild(tempTextArea);
                tempTextArea.select();
                document.execCommand("copy");
                document.body.removeChild(tempTextArea);
                toast({time: 3000, msg: '复制成功'});
            }
            function copy_url() {
                var tempTextArea = document.createElement("textarea");
                tempTextArea.value = "<?php echo url('/')->domain(true); ?>register?code=<?php echo htmlentities($user_info['invite_code']); ?>";
                document.body.appendChild(tempTextArea);
                tempTextArea.select();
                document.execCommand("copy");
                document.body.removeChild(tempTextArea);
                toast({time: 3000, msg: '复制成功'});
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
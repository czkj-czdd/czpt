<?php /*a:2:{s:58:"/www/wwwroot/www.czysqcrxw.site/5555/view/index/batch.html";i:1728755286;s:66:"/www/wwwroot/www.czysqcrxw.site/5555/view/layout/index_footer.html";i:1728755148;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + 0px); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>批量导入</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/batch.css">
        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-home-batch" style="overflow: visible;">
        <div class="container">
            <div class="bg"></div>
            <div class="fixation">
                <div class="tab flexJA flexSb nav">
                    <div class="icon" onclick="window.history.back()">
                        <div style="background-image: url(/static/index/image/33.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="title white"></div>
                    <div class="icon"></div>
                </div>
                <div class="title">号码批量充值</div>
                <div class="card">
                    <input type="file" id="file" style="display: none;">
                    <div class="bar flexJA flexSb" id="uploadBtn">
                        <div class="text">导入表格批量导入</div>
                        <div class="lsj-file">
                            <div class="hFile">
                                <div class="flexJA flexFs">
                                    <div class="tips">点击导入</div>
                                    <duv class="icon">
                                        <div style="background-image: url(/static/index/image/83.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                                    </duv>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bar flexJA flexSb" onclick="manual_import()">
                        <div class="text">手动复制批量导入</div>
                        <div class="flexJA flexFs">
                            <div class="tips">点击输入</div>
                            <duv class="icon">
                                <div style="background-image: url(/static/index/image/84.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                            </duv>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="tab flexJA flexSa">
                        <div class="item status check" data-value="0">充值号码 (<span id="batch_ok_count"></span>)</div>
                        <div class="item status"  data-value="1">号码重复 (<span id="batch_no_count"></span>)</div>
                    </div>
                    <div class="list" id="batch_list" style="max-height: calc(113px);"></div>
                </div>
            </div>
            <div class="bottom">
                <div class="button button1 flexJA" style="margin-bottom: 9px;" onclick="dels()">一键清除</div>
                <a class="button flexJA" href="/product/<?php echo htmlentities($_REQUEST['id']); ?>">确认</a>
            </div>
        </div>

        <div id="manual_import_Modal" class="modal">
            <div class="modal-content">
                <div class="uni-popup__wrapper center" style="background-color: transparent;">
                    <div class="popup">
                        <div class="tips  flexJA flexSb">
                            注:多个号码用,隔开
                            <div class="icon" onclick="manual_import_close()">
                                <div style="background-image: url(/static/index/image/22.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                            </div>
                        </div>
                        <uni-textarea class="input">
                            <textarea maxlength="-1" enterkeyhint="return" class="uni-textarea-textarea" style="overflow-y: auto;" placeholder="请输入" id="manual_import"></textarea>
                        </uni-textarea>
                        <div class="bar flexJA">
                            <div class="button flexJA" onclick="add_batch()">确认</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="status">
        <script src="/static/index/js/jquery.min.js"></script>
		<script src="/static/index/js/layui/layui.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const items = document.querySelectorAll('.status');
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
                        batch_list();
                    });
                });
            });

            function batch_list(status) {
                $.post("/batch_list",{
                    status: $('#status').val(),
                },function(res){
                    let list = res.data.list,html =  "";
                    $("#batch_ok_count").html(res.batch_ok_count);
                    $("#batch_no_count").html(res.batch_no_count);
                    if (list.length > 0) {
                        $.each(list, function (index, item) {
                            html += `
                                <div class="item flexJA flexSb">
                                    <div class="text">${item['number']}</div>
                                    <div class="icon" onclick="del(${item['id']})">
                                        <div style="background-image: url(/static/index/image/85.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                                    </div>
                                </div>`;
                        })
                    }else{
                        html += ``;
                    }
                    $("#batch_list").html(html);
                },'json')
            }



            function add_batch() {
                $.ajax({
                    url: "/batch_post/add_batch",
                    method: 'POST',
                    data: {
                        manual_import: $('#manual_import').val(),
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
            
            function del(id) {
                $.ajax({
                    url: "/batch_post/del",
                    method: 'POST',
                    data: {
                        id:id
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            batch_list();
                        }else{
                            toast({time: 3000, msg: res.message});
                        }
                    }
                });
            }
            function dels() {
                $.ajax({
                    url: "/batch_post/dels",
                    method: 'POST',
                    data: {},
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            batch_list();
                            toast({time: 3000, msg: res.message});
                        }else{
                            toast({time: 3000, msg: res.message});
                        }
                    }
                });
            }

            
            function manual_import() {
                document.getElementById('manual_import_Modal').style.display = "block";
            }
            function manual_import_close() {
                document.getElementById('manual_import_Modal').style.display = "none";
            }
            var manual_import_modal = document.getElementById('manual_import_Modal');
            window.onclick = function(event) {
                if (event.target == manual_import_modal) {
                    manual_import_modal.style.display = "none";
                }
            }
        </script>

        
        <script>
            $(document).ready(function() {
                // 当文件选择框的内容改变时触发上传文件操作
                $('#file').on('change', function() {
                    var file = this.files[0];
                    var formData = new FormData();
                    formData.append('file', file);

                    $.ajax({
                        url: "/batch_post/upload_batch",
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(res) {
                            if (res.code === 200) {
                                batch_list();
                            } else {
                                toast({time: 3000, msg: res.message});
                            }
                        }
                    });
                });

                // 点击按钮触发文件选择框
                $('#uploadBtn').on('click', function() {
                    $('#file').click();
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
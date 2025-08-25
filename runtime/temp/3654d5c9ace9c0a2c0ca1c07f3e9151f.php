<?php /*a:3:{s:60:"/www/wwwroot/www.czysqcrxw.site/5555/view/index/product.html";i:1731339672;s:59:"/www/wwwroot/www.czysqcrxw.site/5555/view/plugin/addrs.html";i:1728193050;s:66:"/www/wwwroot/www.czysqcrxw.site/5555/view/layout/index_footer.html";i:1728755148;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo htmlentities((isset($product['name']) && ($product['name'] !== '')?$product['name']:'')); ?></title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/product.css">
        <link rel="stylesheet" type="text/css" href="/static/index/css/product.upload.css"/><!-- 图片上传 -->
        <script src="/static/index/js/product.upload.js"></script><!-- 图片上传 -->
        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-home-topUp2" style="overflow: visible;">
        <header header-type="default">
            <div class="header" style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);">
                <div class="header-hd" onclick="window.history.back()">
                    <div class="header-btn">
                        <i class="uni-btn-icon" style="color: rgb(0, 0, 0); font-size: 27px;"></i>
                    </div>
                    <div class="header-ft"></div>
                </div>
                <div class="header-bd">
                    <div class="header__title" style="font-size: 16px; opacity: 1;"><?php echo htmlentities((isset($product['name']) && ($product['name'] !== '')?$product['name']:'')); ?></div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <div class="container">
            <div class="form">
                <?php if($product['batch_status'] == 1): ?>
                <div class="types flexJA">
                    <div class="btn flexJA batch check">单个号码充值</div>
                    <div class="btn flexJA batch">批量号码充值</div>
                </div>
                <div class="card batch_b" style="display: none;">
                    <div class="bar flexJA flexSb">
                        <div class="icon">
                            <div style="background-image: url(/static/index/image/81.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;height: 100%;"></div>
                        </div>
                        <div class="text">号码批量充值</div>
                    </div>
                    <div class="title">当前已导入<span><?php echo htmlentities($batch_ok_count); ?></span>个号码</div>
                    <a class="btn flexJA" href="/batch?id=<?php echo htmlentities($product['id']); ?>">点击一键导入</a>
                </div>
                <?php endif; ?>

                <div class="main" style="padding-bottom: 0px;">
                    <div class="title flexJA flexSb">快速选择
                        <div style="color: rgb(56, 117, 244); font-size: 11px;" onclick="tutorial_content_Modal()">
                            <span>充值操作教程</span>
                        </div>
                    </div>
                    <div class="list flexJA flexWw flexFs">
                        <?php foreach($par_values as $key => $vo): if(!empty($vo['value'])): ?>
                        <div class="item flexJA" data-value="<?php echo htmlentities((isset($vo['value']) && ($vo['value'] !== '')?$vo['value']:'')); ?>"><?php echo isset($vo['name']) ? htmlentities($vo['name']) : htmlentities($vo['value']); ?></div>
                        <?php endif; ?>
                        <?php endforeach; foreach($par_values as $key => $vo): if(empty($vo['value'])): ?>
                        <div class="item flexJA" data-value="<?php echo htmlentities((isset($vo['value']) && ($vo['value'] !== '')?$vo['value']:'')); ?>"><?php echo isset($vo['name']) ? htmlentities($vo['name']) : htmlentities($vo['value']); ?></div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="line batch_a" style="width: 100%;"></div>
                <div class="order_info batch_a" style="padding: 13px;">
                    <?php foreach($order_info as $key => $vo): ?>
                    <div class="item <?php if($vo['type'] != 4): ?> flexJA flexSb<?php endif; ?>" <?php if((count($order_info) - 1) ==  $key): ?>style="border: none;"<?php endif; ?>>
                        <div class="title"><?php echo htmlentities($vo['name']); ?></div>
                        <div class="input">
                            <div class="uni-input-wrapper">
                                <?php if($vo['type'] == 1): ?>
                                    <input type="text" class="uni-input-input" placeholder="请输入<?php echo htmlentities($vo['name']); ?>">
                                <?php endif; if($vo['type'] == 2 || $vo['type'] == 3): ?>
                                    <input type="text" readonly="readonly" class="uni-input-input" placeholder="请选择<?php echo htmlentities($vo['name']); ?>" id="Addrs_<?php echo htmlentities($key); ?>" data-key="1-36-37">
                                <?php endif; if($vo['type'] == 4): ?>
                                <article class="upload-piclist upload-piclist_<?php echo htmlentities($key); ?>">
                                   <div class="upload-file upload-file_<?php echo htmlentities($key); ?>">
                                       <input type="file" class="file" id="file_<?php echo htmlentities($key); ?>" accept="image/*" multiple onchange="imgChange('<?php echo htmlentities($key); ?>')"/>
                                   </div>
                                </article>
                              <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="line" style="width: 100%;"></div>
            <div class="main">
                <div class="title">实充金额</div>
                <div class="input flexJA flexSb">
                    <div class="unit">￥</div>
                    <uni-input class="text">
                        <div class="uni-input-wrapper">
                            <input autocomplete="off" type="number" class="uni-input-input" placeholder="100" maxlength="140" pattern="[0-9]*" id="amount_money" oninput="discount();">
                        </div>
                    </uni-input>
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/38.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image>
                </div>
                <div class="discounts flexJA flexSb">
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/35.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image>
                    <div class="text inDiscountRange">折扣0 优惠-0元</div>
                </div>
                <div class="rate flexJA flexSb">
                    <uni-image class="icon">
                        <div style="background-image: url(/static/index/image/76.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                    </uni-image>
                    <div class="text">参考汇率 <?php echo htmlentities((isset($config['rate']) && ($config['rate'] !== '')?$config['rate']:'未设置')); ?></div>
                </div>
                <div class="total flexJA flexSb flexAib">
                    <div class="text">合计:</div>
                    <div class="symbol">$</div>
                    <div class="num cnyAmount">0</div>
                    <div class="unit">USDT</div>
                </div>
                <div class="button flexJA" onclick="confirm_recharge()">确认充值</div>
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
                        <div class="total flexJA">$<span class="cnyAmount">0.00</span>USDT</div>
                        <div class="bottom flexJA flexSb">
                            <div class="btn1 flexJA close">取消</div>
                            <div class="btn2 flexJA" onclick="confirm_payment()">确认支付</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="tutorial_content_Modal" class="modal">
            <div class="modal-content">
                <div class="uni-popup__wrapper center" style="background-color: transparent;">
                    <div class="popup tutorials">
                        <div class="title flexJA">充值操作教程</div>
                        <div class="desc">
                            <div class="wxParse">
                                <?php echo htmlentities((isset($product['tutorial_content']) && ($product['tutorial_content'] !== '')?$product['tutorial_content']:'')); ?>
                            </div>
                        </div>
                        <div class="bottom flexJA flexSb">
                            <div class="btn1 flexJA" onclick="tutorial_content_close(1)" style="text-align: center; font-size: 11px;">已查看，不再显示</div>
                            <div class="btn2 flexJA" onclick="tutorial_content_close(2)">关闭</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="batch_type" value="0">
        <script>
            function confirm_recharge() {
                var order_info = [];
                var items = document.getElementsByClassName('item');
                for (var i = 0; i < items.length; i++) {
                    // 获取输入框
                    var titleElement = items[i].getElementsByClassName('title')[0];
                    var inputElement = items[i].getElementsByClassName('uni-input-input')[0];
                    if (titleElement && inputElement) {
                        var title = titleElement.innerText;
                        var input = inputElement.value;
                        order_info.push('[' + title + ']' + input);
                    }
                    // 获取所有图片元素
                    var uploadPicItems = items[i].getElementsByClassName('upload-Picitem');
                    for (var j = 0; j < uploadPicItems.length; j++) {
                        var imgSrcElement = uploadPicItems[j].querySelector('img');
                        if (imgSrcElement) {
                            var imgSrc = imgSrcElement.getAttribute('src');
                            var title = titleElement.innerText;
                            order_info.push('[' + title + ']' + imgSrc);
                        }
                    }
                }

                $.ajax({
                    url: "/product_post/confirm_recharge",
                    method: 'POST',
                    data: {
                        product_id: "<?php echo htmlentities($product['id']); ?>",
                        amount_money: $('#amount_money').val(),
                        order_info: JSON.stringify(order_info),
                        batch_type: $('#batch_type').val(),
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            $(".balance").html(res.data.balance);
                            $(".cnyAmount").html(res.data.discount.cnyAmount);

                            document.getElementById('myModal').style.display = "block";
                        }else{
                            toast({time: 3000, msg: res.message});
                        }
                    }
                })
            }

            function confirm_payment() {
                var order_info = [];
                var items = document.getElementsByClassName('item');
                for (var i = 0; i < items.length; i++) {
                    // 获取输入框
                    var titleElement = items[i].getElementsByClassName('title')[0];
                    var inputElement = items[i].getElementsByClassName('uni-input-input')[0];
                    if (titleElement && inputElement) {
                        var title = titleElement.innerText;
                        var input = inputElement.value;
                        order_info.push('[' + title + ']' + input);
                    }
                    var uploadPicItems = items[i].getElementsByClassName('upload-Picitem');
                    for (var j = 0; j < uploadPicItems.length; j++) {
                        var imgSrcElement = uploadPicItems[j].querySelector('img');
                        if (imgSrcElement) {
                            var imgSrc = imgSrcElement.getAttribute('src');
                            var title = titleElement.innerText;
                            order_info.push('[' + title + ']' + imgSrc);
                        }
                    }
                }

                $.ajax({
                    url: "/product_post/confirm_payment",
                    method: 'POST',
                    data: {
                        product_id: "<?php echo htmlentities($product['id']); ?>",
                        amount_money: $('#amount_money').val(),
                        order_info: JSON.stringify(order_info),
                        batch_type: $('#batch_type').val(),
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            toast({time: 3000, msg: res.message});
                            setTimeout(function (){
                                window.location.href = `${res.data}`
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

            // 产品教程文章弹窗
            if(getLocalStorage('tutorial_content_<?php echo htmlentities($product['id']); ?>') == null){
                tutorial_content_Modal();
            }
            function tutorial_content_Modal() {
                document.getElementById('tutorial_content_Modal').style.display = "block";
            }
            function tutorial_content_close(type) {
                if(type == 1){
                    setLocalStorage("tutorial_content_<?php echo htmlentities($product['id']); ?>", 1);
                }
                document.getElementById('tutorial_content_Modal').style.display = "none";
            }
            var tutorial_content_modal = document.getElementById('tutorial_content_Modal');
            window.onclick = function(event) {
                if (event.target == tutorial_content_modal) {
                    tutorial_content_modal.style.display = "none";
                }
            }

            const batch = document.querySelectorAll('.batch');
            batch.forEach(btn => {
                btn.addEventListener('click', function() {
                    batch.forEach(b => b.classList.remove('check'));
                    this.classList.add('check');
                    if(this.textContent == '单个号码充值'){
                        $(".batch_a").show();
                        $(".batch_b").hide();
                        $("#batch_type").val(0);
                    }
                    if(this.textContent == '批量号码充值'){
                        $(".batch_a").hide();
                        $(".batch_b").show();
                        $("#batch_type").val(1);
                    }
                    discount();
                });
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
        <script>
            const items = document.querySelectorAll('.flexFs .item');
            items.forEach(item => {
                item.addEventListener('click', function() {
                    items.forEach(el => el.classList.remove('active'));
                    this.classList.add('active');
                    const dataValue = this.getAttribute('data-value');
                    $("#amount_money").val(dataValue);
                    if(!dataValue){
                        const input = document.getElementById('amount_money');
                        input.focus();
                        input.setSelectionRange(input.value.length, input.value.length);
                    }
                    discount();
                });
            });

            function discount() {
                $.ajax({
                    url: "/product_post/discount",
                    method: 'POST',
                    data: {
                        product_id: "<?php echo htmlentities($product['id']); ?>",
                        amount_money: $('#amount_money').val(),
                        batch_type: $('#batch_type').val(),
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            if(res.data.inDiscountRange == 1){
                                $(".inDiscountRange").html(`折扣${res.data.discount} 优惠-${res.data.discountAmount}元`);
                            }else{
                                $(".inDiscountRange").html('折扣无 优惠-0.00元');
                            }
                            $(".cnyAmount").html(res.data.cnyAmount);
                        }
                    }
                });
            }
        </script>
        <link href="/static/plugin/css/style.css" rel="stylesheet" type="text/css" />
<link href="/static/plugin/css/scs.css" rel="stylesheet">
<script src="/static/plugin/js/jquery.min.js"></script>
<script src="/static/plugin/js/xz.js"></script>
<script src="/static/plugin/js/CNAddrArr.js"></script>
<?php if(!empty($order_info)): foreach($order_info as $key => $vo): if($vo['type'] == 2): ?>
            <script>
            $(function() {
                /**
                 * 通过数组id获取地址列表数组
                 *
                 * @param {Number} id
                 * @return {Array} 
                 */ 
                function getAddrsArrayById(id) {
                    var results = [];
                    if (addr_arr[id] != undefined)
                        addr_arr[id].forEach(function(subArr) {
                            results.push({
                                key: subArr[0],
                                val: subArr[1]
                            });
                        });
                    else {
                        return;
                    }
                    return results;
                }
                /**
                 * 通过开始的key获取开始时应该选中开始数组中哪个元素
                 *
                 * @param {Array} StartArr
                 * @param {Number|String} key
                 * @return {Number} 
                 */         
                function getStartIndexByKeyFromStartArr(startArr, key) {
                    var result = 0;
                    if (startArr != undefined)
                        startArr.forEach(function(obj, index) {
                            if (obj.key == key) {
                                result = index;
                                return false;
                            }
                        });
                    return result;
                }
                $("#Addrs_<?php echo htmlentities($key); ?>").click(function() {
                    var PROVINCES = [],
                        startCities = [],
                        startDists = [];
                    //Province data，shall never change.
                    addr_arr[0].forEach(function(prov) {
                        PROVINCES.push({
                            key: prov[0],
                            val: prov[1]
                        });
                    });
                    //init other data.
                    var $input = $(this),
                        dataKey = $input.attr("data-key"),
                        provKey = 1, //default province 北京
                        cityKey = 36, //default city 北京
                        distKey = 37, //default district 北京东城区
                        distStartIndex = 0, //default 0
                        cityStartIndex = 0, //default 0
                        provStartIndex = 0; //default 0

                    if (dataKey != "" && dataKey != undefined) {
                        var sArr = dataKey.split("-");
                        if (sArr.length == 3) {
                            provKey = sArr[0];
                            cityKey = sArr[1];
                            distKey = sArr[2];

                        } else if (sArr.length == 2) { //such as 台湾，香港 and the like.
                            provKey = sArr[0];
                            cityKey = sArr[1];
                        }
                        startCities = getAddrsArrayById(provKey);
                        startDists = getAddrsArrayById(cityKey);
                        provStartIndex = getStartIndexByKeyFromStartArr(PROVINCES, provKey);
                        cityStartIndex = getStartIndexByKeyFromStartArr(startCities, cityKey);
                        distStartIndex = getStartIndexByKeyFromStartArr(startDists, distKey);
                    }
                    var navArr = [{//3 scrollers, and the title and id will be as follows:
                        title: "省",
                        id: "scs_items_prov"
                    }, {
                        title: "市",
                        id: "scs_items_city"
                    }, {
                        title: "区",
                        id: "scs_items_dist"
                    }];
                    SCS.init({
                        navArr: navArr,
                        onOk: function(selectedKey, selectedValue) {
                            $input.val(selectedValue).attr("data-key", selectedKey);
                        }
                    });
                    var distScroller = new SCS.scrollCascadeSelect({
                        el: "#" + navArr[2].id,
                        dataArr: startDists,
                        startIndex: distStartIndex
                    });
                    var cityScroller = new SCS.scrollCascadeSelect({
                        el: "#" + navArr[1].id,
                        dataArr: startCities,
                        startIndex: cityStartIndex,
                        onChange: function(selectedItem, selectedIndex) {
                            distScroller.render(getAddrsArrayById(selectedItem.key), 0); //re-render distScroller when cityScroller change
                        }
                    });
                    var provScroller = new SCS.scrollCascadeSelect({
                        el: "#" + navArr[0].id,
                        dataArr: PROVINCES,
                        startIndex: provStartIndex,
                        onChange: function(selectedItem, selectedIndex) { //re-render both cityScroller and distScroller when provScroller change
                            cityScroller.render(getAddrsArrayById(selectedItem.key), 0);
                            distScroller.render(getAddrsArrayById(cityScroller.getSelectedItem().key), 0);
                        }
                    });
                });
            });
            </script>
        <?php endif; if($vo['type'] == 3): ?>
            <script>
            $(function() {
                /**
                 * 通过数组id获取地址列表数组
                 *
                 * @param {Number} id
                 * @return {Array} 
                 */ 
                function getAddrsArrayById(id) {
                    var results = [];
                    if (addr_arr[id] != undefined)
                        addr_arr[id].forEach(function(subArr) {
                            results.push({
                                key: subArr[0],
                                val: subArr[1]
                            });
                        });
                    else {
                        return;
                    }
                    return results;
                }
                /**
                 * 通过开始的key获取开始时应该选中开始数组中哪个元素
                 *
                 * @param {Array} StartArr
                 * @param {Number|String} key
                 * @return {Number} 
                 */         
                function getStartIndexByKeyFromStartArr(startArr, key) {
                    var result = 0;
                    if (startArr != undefined)
                        startArr.forEach(function(obj, index) {
                            if (obj.key == key) {
                                result = index;
                                return false;
                            }
                        });
                    return result;
                }
                $("#Addrs_<?php echo htmlentities($key); ?>").click(function() {
                    var PROVINCES = [],
                        startCities = [],
                        startDists = [];
                    //Province data，shall never change.
                    addr_arr[0].forEach(function(prov) {
                        PROVINCES.push({
                            key: prov[0],
                            val: prov[1]
                        });
                    });
                    //init other data.
                    var $input = $(this),
                        dataKey = $input.attr("data-key"),
                        provKey = 1, //default province 北京
                        cityKey = 36, //default city 北京
                        distKey = 37, //default district 北京东城区
                        distStartIndex = 0, //default 0
                        cityStartIndex = 0, //default 0
                        provStartIndex = 0; //default 0

                    if (dataKey != "" && dataKey != undefined) {
                        var sArr = dataKey.split("-");
                        if (sArr.length == 3) {
                            provKey = sArr[0];
                            cityKey = sArr[1];
                            distKey = sArr[2];

                        } else if (sArr.length == 2) { //such as 台湾，香港 and the like.
                            provKey = sArr[0];
                            cityKey = sArr[1];
                        }
                        startCities = getAddrsArrayById(provKey);
                        startDists = getAddrsArrayById(cityKey);
                        provStartIndex = getStartIndexByKeyFromStartArr(PROVINCES, provKey);
                        cityStartIndex = getStartIndexByKeyFromStartArr(startCities, cityKey);
                        distStartIndex = getStartIndexByKeyFromStartArr(startDists, distKey);
                    }
                    var navArr = [{//3 scrollers, and the title and id will be as follows:
                        title: "省",
                        id: "scs_items_prov"
                    }, {
                        title: "市",
                        id: "scs_items_city"
                    }];
                    SCS.init({
                        navArr: navArr,
                        onOk: function(selectedKey, selectedValue) {
                            $input.val(selectedValue).attr("data-key", selectedKey);
                        }
                    });
                    var cityScroller = new SCS.scrollCascadeSelect({
                        el: "#" + navArr[1].id,
                        dataArr: startCities,
                        startIndex: cityStartIndex,
                        onChange: function(selectedItem, selectedIndex) {
                            distScroller.render(getAddrsArrayById(selectedItem.key), 0); //re-render distScroller when cityScroller change
                        }
                    });
                    var provScroller = new SCS.scrollCascadeSelect({
                        el: "#" + navArr[0].id,
                        dataArr: PROVINCES,
                        startIndex: provStartIndex,
                        onChange: function(selectedItem, selectedIndex) { //re-render both cityScroller and distScroller when provScroller change
                            cityScroller.render(getAddrsArrayById(selectedItem.key), 0);
                            distScroller.render(getAddrsArrayById(cityScroller.getSelectedItem().key), 0);
                        }
                    });
                });
            });
            </script>
        <?php endif; ?>
    <?php endforeach; else: ?>
<script>
    $(function() {
        /**
         * 通过数组id获取地址列表数组
         *
         * @param {Number} id
         * @return {Array} 
         */ 
        function getAddrsArrayById(id) {
            var results = [];
            if (addr_arr[id] != undefined)
                addr_arr[id].forEach(function(subArr) {
                    results.push({
                        key: subArr[0],
                        val: subArr[1]
                    });
                });
            else {
                return;
            }
            return results;
        }
        /**
         * 通过开始的key获取开始时应该选中开始数组中哪个元素
         *
         * @param {Array} StartArr
         * @param {Number|String} key
         * @return {Number} 
         */         
        function getStartIndexByKeyFromStartArr(startArr, key) {
            var result = 0;
            if (startArr != undefined)
                startArr.forEach(function(obj, index) {
                    if (obj.key == key) {
                        result = index;
                        return false;
                    }
                });
            return result;
        }
        $("#Addrs").click(function() {
            var PROVINCES = [],
                startCities = [],
                startDists = [];
            //Province data，shall never change.
            addr_arr[0].forEach(function(prov) {
                PROVINCES.push({
                    key: prov[0],
                    val: prov[1]
                });
            });
            //init other data.
            var $input = $(this),
                dataKey = $input.attr("data-key"),
                provKey = 1, //default province 北京
                cityKey = 36, //default city 北京
                distKey = 37, //default district 北京东城区
                distStartIndex = 0, //default 0
                cityStartIndex = 0, //default 0
                provStartIndex = 0; //default 0

            if (dataKey != "" && dataKey != undefined) {
                var sArr = dataKey.split("-");
                if (sArr.length == 3) {
                    provKey = sArr[0];
                    cityKey = sArr[1];
                    distKey = sArr[2];

                } else if (sArr.length == 2) { //such as 台湾，香港 and the like.
                    provKey = sArr[0];
                    cityKey = sArr[1];
                }
                startCities = getAddrsArrayById(provKey);
                startDists = getAddrsArrayById(cityKey);
                provStartIndex = getStartIndexByKeyFromStartArr(PROVINCES, provKey);
                cityStartIndex = getStartIndexByKeyFromStartArr(startCities, cityKey);
                distStartIndex = getStartIndexByKeyFromStartArr(startDists, distKey);
            }
            var navArr = [{//3 scrollers, and the title and id will be as follows:
                title: "省",
                id: "scs_items_prov"
            }, {
                title: "市",
                id: "scs_items_city"
            }, {
                title: "区",
                id: "scs_items_dist"
            }];
            SCS.init({
                navArr: navArr,
                onOk: function(selectedKey, selectedValue) {
                    $input.val(selectedValue).attr("data-key", selectedKey);
                }
            });
            var distScroller = new SCS.scrollCascadeSelect({
                el: "#" + navArr[2].id,
                dataArr: startDists,
                startIndex: distStartIndex
            });
            var cityScroller = new SCS.scrollCascadeSelect({
                el: "#" + navArr[1].id,
                dataArr: startCities,
                startIndex: cityStartIndex,
                onChange: function(selectedItem, selectedIndex) {
                    distScroller.render(getAddrsArrayById(selectedItem.key), 0); //re-render distScroller when cityScroller change
                }
            });
            var provScroller = new SCS.scrollCascadeSelect({
                el: "#" + navArr[0].id,
                dataArr: PROVINCES,
                startIndex: provStartIndex,
                onChange: function(selectedItem, selectedIndex) { //re-render both cityScroller and distScroller when provScroller change
                    cityScroller.render(getAddrsArrayById(selectedItem.key), 0);
                    distScroller.render(getAddrsArrayById(cityScroller.getSelectedItem().key), 0);
                }
            });
        });
    });
    </script>

<?php endif; ?>
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
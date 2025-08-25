<?php /*a:3:{s:56:"/www/wwwroot/th.pay51888.vip/view/index/information.html";i:1736872451;s:51:"/www/wwwroot/th.pay51888.vip/view/plugin/addrs.html";i:1736872451;s:58:"/www/wwwroot/th.pay51888.vip/view/layout/index_footer.html";i:1736872451;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>个人资料</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
		<link rel="stylesheet" href="/static/index/css/information.css">

        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
	</head>
	<body class="uni-body pages-user-information" style="overflow: visible;">
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
                        个人资料
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <div class="container">
            <div class="upload" id="upload">
                <input type="file" id="picture_upload" accept=".png, .jpg, .jpeg" style="display: none;" />
                <uni-image class="photo avatar">
                    <div style="background-image: url('<?php echo htmlentities((isset($user_info['avatar']) && ($user_info['avatar'] !== '')?$user_info['avatar']:"/static/index/image/user_avatar.jpg")); ?>'); background-position: center center; background-size: cover; background-repeat: no-repeat;"></div>
                </uni-image>
                <uni-image class="icon">
                    <div style="background-image: url('/static/index/image/24.png'); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                </uni-image>
                <input type="hidden" id="avatar" value="<?php echo htmlentities((isset($user_info['avatar']) && ($user_info['avatar'] !== '')?$user_info['avatar']:"")); ?>"/>
            </div>
            <div class="list">
                <div class="item flexJA flexSb">
                    <div class="title">昵称</div>
                    <div class="right">
                        <uni-input class="input">
                            <div class="uni-input-wrapper">
                                <input type="text" class="uni-input-input" placeholder="请输入昵称" maxlength="11" id="nickname" value="<?php echo htmlentities((isset($user_info['nickname']) && ($user_info['nickname'] !== '')?$user_info['nickname']:"")); ?>">
                            </div>
                        </uni-input>
                    </div>
                </div>
                <div class="item flexJA flexSb">
                    <div class="title">姓氏</div>
                    <div class="right">
                        <uni-input class="input">
                            <div class="uni-input-wrapper">
                                <input type="text" class="uni-input-input" placeholder="请输入(选填)" id="surname" value="<?php echo htmlentities((isset($user_info['surname']) && ($user_info['surname'] !== '')?$user_info['surname']:"")); ?>">
                            </div>
                        </uni-input>
                    </div>
                </div>
                <div class="item flexJA flexSb">
                    <div class="title">性别</div>
                    <div class="right">
                        <input type="hidden" id="gender" value="<?php echo htmlentities((isset($user_info['gender']) && ($user_info['gender'] !== '')?$user_info['gender']:"")); ?>">

                        <div class="uni-data-checklist" style="margin-top: 0px;">
                            <div class="checklist-group">
                                <div class="checklist-box div-pointer is--default <?php if(!empty($user_info['gender']) && $user_info['gender'] == 1): ?>is-checked<?php endif; ?>"  data-value="1">
                                    <div class="radio__inner">
                                        <div class="radio__inner-icon"></div>
                                    </div>
                                    <div class="checklist-content">
                                        <div class="checklist-text">
                                            <span onclick="selectOption(this)">先生</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="checklist-box div-pointer is--default <?php if(!empty($user_info['gender']) && $user_info['gender'] == 2): ?>is-checked<?php endif; ?>" data-value="2">
                                    <div class="radio__inner">
                                        <div class="radio__inner-icon"></div>
                                    </div>
                                    <div class="checklist-content">
                                        <div class="checklist-text">
                                            <span onclick="selectOption(this)">女士</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="checklist-box div-pointer is--default <?php if(!empty($user_info['gender']) && $user_info['gender'] == 0 || empty($user_info['gender'])): ?>is-checked<?php endif; ?>" data-value="0">
                                    <div class="radio__inner">
                                        <div class="radio__inner-icon"></div>
                                    </div>
                                    <div class="checklist-content">
                                        <div class="checklist-text">
                                            <span onclick="selectOption(this)">保密</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item flexJA flexSb">
                    <div class="title">城市</div>
                    <div class="right">
                        <uni-input class="input">
                            <div class="uni-input-wrapper">
                                <input type="text" class="uni-input-input" placeholder="请选择城市" id="Addrs" data-key="1-36-37" value="<?php echo htmlentities((isset($user_info['city']) && ($user_info['city'] !== '')?$user_info['city']:"")); ?>">
                            </div>
                        </uni-input>
                    </div>
                </div>
                <div class="item flexJA flexSb">
                    <div class="title">生日</div>
                    <div class="right">
                        <uni-input class="input">
                            <div class="uni-input-wrapper">
                                <input type="text" class="uni-input-input" placeholder="请选择日期" id="birthday" value="<?php echo htmlentities((isset($user_info['birthday']) && ($user_info['birthday'] !== '')?$user_info['birthday']:"")); ?>">
                            </div>
                        </uni-input>
                    </div>
                </div>
            </div>
            <div class="bottom">
                <div class="button flexJA" onclick="submit()">保存</div>
            </div>
        </div>
        <script type="text/javascript" src="/static/index/js/mobileSelect.min.js"></script>
        <script src="/static/index/js/jquery.min.js"></script>
        <script type="text/javascript" src="/static/index/js/selectDate.js"></script>
        <script type="text/javascript">
            function submit() {
                $.ajax({
                    url: "/account_settings_post/information",
                    method: 'POST',
                    data: {
                        avatar: $('#avatar').val(),
                        nickname: $('#nickname').val(),
                        surname: $('#surname').val(),
                        city: $('#Addrs').val(),
                        birthday: $('#birthday').val(),
                        gender: $('#gender').val(),
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            toast({time: 3000, msg: res.message});
                        }else{
                            toast({time: 3000, msg: res.message});
                        }

                    }
                });
            }


            function selectOption(element) {
                var selectedOption = event.target.closest('.checklist-box');
                var selectedValue = selectedOption.getAttribute('data-value');
                $("#gender").val(selectedValue);

                // 移除所有选中状态
                var allOptions = document.querySelectorAll('.checklist-box');
                allOptions.forEach(function(option) {
                    option.classList.remove('is-checked');
                });
        
                var selectedOption = element.closest('.checklist-box');
                selectedOption.classList.add('is-checked');
            }

            $.selectDate("#birthday",{},function (data) {
                console.log(data);
                $("#birthday").val(data.year+"-"+data.month+"-"+data.day);
            });

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
                                $('.avatar').html(`<div style="background-image: url('${res.data}'); background-position: center center; background-size: cover; background-repeat: no-repeat;"></div>`);
                                $('#avatar').val(res.data);
                            } else {
                                toast({time: 3000, msg: res.message});
                            }
                        }
                    });
                }
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
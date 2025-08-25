<?php /*a:1:{s:64:"/www/wwwroot/www.czysqcrxw.site/5555/view/index/order_query.html";i:1731260597;}*/ ?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>SchoolGirl's Shop</title>
	<script src="https://lib.baomitu.com/vue/2.7.4/vue.min.js"></script>
	<script src="https://lib.baomitu.com/element-ui/2.15.9/index.js"></script>
	<link href="https://lib.baomitu.com/element-ui/2.15.9/theme-chalk/index.min.css" rel="stylesheet">
	<script src="https://lib.baomitu.com/jquery/3.6.0/jquery.js"></script>
	<link crossorigin="anonymous" integrity="sha512-I2U/uKXC9MvBXLNfIV8WYVBRbYS4vMFDr/LZxzBWzo4zaJ7wV4AQytk+osLgRCPTzJ7h9VNaa8seIwLl1H2iYw==" href="https://lib.baomitu.com/vant/2.12.48/index.css" rel="stylesheet">
	<script crossorigin="anonymous" integrity="sha512-q67OMX4cXCyMbd2bce1JiPTFS6pvkvmxFjwV4zxAo0xCCacPENecwec4VpU9jwLdfENizPiIssVbvLHC1uQ/SA==" src="https://lib.baomitu.com/vant/2.12.48/vant.js"></script>
	<style type="text/css">
		.qa-sdk-wrapper {
		  position: fixed;
		  z-index: 10000;
		  width: 400px;
		  right: -600px;
		  max-height: 530px;
		  overflow: hidden;
		  border-radius: 4px;
		  box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.1);
		  transition: all 0.5s ease-in-out;
		  background: #fff;
		}
		
		.qa-sdk-close-btn {
		  display: inline-block;
		  width: 18px;
		  height: 18px;
		  cursor: pointer;
		  position: absolute;
		  top: 16px;
		  right: 16px;
		}
		
		.qa-sdk-close-btn:hover {
		  border-radius: 50%;
		  background-color: #d5d9df;
		}
	</style>

        <link rel="stylesheet" href="/static/index/css/base.css"><!-- 提示弹出 -->
        <script src="/static/index/js/message.js"></script><!-- 提示弹出 -->
</head>
<body style="background-color: #f3f4f6">

	<div class="el-row el-row--flex">
		<div class="el-col el-col-24 el-col-xs-20 el-col-sm-15 el-col-md-20 el-col-lg-10" style="margin: auto;">
			<div class="el-card box-card is-always-shadow">
				<!---->
				<div class="el-card__body">
					<p style="text-align: center; font-size: 24px;">订单查询</p>
					<br>
					<div class="el-tabs el-tabs--top">
						<div class="el-tabs__header is-top">
							<div class="el-tabs__nav-wrap is-top">
								<div class="el-tabs__nav-scroll">
									<div role="tablist" class="el-tabs__nav is-top" style="transform: translateX(0px);">
										<div class="el-tabs__active-bar is-top" style="width: 56px; transform: translateX(0px);"></div>
										<div id="tab-cha" aria-controls="pane-cha" role="tab" tabindex="0" class="el-tabs__item is-top is-active" aria-selected="true">进度查询</div>
									</div>
								</div>
							</div>
						</div>
						<div class="el-tabs__content">
							<div class="el-form-item">
							    <input type="text" autocomplete="off" placeholder="请输入下单账号" class="el-input__inner" id="order_content">
							</div>
							<div class="el-form-item">
								<div class="el-form-item__content">
									<button type="button" class="el-button el-button--primary" style="width: 100%;" onclick="submit()">理财信息</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="el-row el-row--flex">
		<div class="el-col el-col-24 el-col-xs-20 el-col-sm-15 el-col-md-20 el-col-lg-10 order_info" style="margin: auto;">

		</div>
	</div>
	<script src="/static/index/js/jquery.min.js"></script>
	<script src="/static/index/js/mSlider.min.js"></script>
	<script type="text/javascript">
    	function submit() {
            $.ajax({
                url: "/order_query",
                method: 'POST',
                data: {
                    order_content: $('#order_content').val(),
                },
                dataType: 'json',
                success: function(res) {
                    if (res.code === 200) {
                        toast({time: 3000, msg: res.message});
                        
                        
                    var order_info = '';
                    for (var i = 0; i < res.data.length; i++) {
                        var item = res.data[i];
                        if(item.status == 0){
                            var status = '待充值';
                        }
                        if(item.status == 1){
                            var status = '充值中';
                        }
                        if(item.status == 2){
                            var status = '已完成';
                        }
                        if(item.status == 3){
                            var status = '已取消';
                        }
                        order_info += `
            			<div class="el-card box-card is-always-shadow">
            				<div class="el-card__header">
            					<div class="clearfix">
            						<span>${item.product_info.name} - ${item.product_info.describe}</span>
            					</div>
            				</div>
            				<div class="el-card__body">
            					<div role="feed" class="van-list">
                					<div class="van-cell">
            							<div class="van-cell__value van-cell__value--alone">
            								订单类型：
            								<span class="van-tag van-tag--plain van-tag--primary"> ${item.product_info.name}</span>
            							</div>
            						</div>
            						<div class="van-cell">
            							<div class="van-cell__value van-cell__value--alone">
            								订单状态：
            								<span class="van-tag van-tag--primary">${status}</span>
            							</div>
            						</div>
            						<div class="van-cell">
            							<div class="van-cell__value van-cell__value--alone">
            								下单时间：${item.create_time}
            							</div>
            						</div>
            						<div class="van-list__placeholder"></div>
            					</div>
            				</div>
            			</div>`;
                    }
                    $('.order_info').html(order_info);

                        
                        
                    }else{
                        toast({time: 3000, msg: res.message});
                    }

                }
            });
        }
	</script>
</body>
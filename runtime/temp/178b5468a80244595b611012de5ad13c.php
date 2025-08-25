<?php /*a:1:{s:61:"/www/wwwroot/www.biand.xyz/view/index/order_voucher_edit.html";i:1736820246;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>编辑凭证</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="/static/index/css/order_voucher_edit.css">
        
	</head>
	<body class="uni-body pages-order-orderDetails">
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
                        编辑凭证
                    </div>
                </div>
                <div class="header-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </header>
        <input type="hidden" name="order_id" id="order_id" value="<?php echo htmlentities($list['order_id']); ?>">
        <div class="container">
        	<div class="photo flexJA flexFs">
        		<uni-image class="icon">
        			<img src="/static/image/115.png" draggable="false">
        		</uni-image>
        		<div class="text">商户图标</div>
        		<div class="blue">修改</div>
        	</div>
        	<div class="item">
        		<div class="bar flexJA flexFs bb1">
        			<div class="text">标题名称：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
    					<input class="uni-input-input" placeholder="请输入" id="name" value="<?php echo htmlentities($list['name']); ?>">
        				</div>
        			</uni-input>
        		</div>
        		<div class="bar flexJA flexFs">
        			<div class="text">充值金额：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
    					<input class="uni-input-input" placeholder="请输入" id="money" value="<?php echo htmlentities($list['money']); ?>">
        				</div>
        			</uni-input>
        		</div>
        	</div>
        	<div class="tips">注：以下标题/内容都可以修改</div>
        	<div class="item">
        		<div class="bar flexJA flexFs bb1">
        			<div class="text">标题：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
        				    <input class="uni-input-input" placeholder="请输入" id="title1" value="<?php echo htmlentities($list['title1']); ?>">
        				</div>
        			</uni-input>
        		</div>
        		<div class="bar flexJA flexFs">
        			<div class="text">内容：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
        				    <input class="uni-input-input" placeholder="请输入" id="remark1" value="<?php echo htmlentities($list['remark1']); ?>">
        				</div>
        			</uni-input>
        		</div>
        	</div>
        	<div class="item">
        		<div class="bar flexJA flexFs bb1">
        			<div class="text">标题：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
        				    <input class="uni-input-input" placeholder="请输入" id="title2" value="<?php echo htmlentities($list['title2']); ?>">
        				</div>
        			</uni-input>
        		</div>
        		<div class="bar flexJA flexFs">
        			<div class="text">内容：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
        				    <input class="uni-input-input" placeholder="请输入" id="remark2" value="<?php echo htmlentities($list['remark2']); ?>">
        				</div>
        			</uni-input>
        		</div>
        	</div>
        	<div class="item">
        		<div class="bar flexJA flexFs bb1">
        			<div class="text">标题：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
        				    <input class="uni-input-input" placeholder="请输入" id="title3" value="<?php echo htmlentities($list['title3']); ?>">
        				</div>
        			</uni-input>
        		</div>
        		<div class="bar flexJA flexFs">
        			<div class="text">内容：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
        				    <input class="uni-input-input" placeholder="请输入" id="remark3" value="<?php echo htmlentities($list['remark3']); ?>">
        				</div>
        			</uni-input>
        		</div>
        	</div>
        	<div class="item">
        		<div class="bar flexJA flexFs bb1">
        			<div class="text">标题：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
        				    <input class="uni-input-input" placeholder="请输入" id="title4" value="<?php echo htmlentities($list['title4']); ?>">
        				</div>
        			</uni-input>
        		</div>
        		<div class="bar flexJA flexFs">
        			<div class="text">内容：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
        				    <input class="uni-input-input" placeholder="请输入" id="remark4" value="<?php echo htmlentities($list['remark4']); ?>">
        				</div>
        			</uni-input>
        		</div>
        	</div>
        	<div class="item">
        		<div class="bar flexJA flexFs bb1">
        			<div class="text">标题：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
        				    <input class="uni-input-input" placeholder="请输入" id="title5" value="<?php echo htmlentities($list['title5']); ?>">
        				</div>
        			</uni-input>
        		</div>
        		<div class="bar flexJA flexFs">
        			<div class="text">内容：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
        				    <input class="uni-input-input" placeholder="请输入" id="remark5" value="<?php echo htmlentities($list['remark5']); ?>">
        				</div>
        			</uni-input>
        		</div>
        	</div>
        	<div class="item">
        		<div class="bar flexJA flexFs bb1">
        			<div class="text">标题：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
        				    <input class="uni-input-input" placeholder="请输入"  id="title6" value="<?php echo htmlentities($list['title6']); ?>">
        				</div>
        			</uni-input>
        		</div>
        		<div class="bar flexJA flexFs">
        			<div class="text">内容：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
        				    <input class="uni-input-input" placeholder="请输入" id="remark6" value="<?php echo htmlentities($list['remark6']); ?>">
        				</div>
        			</uni-input>
        		</div>
        	</div>
        	<div class="item">
        		<div class="bar flexJA flexFs bb1">
        			<div class="text">标题：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
        					 <input class="uni-input-input" placeholder="请输入"  id="title7" value="<?php echo htmlentities($list['title7']); ?>">
        				</div>
        			</uni-input>
        		</div>
        		<div class="bar flexJA flexFs">
        			<div class="text">内容：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
        				     <input class="uni-input-input" placeholder="请输入" id="remark7" value="<?php echo htmlentities($list['remark7']); ?>">
        				</div>
        			</uni-input>
        		</div>
        	</div>
        	<div class="item">
        		<div class="bar flexJA flexFs bb1">
        			<div class="text">标题：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
        				  <input class="uni-input-input" placeholder="请输入"  id="title8" value="<?php echo htmlentities($list['title8']); ?>">
        				</div>
        			</uni-input>
        		</div>
        		<div class="bar flexJA flexFs">
        			<div class="text">内容：</div>
        			<uni-input class="input">
        				<div class="uni-input-wrapper">
        				  <input class="uni-input-input" placeholder="请输入" id="remark8" value="<?php echo htmlentities($list['remark8']); ?>">
        				</div>
        			</uni-input>
        		</div>
        	</div>
        	<div class="bottom flexJA">
        		<div class="button flexJA" onclick="edit()">保存</div>
        	</div>
        </div>
  <script src="/static/index/js/jquery.min.js"></script>
  
    <script>
            function edit() {
                $.ajax({
                    url: "/payment_voucher/edit",
                    method: 'POST',
                    data: {
                        order_id: $('#order_id').val(),
                        name: $('#name').val(),
                        money: $('#money').val(),
                        title1: $('#title1').val(),
                        remark1: $('#remark1').val(),
                        title2: $('#title2').val(),
                        remark2: $('#remark2').val(),
                        title3: $('#title3').val(),
                        remark3: $('#remark3').val(),
                        title4: $('#title4').val(),
                        remark4: $('#remark4').val(),
                        title5: $('#title5').val(),
                        remark5: $('#remark5').val(),
                        title6: $('#title6').val(),
                        remark6: $('#remark6').val(),
                        title7: $('#title7').val(),
                        remark7: $('#remark7').val(),
                        title8: $('#title8').val(),
                        remark8: $('#remark8').val(),
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                          
                            setTimeout(function (){
                                alert('操作成功')
                                window.location.href = '/order_voucher?id='+$('#order_id').val()
                            },1500);
                        }else{
                            alert('操作失败')
                        }

                    }
                });
            }
     
        </script>
  
  
	</body>
</html>
(function() {
	// 滑动组件 验证人机
	$.fn.slideComponent = function(o) {
		// 在这里定义组件的实现逻辑
		console.log('滑动组件参数 o :', o)
 
		let div = `    <div class="container huadong">
	    <canvas width="310" height="155" id="canvas"></canvas>
	     <canvas width="310" height="155" id="block"></canvas>
	    <div class="refreshIcon"></div>
	    <div class="bar">
	         <div id="bar-mask">
	            <div class="verSliderBlock" style="background:https://etfinfo.xcf.cn/appletImg/puzzle-right.png !important;backgroundSize:100% !important"></div>
	        </div>
	         <span id="slide">向右滑动验证</span>
	    </div>
	</div>`
		layer.open({
			title: false,
			btn: '取消',
			closeBtn: 0,
			skin: 'diy-huadong-layer',
			content: div,
			success: function(layero, index) {
				$('.diy-huadong-layer').prev().attr("style",
					"z-index: 1989101600 !important;background-color: rgb(0, 0, 0);opacity: 0.3;");
			},
		});
		console.log('滑动开始')
		var canvas = document.getElementById('canvas');
		console.log('滑动开始 canvas', canvas)
		var block = document.getElementById('block');
		var canvas_ctx = canvas.getContext('2d')
		var block_ctx = block.getContext('2d')
		var img = document.createElement('img')
		var refresh = document.querySelector('.refreshIcon')
		var x = Math.round(Math.random() * 200) + 10,
			y = Math.round(Math.random() * 100) + 10,
			w = 42,
			l = 42,
			r = 10,
			PI = Math.PI
		console.log(x, y)
		//获取图片后面的随机号码
		function getRandomNumberByRange(start, end) {
			return Math.round(Math.random() * (end - start) + start)
		}
		//初始化图片
		function initImg() {
			img.onload = function() {
				canvas_ctx.drawImage(img, 0, 0, 310, 155)
				block_ctx.drawImage(img, 0, 0, 310, 155)
				var blockWidth = w + r * 2
				var _y = y - r * 2 + 2 // 滑块实际的y坐标
				var ImageData = block_ctx.getImageData(x, _y, blockWidth, blockWidth)
				block.width = blockWidth
				block_ctx.putImageData(ImageData, 0, _y)
			};
			// 随机滑动验证背景图片
			var imgIndex = Math.round(Math.random() * 13 + 1)
			let imgUrl = 'https://etfinfo.xcf.cn/appletImg/' + `puzzle-bg${imgIndex}.png`;
			console.log('imgUrl:', imgUrl)
			img.crossOrigin = "Anonymous"
			img.src = imgUrl
			// img.src = 'https://picsum.photos/300/150/?image=' + getRandomNumberByRange(0, 100)
		}
		//清除tupian
		function clean() {
			x = Math.round(Math.random() * 200) + 10,
				y = Math.round(Math.random() * 100) + 10,
				console.log(x, y)
			canvas_ctx.clearRect(0, 0, 310, 155);
			block_ctx.clearRect(0, 0, 310, 155)
			block.width = 310
			draw(canvas_ctx, 'fill')
			draw(block_ctx, 'clip')
		}
		//绘制方块
		function draw(ctx, operation) {
			ctx.beginPath()
			ctx.moveTo(x, y)
			ctx.arc(x + l / 2, y - r + 2, r, 0.72 * PI, 2.26 * PI)
			ctx.lineTo(x + l, y)
			ctx.arc(x + l + r - 2, y + l / 2, r, 1.21 * PI, 2.78 * PI)
			ctx.lineTo(x + l, y + l)
			ctx.lineTo(x, y + l)
			ctx.arc(x + r - 2, y + l / 2, r + 0.4, 2.76 * PI, 1.24 * PI, true)
			ctx.lineTo(x, y)
			ctx.lineWidth = 2
			ctx.fillStyle = 'rgba(255, 255, 255, 0.7)'
			ctx.strokeStyle = 'rgba(255, 255, 255, 0.7)'
			ctx.stroke()
			ctx[operation]()
			ctx.globalCompositeOperation = 'overlay'
		}
		initImg()
		draw(canvas_ctx, 'fill')
		draw(block_ctx, 'clip')
		//添加移动事件
		var block_slider = document.querySelector("#block");
		var slider = document.querySelector(".verSliderBlock");
		var slider_mark = document.querySelector("#bar-mask");
		//用于判断当前是否是在按住滑块的情况下
		var yd = false
		var moveX = 0
		var downX = 0
 
		//鼠标按下
		slider.onmousedown = function(e) {
			downX = e.clientX;
			yd = true
 
		}
 
		//鼠标移动事件
		function hadleMousemove(e) {
			if (yd) {
				moveX = e.clientX - downX;
				document.querySelector('#slide').innerHTML = ''
 
				if (moveX >= 310) {
					moveX = 310 - 40
				}
 
				if (moveX > -2) {
					slider.style.backgroundColor = "#1991FA";
					slider_mark.style.borderWidth = "1px"
					slider_mark.style.borderColor = "#1991fa"
					slider_mark.style.width = moveX + 40 + "px";
 
					block_slider.style.left = (310 - 40 - 20) / (310 - 40) * moveX + "px";
					slider.style.left = moveX + "px";
 
				}
			}
 
		}
 
		//鼠标抬起事件
		function hadleMouseup(e) {
			if (yd) {
				slider.onmousemove = null;
				console.log(moveX)
				block_slider.style.left = (310 - 40 - 20) / (310 - 40) * moveX + "px";
				if (Math.abs((310 - 40 - 20) / (310 - 40) * moveX - x) < 10) {
					slider.style.background = "url('https://etfinfo.xcf.cn/appletImg/puzzle-success.png')";
					slider.style.backgroundSize = '100%'
					setTimeout(() => {
						rest();
						var index = layer.open();
						layer.close(index);
						o(); //滑动验证成功后执行的方法
					}, 1000)
 
				} else {
					slider_mark.style.backgroundColor = "#fce1e1"
					slider_mark.style.borderWidth = "1px"
					slider_mark.style.borderColor = "#f57a7a"
 
					slider.style.backgroundColor = "#f57a7a";
					slider.style.background = "url('https://etfinfo.xcf.cn/appletImg/puzzle-error.png')";
					slider.style.backgroundSize = '100%'
					setTimeout(() => {
						rest();
 
					}, 1000)
				}
 
				yd = false
			}
		}
 
		//鼠标在按住滑块下移动
		slider.onmousemove = function(e) {
			hadleMousemove(e)
		}
		//鼠标在滑块下抬起
		slider.onmouseup = function(e) {
			hadleMouseup(e)
		}
 
		//设置全局的移动事件,当鼠标按下滑块后,移动过程中鼠标可能会移出滑块,这是滑块也会监听鼠标的移动进行相应的移动
		document.addEventListener('mousemove', function(e) {
			hadleMousemove(e)
		})
		document.addEventListener('mouseup', function(e) {
			hadleMouseup(e)
		})
 
 
		function rest() {
			clean()
			document.querySelector('#slide').innerHTML = '向右滑动验证'
			slider.style.backgroundColor = "#fff";
			slider.style.left = "0px"
			slider.style.background = "url(https://etfinfo.xcf.cn/appletImg/puzzle-right.png)";
			slider.style.backgroundSize = '100%'
			block_slider.style.left = "0px"
 
			slider_mark.style.width = "0px"
			slider_mark.style.backgroundColor = "#d1e9fe"
			slider_mark.style.borderWidth = "0px"
			slider_mark.style.borderColor = "#d1e9fe"
			initImg()
		}
		//刷新
		refresh.onclick = function() {
			rest()
		}
	};
 
	// $.fn.slideComponent.defaults = {
	// 	slideSuccess(obj)
	// };
})();
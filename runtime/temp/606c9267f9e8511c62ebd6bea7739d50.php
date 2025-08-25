<?php /*a:1:{s:46:"/www/wwwroot/pay1888.top/view/admin/login.html";i:1736872451;}*/ ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>后台登录</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="/static/admin/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/static/admin/css/style.bundle.css" rel="stylesheet" type="text/css" />
	</head>
	<body id="kt_body" class="auth-bg" style="background-image: url(/static/admin/media/auth/bg10.jpeg);">
		<div class="d-flex flex-column flex-root" >
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<div class="w-lg-550px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
						<div class="text-center mb-10">
							<h1 class="text-dark mb-3">
								管理员登录
							</h1>
						</div>
						<div id="login_no" style="display: none;" class="alert alert-dismissible bg-light-danger flex-column flex-sm-row p-5 mb-8">
							<div class="row">
								<div class="col-md-1">
									<span class="svg-icon svg-icon-1 svg-icon-danger">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg">
											<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
											<rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
											<rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
										</svg>
									</span>
								</div>
								<div class="col-md-11 mt-1">
									<div class="d-flex flex-column pe-0 pe-sm-10">
										<h4 class="mb-1 text-danger">
											<span id="message_no"></span>
										</h4>
									</div>
								</div>
							</div>
						</div>
						<div id="login_ok" style="display: none;" class="alert alert-dismissible bg-light-primary flex-column flex-sm-row p-5 mb-8">
							<div class="row">
								<div class="col-md-1">
									<span class="svg-icon svg-icon-1 svg-icon-primary">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg">
											<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
											<path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
										</svg>
									</span>
								</div>
								<div class="col-md-11 mt-1">
									<div class="d-flex flex-column pe-0 pe-sm-10">
										<h4 class="mb-1 text-primary">
											<span id="message_ok"></span>
										</h4>
									</div>
								</div>
							</div>
						</div>
						<div class="fv-row mb-3">
							<label class="form-label fw-bolder text-dark fs-6">管理员账号</label>
							<input class="form-control form-control-lg form-control-solid" type="text" placeholder="请输入管理员账号或绑定手机号" name="account" autocomplete="off"/>
						</div>
						<div class="fv-row mb-10" data-kt-password-meter="true">
							<div class="mb-1">
								<label class="form-label fw-bolder text-dark fs-6">
								</label>
								<div class="position-relative">
									<label class="form-label fw-bolder text-dark fs-6">登录密码</label>
									<input class="form-control form-control-lg form-control-solid" type="password" placeholder="请输入登录密码" name="password" autocomplete="off"/>
								</div>
							</div>
						</div>
						<div class="d-grid">
							<button type="submit" id="kt_sign_in_submit" class="btn btn-primary" onclick="Accountlogin()">
								<span class="indicator-label">登 录</span>
								<span class="indicator-progress">登录中 请稍等...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
								</span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="/static/admin/plugins/global/plugins.bundle.js"></script>
		<script src="/static/admin/js/scripts.bundle.js"></script>
		<script src="/static/admin/js/custom/authentication/sign-in/general.js"></script>
		<script>
            function Accountlogin() {
                let submitbutton = document.querySelector("#kt_sign_in_submit");
                submitbutton.setAttribute("data-kt-indicator", "on");
                submitbutton.disabled = !0;
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo getConfig('backstage_entrance'); ?>/login_check",
                    timeout: 10000,
                    data: {
                        account: document.querySelector('[name="account"]').value,
                        password: document.querySelector('[name="password"]').value,
                    },
                    success: function(data) {
                        submitbutton.removeAttribute("data-kt-indicator");
                        if (data.status === "success") {
                            login_no.style.display = "none";
                            login_ok.style.display = "block";
                            message_ok.innerHTML = data.message;
                            setTimeout(function (){
                                window.location.href = data.data
                            },2000);
                        } else {
                            submitbutton.disabled = !1;
                            login_no.style.display = "block";
                            message_no.innerHTML = data.message;
                        }
                    }
                })
            }
		</script>
	</body>
</html>
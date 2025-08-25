<?php /*a:3:{s:55:"/www/wwwroot/45.207.213.41/5555/view/admin/setting.html";i:1729847355;s:61:"/www/wwwroot/45.207.213.41/5555/view/layout/admin_header.html";i:1728714339;s:61:"/www/wwwroot/45.207.213.41/5555/view/layout/admin_footer.html";i:1728804732;}*/ ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>系统设置管理 - 【<?php echo htmlentities((isset($config['name']) && ($config['name'] !== '')?$config['name']:'')); ?>】后台管理</title>
		<meta charset="utf-8" />
		<!--<meta name="viewport" content="width=device-width, initial-scale=1" />-->
		<meta name="viewport" content="width=1250">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="/static/admin/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/static/admin/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/static/admin/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/static/admin/css/style.bundle.css" rel="stylesheet" type="text/css" />
	</head>
	<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
					<div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
						<div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
							<div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
								<i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
									<span class="path1"></span>
									<span class="path2"></span>
								</i>
							</div>
						</div>
						<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
							<div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
							</div>
							<div class="app-navbar flex-shrink-0">
								<div class="app-navbar-item ms-1 ms-lg-3">
									<a class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px" onclick="refreshPage()">
										<span class="svg-icon svg-icon-2">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M14.5 20.7259C14.6 21.2259 14.2 21.826 13.7 21.926C13.2 22.026 12.6 22.0259 12.1 22.0259C9.5 22.0259 6.9 21.0259 5 19.1259C1.4 15.5259 1.09998 9.72592 4.29998 5.82592L5.70001 7.22595C3.30001 10.3259 3.59999 14.8259 6.39999 17.7259C8.19999 19.5259 10.8 20.426 13.4 19.926C13.9 19.826 14.4 20.2259 14.5 20.7259ZM18.4 16.8259L19.8 18.2259C22.9 14.3259 22.7 8.52593 19 4.92593C16.7 2.62593 13.5 1.62594 10.3 2.12594C9.79998 2.22594 9.4 2.72595 9.5 3.22595C9.6 3.72595 10.1 4.12594 10.6 4.02594C13.1 3.62594 15.7 4.42595 17.6 6.22595C20.5 9.22595 20.7 13.7259 18.4 16.8259Z" fill="currentColor"></path>
												<path opacity="0.3" d="M2 3.62592H7C7.6 3.62592 8 4.02592 8 4.62592V9.62589L2 3.62592ZM16 14.4259V19.4259C16 20.0259 16.4 20.4259 17 20.4259H22L16 14.4259Z" fill="currentColor"></path>
											</svg>
										</span>
									</a>
								</div>
								
								<div class="app-navbar-item ms-1 ms-md-4">
									<a href="#" class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
										<i class="ki-duotone ki-night-day theme-light-show fs-1">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
											<span class="path4"></span>
											<span class="path5"></span>
											<span class="path6"></span>
											<span class="path7"></span>
											<span class="path8"></span>
											<span class="path9"></span>
											<span class="path10"></span>
										</i>
										<i class="ki-duotone ki-moon theme-dark-show fs-1">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</a>
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
										<div class="menu-item px-3 my-0">
											<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-duotone ki-night-day fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
														<span class="path5"></span>
														<span class="path6"></span>
														<span class="path7"></span>
														<span class="path8"></span>
														<span class="path9"></span>
														<span class="path10"></span>
													</i>
												</span>
												<span class="menu-title">Light</span>
											</a>
										</div>
										<div class="menu-item px-3 my-0">
											<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-duotone ki-moon fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</span>
												<span class="menu-title">Dark</span>
											</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-3 my-0">
											<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-duotone ki-screen fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
													</i>
												</span>
												<span class="menu-title">System</span>
											</a>
										</div>
										<!--end::Menu item-->
									</div>
									<!--end::Menu-->
								</div>
								<div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
									<div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
										<img src="<?php echo htmlentities((isset($admin_info['avatar']) && ($admin_info['avatar'] !== '')?$admin_info['avatar']:'/static/admin/media/avatars/blank.png')); ?>" class="rounded-3" alt="user" />
									</div>
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-125px" data-kt-menu="true">
										<div class="menu-item px-5 my-1">
											<a href="<?php echo getConfig('backstage_entrance'); ?>/account" class="menu-link px-5">信息修改</a>
										</div>
										<div class="menu-item px-5">
											<a href="<?php echo getConfig('backstage_entrance'); ?>/logout" class="menu-link px-5">退出登录</a>
										</div>
									</div>
								</div>
								<div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">
									<div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px" id="kt_app_header_menu_toggle">
										<i class="ki-duotone ki-element-4 fs-1">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
						<div class="app-sidebar-logo px-6 ms-10" id="kt_app_sidebar_logo">
							<p style="color: #fff; font-size: 24px;">后台管理系统</p>
						</div>
						<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
							<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
								<div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
									<div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
										<div class="menu-item">
											<a class="menu-link <?php if('系统设置管理'=='首页概况总览'){echo 'active';}?>" href="<?php echo getConfig('backstage_entrance'); ?>">
												<span class="menu-icon">
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z" fill="currentColor"></path>
															<path d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="currentColor"></path>
														</svg>
													</span>
												</span>
												<span class="menu-title">首页概况总览</span>
											</a>
										</div>
										<?php if(power($admin_info['power'],'用户管理') == 1 || power($admin_info['power'],'支付管理') == 1): ?>
										<div class="menu-item pt-5">
											<div class="menu-content">
												<span class="menu-heading fw-bold text-uppercase fs-7">用户管理</span>
											</div>
										</div>
										<?php endif; if(power($admin_info['power'],'用户列表') == 1): ?>
										<div class="menu-item">
											<a class="menu-link <?php if('系统设置管理'=='用户列表'){echo 'active';}?>" href="<?php echo getConfig('backstage_entrance'); ?>/user">
												<span class="menu-icon">
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z" fill="currentColor"></path>
															<path d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="currentColor"></path>
														</svg>
													</span>
												</span>
												<span class="menu-title">用户列表</span>
											</a>
										</div>
										<?php endif; if(power($admin_info['power'],'支付管理') == 1): ?>
										<div class="menu-item">
											<a class="menu-link <?php if('系统设置管理'=='支付管理'){echo 'active';}?>" href="<?php echo getConfig('backstage_entrance'); ?>/bank_card">
												<span class="menu-icon">
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z" fill="currentColor"></path>
															<path d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="currentColor"></path>
														</svg>
													</span>
												</span>
												<span class="menu-title">支付管理</span>
											</a>
										</div>
										<?php endif; if(power($admin_info['power'],'充值业务 - 产品列表') == 1 || power($admin_info['power'],'查询业务 - 产品列表') == 1): ?>
										<div class="menu-item pt-5">
											<div class="menu-content">
												<span class="menu-heading fw-bold text-uppercase fs-7">产品管理</span>
											</div>
										</div>
										<?php endif; if(power($admin_info['power'],'充值业务 - 产品列表') == 1): ?>
										<div class="menu-item">
											<a class="menu-link <?php if('系统设置管理'=='充值业务 - 产品列表'){echo 'active';}?>" href="<?php echo getConfig('backstage_entrance'); ?>/product_cz">
												<span class="menu-icon">
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z" fill="currentColor"></path>
															<path d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="currentColor"></path>
														</svg>
													</span>
												</span>
												<span class="menu-title">充值业务 - 产品列表</span>
											</a>
										</div>
										<?php endif; if(power($admin_info['power'],'查询业务 - 产品列表') == 1): ?>
										<div class="menu-item">
											<a class="menu-link <?php if('系统设置管理'=='查询业务 - 产品列表'){echo 'active';}?>" href="<?php echo getConfig('backstage_entrance'); ?>/product_cx">
												<span class="menu-icon">
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z" fill="currentColor"></path>
															<path d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="currentColor"></path>
														</svg>
													</span>
												</span>
												<span class="menu-title">查询业务 - 产品列表</span>
											</a>
										</div>
										<?php endif; if(power($admin_info['power'],'充值业务 - 订单列表') == 1 || power($admin_info['power'],'查询业务 - 订单列表') == 1): ?>
										<div class="menu-item pt-5">
											<div class="menu-content">
												<span class="menu-heading fw-bold text-uppercase fs-7">订单管理</span>
											</div>
										</div>
										<?php endif; if(power($admin_info['power'],'充值业务 - 订单列表') == 1): ?>
										<div class="menu-item">
											<a class="menu-link <?php if('系统设置管理'=='充值业务 - 订单列表'){echo 'active';}?>" href="<?php echo getConfig('backstage_entrance'); ?>/order_cz">
												<span class="menu-icon">
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z" fill="currentColor"></path>
															<path d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="currentColor"></path>
														</svg>
													</span>
												</span>
												<span class="menu-title">充值业务 - 订单列表</span>
											</a>
										</div>
										<?php endif; if(power($admin_info['power'],'查询业务 - 订单列表') == 1): ?>
										<div class="menu-item">
											<a class="menu-link <?php if('系统设置管理'=='查询业务 - 订单列表'){echo 'active';}?>" href="<?php echo getConfig('backstage_entrance'); ?>/order_cx">
												<span class="menu-icon">
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z" fill="currentColor"></path>
															<path d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="currentColor"></path>
														</svg>
													</span>
												</span>
												<span class="menu-title">查询业务 - 订单列表</span>
											</a>
										</div>
										<?php endif; if(power($admin_info['power'],'充值订单记录') == 1  || power($admin_info['power'],'提现订单记录') == 1 || power($admin_info['power'],'返佣记录') == 1): ?>
										<div class="menu-item pt-5">
											<div class="menu-content">
												<span class="menu-heading fw-bold text-uppercase fs-7">财务管理</span>
											</div>
										</div>
										<?php endif; if(power($admin_info['power'],'充值订单记录') == 1): ?>
										<div class="menu-item">
											<a class="menu-link <?php if('系统设置管理'=='充值订单记录'){echo 'active';}?>" href="<?php echo getConfig('backstage_entrance'); ?>/recharge">
												<span class="menu-icon">
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z" fill="currentColor"></path>
															<path d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="currentColor"></path>
														</svg>
													</span>
												</span>
												<span class="menu-title">充值订单记录</span>
											</a>
										</div>
										<?php endif; if(power($admin_info['power'],'提现订单记录') == 1): ?>
										<div class="menu-item">
											<a class="menu-link <?php if('系统设置管理'=='提现订单记录'){echo 'active';}?>" href="<?php echo getConfig('backstage_entrance'); ?>/withdrawal">
												<span class="menu-icon">
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z" fill="currentColor"></path>
															<path d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="currentColor"></path>
														</svg>
													</span>
												</span>
												<span class="menu-title">提现订单记录</span>
											</a>
										</div>
										<?php endif; if(power($admin_info['power'],'返佣记录') == 1): ?>
										<div class="menu-item">
											<a class="menu-link <?php if('系统设置管理'=='返佣记录'){echo 'active';}?>" href="<?php echo getConfig('backstage_entrance'); ?>/rebate_record">
												<span class="menu-icon">
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z" fill="currentColor"></path>
															<path d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="currentColor"></path>
														</svg>
													</span>
												</span>
												<span class="menu-title">返佣记录</span>
											</a>
										</div>
										<?php endif; if(power($admin_info['power'],'交易挂单数据') == 1 || power($admin_info['power'],'交易订单数据') == 1): ?>
										<div class="menu-item pt-5">
											<div class="menu-content">
												<span class="menu-heading fw-bold text-uppercase fs-7">交易管理</span>
											</div>
										</div>
										<?php endif; if(power($admin_info['power'],'交易挂单数据') == 1): ?>
										<div class="menu-item">
											<a class="menu-link <?php if('系统设置管理'=='交易挂单数据'){echo 'active';}?>" href="<?php echo getConfig('backstage_entrance'); ?>/transaction_product">
												<span class="menu-icon">
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z" fill="currentColor"></path>
															<path d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="currentColor"></path>
														</svg>
													</span>
												</span>
												<span class="menu-title">交易挂单数据</span>
											</a>
										</div>
										<?php endif; if(power($admin_info['power'],'交易订单数据') == 1): ?>
										<div class="menu-item">
											<a class="menu-link <?php if('系统设置管理'=='交易订单数据'){echo 'active';}?>" href="<?php echo getConfig('backstage_entrance'); ?>/transaction_order">
												<span class="menu-icon">
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z" fill="currentColor"></path>
															<path d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="currentColor"></path>
														</svg>
													</span>
												</span>
												<span class="menu-title">交易订单数据</span>
											</a>
										</div>
										<?php endif; if(power($admin_info['power'],'首页轮播图') == 1 || power($admin_info['power'],'管理员列表') == 1): ?>
										<div class="menu-item pt-5">
											<div class="menu-content">
												<span class="menu-heading fw-bold text-uppercase fs-7">其他配置</span>
											</div>
										</div>
										<?php endif; if(power($admin_info['power'],'首页轮播图') == 1): ?>
										<div class="menu-item">
											<a class="menu-link <?php if('系统设置管理'=='首页轮播图'){echo 'active';}?>" href="<?php echo getConfig('backstage_entrance'); ?>/slide">
												<span class="menu-icon">
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z" fill="currentColor"></path>
															<path d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="currentColor"></path>
														</svg>
													</span>
												</span>
												<span class="menu-title">首页轮播图</span>
											</a>
										</div>
										<?php endif; if(power($admin_info['power'],'管理员列表') == 1): ?>
										<div class="menu-item">
											<a class="menu-link <?php if('系统设置管理'=='管理员列表'){echo 'active';}?>" href="<?php echo getConfig('backstage_entrance'); ?>/admin">
												<span class="menu-icon">
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM6.39999 9.89999C6.99999 8.19999 8.40001 6.9 10.1 6.4C10.6 6.2 10.9 5.7 10.7 5.1C10.5 4.6 9.99999 4.3 9.39999 4.5C7.09999 5.3 5.29999 7 4.39999 9.2C4.19999 9.7 4.5 10.3 5 10.5C5.1 10.5 5.19999 10.6 5.39999 10.6C5.89999 10.5 6.19999 10.2 6.39999 9.89999ZM14.8 19.5C17 18.7 18.8 16.9 19.6 14.7C19.8 14.2 19.5 13.6 19 13.4C18.5 13.2 17.9 13.5 17.7 14C17.1 15.7 15.8 17 14.1 17.6C13.6 17.8 13.3 18.4 13.5 18.9C13.6 19.3 14 19.6 14.4 19.6C14.5 19.6 14.6 19.6 14.8 19.5Z" fill="currentColor"></path>
															<path d="M16 12C16 14.2 14.2 16 12 16C9.8 16 8 14.2 8 12C8 9.8 9.8 8 12 8C14.2 8 16 9.8 16 12ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="currentColor"></path>
														</svg>
													</span>
												</span>
												<span class="menu-title">管理员列表</span>
											</a>
										</div>
										<?php endif; ?>

									</div>
								</div>
							</div>
						</div>
						<?php if(power($admin_info['power'],'系统设置管理') == 1): ?>
						<div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
							<a href="<?php echo getConfig('backstage_entrance'); ?>/setting" class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100">
								<span class="btn-label">系统设置管理</span>
								<i class="ki-duotone ki-document btn-icon fs-2 m-0">
									<span class="path1"></span>
									<span class="path2"></span>
								</i>
							</a>
						</div>
						<?php endif; ?>
					</div>
                    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                        <div class="d-flex flex-column flex-column-fluid">
                            <div id="kt_app_content" class="app-content flex-column-fluid py-3 py-lg-6">
<link rel="stylesheet" href="/static/admin/css/snippet.css" type="text/css" data-cke="true">
<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h2>站点信息配置</h2>
            </div>
            <div class="card-toolbar">
                <ul class="nav nav-stretch fs-5 fw-semibold nav-line-tabs nav-line-tabs-2x border-transparent" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-active-primary active" data-bs-toggle="tab" role="tab" href="#setting_1">基本信息配置</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-active-primary" data-bs-toggle="tab" role="tab" href="#setting_2">充值提现配置</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-active-primary" data-bs-toggle="tab" role="tab" href="#setting_3">交易管理配置</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-active-primary" data-bs-toggle="tab" role="tab" href="#setting_4">用户协议</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-active-primary" data-bs-toggle="tab" role="tab" href="#setting_5">隐私政策</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body pb-5">
            <div id="setting_tab_content" class="tab-content">
                <div id="setting_1" class="py-0 tab-pane fade show active" role="tabpanel">
                    <div class="card-body">
                        <div class="d-flex fs-6 fw-semibold align-items-center mb-10">
                            <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                            <div class="fs-6 fw-semibold text-gray-400 flex-shrink-0">站点信息设置</div>
                            <div class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">网站名称</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="name" value="<?php echo htmlentities((isset($config['name']) && ($config['name'] !== '')?$config['name']:'')); ?>" placeholder="请输入网站名称" class="form-control">
                            </div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">后台入口设置</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="backstage_entrance" value="<?php echo htmlentities((isset($config['backstage_entrance']) && ($config['backstage_entrance'] !== '')?$config['backstage_entrance']:'')); ?>" placeholder="请输入后台入口地址" class="form-control">
                            </div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">最新费率</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="rate" value="<?php echo htmlentities((isset($config['rate']) && ($config['rate'] !== '')?$config['rate']:'')); ?>" placeholder="请输入最新费率" class="form-control">
                            </div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">邮件地址</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="mailing_address" value="<?php echo htmlentities((isset($config['mailing_address']) && ($config['mailing_address'] !== '')?$config['mailing_address']:'')); ?>" placeholder="请输入邮件地址" class="form-control">
                            </div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">在线客服</label>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text">客服联系地址</span>
                                    <div class="w-300px">
                                        <input type="text" id="contact_service_url" value="<?php echo htmlentities((isset($config['contact_service_url']) && ($config['contact_service_url'] !== '')?$config['contact_service_url']:'')); ?>" placeholder="请输入客服联系地址" class="form-control">
                                    </div>
                                    <span class="input-group-text">logo图片：</span>
                                    <input type="text" class="form-control contact_service_upload" id="contact_service_image" placeholder="请上传logo图片" value="<?php echo htmlentities((isset($config['contact_service_image']) && ($config['contact_service_image'] !== '')?$config['contact_service_image']:'')); ?>">
                                    <button class="btn btn-primary dz-clickable" id="contact_service_upload">
                                        上传图片
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex fs-6 fw-semibold align-items-center mb-10">
                            <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                            <div class="fs-6 fw-semibold text-gray-400 flex-shrink-0">首页信息配置</div>
                            <div class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">首页顶部公告</label>
                            </div>
                            <div class="col-md-9">
                                <textarea type="text" id="notice" placeholder="请输入首页顶部公告" class="form-control" rows="3"><?php echo htmlentities((isset($config['notice']) && ($config['notice'] !== '')?$config['notice']:'')); ?></textarea>
                            </div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">首页推荐一</label>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text">选择充值产品</span>
                                    <div class="w-300px">
                                        <select class="form-select" id="a_recommend_id" data-control="select2" data-placeholder="产品筛选" data-kt="product">
                                            <option></option>
                                            <?php foreach($product_list as $key=>$vo): ?>
                                            <option value="<?php echo htmlentities($vo['id']); ?>" <?php if($config['a_recommend_id'] == $vo['id']): ?>selected<?php endif; ?>><?php echo htmlentities($vo['name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <span class="input-group-text">上传背景图片：</span>
                                    <input type="text" class="form-control a_recommend_upload" id="a_recommend_image" placeholder="请上传背景图片" value="<?php echo htmlentities((isset($config['a_recommend_image']) && ($config['a_recommend_image'] !== '')?$config['a_recommend_image']:'')); ?>">
                                    <button class="btn btn-primary dz-clickable" id="a_recommend_upload">
                                        上传图片
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">首页推荐二</label>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text">选择充值产品</span>
                                    <div class="w-300px">
                                        <select class="form-select" id="b_recommend_id" data-control="select2" data-placeholder="产品筛选" data-kt="product">
                                            <option></option>
                                            <?php foreach($product_list as $key=>$vo): ?>
                                            <option value="<?php echo htmlentities($vo['id']); ?>" <?php if($config['b_recommend_id'] == $vo['id']): ?>selected<?php endif; ?>><?php echo htmlentities($vo['name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <span class="input-group-text">上传背景图片：</span>
                                    <input type="text" class="form-control b_recommend_upload" id="b_recommend_image" placeholder="请上传背景图片" value="<?php echo htmlentities((isset($config['b_recommend_image']) && ($config['b_recommend_image'] !== '')?$config['b_recommend_image']:'')); ?>">
                                    <button class="btn btn-primary dz-clickable" id="b_recommend_upload">
                                        上传图片
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex fs-6 fw-semibold align-items-center mb-10">
                            <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                            <div class="fs-6 fw-semibold text-gray-400 flex-shrink-0">默认用户信息配置</div>
                            <div class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">默认注册头像</label>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="text" class="form-control user_avatar_upload" id="user_avatar_image" placeholder="请上传logo图片" value="<?php echo htmlentities((isset($config['user_avatar_image']) && ($config['user_avatar_image'] !== '')?$config['user_avatar_image']:'')); ?>">
                                    <button class="btn btn-primary dz-clickable" id="user_avatar_upload">
                                        上传图片
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex fs-6 fw-semibold align-items-center mb-10">
                            <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                            <div class="fs-6 fw-semibold text-gray-400 flex-shrink-0">代理开通配置</div>
                            <div class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">代理开通价格</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="agent_money" value="<?php echo htmlentities((isset($config['agent_money']) && ($config['agent_money'] !== '')?$config['agent_money']:'')); ?>" placeholder="请输入代理开通价格" class="form-control">
                            </div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">代理开通介绍</label>
                            </div>
                            <div class="col-md-9">
                                <textarea type="text" id="agent_jieshao" placeholder="请输入代理开通介绍" class="form-control" rows="3"><?php echo (isset($config['agent_jieshao']) && ($config['agent_jieshao'] !== '')?$config['agent_jieshao']:''); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="setting_2" class="py-0 tab-pane fade" role="tabpanel">
                    <div class="card-body">
                        <div class="d-flex fs-6 fw-semibold align-items-center mb-10">
                            <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                            <div class="fs-6 fw-semibold text-gray-400 flex-shrink-0">充值信息配置</div>
                            <div class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">最低充值金额</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="mini_recharge_amount" value="<?php echo htmlentities((isset($config['mini_recharge_amount']) && ($config['mini_recharge_amount'] !== '')?$config['mini_recharge_amount']:'')); ?>" placeholder="请输入最低充值金额" class="form-control">
                            </div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">收款地址</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="payment_address" value="<?php echo htmlentities((isset($config['payment_address']) && ($config['payment_address'] !== '')?$config['payment_address']:'')); ?>" placeholder="请输入收款地址" class="form-control">
                            </div>
                        </div>
                        <div class="d-flex fs-6 fw-semibold align-items-center mb-10">
                            <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                            <div class="fs-6 fw-semibold text-gray-400 flex-shrink-0">提现信息配置</div>
                            <div class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">最低提现金额</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="mini_withdrawal_amount" value="<?php echo htmlentities((isset($config['mini_withdrawal_amount']) && ($config['mini_withdrawal_amount'] !== '')?$config['mini_withdrawal_amount']:'')); ?>" placeholder="请输入最低提现金额" class="form-control">
                            </div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">提现手续费</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="withdrawal_fee" value="<?php echo htmlentities((isset($config['withdrawal_fee']) && ($config['withdrawal_fee'] !== '')?$config['withdrawal_fee']:'')); ?>" placeholder="请输入提现手续费" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="setting_3" class="py-0 tab-pane fade" role="tabpanel">
                    <div class="card-body">
                        <div class="d-flex fs-6 fw-semibold align-items-center mb-10">
                            <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                            <div class="fs-6 fw-semibold text-gray-400 flex-shrink-0">交易管理配置</div>
                            <div class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">最低挂单数量</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="transaction_mini_quantity" value="<?php echo htmlentities((isset($config['transaction_mini_quantity']) && ($config['transaction_mini_quantity'] !== '')?$config['transaction_mini_quantity']:'')); ?>" placeholder="请输入收款地址" class="form-control">
                            </div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="col-md-3 d-flex align-items-center">
                                <label class="fs-6 fw-semibold">交易手续费</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="transaction_fees" value="<?php echo htmlentities((isset($config['transaction_fees']) && ($config['transaction_fees'] !== '')?$config['transaction_fees']:'')); ?>" placeholder="请输入提现手续费" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="setting_4" class="py-0 tab-pane fade" role="tabpanel">
                    <div class="card-body">
                        <div class="d-flex fs-6 fw-semibold align-items-center mb-10">
                            <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                            <div class="fs-6 fw-semibold text-gray-400 flex-shrink-0">用户协议</div>
                            <div class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="tab-pane fade active show">
                                <textarea id="agreement">
                                    <?php echo (isset($config['agreement']) && ($config['agreement'] !== '')?$config['agreement']:''); ?>
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="setting_5" class="py-0 tab-pane fade" role="tabpanel">
                    <div class="card-body">
                        <div class="d-flex fs-6 fw-semibold align-items-center mb-10">
                            <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                            <div class="fs-6 fw-semibold text-gray-400 flex-shrink-0">隐私政策</div>
                            <div class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
                        </div>
                        <div class="fv-row row mb-9">
                            <div class="tab-pane fade active show">
                                <textarea id="privacy_policy">
                                    <?php echo (isset($config['privacy_policy']) && ($config['privacy_policy'] !== '')?$config['privacy_policy']:''); ?>
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="button" class="btn btn-primary" onclick="setting()">保存设置</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/static/admin/js/snippet.js"></script>

                            </div>
                        </div>
                        <div id="kt_app_footer" class="app-footer">
                            <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                                <div class="text-gray-900 order-2 order-md-1">
                                    <span class="text-muted fw-semibold me-1">2024&copy;</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>

		<script src="/static/admin/plugins/global/plugins.bundle.js"></script>
		<script src="/static/admin/js/scripts.bundle.js"></script>
		<script src="/static/admin/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="/static/admin/plugins/custom/datatables/datatables.bundle.js"></script>
		<script src="/static/admin/js/widgets.bundle.js"></script>
		<script src="/static/admin/js/custom/widgets.js"></script>
		<script src="/static/admin/js/custom/apps/chat/chat.js"></script>
		<script src="/static/admin/js/custom/utilities/modals/users-search.js"></script>
        <script>
            function refreshPage() {
                location.reload(); // 刷新当前页面
            }

            out_order();
            function out_order() {
                $.ajax({
                    url: "<?php echo getConfig('backstage_entrance'); ?>/admin_footer/out_order",
                    method: 'POST',
                    dataType: 'json',
                    success: function(res) {
                        if (res.code === 200) {
                            if(res.data.order_cz != 0){
                                var utterThis = new window.SpeechSynthesisUtterance('您有'+res.data.order_cz+'笔业务充值订单带处理');
                                utterThis.pitch=1
                                utterThis.rate=1.2
                                utterThis.voiceURI='BaiduMandarinMale'
                                window.speechSynthesis.speak(utterThis);
                            }
                            if(res.data.order_cx != 0){
                                var utterThis = new window.SpeechSynthesisUtterance('您有'+res.data.order_cx+'笔业务理财信息带处理');
                                utterThis.pitch=1
                                utterThis.rate=1.2
                                utterThis.voiceURI='BaiduMandarinMale'
                                window.speechSynthesis.speak(utterThis);
                            }
                            if(res.data.recharge != 0){
                                var utterThis = new window.SpeechSynthesisUtterance('您有'+res.data.recharge+'笔余额充值订单带处理');
                                utterThis.pitch=1
                                utterThis.rate=1.2
                                utterThis.voiceURI='BaiduMandarinMale'
                                window.speechSynthesis.speak(utterThis);
                            }
                            if(res.data.withdrawal != 0){
                                var utterThis = new window.SpeechSynthesisUtterance('您有'+res.data.withdrawal+'笔余额提现订单带处理');
                                utterThis.pitch=1
                                utterThis.rate=1.2
                                utterThis.voiceURI='BaiduMandarinMale'
                                window.speechSynthesis.speak(utterThis);
                            }
                            setTimeout(function (){
                                out_order();
                            }, 600000);
                        }else{
                            setTimeout(function (){
                                out_order();
                            },10000);
                        }
                    }
                });
            };
        </script>
	</body>
</html>
<script>
    Inputmask({
        mask: "/*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]",
    }).mask("#backstage_entrance");

    function setting() {
        $.ajax({
            url: "<?php echo getConfig('backstage_entrance'); ?>/setting_post/setting",
            method: 'POST',
            data: {
                name: $('#name').val(),
                backstage_entrance: $('#backstage_entrance').val(),
                rate: $('#rate').val(),
                mailing_address: $('#mailing_address').val(),
                agreement: agreements.getData(),
                privacy_policy: privacy_policys.getData(),
                mini_recharge_amount: $('#mini_recharge_amount').val(),
                payment_address: $('#payment_address').val(),
                mini_withdrawal_amount: $('#mini_withdrawal_amount').val(),
                withdrawal_fee: $('#withdrawal_fee').val(),
                notice: $('#notice').val(),
                a_recommend_id: $('#a_recommend_id').val(),
                b_recommend_id: $('#b_recommend_id').val(),
                a_recommend_image: $('#a_recommend_image').val(),
                b_recommend_image: $('#b_recommend_image').val(),
                contact_service_url: $('#contact_service_url').val(),
                contact_service_image: $('#contact_service_image').val(),
                transaction_mini_quantity: $('#transaction_mini_quantity').val(),
                transaction_fees: $('#transaction_fees').val(),
                user_avatar_image: $('#user_avatar_image').val(),
                agent_money: $('#agent_money').val(),
                agent_jieshao: $('#agent_jieshao').val(),
            },
            dataType: 'json',
            success: function(res) {
                if (res.code === 200) {
                    toastr.success(
                        res.message,
                        {closeButton :!0, timeOut : "3000"}
                    );
                } else {
                    toastr.error(
                        res.message,
                        {closeButton :!0, timeOut : "3000"}
                    );
                }
            }
        });
    }

    function upload(name) {
        new Dropzone("#" + name, {
            url: "<?php echo getConfig('backstage_entrance'); ?>/upload_post",
            paramName: name,
            maxFiles: 1,
            maxFilesize: 5, // MB
            uploadMultiple: false,
            addRemoveLinks: true,
            success: function (file, res) {
                $('.' + name ).val(res.data);
            }
        })
    }
    window.onload = function() {
        upload('a_recommend_upload');
        upload('b_recommend_upload');
        upload('contact_service_upload');
        upload('user_avatar_upload');
    }
    
    

    function MyCustomUploadAdapterPlugin( editor ) {
        editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
            return new MyUploadAdapter( loader );
        };
    }
    ClassicEditor
    .create( document.querySelector( '#agreement' ), {
        
        toolbar: {
            items: [
                'heading','|','fontColor', 'fontBackgroundColor','|','bold', 'italic', 'underline','|','specialCharacters', 'horizontalLine', 'pageBreak','|','link', 'insertImage', 'ckbox', 'insertTable', 'tableOfContents', 'insertTemplate','|','alignment:left', 'alignment:right', 'alignment:center', 
            ],
            shouldNotGroupWhenFull: true
        },
        table: {
            contentToolbar: [
                'tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties', 'toggleTableCaption'
            ]
        },
        extraPlugins: [ MyCustomUploadAdapterPlugin ],
    } )
    .then( newEditor => {
        agreements = newEditor;
    } )


    ClassicEditor
    .create( document.querySelector( '#privacy_policy' ), {
        
        toolbar: {
            items: [
                'heading','|','fontColor', 'fontBackgroundColor','|','bold', 'italic', 'underline','|','specialCharacters', 'horizontalLine', 'pageBreak','|','link', 'insertImage', 'ckbox', 'insertTable', 'tableOfContents', 'insertTemplate','|','alignment:left', 'alignment:right', 'alignment:center', 
            ],
            shouldNotGroupWhenFull: true
        },
        table: {
            contentToolbar: [
                'tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties', 'toggleTableCaption'
            ]
        },
        extraPlugins: [ MyCustomUploadAdapterPlugin ],
    } )
    .then( newEditor => {
        privacy_policys = newEditor;
    } )


    .catch( error => {
        console.log( error );
    } );
    class MyUploadAdapter {
        constructor( loader ) {
            this.loader = loader;
        }
        upload() {
            return this.loader.file
                .then( file => new Promise( ( resolve, reject ) => {
                    this._initRequest();
                    this._initListeners( resolve, reject, file );
                    this._sendRequest( file );
                } ) );
        }
        abort() {
            if ( this.xhr ) {
                this.xhr.abort();
            }
        }
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();
            xhr.open( 'POST', "<?php echo getConfig('backstage_entrance'); ?>/setting_post/upload", true );
            xhr.responseType = 'json';
        }
        _initListeners( resolve, reject, file ) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;
    
            xhr.addEventListener( 'error', () => reject( genericErrorText ) );
            xhr.addEventListener( 'abort', () => reject() );
            xhr.addEventListener( 'load', () => {
                const response = xhr.response;
                if ( !response || response.error ) {
                    return reject( response && response.error ? response.error.message : genericErrorText );
                }
                resolve( {
                    default: response.default
                } );
            } );
            if ( xhr.upload ) {
                xhr.upload.addEventListener( 'progress', evt => {
                    if ( evt.lengthComputable ) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                } );
            }
        }
        _sendRequest( file ) {
            const data = new FormData();
            data.append( 'upload', file );
            this.xhr.send( data );
        }
    }



</script>
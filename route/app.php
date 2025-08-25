<?php
use think\facade\Route;

Route::get('/', 'Index/index');                                                       // 首页


Route::get('order_query', 'Index/order_query');                                                       // 订单查询

Route::post('order_query', 'IndexApi/order_query');                             // 订单查询请求


Route::get('login', 'Index/login');                                                   // 登录
Route::post('login_post/:action', 'IndexApi/login_post');                             // 登录请求
Route::get('register', 'Index/register');                                             // 注册
Route::post('register_post/:action', 'IndexApi/register_post');                       // 注册请求
Route::get('logout', 'IndexApi/logout');                                              // 退出登录
Route::post('payment_voucher/:action', 'IndexApi/payment_voucher');                   // 我的凭证编辑


Route::get('product/<id>', 'Index/product');                                          // 产品下单
Route::post('product_post/:action', 'IndexApi/product_post');                         // 产品下单请求
Route::get('batch', 'Index/batch');                                                   // 批量导入
Route::post('batch_post/:action', 'IndexApi/batch_post');                             // 批量导入请求
Route::post('batch_list', 'IndexList/batch_list');                                    // 批量导入列表Ajax分页请求

Route::get('order_cz', 'Index/order_cz');                                             // 在线订单
Route::post('order_cz_list', 'IndexList/order_cz_list');                              // 在线订单列表Ajax分页请求

Route::get('order_cx', 'Index/order_cx');                                             // 在线订单
Route::post('order_cx_list', 'IndexList/order_cx_list');                              // 在线订单列表Ajax分页请求

Route::post('order_post/:action', 'IndexApi/order_post');                             // 在线订单请求

Route::get('out_order', 'Index/out_order');                                           // 审核池
Route::post('out_order_post/:action', 'IndexApi/out_order_post');                     // 审核池请求
Route::post('out_order_list', 'IndexList/out_order_list');                            // 审核池列表Ajax分页请求

Route::get('query_business/<id>', 'Index/query_business_page');                       // 查询业务下单页面
Route::post('query_business_page_post/:action', 'IndexApi/query_business_page_post'); // 查询业务下单页面请求

Route::get('query_business', 'Index/query_business');                                 // 查询业务

Route::get('chat_message', 'Index/chat_message');                                     // 消息中心

Route::get('invite_friends', 'Index/invite_friends');                                 // 推广海报
Route::get('agency_center', 'Index/agency_center');                                   // 代理中心
Route::post('agency_center_list', 'IndexList/agency_center_list');                    // 代理中心列表Ajax分页请求
Route::post('agency_center_post/:action', 'IndexApi/agency_center_post');             // 代理中心页面请求

Route::get('bank_card', 'Index/bank_card');                                           // 支付管理
Route::get('bank_card_add_modify', 'Index/bank_card_add_modify');                     // 支付管理 添加/修改
Route::post('bank_card_post/:action', 'IndexApi/bank_card_post');                     // 支付管理请求


Route::get('order', 'Index/order');                                           // 生活缴费
Route::post('order_list', 'IndexList/order_list');                            // 生活缴费Ajax分页请求

Route::get('order_info', 'Index/order_info');                                           // 生活缴费 订单详情

Route::get('order_voucher', 'Index/order_voucher');                                           // 付款凭证
Route::get('order_voucher_edit', 'Index/order_voucher_edit');                                 // 付款凭证编辑


Route::get('wallet_details', 'Index/wallet_details');                                 // 账单明细
Route::post('wallet_details_post/:action', 'IndexApi/wallet_details_post');           // 账单明细请求

Route::get('wallet_details_data', 'Index/wallet_details_data');                       // 账单明细数据

Route::get('my', 'Index/my');                                                         // 我的
Route::get('account_settings', 'Index/account_settings');                             // 账户设置
Route::post('account_settings_post/:action', 'IndexApi/account_settings_post');       // 账户设置下页面的请求
Route::get('information', 'Index/information');                                       // 个人资料
Route::get('password', 'Index/password');                                             // 密码修改
Route::get('wallet_address', 'Index/wallet_address');                                 // 钱包地址
Route::get('oil_card_list', 'Index/oil_card_list');                                   // 油卡管理
Route::get('agreement', 'Index/agreement');                                           // 用户协议
Route::get('privacy_policy', 'Index/privacy_policy');                                 // 隐私政策

Route::get('recharge_withdrawal', 'Index/recharge_withdrawal');                       // 充值提现
Route::post('recharge_withdrawal_post/:action', 'IndexApi/recharge_withdrawal_post'); // 充值提现请求

Route::get('recharge/<order_number>', 'Index/recharge');                              // 充值详情页面
Route::post('recharge_post/:action', 'IndexApi/recharge_post');                       // 充值详情页面请求
Route::get('withdrawal_confirm', 'Index/withdrawal_confirm');                         // 提现确认页面
Route::post('withdrawal_confirm_post/:action', 'IndexApi/withdrawal_confirm_post');   // 提现确认页面请求


Route::get('transaction_index', 'Index/transaction_index');                                 // 交易 - 首页
Route::post('transaction_index_list', 'IndexList/transaction_index_list');                  // 交易 - 首页列表Ajax分页请求
Route::get('transaction_my_sale', 'Index/transaction_my_sale');                             // 交易 - 我的出售
Route::post('transaction_my_sale_post/:action', 'IndexApi/transaction_my_sale_post');       // 交易 - 我的出售请求

Route::get('transaction_sale_edit', 'Index/transaction_sale_edit');                         // 交易 - 我要出售/编辑/添加
Route::post('transaction_sale_edit_post/:action', 'IndexApi/transaction_sale_edit_post');   // 交易 - 我要出售/编辑/添加请求
Route::post('transaction_my_sale_list', 'IndexList/transaction_my_sale_list');              // 交易 - 我要出售列表Ajax分页请求

Route::get('transaction_buy', 'Index/transaction_buy');                                     // 交易 - 交易购买
Route::post('transaction_buy_post/:action', 'IndexApi/transaction_buy_post');               // 交易 - 交易购买请求
Route::get('transaction_order', 'Index/transaction_order');                                 // 交易 - 交易订单
Route::post('transaction_order_list', 'IndexList/transaction_order_list');                  // 交易 - 交易订单列表Ajax分页请求


Route::get('transaction_trading_details/<order_number>', 'Index/transaction_trading_details');        // 交易 - 订单详情
Route::post('transaction_trading_details_post/:action', 'IndexApi/transaction_trading_details_post'); // 交易 - 订单详情请求

Route::get('epay_notify_url', 'IndexApi/epay_notify_url');        // 易支付交易回调



Route::post('footer_post/:action', 'IndexApi/footer_post');                           // 全局底部请求
Route::post('upload_post', 'IndexApi/upload_post');                                   // 图片上传

// admin目录下地址
Route::group(getConfig('backstage_entrance'), static function () {
    Route::get('/', 'Admin/index');                                                    // 后台首页
    Route::get('login', 'Admin/login');                                                // 后台登录
    Route::post('login_check', 'AdminApi/login_check');                                // 后台登录验证
    Route::get('logout', 'AdminApi/logout');                                           // 退出登录
    Route::get('setting', 'Admin/setting');                                            // 系统设置
    Route::post('setting_post/:action', 'AdminApi/setting_post');                      // 系统设置提交
    Route::get('account', 'Admin/account');                                            // 管理员基本资料
    Route::post('account_post/:action', 'AdminApi/account_post');                      // 管理员基本资料请求


    Route::get('user', 'Admin/user');                                                // 用户管理页面
    Route::post('user_post/:action', 'AdminApi/user_post');                          // 用户管理页面请求
    Route::get('user_list', 'AdminList/user_list');                                  // 用户管理页面列表Ajax分页请求


    Route::get('product_cz', 'Admin/product_cz');                                    // 产品充值管理页面
    Route::get('product_cx', 'Admin/product_cx');                                    // 产品查询页面

    Route::post('product_post/:action', 'AdminApi/product_post');                    // 产品页面请求
    Route::get('product_list', 'AdminList/product_list');                            // 产品页面列表Ajax分页请求
    
    Route::get('order_cz', 'Admin/order_cz');                                         // 充值业务 订单管理页面
    Route::get('order_cz_list', 'AdminList/order_cz_list');                           // 订单管理页面列表Ajax分页请求
    Route::get('order_cx', 'Admin/order_cx');                                         // 查询业务 订单管理页面
    Route::get('order_cx_list', 'AdminList/order_cx_list');                           // 订单管理页面列表Ajax分页请求

    
    Route::post('order_post/:action', 'AdminApi/order_post');                          // 订单管理页面请求

    Route::get('slide', 'Admin/slide');                                                // 轮播图管理页面
    Route::post('slide_post/:action', 'AdminApi/slide_post');                          // 轮播图管理页面请求
    Route::get('slide_list', 'AdminList/slide_list');                                  // 轮播图管理页面列表Ajax分页请求

    Route::get('transaction_product', 'Admin/transaction_product');                        // 交易挂单数据
    Route::post('transaction_product_post/:action', 'AdminApi/transaction_product_post');  // 交易挂单数据请求
    Route::get('transaction_product_list', 'AdminList/transaction_product_list');          // 交易挂单数据列表Ajax分页请求

    Route::get('transaction_order', 'Admin/transaction_order');                        // 交易订单数据
    Route::post('transaction_order_post/:action', 'AdminApi/transaction_order_post');  // 交易订单数据请求
    Route::get('transaction_order_list', 'AdminList/transaction_order_list');          // 交易订单数据列表Ajax分页请求

    
    
    Route::post('bank_card_post/:action', 'AdminApi/bank_card_post');                  // 支付管理据请求
    Route::get('bank_card', 'Admin/bank_card');                                        // 支付管理
    Route::get('bank_card_list', 'AdminList/bank_card_list');                          // 支付管理列表Ajax分页请求

    
    Route::get('user_t', 'Admin/user_t');                                              // 下级用户
    Route::get('user_t_list', 'AdminList/user_t_list');                                // 下级用户列表Ajax分页请求
    
    
    
    Route::post('rebate_record_post/:action', 'AdminApi/rebate_record_post');          // 返佣记录请求
    Route::get('rebate_record', 'Admin/rebate_record');                                // 返佣记录
    Route::get('rebate_record_list', 'AdminList/rebate_record_list');                  // 返佣记录列表Ajax分页请求

    
    Route::get('recharge', 'Admin/recharge');                                          // 充值订单管理页面
    Route::post('recharge_post/:action', 'AdminApi/recharge_post');                    // 充值订单管理页面请求
    Route::get('recharge_list', 'AdminList/recharge_list');                            // 充值订单管理页面列表Ajax分页请求

    Route::get('withdrawal', 'Admin/withdrawal');                                      // 提现订单管理页面
    Route::post('withdrawal_post/:action', 'AdminApi/withdrawal_post');                // 提现订单管理页面请求
    Route::get('withdrawal_list', 'AdminList/withdrawal_list');                        // 提现订单管理页面列表Ajax分页请求
    
    
    Route::get('admin', 'Admin/admin');                                                // 管理员
    Route::get('admin_list', 'AdminList/admin_list');                                  // 管理员列表Ajax分页请求
    Route::post('admin_post/:action', 'AdminApi/admin_post');                          // 管理员请求
    

    Route::post('admin_footer/:action', 'AdminApi/admin_footer');                      // 后台全局请求
    
    Route::post('upload_post', 'AdminApi/upload_post');                                 // 图片上传
    Route::miss('admin/index', 'get');                                                 // 分组MISS路由
});



<?php
declare (strict_types=1);
namespace app\controller;
use app\middleware\AdminAuth;
use app\model\Admin as AdminModel;
use app\model\User as UserModel;
use app\model\Product;
use app\model\Recharge;
use app\model\RebateRecord;
use app\model\Withdrawal;
use app\model\Order;
use app\model\TransactionOrder;

use think\App;
use think\facade\View;
use think\facade\Route;
use think\Request;

class Admin 
{
    /**
     * Request实例
     * @var Request
     */
    protected Request $request;

    /**
     * 应用实例
     * @var App
     */
    protected App $app;

    protected mixed $admin_info;
    protected string|array|bool $config = [];
    protected array $middleware = [AdminAuth::class];

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->request = $this->app->request;
        // 将当前登录管理员信息写入至私有属性
        $this->admin_info = $this->request->session('admin');
        $this->config = getConfig();
        View::assign('admin', $this->admin_info);
        View::assign('config', $this->config);
        if (isset($this->admin_info['id'])) {
            $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
            View::assign('admin_info', $admin_info);
        }
    }

    public function index()
    {  
        View::assign('balance_zc_jr', number_format(Recharge::where('status', 3)->whereDay('create_time')->sum('amount'), 2));
        View::assign('balance_zc_zr', number_format(Recharge::where('status', 3)->whereDay('create_time', 'yesterday')->sum('amount'), 2));
        View::assign('balance_zc_s', number_format(Recharge::where('status', 3)->sum('amount'), 2));

        View::assign('withdrawal_jr', number_format(Withdrawal::where('status', 1)->whereDay('create_time')->sum('amount'), 2));
        View::assign('withdrawal_zr', number_format(Withdrawal::where('status', 1)->whereDay('create_time', 'yesterday')->sum('amount'), 2));
        View::assign('withdrawal_s', number_format(Withdrawal::where('status', 1)->sum('amount'), 2));
        
        View::assign('order_jr', Order::whereDay('create_time')->count());
        View::assign('order_zr', Order::whereDay('create_time', 'yesterday')->count());
        View::assign('order_s', Order::count());
        
        View::assign('transaction_order_jr', TransactionOrder::whereDay('create_time')->count());
        View::assign('transaction_order_zr', TransactionOrder::whereDay('create_time', 'yesterday')->count());
        View::assign('transaction_order_s', TransactionOrder::count());
        
        View::assign('transaction_order_amount_jr', number_format(TransactionOrder::whereDay('create_time')->sum('pay_amount'), 2));
        View::assign('transaction_order_amount_jr', number_format(TransactionOrder::whereDay('create_time', 'yesterday')->sum('pay_amount'), 2));
        View::assign('transaction_order_amount_jr', number_format(TransactionOrder::sum('pay_amount'), 2));
        
        
        View::assign('rebate_record_jr', number_format(RebateRecord::whereDay('create_time')->sum('amount'), 2));
        View::assign('rebate_record_zr', number_format(RebateRecord::whereDay('create_time', 'yesterday')->sum('amount'), 2));
        View::assign('rebate_record_s', number_format(RebateRecord::sum('amount'), 2));
        return View::fetch();
    }

    public function user()
    {
        $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
        if(power($admin_info['power'],'用户列表') == 2){
            return view('/error_message', ['msg' => '权限不足']);
        }
        return View::fetch();
    }
    
    public function slide()
    {
        $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
        if(power($admin_info['power'],'首页轮播图') == 2){
            return view('/error_message', ['msg' => '权限不足']);
        }
        return View::fetch();
    }
    
    public function product_cz()
    {
        $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
        if(power($admin_info['power'],'充值业务 - 产品列表') == 2){
            return view('/error_message', ['msg' => '权限不足']);
        }
        return View::fetch();
    }

    public function product_cx()
    {
        $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
        if(power($admin_info['power'],'查询业务 - 产品列表') == 2){
            return view('/error_message', ['msg' => '权限不足']);
        }
        return View::fetch();
    }

    public function order_cz()
    {
        $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
        if(power($admin_info['power'],'充值业务 - 订单列表') == 2){
            return view('/error_message', ['msg' => '权限不足']);
        }
      
        View::assign('product_list', Product::where('type', 1)->select());
     
        return View::fetch();
    }

    public function order_cx()
    {
        $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
        if(power($admin_info['power'],'查询业务 - 订单列表') == 2){
            return view('/error_message', ['msg' => '权限不足']);
        }
        View::assign('product_list', Product::where('type', 2)->select());
        return View::fetch();
    }

    public function recharge()
    {
        $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
        if(power($admin_info['power'],'充值订单记录') == 2){
            return view('/error_message', ['msg' => '权限不足']);
        }
        return View::fetch();
    }

    public function withdrawal()
    {
        $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
        if(power($admin_info['power'],'提现订单记录') == 2){
            return view('/error_message', ['msg' => '权限不足']);
        }
        return View::fetch();
    }

    public function transaction_product()
    {
        $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
        if(power($admin_info['power'],'交易挂单数据') == 2){
            return view('/error_message', ['msg' => '权限不足']);
        }
        return View::fetch();
    }

    public function transaction_order()
    {
        $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
        if(power($admin_info['power'],'交易订单数据') == 2){
            return view('/error_message', ['msg' => '权限不足']);
        }
        return View::fetch();
    }

    public function bank_card()
    {
        $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
        if(power($admin_info['power'],'支付管理') == 2){
            return view('/error_message', ['msg' => '权限不足']);
        }
        return View::fetch();
    }

    public function user_t()
    {
        $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
        if(power($admin_info['power'],'用户列表') == 2){
            return view('/error_message', ['msg' => '权限不足']);
        }
        return View::fetch();
    }

    public function rebate_record()
    {
        $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
        if(power($admin_info['power'],'返佣记录') == 2){
            return view('/error_message', ['msg' => '权限不足']);
        }
        return View::fetch();
    }
    
    
    public function setting()
    {
        $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
        if(power($admin_info['power'],'系统设置管理') == 2){
            return view('/error_message', ['msg' => '权限不足']);
        }
        View::assign('product_list', Product::where('type', 1)->select());
        return View::fetch();
    }
    
    public function account()
    {
        return View::fetch();
    }
    
    public function admin()
    {
        $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
        if(power($admin_info['power'],'管理员列表') == 2){
            return view('/error_message', ['msg' => '权限不足']);
        }
        return View::fetch();
    }
    
    public function login()
    {
        if (!empty($this->request->session('admin.login_ip')) && $this->request->session('admin.login_ip') === $this->request->ip()) {
            return redirect(getConfig('backstage_entrance'));
        }
        return View::fetch();
    }
    
}

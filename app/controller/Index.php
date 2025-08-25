<?php
declare (strict_types=1);
namespace app\controller;
use app\middleware\UserAuth;
use app\model\User as UserModel;
use app\model\Batch;
use app\model\BankCard;
use app\model\Order;
use app\model\Product;
use app\model\Slide;
use app\model\Recharge;
use app\model\RebateRecord;
use app\model\Withdrawal;
use app\model\TransactionOrder;
use app\model\TransactionProduct;
use app\model\PaymentVoucher as PaymentVoucherModel;
use think\facade\Session;
use think\App;
use think\facade\View;
use think\facade\Route;
use think\Request;

class Index 
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

    protected mixed $user_info;
    protected string|array|bool $config = [];
    protected array $middleware = [UserAuth::class];

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->request = $this->app->request;
        // 将当前登录管理员信息写入至私有属性
        $this->user_info = $this->request->session('user');
        $this->config = getConfig();
        View::assign('user', $this->user_info);
        View::assign('config', $this->config);
        if (isset($this->user_info['id'])) {
            $user_info = UserModel::where('id', $this->user_info['id'])->find();
            View::assign('user_info', $user_info);
        }
    }

    public function index()
    {
        
        View::assign('Product_list', Product::where('status', 1)->where('type', 1)->order('sort', 'desc')->select());

        View::assign('b_product', Product::find(getConfig('a_recommend_id')));
        View::assign('a_product', Product::find(getConfig('b_recommend_id')));


        View::assign('Slide_list', Slide::select());
        return View::fetch();
    }
    
    public function query_business()
    {
        View::assign('Product_list', Product::where('type', 2)->order('sort', 'desc')->select());
        return View::fetch();
    }

    public function query_business_page($id)
    {
        $Product = Product::find($id);
        View::assign('product', $Product);
        return View::fetch();
    }
    

    public function order_cz()
    {
        View::assign('product_list', Product::where('type', 1)->field('id,name')->select());
        return View::fetch();
    }

    public function order_cx()
    {
        View::assign('product_list', Product::where('type', 1)->field('id,name')->select());
        return View::fetch();
    }

    public function out_order()
    {
        return View::fetch();
    }

    public function order_voucher()
    {
      $get_info = $this->request->get();    
      View::assign('order_id', $get_info['id']);    
      return View::fetch();
    }

    public function order_voucher_edit()
    {
      $get_info = $this->request->get();
      $list = PaymentVoucherModel::where('order_id', $get_info['order_id'])->find();   
      if(!$list){
          $list['order_id'] = $get_info['order_id'];
          $list['name'] = '';
          $list['money'] = '';
          for($a =1 ;$a<=8;$a++){
              $list['title'.$a] = '';
              $list['remark'.$a] ='';
          }
      }
      View::assign('list', $list);        
      return View::fetch();
    }


    public function order()
    {
        return View::fetch();
    }
    
    public function order_info()
    {
        $order = Order::where('uid', $this->user_info['id'])->where('order_number', $_REQUEST['order_number'])->find();
        if($order){
            $order_info = '';
            foreach ($order['order_info'] as $item) {
                if (preg_match('/\[(.*?)\](.*)/', $item, $matches)) {

                    $result = checkIfImageExists(url('/')->domain(true) . $matches[2]);
                    if ($result == 1) {
                        $order_info .=  '
                        <div class="flexJA flexSb">
                            <div class="num">'.$matches[1].':<img src="'.$matches[2].'" style="width: 50px;"></div>
                        </div>';
                    } else {
                        $order_info .= '
                        <div class="flexJA flexSb">
                            <div class="num">'.$matches[1].':'.$matches[2].'</div>
                            <div class="num" onclick="copyToClipboard('.$matches[2].')">复制</div>
                        </div>';
                        
                        if(phone_info($matches[2]) == '移动' || phone_info($matches[2]) == '联通' || phone_info($matches[2]) == '电信'){
                            $order_info .= '
                            <div class="flexJA flexSb">
                                <div class="num">运营商:'.phone_info($matches[2], 1).'</div>
                            </div>';
                        }
                        
                        if(!empty($order['phone_yue_a'])){
                            $order_info .= '
                            <div class="flexJA flexSb">
                                <div class="num">下单前余额:'.$order['phone_yue_a'].'</div>
                            </div>';
                        }
                        
                    }
                }
            }
            View::assign('order_infos', $order_info);
            
            
            
            View::assign('order_info', $order);
            return View::fetch();
        }
        return '订单不存在';
    }
    

    
    public function recharge_withdrawal()
    {
        View::assign('recharge_list', Recharge::where('uid', $this->user_info['id'])->order('id', 'desc')->select());
        View::assign('withdrawal_list', Withdrawal::where('uid', $this->user_info['id'])->order('id', 'desc')->select());
        return View::fetch();
    }

    public function recharge($order_number)
    {
        $Recharge = Recharge::where('order_number', $order_number)->find();
        if($Recharge){
            View::assign('recharge', $Recharge);
            return View::fetch();
        }
        return '订单不存在';
    }

    public function withdrawal_confirm()
    {
        return View::fetch();
    }

    public function wallet_details()
    {
        View::assign('product_cz_list', Product::where('type', 1)->order('id', 'desc')->select());

        return View::fetch();
    }

    public function wallet_details_data()
    {
        $wallet_details_data = '';
        // 冻结金额
        if($_REQUEST['type'] == 1){
            $wallet_details_data .= '<div class="list">';
            $order_1 = Order::where('uid', $this->user_info['id'])->where('status', 'in', '0,1,2')->where('confirm_status', 'in', '0,1')->where('type', 1)->select();
            foreach($order_1 as $key => $vo) {
                $wallet_details_data .= '
                <div class="item flexJA flexFs flexAis">
                    <div class="icon">
                        <div style="background-image: url(/static/index/image/unusable_amount_icon.png); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="right">
                        <div class="bar flexJA flexSb">
                            <div class="title">金额冻结</div>
                            <div class="num">'.$vo['cny_amount'].'</div>
                        </div>
                        <div class="bar flexJA flexSb">
                            <div class="text">充值订单</div>
                            <div class="unit">USDT</div>
                        </div>
                        <div class="date">'.$vo['create_time'].'</div>
                    </div>
                </div>';
            }
            $order_2 = Order::where('uid', $this->user_info['id'])->where('status', 'in', '0,1')->where('type', 2)->select();
            foreach($order_2 as $key => $vo) {
                $wallet_details_data .= '
                <div class="item flexJA flexFs flexAis">
                    <div class="icon">
                        <div style="background-image: url(/static/index/image/unusable_amount_icon.png); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="right">
                        <div class="bar flexJA flexSb">
                            <div class="title">金额冻结</div>
                            <div class="num">'.$vo['cny_amount'].'</div>
                        </div>
                        <div class="bar flexJA flexSb">
                            <div class="text">线索提供</div>
                            <div class="unit">USDT</div>
                        </div>
                        <div class="date">'.$vo['create_time'].'</div>
                    </div>
                </div>';
            }
            
            $T_product = TransactionProduct::where('uid', $this->user_info['id'])->where('status', 'in', '1,2')->select();
            foreach($T_product as $key => $vo) {
                $wallet_details_data .= '
                <div class="item flexJA flexFs flexAis">
                    <div class="icon">
                        <div style="background-image: url(/static/index/image/unusable_amount_icon.png); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="right">
                        <div class="bar flexJA flexSb">
                            <div class="title">金额冻结</div>
                            <div class="num">'.$vo['sell_account'].'</div>
                        </div>
                        <div class="bar flexJA flexSb">
                            <div class="text">交易挂单</div>
                            <div class="unit">USDT</div>
                        </div>
                        <div class="date">'.$vo['create_time'].'</div>
                    </div>
                </div>';
            }
            $wallet_details_data .= '</div>';
        }

        // 订单退款
        if($_REQUEST['type'] == 2){
            $wallet_details_data .= '<div class="list">';
            $order_1 = Order::where('uid', $this->user_info['id'])->where('status', 3)->select();
            foreach($order_1 as $key => $vo) {
                if($vo['type'] == 1){
                    $type = '充值订单';
                }else{
                    $type = '线索提供';
                }
                $wallet_details_data .= '
                <div class="item flexJA flexFs flexAis">
                    <div class="icon">
                        <div style="background-image: url(/static/index/image/unusable_amount_icon.png); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="right">
                        <div class="bar flexJA flexSb">
                            <div class="title">订单退款</div>
                            <div class="num">'.$vo['cny_amount'].'</div>
                        </div>
                        <div class="bar flexJA flexSb">
                            <div class="text">'.$type.'</div>
                            <div class="unit">USDT</div>
                        </div>
                        <div class="date">'.$vo['create_time'].'</div>
                    </div>
                </div>';
            }
            $wallet_details_data .= '</div>';
        }

        // 充值业务
        $parts = explode("_", $_REQUEST['type']);
        if($parts[0] == 'product'){
            $wallet_details_data .= '<div class="list">';
            $order = Order::where('uid', $this->user_info['id'])->where('product_id', $parts[1])->select();
            foreach($order as $key => $vo) {
                $wallet_details_data .= '
                <div class="item flexJA flexFs flexAis">
                    <div class="icon">
                        <div style="background-image: url(/static/index/image/unusable_amount_icon.png); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="right">
                        <div class="bar flexJA flexSb">
                            <div class="title">'.$vo['product_info']['name'].'</div>
                            <div class="num">'.$vo['cny_amount'].'</div>
                        </div>
                        <div class="bar flexJA flexSb">
                            <div class="text">充值订单</div>
                            <div class="unit">USDT</div>
                        </div>
                        <div class="date">'.$vo['create_time'].'</div>
                    </div>
                </div>';
            }
            $wallet_details_data .= '</div>';
        }

        // 查询业务
        if($_REQUEST['type'] == 3){
            $wallet_details_data .= '<div class="list">';
            $order_1 = Order::where('uid', $this->user_info['id'])->where('type', 2)->select();
            foreach($order_1 as $key => $vo) {
                $wallet_details_data .= '
                <div class="item flexJA flexFs flexAis">
                    <div class="icon">
                        <div style="background-image: url(/static/index/image/unusable_amount_icon.png); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="right">
                        <div class="bar flexJA flexSb">
                            <div class="title">'.$vo['product_info']['name'].'</div>
                            <div class="num">'.$vo['cny_amount'].'</div>
                        </div>
                        <div class="bar flexJA flexSb">
                            <div class="text">线索提供</div>
                            <div class="unit">USDT</div>
                        </div>
                        <div class="date">'.$vo['create_time'].'</div>
                    </div>
                </div>';
            }
            $wallet_details_data .= '</div>';
        }

        // 提现U币
        if($_REQUEST['type'] == 4){
            $wallet_details_data .= '<div class="list">';
            $Withdrawal = Withdrawal::where('uid', $this->user_info['id'])->select();
            foreach($Withdrawal as $key => $vo) {
                if($vo['status'] == 0){
                    $status = '申请中';
                }
                if($vo['status'] == 1){
                    $status = '提现成功';
                }
                if($vo['status'] == 2){
                    $status = '提现失败';
                }
                $wallet_details_data .= '
                <div class="item flexJA flexFs flexAis">
                    <div class="icon">
                        <div style="background-image: url(/static/index/image/unusable_amount_icon.png); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="right">
                        <div class="bar flexJA flexSb">
                            <div class="title">余额提现</div>
                            <div class="num">'.$vo['amount'].'</div>
                        </div>
                        <div class="bar flexJA flexSb">
                            <div class="text">'.$status.'</div>
                            <div class="unit">USDT</div>
                        </div>
                        <div class="date">'.$vo['create_time'].'</div>
                    </div>
                </div>';
            }
            $wallet_details_data .= '</div>';
        }

        // 充值U币
        if($_REQUEST['type'] == 5){
            $wallet_details_data .= '<div class="list">';
            $Recharge = Recharge::where('uid', $this->user_info['id'])->select();
            foreach($Recharge as $key => $vo) {
                if($vo['status'] == 0){
                    $status = '待汇款提交';
                }
                if($vo['status'] == 1){
                    $status = '已提交';
                }
                if($vo['status'] == 2){
                    $status = '取消订单';
                }
                if($vo['status'] == 3){
                    $status = '订单完成';
                }
                $wallet_details_data .= '
                <div class="item flexJA flexFs flexAis">
                    <div class="icon">
                        <div style="background-image: url(/static/index/image/unusable_amount_icon.png); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="right">
                        <div class="bar flexJA flexSb">
                            <div class="title">余额充值</div>
                            <div class="num">'.$vo['amount'].'</div>
                        </div>
                        <div class="bar flexJA flexSb">
                            <div class="text">'.$status.'</div>
                            <div class="unit">USDT</div>
                        </div>
                        <div class="date">'.$vo['create_time'].'</div>
                    </div>
                </div>';
            }
            $wallet_details_data .= '</div>';
        }

        // 代理分润
        if($_REQUEST['type'] == 6){
            $wallet_details_data .= '<div class="list">';
            $RebateRecord = RebateRecord::where('tid', $this->user_info['id'])->select();
            foreach($RebateRecord as $key => $vo) {
                $wallet_details_data .= '
                <div class="item flexJA flexFs flexAis">
                    <div class="icon">
                        <div style="background-image: url(/static/index/image/unusable_amount_icon.png); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="right">
                        <div class="bar flexJA flexSb">
                            <div class="title">返佣分润</div>
                            <div class="num">'.$vo['amount'].'</div>
                        </div>
                        <div class="bar flexJA flexSb">
                            <div class="text"></div>
                            <div class="unit">USDT</div>
                        </div>
                        <div class="date">'.$vo['create_time'].'</div>
                    </div>
                </div>';
            }
            $wallet_details_data .= '</div>';
        }


        // 交易买入
        if($_REQUEST['type'] == 7){
            $wallet_details_data .= '<div class="list">';
            $TransactionOrder = TransactionOrder::where('uid', $this->user_info['id'])->select();
            foreach($TransactionOrder as $key => $vo) {
                $wallet_details_data .= '
                <div class="item flexJA flexFs flexAis">
                    <div class="icon">
                        <div style="background-image: url(/static/index/image/unusable_amount_icon.png); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="right">
                        <div class="bar flexJA flexSb">
                            <div class="title">交易买入</div>
                            <div class="num">'.$vo['usdt_amount'].'</div>
                        </div>
                        <div class="bar flexJA flexSb">
                            <div class="text"></div>
                            <div class="unit">USDT</div>
                        </div>
                        <div class="date">'.$vo['create_time'].'</div>
                    </div>
                </div>';
            }
            $wallet_details_data .= '</div>';
        }

        // 交易卖出
        if($_REQUEST['type'] == 8){
            $wallet_details_data .= '<div class="list">';
            $TransactionOrder = TransactionOrder::where('sell_uid', $this->user_info['id'])->select();
            foreach($TransactionOrder as $key => $vo) {
                $wallet_details_data .= '
                <div class="item flexJA flexFs flexAis">
                    <div class="icon">
                        <div style="background-image: url(/static/index/image/unusable_amount_icon.png); background-position: center center; background-size: cover; background-repeat: no-repeat;height: 100%;"></div>
                    </div>
                    <div class="right">
                        <div class="bar flexJA flexSb">
                            <div class="title">交易卖出</div>
                            <div class="num">'.$vo['pay_amount'].'</div>
                        </div>
                        <div class="bar flexJA flexSb">
                            <div class="text"></div>
                            <div class="unit">USDT</div>
                        </div>
                        <div class="date">'.$vo['create_time'].'</div>
                    </div>
                </div>';
            }
            $wallet_details_data .= '</div>';
        }



        View::assign('wallet_details_data', $wallet_details_data);
        return View::fetch();
    }
    
    
    public function my()
    {
        View::assign('order_cz_count', Order::where('uid', $this->user_info['id'])->where('type', 1)->count());
        View::assign('order_cx_count', Order::where('uid', $this->user_info['id'])->where('type', 2)->count());
        

        $order_1 = Order::where('uid', $this->user_info['id'])->where('status', 'in', '0,1,2')->where('confirm_status', 'in', '0,1,3')->where('type', 1)->sum('cny_amount');
        $order_2 = Order::where('uid', $this->user_info['id'])->where('status', 'in', '0,1')->where('type', 2)->sum('cny_amount');
        $T_product = TransactionProduct::where('uid', $this->user_info['id'])->where('status', 'in', '1,2')->sum('sell_account');
       
        View::assign('freeze_amount', number_format($order_1 + $order_2 + $T_product, 2));

        $TransactionOrder_count = TransactionOrder::where('uid|sell_uid', '=', $this->user_info['id'])->where('status', 'in', '0,1')->count();
        View::assign('TransactionOrder_count', $TransactionOrder_count);
        return View::fetch();
    }

    public function account_settings()
    {
        return View::fetch();
    }

    public function information()
    {
        return View::fetch();
    }

    public function password()
    {
        return View::fetch();
    }

    public function wallet_address()
    {
        return View::fetch();
    }
    
    public function agreement()
    {
        return View::fetch();
    }
    
    public function privacy_policy()
    {
        return View::fetch();
    }
    
    public function oil_card_list()
    {
        return View::fetch();
    }
    
    public function invite_friends()
    {
        return View::fetch();
    }
    
    public function chat_message()
    {
        return View::fetch();
    }
    
    public function agency_center()
    {
        $rebate_jr = RebateRecord::where('tid', $this->user_info['id'])->whereDay('create_time')->sum('amount');
        View::assign('rebate_jr', number_format($rebate_jr, 2));

        $rebate_s = RebateRecord::where('tid', $this->user_info['id'])->sum('amount');
        View::assign('rebate_s', number_format($rebate_s, 2));

        return View::fetch();
    }
    
    public function bank_card()
    {
        View::assign('BankCard_list', BankCard::where('uid', $this->user_info['id'])->order('id', 'desc')->select());
        return View::fetch();
    }
    public function bank_card_add_modify()
    {
        $BankCard_info = BankCard::where('uid', $this->user_info['id'])->find($_REQUEST['id']??'');
        View::assign('BankCard_info', $BankCard_info);

        return View::fetch();
    }
    

    public function product($id)
    {
        $Product = Product::find($id);

        View::assign('product', $Product);

        $order_info = $Product['order_info'];
        usort($order_info, function($a, $b) {
            return intval($b['sort']) - intval($a['sort']);
        });
        View::assign('order_info', $order_info);
        
        // 面值
        $par_values = $Product['par_value'];
        usort($par_values, function($a, $b) {
            return intval($a['value']) - intval($b['value']);
        });
        View::assign('par_values', $par_values);

        
        View::assign('batch_ok_count', Batch::where('uid', $this->user_info['id'])->where('status', 0)->count());
        return View::fetch();
    }

    public function batch()
    {
        return View::fetch();
    }

    public function transaction_index()
    {
        return View::fetch();
    }
    
    public function transaction_my_sale()
    {
        return View::fetch();
    }

    public function transaction_sale_edit()
    {
        $TransactionProduct_info = TransactionProduct::where('uid', $this->user_info['id'])->where('status', 'in', '1,2')->find($_REQUEST['id']??'');
        View::assign('TransactionProduct_info', $TransactionProduct_info);
        return View::fetch();
    }
    
    public function transaction_buy()
    {
        $TransactionProduct_info = TransactionProduct::where('status', 'in', '1')->find($_REQUEST['id']??'');
        View::assign('TransactionProduct_info', $TransactionProduct_info);
        
        $sell_uid_info = UserModel::where('id', $TransactionProduct_info['uid'])->find();
        View::assign('sell_uid_info', $sell_uid_info);

        return View::fetch();
    }

    public function transaction_order()
    {
        return View::fetch();
    }

    public function transaction_trading_details($order_number)
    {
        View::assign('TransactionOrder_info', TransactionOrder::where('order_number', $order_number)->find());
        return View::fetch();
    }
    
    public function login()
    {
        View::assign('mobile', Session::get('mobile'));
        View::assign('remember_password', Session::get('remember_password'));
        return View::fetch();
    }

    public function register()
    {
        return View::fetch();
    }

    

    public function order_query()
    {
        return View::fetch();
    }
}

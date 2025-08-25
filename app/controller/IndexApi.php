<?php
declare (strict_types=1);

namespace app\controller;
use app\middleware\UserAuth;
use app\model\User as UserModel;
use app\model\PaymentVoucher as PaymentVoucherModel;
use app\model\Batch;
use app\model\BankCard;
use app\model\Order;
use app\model\Product;
use app\model\Recharge;
use app\model\RebateRecord;
use app\model\Withdrawal;
use app\model\TransactionOrder;
use app\model\TransactionProduct;


use Exception;
use JsonException;
use think\App;
use think\db\exception\DbException;
use think\exception\ValidateException;
use think\facade\Session;
use think\facade\Validate;
use think\Request;
use Yurun\Util\HttpRequest;
use yzh52521\filesystem\facade\Filesystem;

class IndexApi
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
    }
    


    public function order_query()
    {
        $post_info = $this->request->post();
        if(empty($post_info['order_content'])){
            return show(500, 'error', '请输入下单账号');
        }
        
        $Order = Order::where('order_info', 'like', '%]' . $_REQUEST['order_content'].'"%')->order('id', 'desc')->select();
        if(!empty(count($Order))){
            return show(200, 'success', '查询成功', $Order);
        }
        return show(500, 'error', '暂无数据');
    }

    public function agency_center_post(string $action)
    {
        $post_info = $this->request->post();
        switch ($action) {
            case 'confirm_payment':
                $user_info = UserModel::where('id', $this->user_info['id'])->find();
                if($user_info['balance'] < getConfig('agent_money')){
                    return show(500, 'error', '可用余额已不足');
                }
                $user_info->balance -= getConfig('agent_money');
                $user_info->agent_status = 1;
                $user_info->save();
                return show(200, 'success', '开通成功');

            default:
                return show(500, 'error', '请求出错');
        }
    }

    public function transaction_trading_details_post(string $action)
    {
        $post_info = $this->request->post();
        $user_info = UserModel::where('id', $this->user_info['id'])->find();
        $TransactionOrder_info = TransactionOrder::where('uid', $user_info['id'])->find($post_info['id']);
        switch ($action) {
            case 'acepted_submit':
                if(empty($post_info['password'])){
                    return show(500, 'error', '请输入登录密码');
                }
                if ($user_info && password_verify(($post_info['password'] . $user_info->salt), $user_info->password)) {
                    $TransactionOrder_info = TransactionOrder::where('sell_uid', $user_info['id'])->find($post_info['id']);
                    if($TransactionOrder_info['status'] == 1){
                        $TransactionOrder_info->status = 3;
                        $TransactionOrder_info->complete_time = date("Y-m-d H:i:s");
                        $TransactionOrder_info->save();

                        $TransactionProduct_info = TransactionProduct::find($TransactionOrder_info['pid']);
                        $TransactionProduct_info->sell_account -= $TransactionOrder_info['pay_amount'];
                        $TransactionProduct_info->save();

                        $user_info = UserModel::find($TransactionOrder_info['uid']);
                        $user_info->balance += $TransactionOrder_info['usdt_amount'];
                        $user_info->save();
                        return show(200, 'success', '操作成功');
                    }
                    return show(500, 'error', '状态错误');
                }
                return show(500, 'error', '登录密码错误');

            case 'confirm':
                if($TransactionOrder_info && empty($TransactionOrder_info['status'])){
                    $TransactionOrder_info->status = 1;
                    $TransactionOrder_info->submit_time = date("Y-m-d H:i:s");
                    $TransactionOrder_info->save();
                    return show(200, 'success', '操作成功');
                }
                return show(500, 'error', '请求失败');

            case 'cancel':
                if($TransactionOrder_info && empty($TransactionOrder_info['status'])){
                    $TransactionOrder_info->status = 2;
                    $TransactionOrder_info->cancel_time = date("Y-m-d H:i:s");
                    $TransactionOrder_info->save();
                    return show(200, 'success', '取消成功');
                }
                return show(500, 'error', '请求失败');

            case 'image':
                $TransactionOrder_info->voucher_image = $post_info['voucher_image'];
                $TransactionOrder_info->save();
                return show(200, 'success', '上传成功');

            default:
                return show(500, 'error', '请求出错');
        }
    }

    public function transaction_buy_post(string $action)
    {
        $post_info = $this->request->post();
        $user_info = UserModel::where('id', $this->user_info['id'])->find();
        switch ($action) {
            case 'submit':
                $TransactionProduct_info = TransactionProduct::where('status', 'in', '1')->find($post_info['transact_id']);
                if(empty($post_info['pay_amount'])){
                    return show(500, 'error', '请输入购买数量');
                }
                if(empty($post_info['remittance_user_name'])){
                    return show(500, 'error', '请输入您的真实姓名');
                }
                if($TransactionProduct_info['min_limit'] > $post_info['pay_amount'] || $TransactionProduct_info['max_limit'] < $post_info['pay_amount']){
                    return show(500, 'error', '超出购买限制');
                }
                if($TransactionProduct_info['sell_account'] < $post_info['pay_amount']){
                    return show(500, 'error', '超出最高出售数量');
                }
                if(empty($TransactionProduct_info)){
                    return show(500, 'error', '售卖交易已下架或取消');
                }
                $order_number = date("Ymd") . randomkeys(6, 'number');

                TransactionOrder::create([
                    'uid' => $user_info['id'],
                    'sell_uid' => $TransactionProduct_info['uid'],
                    'pid' => $TransactionProduct_info['id'],
                    'order_number' => $order_number,
                    'pay_amount' => $post_info['pay_amount'],
                    'payment_amount' => $post_info['pay_amount'] * $TransactionProduct_info['unit_price'],
                    'remittance_user_name' => $post_info['remittance_user_name'],
                    'bank_card_info' => $TransactionProduct_info['bank_card_info'],
                    'unit_price' => $TransactionProduct_info['unit_price'],
                    'transaction_fees' => getConfig('transaction_fees'),
                    'usdt_amount' => $post_info['pay_amount'] - (floatval(getConfig('transaction_fees')) ?? 0),
                ]);
                return show(200, 'success', '确认成功', $order_number);

            default:
                return show(500, 'error', '请求出错');
        }
    }

    public function transaction_my_sale_post(string $action)
    {
        $post_info = $this->request->post();
        $user_info = UserModel::where('id', $this->user_info['id'])->find();
        $TransactionProduct_info = TransactionProduct::where('uid', $user_info['id'])->find($post_info['id']);
        switch ($action) {
            case 'status_operate':
                if($post_info['status'] == 1 || $post_info['status'] == 2){
                    $TransactionProduct_info->status = $post_info['status'];
                    $TransactionProduct_info->save();
                    return show(200, 'success', '操作成功');
                }
                if($post_info['status'] == 3 && $TransactionProduct_info['status'] != 3){
                    $TransactionProduct_info->status = $post_info['status'];
                    $TransactionProduct_info->save();
                    $user_info->balance += $TransactionProduct_info['sell_account'];
                    $user_info->save();
                    return show(200, 'success', '操作成功');
                }
                return show(500, 'error', '操作失败');

            default:
                return show(500, 'error', '请求出错');
        }
    }

    public function transaction_sale_edit_post(string $action)
    {
        $post_info = $this->request->post();
        $user_info = UserModel::where('id', $this->user_info['id'])->find();
        $TransactionProduct_info = TransactionProduct::where('uid', $user_info['id'])->find($post_info['id']??'');
        switch ($action) {
            case 'submit':
                if(empty($post_info['sell_account'])){
                    return show(500, 'error', '请输入挂单数量');
                }
                if($post_info['sell_account'] < getConfig('transaction_mini_quantity')){
                    return show(500, 'error', '最低挂单数'.getConfig('transaction_mini_quantity').'起');
                }
                if(empty($post_info['unit_price'])){
                    return show(500, 'error', '请输入单价价格');
                }
                if(empty($post_info['min_limit'])){
                    return show(500, 'error', '请输入最小额度');
                }
                if(empty($post_info['max_limit'])){
                    return show(500, 'error', '请输入最大额度');
                }
                if($post_info['min_limit'] > $post_info['max_limit']){
                    return show(500, 'error', '最小额度不能大于最大额度');
                }
                $BankCard_info = BankCard::where('uid', $this->user_info['id'])->where('default_selection', 1)->find();
                if(!$BankCard_info){
                    return show(500, 'error', '请选择收款卡号');
                }
                $sell_account = $user_info['balance'] +  ($TransactionProduct_info['sell_account'] ?? 0);
                if($sell_account < $post_info['sell_account']){
                    return show(500, 'error', '可用余额已不足');
                }
                
                $user_info->balance = $sell_account - $post_info['sell_account'];
                $user_info->save();
                if($TransactionProduct_info){
                    $TransactionProduct_info->sell_account = $post_info['sell_account'];
                    $TransactionProduct_info->unit_price = $post_info['unit_price'];
                    $TransactionProduct_info->min_limit = $post_info['min_limit'];
                    $TransactionProduct_info->max_limit = $post_info['max_limit'];
                    $TransactionProduct_info->bank_card_info = BankCard::where('uid', $this->user_info['id'])->where('default_selection', 1)->find();
                    $TransactionProduct_info->save();
                    return show(200, 'success', '修改成功');
                }
                
                TransactionProduct::create([
                    'uid' => $user_info['id'],
                    'sell_account' => $post_info['sell_account'],
                    'unit_price' => $post_info['unit_price'],
                    'min_limit' => $post_info['min_limit'],
                    'max_limit' => $post_info['max_limit'],
                    'bank_card_info' => BankCard::where('uid', $this->user_info['id'])->where('default_selection', 1)->find(),
                ]);
                return show(200, 'success', '保存成功');

            case 'bank_card':
                $BankCard_info = BankCard::where('uid', $this->user_info['id'])->where('default_selection', 1)->find();
                return show(200, 'success', '获取成功', $BankCard_info);

            default:
                return show(500, 'error', '请求出错');
        }
    }

    public function batch_post(string $action)
    {
        $post_info = $this->request->post();
        $user_info = UserModel::where('id', $this->user_info['id'])->find();
        switch ($action) {
            case 'add_batch':
                if(empty($post_info['manual_import'])){
                    return show(500, 'error', '请输入号码');
                }
                $manual_import = explode(',', $post_info['manual_import']);
                foreach ($manual_import as $number) {
                    $batch_count = Batch::where('uid', $user_info['id'])->where('number', $number)->count();
                    if(empty($batch_count)){
                        $status = 0;
                    }else{
                        $status = 1;
                    }
                    Batch::create([
                        'uid' => $user_info['id'],
                        'number' => $number,
                        'status' => $status,
                    ]);
                }
                return show(200, 'success', '保存成功');
                
            case 'upload_batch':
                if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
                    $file = $_FILES["file"]["tmp_name"];
                    
                    $lines = file($file, FILE_IGNORE_NEW_LINES);
                    
                    foreach ($lines as $number) {
                        $batch_count = Batch::where('uid', $user_info['id'])->where('number', $number)->count();
                        if(empty($batch_count)){
                            $status = 0;
                        }else{
                            $status = 1;
                        }
                        Batch::create([
                            'uid' => $user_info['id'],
                            'number' => $number,
                            'status' => $status,
                        ]);
                    }
                    return show(200, 'success', '导入成功');
                } else {
                    return show(500, 'error', '导入失败');
                }

            case 'del':
                Batch::destroy($post_info['id']);
                return show(200, 'success', '删除成功');

            case 'dels':
                $batch = Batch::where('uid', $user_info['id'])->select();
                foreach ($batch as $vo) {
                    Batch::destroy($vo['id']);
                }
                return show(200, 'success', '清除成功');

            default:
                return show(500, 'error', '请求出错');
        }
    }

    public function bank_card_post(string $action)
    {
        $post_info = $this->request->post();
        $user_info = UserModel::where('id', $this->user_info['id'])->find();
        $BankCard_info = BankCard::where('uid', $user_info['id'])->find($post_info['bank_card_id']??'');
        switch ($action) {
            case 'submit':
                if(empty($post_info['name'])){
                    return show(500, 'error', '请输入姓名');
                }
                if(empty($post_info['mobile'])){
                    return show(500, 'error', '请输入预留手机号');
                }
                if(empty($post_info['wx_account'])){
                    return show(500, 'error', '请输入微信');
                }
                if(empty($post_info['zfb_account'])){
                    return show(500, 'error', '请输入支付宝');
                }
                if($BankCard_info){
                    $BankCard_info->name = $post_info['name'];
                    $BankCard_info->mobile = $post_info['mobile'];
                    $BankCard_info->wx_account = $post_info['wx_account'];
                    $BankCard_info->zfb_account = $post_info['zfb_account'];
                    $BankCard_info->save();
                    return show(200, 'success', '保存成功');         
                }
                
                $BankCard_count = BankCard::where('uid', $user_info['id'])->count();
                if(empty($BankCard_count)){
                    $default_selection = 1;
                }else{
                    $default_selection = 0;
                }
                BankCard::create([
                    'uid' => $user_info['id'],
                    'name' => $post_info['name'],
                    'mobile' => $post_info['mobile'],
                    'wx_account' => $post_info['wx_account'],
                    'zfb_account' => $post_info['zfb_account'],
                    'default_selection' => $default_selection,
                ]);
                return show(200, 'success', '保存成功');
                
            case 'default_selection':
                $data = BankCard::where('uid', $user_info['id'])->select();
                foreach($data as $key => $vo) {
                    $BankCard = BankCard::find($vo['id']);
                    $BankCard->default_selection = 0;
                    $BankCard->save();
                }
                $BankCard_info->default_selection = 1;
                $BankCard_info->save();
                return show(200, 'success', '切换成功');

            case 'del':
                BankCard::destroy($post_info['id']);
                return show(200, 'success', '删除成功');

            default:
                return show(500, 'error', '请求出错');
        }
    }

    public function wallet_details_post(string $action)
    {
        $post_info = $this->request->post();
        $user_info = UserModel::where('id', $this->user_info['id'])->find();
        switch ($action) {
            case 'wallet_details':
                $data = [];
                // 查询收入数据
                $Recharge_amount = Recharge::where('uid', $user_info['id'])->where('operate_type', 0)->whereTime('create_time', 'between', [$post_info['start_time'], $post_info['end_time']])->sum('amount');
                
                $data['recharge_amount'] = $Recharge_amount;


                $data['total_income'] = $Recharge_amount;

                $RebateRecord_amount = RebateRecord::where('tid', $user_info['id'])->whereTime('create_time', 'between', [$post_info['start_time'], $post_info['end_time']])->sum('amount');
                $data['rebate_record_amount'] = $RebateRecord_amount;

                $TransactionOrder_u_amount = TransactionOrder::where('uid', $user_info['id'])->whereTime('create_time', 'between', [$post_info['start_time'], $post_info['end_time']])->sum('usdt_amount');
                $data['transaction_order_u_amount'] = $TransactionOrder_u_amount;

                $TransactionOrder_t_amount = TransactionOrder::where('sell_uid', $user_info['id'])->whereTime('create_time', 'between', [$post_info['start_time'], $post_info['end_time']])->sum('pay_amount');
                $data['transaction_order_t_amount'] = $TransactionOrder_t_amount;


                // 查询支出数据
                $Product_data = Product::select();
                foreach($Product_data as $key => $vo) {
                    if($vo['type'] == 1){
                        $data['product_'. $vo['id']] = Order::where('uid', $user_info['id'])->where('product_id', $vo['id'])->whereTime('create_time', 'between', [$post_info['start_time'], $post_info['end_time']])->sum('cny_amount');
                    }
                }

                $data['query_business'] = Order::where('uid', $user_info['id'])->where('type', 2)->whereTime('create_time', 'between', [$post_info['start_time'], $post_info['end_time']])->sum('cny_amount');// 查询业务
                $cny_amount = Order::where('uid', $user_info['id'])->whereTime('create_time', 'between', [$post_info['start_time'], $post_info['end_time']])->sum('cny_amount');
                $withdrawal_amount = Withdrawal::where('uid', $user_info['id'])->whereTime('create_time', 'between', [$post_info['start_time'], $post_info['end_time']])->sum('amount');
                $data['withdrawal_amount'] = number_format($withdrawal_amount, 2);
                $data['total_expenditure'] = number_format($cny_amount + $withdrawal_amount, 2);



                // 查询其他数据
                $order_1 = Order::where('uid', $user_info['id'])->where('status', 'in', '0,1,2')->where('confirm_status', 'in', '0,1,3')->where('type', 1)->whereTime('create_time', 'between', [$post_info['start_time'], $post_info['end_time']])->sum('cny_amount');
                $order_2 = Order::where('uid', $user_info['id'])->where('status', 'in', '0,1')->where('type', 2)->whereTime('create_time', 'between', [$post_info['start_time'], $post_info['end_time']])->sum('cny_amount');
                $T_product = TransactionProduct::where('uid', $this->user_info['id'])->where('status', 'in', '1,2')->whereTime('create_time', 'between', [$post_info['start_time'], $post_info['end_time']])->sum('sell_account');

                $data['freeze_amount'] = number_format($order_1 + $order_2 + $T_product, 2);

                $refund_amount = Order::where('uid', $user_info['id'])->where('status', 3)->whereTime('create_time', 'between', [$post_info['start_time'], $post_info['end_time']])->sum('cny_amount');
                $data['refund_amount'] = number_format($refund_amount, 2);
                return show(200, 'success', '查询成功', $data);

            default:
                return show(500, 'error', '请求出错');
        }
    }

    public function out_order_post(string $action)
    {
        $post_info = $this->request->post();
        $user_info = UserModel::where('id', $this->user_info['id'])->find();
        $order_info = Order::where('uid', $user_info['id'])->find($post_info['id']??'');
        switch ($action) {
            case 'received':
                if($order_info){
                    if($post_info['confirm_status'] == 1){
                        $confirm_status = 3;
                    }elseif($post_info['confirm_status'] == 2){
                        $confirm_status = 2;
                    }else{
                        return show(500, 'error', '参数有误');
                    }
                    $order_info->confirm_status = $confirm_status;
                    $order_info->save();

                    return show(200, 'success', '操作成功');
                }
                return show(500, 'error', '请求失败');

            default:
                return show(500, 'error', '请求出错');
        }
    }
    
    public function payment_voucher(string $action){
        $post_info = $this->request->post();
        switch ($action) {
            case 'edit':
            $payment_voucher_list = PaymentVoucherModel::where('order_id', $post_info['order_id'])->find();    
               if($payment_voucher_list){
                   $payment_voucher_list->order_id = $post_info['order_id'];
                    if($post_info['name']){
                        $payment_voucher_list->name = $post_info['name'];
                    }
                    if($post_info['money']){
                        $payment_voucher_list->money = $post_info['money'];
                    }
                    if($post_info['title1']){
                        $payment_voucher_list->title1 = $post_info['title1'];
                    }
                    if($post_info['remark1']){
                        $payment_voucher_list->remark1 = $post_info['remark1'];
                    }
                    if($post_info['title2']){
                        $payment_voucher_list->title2 = $post_info['title2'];
                    }
                    if($post_info['remark2']){
                        $payment_voucher_list->remark2 = $post_info['remark2'];
                    }
                    if($post_info['title3']){
                        $payment_voucher_list->title3 = $post_info['title3'];
                    }
                    if($post_info['remark3']){
                        $payment_voucher_list->remark3 = $post_info['remark3'];
                    }
                    if($post_info['title4']){
                        $payment_voucher_list->title4 = $post_info['title4'];
                    }
                    if($post_info['remark4']){
                        $payment_voucher_list->remark4 = $post_info['remark4'];
                    }
                    if($post_info['title5']){
                        $payment_voucher_list->title5 = $post_info['title5'];
                    }
                    if($post_info['remark5']){
                        $payment_voucher_list->remark5 = $post_info['remark5'];
                    }
                    if($post_info['title6']){
                        $payment_voucher_list->title6 = $post_info['title6'];
                    }
                    if($post_info['remark6']){
                        $payment_voucher_list->remark6 = $post_info['remark6'];
                    }
                    if($post_info['title7']){
                        $payment_voucher_list->title7 = $post_info['title7'];
                    }
                    if($post_info['remark7']){
                        $payment_voucher_list->remark7 = $post_info['remark7'];
                    }
                    if($post_info['title8']){
                        $payment_voucher_list->title8 = $post_info['title8'];
                    }
                    if($post_info['remark8']){
                        $payment_voucher_list->remark8 = $post_info['remark8'];
                    }
                    $payment_voucher_list->save();
                    return show(200, 'success', '操作成功');    
                }else{
                    $data = [];
                      $data['order_id'] = $post_info['order_id'];
                    if($post_info['name']){
                        $data['name'] = $post_info['name'];
                    }
                    if($post_info['money']){
                        $data['money'] = $post_info['money'];
                    }
                    if($post_info['title1']){
                         $data['title1'] = $post_info['title1'];
                    }
                    if($post_info['remark1']){
                         $data['remark1'] = $post_info['remark1'];
                    }
                    if($post_info['title2']){
                         $data['title2'] = $post_info['title2'];
                    }
                    if($post_info['remark2']){
                         $data['remark2'] = $post_info['remark2'];
                    }
                    if($post_info['title3']){
                         $data['title3'] = $post_info['title3'];
                    }
                    if($post_info['remark3']){
                         $data['remark3'] = $post_info['remark3'];
                    }
                    if($post_info['title4']){
                         $data['title4'] = $post_info['title4'];
                    }
                    if($post_info['remark4']){
                         $data['remark4'] = $post_info['remark4'];
                    }
                    if($post_info['title5']){
                         $data['title5'] = $post_info['title5'];
                    }
                    if($post_info['remark5']){
                         $data['remark5'] = $post_info['remark5'];
                    }
                    if($post_info['title6']){
                         $data['title6'] = $post_info['title6'];
                    }
                    if($post_info['remark6']){
                         $data['remark6'] = $post_info['remark6'];
                    }
                    if($post_info['title7']){
                         $data['title7'] = $post_info['title7'];
                    }
                    if($post_info['remark7']){
                         $data['remark7'] = $post_info['remark7'];
                    }
                    if($post_info['title8']){
                         $data['title8'] = $post_info['title8'];
                    }
                    if($post_info['remark8']){
                         $data['remark8'] = $post_info['remark8'];
                    }
                    $list = PaymentVoucherModel::create($data);
                }
               
            return show(200, 'success', '操作成功');    
        }
    }

    public function order_post(string $action)
    {
        $post_info = $this->request->post();
        $user_info = UserModel::where('id', $this->user_info['id'])->find();
        $order_info = Order::where('uid', $user_info['id'])->find($post_info['id']??'');
        switch ($action) {
            case 'cancel':
                if($order_info && empty($order_info['status'])){
                    $order_info->status = 3;
                    $order_info->save();

                    $user_info->balance += $order_info['cny_amount'];
                    $user_info->save();
                    return show(200, 'success', '取消成功');
                }
                return show(500, 'error', '请求失败');

            case 'order_del':
                Order::destroy($post_info['del_id']);
                return show(200, 'success', '删除成功');

            case 'del':
                if($order_info && $order_info['status'] == 2){
                    Order::destroy($post_info['id']);
                    return show(200, 'success', '删除成功');
                }
                return show(500, 'error', '请求失败');

            case 'info':
                if($order_info){
                    $info = '';
                    foreach ($order_info['order_info'] as $item) {
                        if (preg_match('/\[(.*?)\](.*)/', $item, $matches)) {
                            $result = checkIfImageExists(url('/')->domain(true) . $matches[2]);
                            if ($result == 1) {
                                $info .= '<div class="title">' . $matches[1] . '：</div>
                                
                                <article class="upload-piclist upload-piclist_4">
                                    <div class="upload-Picitem upload-Picitem_4">
                                        <img src="' . $matches[2] . '" alt="pic">
                                    </div>
                                </article>';
                            } else {
                                $info .= '<div class="title">' . $matches[1] . '：' . $matches[2] . '</div>';
                            }
                        }
                    }

                    return show(200, 'success', '获取成功', $info);
                }
                return show(500, 'error', '请求失败');

                
            case 'user_on_line_status':
                $user_info->on_line_status = $post_info['on_line_status'];
                $user_info->save();
                return show(200, 'success', '提交成功');
                
                
            case 'order_on_line_status':
                $order_info->on_line_status = $post_info['on_line_status'];
                $order_info->save();
                return show(200, 'success', '提交成功');

            default:
                return show(500, 'error', '请求出错');
        }
    }

    public function withdrawal_confirm_post(string $action)
    {
        $post_info = $this->request->post();
        $user_info = UserModel::where('id', $this->user_info['id'])->find();
        switch ($action) {
            case 'submit':
                if(empty($post_info['amount'])){
                    return show(500, 'error', '提现金额有误');
                }
                if($post_info['amount'] < getConfig('mini_withdrawal_amount')){
                    return show(500, 'error', '提现金额不可低于' . getConfig('mini_withdrawal_amount'));
                }
                if($post_info['amount'] > $user_info['balance']){
                    return show(500, 'error', '账户余额不足');
                }
                if(empty($user_info['trc20'])){
                    return show(500, 'error', '未设置地址');
                }

                Withdrawal::create([
                    'uid' => $user_info['id'],
                    'amount' => $post_info['amount'],
                    'wallet_address' => $user_info['trc20'],
                    'withdrawal_fee' => getConfig('withdrawal_fee'),
                    'order_number' => date("Ymd") . randomkeys(6, 'number'),
                ]);

                $user_info->balance -= $post_info['amount'];
                $user_info->save();
                return show(200, 'success', '提交成功');

            default:
                return show(500, 'error', '请求出错');
        }
    }

    public function recharge_post(string $action)
    {
        $post_info = $this->request->post();
        $recharge_info = Recharge::find($post_info['id']);
        switch ($action) {
            case 'cancel':
                $recharge_info->status = 2;
                $recharge_info->cancel_time = date("Y-m-d H:i:s");
                $recharge_info->save();
                return show(200, 'success', '取消成功');

            case 'submit':
                $recharge_info->status = 1;
                $recharge_info->submit_time = date("Y-m-d H:i:s");
                $recharge_info->save();
                return show(200, 'success', '提交成功');
                
            case 'image':
                $recharge_info->image = $post_info['image'];
                $recharge_info->save();
                return show(200, 'success', '上传成功');
                

            default:
                return show(500, 'error', '请求出错');
        }
    }

    public function recharge_withdrawal_post(string $action)
    {
        $post_info = $this->request->post();
        $user_info = UserModel::where('id', $this->user_info['id'])->find();
        switch ($action) {
            case 'recharge':
                if(empty($post_info['amount'])){
                    return show(500, 'error', '请输入充值金额');
                }
                if($post_info['amount'] < getConfig('mini_recharge_amount')){
                    return show(500, 'error', '充值金额不可低于' . getConfig('mini_recharge_amount'));
                }
                if(empty($user_info['trc20'])){
                    return show(500, 'error', '未设置地址');
                }
                $recharge = Recharge::create([
                    'uid' => $this->user_info['id'],
                    'amount' => $post_info['amount'],
                    'pay_type' => $post_info['pay_type'],
                    'wallet_address' => $user_info['trc20'],
                    'order_number' => date("Ymd") . randomkeys(6, 'number'),
                ]);
                return show(200, 'success', '提交成功', '/recharge/'.$recharge->order_number);
                
                
            case 'recharge_epay':
                $order_number = date('Ymd') . randomkeys(8);
                if($post_info['epay_type'] == '1'){
                    $type = 'alipay';
                }else{
                    $type = 'wxpay';
                }
                $params = array(
                    'pid' => getConfig('epay_id'),
                    'type' => $type,
                    'out_trade_no' =>  $order_number,
                    'notify_url' => (string)url('/epay_notify_url')->suffix('')->domain(true),
                    'return_url' => (string)url('/recharge_withdrawal')->suffix('')->domain(true),
                    'name' => '余额充值',
                    'money' => number_format($post_info['amount'] * getConfig('rate')??0, 2),
                    'sign_type' => 'MD5'
                );
        		ksort($params);
        		reset($params);
        		$signstr = '';
        		foreach($params as $k => $v){
        			if($k != "sign" && $k != "sign_type" && $v!=''){
        				$signstr .= $k.'='.$v.'&';
        			}
        		}
        		$signstr = substr($signstr,0,-1);
        		$signstr .= getConfig('epay_key');
        		$sign = md5($signstr);
        		$params['sign'] = $sign;
        
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, getConfig('epay_url').'submit.php?' . http_build_query($params));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'); // 模拟浏览器请求
                $response = curl_exec($ch);
                curl_close($ch);
                
                if (preg_match('/window.location.replace\(\'(.*?)\'\);/', $response, $matches)) {
                    $recharge = Recharge::create([
                        'uid' => $this->user_info['id'],
                        'amount' => $post_info['amount'],
                        'pay_type' => $post_info['pay_type'],
                        'epay_type' => $post_info['epay_type'],
                        'wallet_address' => $user_info['trc20'],
                        'order_number' => $order_number,
                    ]);
                    return show(200, 'success', '提交成功', getConfig('epay_url').$matches[1].'/');
                } else {
                    return show(500, 'error', '未找到重定向');
                }
                
            case 'withdrawal':
                if(empty($post_info['amount'])){
                    return show(500, 'error', '请输入充值金额');
                }
                if($post_info['amount'] < getConfig('mini_withdrawal_amount')){
                    return show(500, 'error', '充值金额不可低于' . getConfig('mini_withdrawal_amount'));
                }
                return show(200, 'success', '提交成功', '/withdrawal_confirm/?amount='.$post_info['amount']);

            default:
                return show(500, 'error', '请求出错');
        }
    }
     
    public function epay_notify_url()
    {
		ksort($_GET);
		reset($_GET);
		$signstr = '';
	
		foreach($_GET as $k => $v){
			if($k != "sign" && $k != "sign_type" && $v!=''){
				$signstr .= $k.'='.$v.'&';
			}
		}
		$signstr = substr($signstr,0,-1);
		$signstr .= getConfig('epay_key');
		$sign = md5($signstr);
		
		if($sign == $_GET['sign']){
		    $recharge_info = Recharge::where('order_number', $_REQUEST['out_trade_no'])->where('status', 0)->where('pay_type', 2)-> find();
		    $recharge_info->status = 3;
		    $recharge_info->save();
		    
            $user_info = UserModel::find($recharge_info['uid']);
            $user_info->balance += $recharge_info['amount'];
            $user_info->save();
		    return show(200, 'success', '回调成功');
		}
        return show(500, 'error', '验签失败');
    }

    public function account_settings_post(string $action)
    {
        $post_info = $this->request->post();
        $user_info = UserModel::where('id', $this->user_info['id'])->find();
        switch ($action) {
            case 'information':
                $user_info->avatar = $post_info['avatar'];
                $user_info->nickname = $post_info['nickname'];
                $user_info->surname = $post_info['surname'];
                $user_info->city = $post_info['city'];
                $user_info->birthday = $post_info['birthday'];
                $user_info->gender = $post_info['gender'];
                $user_info->save();
                return show(200, 'success', '保存成功');

            case 'password':
                if(empty($post_info['old_password'])){
                    return show(500, 'error', '请输入原登录密码');
                }
                if(empty($post_info['password_one'])){
                    return show(500, 'error', '请输入新登录密码');
                }
                if(empty($post_info['password_two'])){
                    return show(500, 'error', '请输入确认新登录密码');
                }
                if($post_info['password_one'] != $post_info['password_two']){
                    return show(500, 'error', '两次密码不相同');
                }
                if ($user_info && password_verify(($post_info['old_password'] . $user_info->salt), $user_info->password)) {
                    $salt = randomkeys(4);
                    $user_info->password = password_hash(($post_info['password_one'] . $salt), PASSWORD_BCRYPT);
                    $user_info->salt = $salt;
                    $user_info->save();

                    Session::delete('user');
                    return show(200, 'success', '修改成功');
                }
                return show(500, 'error', '原登录密码错误');
                
            case 'wallet_address':
                if(empty($post_info['address'])){
                    return show(500, 'error', '请输入提币地址');
                }
                if(empty($post_info['password'])){
                    return show(500, 'error', '请输入登录密码');
                }

                if ($user_info && password_verify(($post_info['password'] . $user_info->salt), $user_info->password)) {
                    $user_info->trc20 = $post_info['address'];
                    $user_info->save();
                    return show(200, 'success', '修改成功');
                }
                return show(500, 'error', '登录密码错误');


            default:
                return show(500, 'error', '请求出错');
        }
    }


    public function product_post(string $action)
    {
        $post_info = $this->request->post();
        $Product = Product::find($post_info['product_id']);
        $user_info = UserModel::where('id', $this->user_info['id'])->find();
        switch ($action) {
            case 'confirm_recharge':
                if(empty($post_info['amount_money'])){
                    return show(500, 'error', '请输入充值金额');
                }
                if($post_info['batch_type'] == 0){
                    $array = json_decode($post_info['order_info'], true);
                    foreach ($array as $item) {
                        if (preg_match('/\[(.*?)\](.*)/', $item, $matches)) {
                            if ($matches[2] == '') {
                                foreach ($Product['order_info'] as $vo) {
                                    if ($vo['name'] == $matches[1]) {
                                        if($vo['type'] == 1){
                                            return show(500, 'error', '请输入'.$matches[1]);
                                        }
                                        if($vo['type'] == 2 || $vo['type'] == 3){
                                            return show(500, 'error', '请选择'.$matches[1]);
                                        }
                                        if($vo['type'] == 4){
                                            return show(500, 'error', '请上传'.$matches[1]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $amount_money = $post_info['amount_money'];
                }elseif($post_info['batch_type'] == 1){
                    $batch_ok_count = Batch::where('uid', $this->user_info['id'])->where('status', 0)->count();
                    if(empty($batch_ok_count)){
                        return show(500, 'error', '请导入充值号码');
                    }
                    $amount_money = $post_info['amount_money'] * $batch_ok_count;
                }
                return show(200, 'success', '查询成功', ['balance' => $user_info['balance'], 'discount' => discount($post_info['product_id'], $amount_money)]);

            case 'confirm_payment':
                // batch_type 0=单号 1=批量
                if($post_info['batch_type'] == 0){
                    $array = json_decode($post_info['order_info'], true);
                    foreach ($array as $item) {
                        if (preg_match('/\[(.*?)\](.*)/', $item, $matches)) {
                            if ($matches[2] == '') {
                                foreach ($Product['order_info'] as $vo) {
                                    if ($vo['name'] == $matches[1]) {
                                        if($vo['type'] == 1){
                                            return show(500, 'error', '请输入'.$matches[1]);
                                        }
                                        if($vo['type'] == 2 || $vo['type'] == 3){
                                            return show(500, 'error', '请选择'.$matches[1]);
                                        }
                                        if($vo['type'] == 4){
                                            return show(500, 'error', '请上传'.$matches[1]);
                                        }
                                    }
                                }
                            }else{
                                if(phone_info($matches[2])){
                                    if($Product['product_type'] == 1){
                                        $phone_yue = phone_yue($matches[2]);
                                    }
                                }
                            }
                        }
                    }
                    if(empty($post_info['amount_money'])){
                        return show(500, 'error', '请输入充值金额');
                    }
                    $discount = discount($post_info['product_id'], $post_info['amount_money']);
                    
                    
                    
                    $amount = str_replace(',', '', $discount['cnyAmount']);
                    $discount['cnyAmount'] = floatval($amount);
    
    
                    if($discount['cnyAmount'] > $user_info['balance']){
                        return show(500, 'error', '账户余额不足');
                    }
                    
                    Order::create([
                        'uid' => $this->user_info['id'],
                        'product_id' => $Product['id'],
                        'product_info' => $Product,
                        'order_number' => date("Ymd") . randomkeys(6, 'number'),
                        'amount_money' => $post_info['amount_money']??'',
                        'cny_amount' => $discount['cnyAmount']??'',
                        'discount_amount' => str_replace(',', '', $discount['discountAmount']??''),
                        'discount' => $discount['discount']??0,
                        'rate' => getConfig('rate'),
                        'order_info' => $post_info['order_info'],
                        'type' => $Product['type'],
                        'product_type' => $Product['product_type'],
                        'phone_yue_a' => $phone_yue??0.00,
                    ]);
                    $user_info->balance -= $discount['cnyAmount'];
                    $user_info->save();

                }elseif($post_info['batch_type'] == 1){
                    $batch_data = Batch::where('uid', $this->user_info['id'])->where('status', 0)->select();
        
                    $batch_ok_count = Batch::where('uid', $this->user_info['id'])->where('status', 0)->count();
                    if(empty($batch_ok_count)){
                        return show(500, 'error', '请导入充值号码');
                    }
                    if(empty($post_info['amount_money'])){
                        return show(500, 'error', '请输入充值金额');
                    }
                    $discount_count = discount($post_info['product_id'], ($post_info['amount_money'] * $batch_ok_count));
                    if($discount_count['cnyAmount'] > $user_info['balance']){
                        return show(500, 'error', '账户余额不足');
                    }
                    foreach($batch_data as $key => $vo) {
                        $discount = discount($post_info['product_id'], $post_info['amount_money']);
                        if($discount['cnyAmount'] > $user_info['balance']){
                            return show(500, 'error', '账户余额不足');
                        }
              
              
                        if(phone_info($vo['number'])){
                            if($Product['product_type'] == 1){
                                $phone_yue = phone_yue($vo['number']);
                            }
                        }
              
              
                        // return show(500, 'error', '账户余额不足' . $Product['type']);
                        Order::create([
                            'uid' => $this->user_info['id'],
                            'product_id' => $Product['id'],
                            'product_info' => $Product,
                            'order_number' => date("Ymd") . randomkeys(6, 'number'),
                            'amount_money' => $post_info['amount_money']??'',
                            'cny_amount' => $discount['cnyAmount']??'',
                            'discount_amount' => $discount['discountAmount']??'',
                            'discount' => $discount['discount']??0,
                            'rate' => getConfig('rate'),
                            'order_info' => ["[充值号码]".$vo['number']],
                            'type' => $Product['type'],
                            'product_type' => $Product['product_type'],
                            'phone_yue' => $phone_yue??0.00,
                        ]);
                        $user_info->balance -= $discount['cnyAmount'];
                        $user_info->save();
                    }
                }
                
                if($Product['product_type'] == 0){
                    $url = '/order_cz';
                }else{
                    $url = '/order';
                }
                
                return show(200, 'success', '支付成功', $url);

            case 'discount':
                if($post_info['batch_type'] == 0){
                    $amount_money = $post_info['amount_money'];
                }elseif($post_info['batch_type'] == 1){
                    $batch_ok_count = Batch::where('uid', $this->user_info['id'])->where('status', 0)->count();
                    $amount_money = $post_info['amount_money'] * $batch_ok_count;
                }
                return show(200, 'success', '查询成功', discount($post_info['product_id'], $amount_money));

            default:
                return show(500, 'error', '请求出错');
        }
    }



    public function query_business_page_post(string $action)
    {
        $post_info = $this->request->post();
        $product = Product::find($post_info['product_id']);
        $user_info = UserModel::where('id', $this->user_info['id'])->find();
        switch ($action) {
            case 'confirm_submit':
                if(empty($post_info['clue'])){
                    return show(500, 'error', '请输入线索');
                }
                if(empty($post_info['image'])){
                    return show(500, 'error', '请上传图片');
                }
                return show(200, 'success', '查询成功', ['balance' => $user_info['balance'], 'price' => number_format($product['quiry_price'] / getConfig('rate') ?? 0, 2, '.', '')]);


            case 'confirm_payment':
                $amount = number_format($product['quiry_price'] / getConfig('rate') ?? 0, 2, '.', '');

                if($amount > $user_info['balance']){
                    return show(500, 'error', '账户余额不足');
                }
                Order::create([
                    'uid' => $this->user_info['id'],
                    'product_id' => $product['id'],
                    'product_info' => $product,
                    'order_number' => date("Ymd") . randomkeys(6, 'number'),
                    'order_info' => $post_info['order_info'],
                    'cny_amount' => $amount,
                    'rate' => getConfig('rate'),
                    'type' => $product['type'],
                ]);
                
                $user_info->balance -= $amount;
                $user_info->save();
                return show(200, 'success', '支付成功');

            case 'discount':
                return show(200, 'success', '查询成功', discount($post_info['product_id'], $post_info['amount_money']));

            default:
                return show(500, 'error', '请求出错');
        }
    }
    

    public function footer_post(string $action)
    {
        $post_info = $this->request->post();
        switch ($action) {
            case 'out_order':
                $confirm_order_count = Order::where('uid', $this->user_info['id'])->where('status', 'in', '2')->where('confirm_status', 'in', '1')->where('type', 1)->count();
                if(!empty($confirm_order_count)){
                    return show(200, 'success', '有待确认订单', $confirm_order_count);
                }
                return show(500, 'error', '无待确认订单');

            default:
                return show(500, 'error', '请求出错');
        }
    }

    // 图片上传
    public function upload_post()
    {
        $base64_img = $this->request->post('result');
        // 存放图片到该用户的专有目录内
        $up_dir = dirname(__DIR__, 2) . '/public/storage/picture/';
        if (!file_exists($up_dir) && !mkdir($up_dir) && !is_dir($up_dir)) {
            return show(500, 'error', '图片缓存目录创建失败，请联系平台客服处理！');
        }
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_img, $image)) {
            $poststamp = $image[2];
            if (in_array($poststamp, array('pjpeg', 'jpeg', 'jpg', 'png'))) {
                $name = randomkeys(6);

                $new_file = $up_dir . $name . '.' . $poststamp;
                if (!file_put_contents($new_file, base64_decode(str_replace($image[1], '', $base64_img)))) {
                    return show(500, 'error', '图片上传失败');
                }
                return show(200, 'success', '上传成功', '/storage/picture/' . $name . '.' . $poststamp);
            } else {
                return show(500, 'error', '图片上传类型错误');
            }
        }
        return show(500, 'error', '图片上传错误');
    }


    public function login_post(string $action)
    {
        $post_info = $this->request->post();
        switch ($action) {
            case 'login':
                if(empty($post_info['mobile'])){
                    return show(500, 'error', '请输入手机号码');
                }
                if(empty($post_info['password'])){
                    return show(500, 'error', '请输入登录密码');
                }
                $user_info = UserModel::where('mobile', '=', $post_info['mobile'])->find();
                if ($user_info && password_verify(($post_info['password'] . $user_info->salt), $user_info->password)) {
                    if($user_info['status'] == 0){
                        return show(500, 'error', '账号已禁封，请联系管理员');
                    }
                    if(!empty($post_info['remember_password'])){
                        Session::set('mobile', $post_info['mobile']);
                        Session::set('remember_password', $post_info['password']);
                    }else{
                        Session::delete('mobile');
                        Session::delete('remember_password');
                    }
                    $ip = $this->request->ip();
                    Session::set('user', $user_info->getData());
                    Session::set('user.login_ip', $ip);
                    return show(200, 'success', '登录成功');
                }
                return show(500, 'error', '账号密码错误');

            default:
                return show(500, 'error', '请求出错');
        }
    }


    public function register_post(string $action)
    {
        $post_info = $this->request->post();
        switch ($action) {
            case 'register':
                if(empty($post_info['mobile'])){
                    return show(500, 'error', '请输入手机号');
                }
                if (!preg_match("/^1[3456789]\d{9}$/", $post_info['mobile'])) {
                    return show(500, 'error', '请输入有效手机号');
                }
                if(empty($post_info['password'])){
                    return show(500, 'error', '请输入密码');
                }
                if(empty($post_info['invite_code'])){
                    return show(500, 'error', '请输入邀请码');
                }
                $tid_1 = UserModel::where('invite_code', $post_info['invite_code'])->find();
                if(empty($tid_1)){
                    return show(500, 'error', '邀请码错误');
                }
                $subordinate = subordinate($tid_1);

                $user_info = UserModel::where('mobile', $post_info['mobile'])->find();
                if($user_info){
                    return show(500, 'error', '当前手机号已存在');
                }
                $salt = randomkeys(4);
                $user_info = UserModel::create([
                    'mobile' => $post_info['mobile'],
                    'password' => password_hash(($post_info['password'] . $salt), PASSWORD_BCRYPT),
                    'salt' => $salt,
                    'avatar' => $this->config['user_avatar_image'],
                    'nickname' => '用户_'.randomkeys(5, 'en'),
                    'invite_code' => randomkeys(8),
                    'tid_1' => $subordinate['tid_1'],
                    'tid_2' => $subordinate['tid_2'],
                    'tid_3' => $subordinate['tid_3'],
                    'tid_4' => $subordinate['tid_4'],
                    'tid_5' => $subordinate['tid_5'],
                    'tid_6' => $subordinate['tid_6'],
                    'tid_7' => $subordinate['tid_7'],
                    'tid_8' => $subordinate['tid_8'],
                    'tid_9' => $subordinate['tid_9'],
                    'tid_10' => $subordinate['tid_10'],
                ]);
                return show(200, 'success', '注册成功');

            default:
                return show(500, 'error', '请求出错');
        }
    }

    // 退出登录
    public function logout()
    {
        Session::delete('user');
        return redirect('/login');
    }
}
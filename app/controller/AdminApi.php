<?php
declare (strict_types=1);

namespace app\controller;
use app\middleware\AdminAuth;
use app\model\Admin as AdminModel;
use app\model\User as UserModel;
use app\model\Cache as CacheModel;
use app\model\Config as ConfigModel;
use app\model\Order;
use app\model\Product;
use app\model\Slide;
use app\model\Recharge;
use app\model\Withdrawal;
use app\model\TransactionOrder;
use app\model\TransactionProduct;
use app\model\RebateRecord;
use app\model\BankCard;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

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

class AdminApi
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
    }
    

    public function transaction_product_post(string $action)
    {
        $post_info = $this->request->post();
        switch ($action) {
            case 'operate':
                $TransactionProduct_info = TransactionProduct::find($post_info['id']);
                if($TransactionProduct_info['status'] == 1 || $TransactionProduct_info['status'] == 2){
                    $TransactionProduct_info->status = $post_info['status'];
                    $TransactionProduct_info->save();

                    if($post_info['status'] == 3){
                        $user_info = UserModel::find($TransactionProduct_info['uid']);
                        $user_info->balance += $TransactionProduct_info['sell_account'];
                        $user_info->save();
                    }
                    return show(200, 'success', '操作成功');
                }
                return show(500, 'error', '操作异常');

            case 'del':
                $TransactionProduct_info = TransactionProduct::find($post_info['id']);
                if($TransactionProduct_info['status'] == 3){
                    $user_info = UserModel::find($TransactionProduct_info['uid']);
                    $user_info->balance += $TransactionProduct_info['sell_account'];
                    $user_info->save();
                }
                TransactionProduct::destroy($post_info['id']);
                return show(200, 'success', '删除成功');
                            case 'dels':
                
            case 'dels':
                $data = TransactionProduct::where('id', 'in', $post_info['ids'])->select();
                foreach($data as $key => $vo) {
                    TransactionProduct::destroy($vo['id']);
                }
                return show(200, 'success', '删除成功');

            default:
                return show(500, 'error', '你不对劲');
        }
    }

    public function order_post(string $action)
    {
        $post_info = $this->request->post();
        switch ($action) {
            case 'audit_s':
                $data = Order::where('id', 'in', $post_info['ids'])->select();
                foreach ($data as $vo) {
                    $vo->status = $post_info['status'];
                    if($vo['status'] == 2){
                        $vo->confirm_status = 1;
                        $vo->complete_time = date("Y-m-d H:i:s");
                        // 返佣操作
                        rebate($vo['order_number']);
                    }
                    $vo->save();
                    if($post_info['status'] == 3){
                        $user_info = UserModel::find($vo['uid']);
                        $user_info->balance += $vo['cny_amount'];
                        $user_info->save();
                    }
                }
                return show(200, 'success', '处理成功');
           case 'audit_dz':
                 $order_info = Order::find($post_info['id']);
                 print_r($post_info['dz_number']);
                 $order_info->amount_received = $post_info['dz_number'];
                 $order_info->save();
                 return show(200, 'success', '处理成功');
            case 'audit':
                if($post_info['type'] == 'status'){
                    $order_info = Order::find($post_info['id']);

                    if($order_info['status'] == 0 || $order_info['status'] == 1){
                        $order_info->status = $post_info['status'];
                        if($order_info['status'] == 2){
                            $order_info->confirm_status = 1;
                            $order_info->complete_time = date("Y-m-d H:i:s");
                            // 返佣操作
                            rebate($order_info['order_number']);
                        }
                        $order_info->save();
                        if($post_info['status'] == 3){
                            $user_info = UserModel::find($order_info['uid']);
                            $user_info->balance += $order_info['cny_amount'];
                            $user_info->save();
                        }
                        return show(200, 'success', '处理成功');
                    }
                    return show(500, 'error', '审核异常');        
                }else{
                    $order_info = Order::find($post_info['id']);
                    if($order_info['status'] == 2 && $order_info['confirm_status'] == 3){
                        if($post_info['status'] == 2){
                            $order_info->confirm_status = 2;
                            $order_info->save();
                        }

                        if($post_info['status'] == 3){
                            $order_info->status = 3;
                            $order_info->save();
                            
                            $user_info = UserModel::find($order_info['uid']);
                            $user_info->balance += $order_info['cny_amount'];
                            $user_info->save();
                        }

                        return show(200, 'success', '处理成功');
                    }
                    return show(500, 'error', '审核异常');      
                }

            case 'query':
                $order_info = Order::find($post_info['id']);
                if($order_info['status'] == 0 || $order_info['status'] == 1){
                    $order_info->status = $post_info['status'];
                    if($order_info['status'] == 2){
                        $order_info->confirm_status = 1;
                        $order_info->complete_time = date("Y-m-d H:i:s");
                        
                        // 返佣操作
                        rebate($order_info['order_number']);
                    }
                    $order_info->save();
                    if($post_info['status'] == 3){
                        $user_info = UserModel::find($order_info['uid']);
                        $user_info->balance += $order_info['cny_amount'];
                        $user_info->save();
                    }
                    return show(200, 'success', '处理成功');
                }
                return show(500, 'error', '审核异常');

            case 'example_a':
                if(empty($post_info['ids'])){
                    if($post_info['product']){
                        $par[] = ['product_id', '=', substr($post_info['product'], 8)];
                    }
                    $par[] = ['type', '=', 1];
                    $data = Order::where($par)->select();
                }else{
                    $data = Order::where('id', 'in', $post_info['ids'])->where('type', 1)->select();
                }
                $customFieldNames = [
                    'order_number' => '订单号',
                    'product_info' => '产品信息',
                    'order_info' => '充值信息',
                    'amount_money' => '充值金额',
                    'discount_amount' => '折扣金额',
                    'discount' => '折扣比例',
                    'rate' => '当前费率',
                    'cny_amount' => '支付金额',
                    'status' => '订单状态',
                    'confirm_status' => '确认状态',	
                    'create_time' => '创建时间',
                ];
                // 创建PHPExcel对象
                $spreadsheet = new Spreadsheet();
                // 设置自定义字段名为第一行
                $spreadsheet->getActiveSheet()->fromArray($customFieldNames, NULL, 'A1');
                // 填充数据
                $rowData = [];
                foreach ($data as $row) {
                    $order_info = Order::where('id', $row['id'])->find();
                    $order_info->export_status = 1;
                    $order_info->save();
                    
                    if($order_info['status'] == 0){
                        $status = '待充值';
                    }if($order_info['status'] == 1){
                        $status = '充值中';
                    }if($order_info['status'] == 2){
                        $status = '已完成';
                    }if($order_info['status'] == 3){
                        $status = '已取消';
                    }
                    if($order_info['confirm_status'] == 0){
                        $confirm_status = '未完成';
                    }if($order_info['confirm_status'] == 1){
                        $confirm_status = '待确认';
                    }if($order_info['confirm_status'] == 2){
                        $confirm_status = '已确认';
                    }if($order_info['confirm_status'] == 3){
                        $confirm_status = '未收到';
                    }

                    $info = '';
                    foreach ($order_info['order_info'] as $item) {
                        if (preg_match('/\[(.*?)\](.*)/', $item, $matches)) {
                            $result = checkIfImageExists(url('/')->domain(true) . $matches[2]);
                            if ($result == 1) {
                                $info .= $matches[1] . '：' . url('/')->domain(true) . $matches[2]. '    ';
                            } else {
                                $info .= $matches[1] . '：' . $matches[2] . '    ';
                            }
                        }
                        
                        if(phone_info($matches[2])){
                            $info .= '运营商：' .  phone_info($matches[2]) . '    ';
                            $info .= '话费余额：' . $row['phone_yue_a'] . '    ';
                        }
                        
                    }

                    $rowData[] = [
                        'order_number' => $order_info['order_number'],
                        'product_info' => $order_info['product_info']['name'],
                        'order_info' => $info,
                        'amount_money' => $order_info['amount_money'],
                        'discount_amount' => $order_info['discount_amount'],
                        'discount' => $order_info['discount'],
                        'rate' => $order_info['rate'],
                        'cny_amount' => $order_info['cny_amount'],
                        'status' => $status,
                        'confirm_status' => $confirm_status,	
                        'create_time' => $order_info['create_time'],
                    ];
                }
                $spreadsheet->getActiveSheet()->fromArray($rowData, NULL, 'A2');
                // 保存Excel文件到服务器
                $filename = 'xls/export_data.xls';
                $writer = new Xls($spreadsheet);
                $writer->save($filename);
                return show(200, 'success', '执行成功', '/'.$filename);
                    
            case 'example_b':
                if(empty($post_info['ids'])){
                    if($post_info['product']){
                        $par[] = ['product_id', '=', substr($post_info['product'], 8)];
                    }
                    $par[] = ['type', '=', 2];
                    $data = Order::where($par)->select();
                }else{
                    $data = Order::where('id', 'in', $post_info['ids'])->where('type', 2)->select();
                }
                $customFieldNames = [
                    'order_number' => '订单号',
                    'product_info' => '产品信息',
                    'order_info' => '充值信息',
                    'rate' => '当前费率',
                    'cny_amount' => '支付金额',
                    'status' => '订单状态',
                    'confirm_status' => '确认状态',	
                    'create_time' => '创建时间',
                ];
                // 创建PHPExcel对象
                $spreadsheet = new Spreadsheet();
                // 设置自定义字段名为第一行
                $spreadsheet->getActiveSheet()->fromArray($customFieldNames, NULL, 'A1');
                // 填充数据
                $rowData = [];
                foreach ($data as $row) {
                    $order_info = Order::where('id', $row['id'])->find();
                    $order_info->export_status = 1;
                    $order_info->save();
                    if($order_info['status'] == 0){
                        $status = '待充值';
                    }if($order_info['status'] == 1){
                        $status = '充值中';
                    }if($order_info['status'] == 2){
                        $status = '已完成';
                    }if($order_info['status'] == 3){
                        $status = '已取消';
                    }
                    if($order_info['confirm_status'] == 0){
                        $confirm_status = '未完成';
                    }if($order_info['confirm_status'] == 1){
                        $confirm_status = '待确认';
                    }if($order_info['confirm_status'] == 2){
                        $confirm_status = '已确认';
                    }if($order_info['confirm_status'] == 3){
                        $confirm_status = '未收到';
                    }

                    $info = '';
                    foreach ($order_info['order_info'] as $item) {
                        if (preg_match('/\[(.*?)\](.*)/', $item, $matches)) {
                            $result = checkIfImageExists(url('/')->domain(true) . $matches[2]);
                            if ($result == 1) {
                                $info .= $matches[1] . '：' . url('/')->domain(true) . $matches[2]. '    ';
                            } else {
                                $info .= $matches[1] . '：' . $matches[2] . '    ';
                            }
                        }
                        
                        if(getTelecomOperator($matches[2]) != '未知'){
                            $info .= '运营商：' .  getTelecomOperator($matches[2]) . '    ';
                            $info .= '话费余额：' . $row['phone_yue_a'] . '    ';
                        }
                    }

                    $rowData[] = [
                        'order_number' => $order_info['order_number'],
                        'product_info' => $order_info['product_info']['name'],
                        'order_info' => $info,
                        'rate' => $order_info['rate'],
                        'cny_amount' => $order_info['cny_amount'],
                        'status' => $status,
                        'confirm_status' => $confirm_status,	
                        'create_time' => $order_info['create_time'],
                    ];
                }
                $spreadsheet->getActiveSheet()->fromArray($rowData, NULL, 'A2');
                // 保存Excel文件到服务器
                $filename = 'xls/export_data.xls';
                $writer = new Xls($spreadsheet);
                $writer->save($filename);

                return show(200, 'success', '执行成功', '/'.$filename);

                

            case 'picture_upload':

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
                        
                        $order_info = Order::find($post_info['order_id']);
                        $order_info->results = '/storage/picture/' . $name . '.' . $poststamp;
                        $order_info->save();
                        return show(200, 'success', '上传保存成功');
                    } else {
                        return show(500, 'error', '图片上传类型错误');
                    }
                }
                return show(500, 'error', '图片上传错误');
            case 'del':
                Order::destroy($post_info['id']);
                return show(200, 'success', '删除成功');
                
            case 'dels':
                
                $data = Order::where('id', 'in', $post_info['ids'])->select();
                foreach($data as $key => $vo) {
                    Order::destroy($vo['id']);
                }
                return show(200, 'success', '删除成功');
                
            default:
                return show(500, 'error', '你不对劲');
        }
    }

    public function withdrawal_post(string $action)
    {
        $post_info = $this->request->post();
        switch ($action) {
            case 'audit':
                $withdrawal_info = Withdrawal::find($post_info['id']);
                if($withdrawal_info['status'] == 0){
                    $withdrawal_info->status = $post_info['status'];
                    $withdrawal_info->save();

                    if($post_info['status'] == 2){
                        $user_info = UserModel::find($withdrawal_info['uid']);
                        $user_info->balance += $withdrawal_info['amount'];
                        $user_info->save();
                    }
                    return show(200, 'success', '审核成功');
                }
                return show(500, 'error', '审核异常');

            case 'del':
                Withdrawal::destroy($post_info['id']);
                return show(200, 'success', '删除成功');
                
            case 'dels':
                $data = Withdrawal::where('id', 'in', $post_info['ids'])->select();
                foreach($data as $key => $vo) {
                    Withdrawal::destroy($vo['id']);
                }
                return show(200, 'success', '删除成功');
            default:
                return show(500, 'error', '你不对劲');
        }
    }

    public function recharge_post(string $action)
    {
        $post_info = $this->request->post();
        switch ($action) {
            case 'audit':
                $recharge_info = Recharge::find($post_info['id']);
                if($recharge_info['status'] == 1){
                    if($post_info['status'] == 1){
                        $status = 3;
                    }elseif($post_info['status'] == 2){
                        $status = 2;
                    }
                    $recharge_info->status = $status;
                    $recharge_info->save();

                    if($post_info['status'] == 1){
                        $user_info = UserModel::find($recharge_info['uid']);
                        $user_info->balance += $recharge_info['amount'];
                        $user_info->save();
                    }
                    return show(200, 'success', '审核成功');
                }
                return show(500, 'error', '审核异常');

            case 'del':
                Recharge::destroy($post_info['id']);
                return show(200, 'success', '删除成功');
                
                
            case 'dels':
                $data = Recharge::where('id', 'in', $post_info['ids'])->select();
                foreach($data as $key => $vo) {
                    Recharge::destroy($vo['id']);
                }
                return show(200, 'success', '删除成功');
                
            default:
                return show(500, 'error', '你不对劲');
        }
    }
    
    
    

    public function bank_card_post(string $action)
    {
        $post_info = $this->request->post();
        switch ($action) {
            case 'dels':
                $data = BankCard::where('id', 'in', $post_info['ids'])->select();
                foreach($data as $key => $vo) {
                    BankCard::destroy($vo['id']);
                }
                return show(200, 'success', '删除成功');
                
            default:
                return show(500, 'error', '你不对劲');
        }
    }
    public function transaction_order_post(string $action)
    {
        $post_info = $this->request->post();
        switch ($action) {
            case 'del':
                TransactionOrder::destroy($post_info['id']);
                return show(200, 'success', '删除成功');
                
            case 'dels':
                $data = TransactionOrder::where('id', 'in', $post_info['ids'])->select();
                foreach($data as $key => $vo) {
                    TransactionOrder::destroy($vo['id']);
                }
                return show(200, 'success', '删除成功');
                
            default:
                return show(500, 'error', '你不对劲');
        }
    }
    

    public function rebate_record_post(string $action)
    {
        $post_info = $this->request->post();
        switch ($action) {
            case 'del':
                RebateRecord::destroy($post_info['id']);
                return show(200, 'success', '删除成功');
                
            case 'dels':
                $data = RebateRecord::where('id', 'in', $post_info['ids'])->select();
                foreach($data as $key => $vo) {
                    RebateRecord::destroy($vo['id']);
                }
                return show(200, 'success', '删除成功');
                
            default:
                return show(500, 'error', '你不对劲');
        }
    }
    
    

    public function slide_post(string $action)
    {
        $post_info = $this->request->post();
        switch ($action) {
            case 'submit':
                if(empty($post_info['name'])){
                    return show(500, 'error', '请输入轮播图名称');
                }
                if(empty($post_info['image'])){
                    return show(500, 'error', '请上传轮播图图片');
                }
                $Product_info = Product::find($post_info['id']??'');
                if($Product_info){
                    $Product_info->name = $post_info['name'];
                    $Product_info->image = $post_info['image'];
                    $Product_info->save();
                    return show(200, 'success', '修改成功');
                }
                Slide::create([
                    'name' => $post_info['name'],
                    'image' => $post_info['image'],
                ]);
                return show(200, 'success', '添加成功');

            case 'del':
                Slide::destroy($post_info['id']);
                return show(200, 'success', '删除成功');
                
            default:
                return show(500, 'error', '你不对劲');
        }
    }
    
    public function product_post(string $action)
    {
        $post_info = $this->request->post();
        switch ($action) {
            case 'add_modify':
                if(empty($post_info['name'])){
                    return show(500, 'error', '请输入产品名称');
                }
                if(empty($post_info['describe'])){
                    return show(500, 'error', '请输入产品描述');
                }
                if($post_info['type'] == 1){
                    if(empty($post_info['image'])){
                        return show(500, 'error', '请上传产品图标');
                    }
                    if(empty($post_info['mini_recharge_amount'])){
                        return show(500, 'error', '请输入最低充值金额');
                    }
                }else{
                    if(empty($post_info['quiry_price'])){
                        return show(500, 'error', '请输入查询价格');
                    }
                }
                
                $Product_info = Product::find($post_info['id']??'');
                if($Product_info){
                    $Product_info->name = $post_info['name'];
                    $Product_info->describe = $post_info['describe'];
                    $Product_info->tutorial_content = $post_info['tutorial_content']??null;
                    $Product_info->image = $post_info['image']??null;
                    $Product_info->mini_recharge_amount = $post_info['mini_recharge_amount']??null;
                    $Product_info->kickback_rtion_1 = $post_info['kickback_rtion_1']??null;
                    $Product_info->kickback_rtion_2 = $post_info['kickback_rtion_2']??null;
                    $Product_info->kickback_rtion_3 = $post_info['kickback_rtion_3']??null;
                    $Product_info->kickback_rtion_4 = $post_info['kickback_rtion_4']??null;
                    $Product_info->kickback_rtion_5 = $post_info['kickback_rtion_5']??null;
                    $Product_info->kickback_rtion_6 = $post_info['kickback_rtion_6']??null;
                    $Product_info->kickback_rtion_7 = $post_info['kickback_rtion_7']??null;
                    $Product_info->kickback_rtion_8 = $post_info['kickback_rtion_8']??null;
                    $Product_info->kickback_rtion_9 = $post_info['kickback_rtion_9']??null;
                    $Product_info->kickback_rtion_10 = $post_info['kickback_rtion_10']??null;

                    $Product_info->order_info = $post_info['order_info']??null;
                    $Product_info->par_value = $post_info['par_value']??null;
                    $Product_info->discount = $post_info['discount']??null;
                    $Product_info->quiry_price = $post_info['quiry_price']??null;
                    $Product_info->batch_status = $post_info['batch_status']??null;
                    $Product_info->product_type = $post_info['product_type']??null;
                    $Product_info->save();
                    
                    return show(200, 'success', '修改成功');
                }
                Product::create([
                    'type' => $post_info['type'],
                    'name' => $post_info['name'],
                    'describe' => $post_info['describe'],
                    'tutorial_content' => $post_info['tutorial_content']??null,
                    'image' => $post_info['image']??null,
                    'mini_recharge_amount' => $post_info['mini_recharge_amount']??null,
                    'kickback_rtion_1' => $post_info['kickback_rtion_1']??null,
                    'kickback_rtion_2' => $post_info['kickback_rtion_2']??null,
                    'kickback_rtion_3' => $post_info['kickback_rtion_3']??null,
                    'kickback_rtion_4' => $post_info['kickback_rtion_4']??null,
                    'kickback_rtion_5' => $post_info['kickback_rtion_5']??null,
                    'kickback_rtion_6' => $post_info['kickback_rtion_6']??null,
                    'kickback_rtion_7' => $post_info['kickback_rtion_7']??null,
                    'kickback_rtion_8' => $post_info['kickback_rtion_8']??null,
                    'kickback_rtion_9' => $post_info['kickback_rtion_9']??null,
                    'kickback_rtion_10' => $post_info['kickback_rtion_10']??null,

                    'order_info' => $post_info['order_info']??null,
                    'par_value' => $post_info['par_value']??null,
                    'discount' => $post_info['discount']??null,
                    'quiry_price' => $post_info['quiry_price']??null,
                    'batch_status' => $post_info['batch_status']??null,
                ]);
                return show(200, 'success', '添加成功');

            case 'info':
                $res = Product::find($post_info['id']);
                
                if($res['type'] == 1){
                    $order_info_html = '';
                    foreach($res['order_info'] as $key => $vo_a) {
                        $selected_1 = $selected_2 = $selected_3 = $selected_4 = '';
                        if($vo_a['type'] == 1){
                            $selected_1 = 'selected';
                        }elseif($vo_a['type'] == 2){
                            $selected_2 = 'selected';
                        }elseif($vo_a['type'] == 3){
                            $selected_3 = 'selected';
                        }elseif($vo_a['type'] == 4){
                            $selected_4 = 'selected';
                        }

                        $order_info_html .= '
                        <div data-repeater-item order_info_html>
                            <div class="form-group row mb-3">
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <span class="input-group-text">类型：</span>
                                        <select class="form-select" id="type" data-placeholder="请选择类型">
                                            <option value="1" '.$selected_1.'>输入框</option>
                                            <option value="2" '.$selected_2.'>地区选择（市）</option>
                                            <option value="3" '.$selected_3.'>地区选择（区）</option>
                                            <option value="4" '.$selected_4.'>图片上传</option>
                                        </select>
                                        <span class="input-group-text">排序：</span>
                                        <input type="text" class="form-control" id="sort" placeholder="请输入排序" value="'.$vo_a['sort'].'"/>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">名称：</span>
                                        <input type="text" class="form-control" id="name" placeholder="请输入名称" value="'.$vo_a['name'].'"/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <a href="javascript:;" data-repeater-delete class="btn btn-light-danger">
                                        <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                    </a>
                                </div>
                            </div>
                        </div>';
                    }
                    $res['order_info_html'] = $order_info_html;

                    $par_value_html = '';
                    foreach($res['par_value'] as $key => $vo_b) {
                        $name = $vo_b['name']??'';
                        $par_value_html .= '
                        <div data-repeater-item>
                            <div class="form-group row mb-3">
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <span class="input-group-text">名称：</span>
                                        <input type="text" class="form-control" id="name" placeholder="请输入名称" value="'.$name.'"/>
                                        <span class="input-group-text">面值：</span>
                                        <input type="text" class="form-control" id="value" placeholder="请输入面值" value="'.$vo_b['value'].'"/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <a href="javascript:;" data-repeater-delete class="btn btn-light-danger">
                                        <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                    </a>
                                </div>
                            </div>
                        </div>';
                    }
                    $res['par_value_html'] = $par_value_html;
                    
                    $discount_html = '';
                    foreach($res['discount'] as $key => $vo_c) {
                        $discount_html .= '
                        <div data-repeater-item>
                            <div class="form-group row mb-3">
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input type="text" id="mini_amount" class="form-control form-control-" placeholder="请输入金额" value="'.$vo_c['mini_amount'].'">
                                        <span class="input-group-text">~</span>
                                        <input type="text" id="maxi_amount" class="form-control form-control-" placeholder="请输入金额" value="'.$vo_c['maxi_amount'].'">
                                        <span class="input-group-text">折扣</span>
                                        <input type="text" id="discounts" class="form-control form-control-" placeholder="请输入折扣" value="'.$vo_c['discount'].'">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <a href="javascript:;" data-repeater-delete class="btn btn-light-danger">
                                        <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                    </a>
                                </div>
                            </div>
                        </div>';
                    }
                    $res['discount_html'] = $discount_html;
                }
                return show(200, 'success', '获取信息成功', (array)$res->getData());
                

            case 'status_switch':
                $res = Product::find($post_info['id']);
                $res->status = ($res->status === 0) ? 1 : 0;
                $res->save();
                return show(200, 'success', '状态更新成功');

            case 'sort':
                $res = Product::find($post_info['id']);
                $res->sort = $post_info['sort'];
                $res->save();
                return show(200, 'success', '更新成功');
                
            case 'del':
                Product::destroy($post_info['id']);
                return show(200, 'success', '删除成功');
                
            case 'dels':
                $data = Product::where('id', 'in', $post_info['ids'])->select();
                foreach($data as $key => $vo) {
                    Product::destroy($vo['id']);
                }
                return show(200, 'success', '删除成功');
                
            default:
                return show(500, 'error', '你不对劲');
        }
    }


    public function user_post(string $action)
    {
        $post_info = $this->request->post();
        switch ($action) {
            case 'balance':
                $user_info = UserModel::find($post_info['uid']);
                if ($post_info['add_minus'] === 'add') {
                    $user_info->balance += $post_info['balance_cz'];
                    $user_info->save();

                    Recharge::create([
                        'uid' => $user_info['id'],
                        'amount' => $post_info['balance_cz'],
                        'wallet_address' => '后台充值加款',
                        'status' => 3,
                        'order_number' => date("Ymd") . randomkeys(6, 'number'),
                    ]);
                    return show(200, 'success', '加款成功');
                }else if ($post_info['add_minus'] === 'minus') {
                    $user_info->balance -= $post_info['balance_cz'];
                    $user_info->save();
                    Recharge::create([
                        'uid' => $user_info['id'],
                        'amount' => $post_info['balance_cz'],
                        'wallet_address' => '后台充值扣款',
                        'status' => 3,
                        'operate_type' => 1,
                        'order_number' => date("Ymd") . randomkeys(6, 'number'),
                    ]);
                    return show(200, 'success', '扣款成功');
                }
            
            case 'password':
                $user_info = UserModel::find($post_info['uid']);
                $salt = randomkeys(4);
                $user_info->password = password_hash(($post_info['password'] . $salt), PASSWORD_BCRYPT);
                $user_info->salt = $salt;
                $user_info->save();
                
                return show(200, 'success', '修改成功');

            case 'status_switch':
                $res = UserModel::find($post_info['uid']);
                $res->status = ($res->status === 0) ? 1 : 0;
                $res->save();
                return show(200, 'success', '状态更新成功');

            case 'dels':
                $data = UserModel::where('id', 'in', $post_info['ids'])->select();
                foreach($data as $key => $vo) {
                    UserModel::destroy($vo['id']);
                }
                return show(200, 'success', '删除成功');
            
            case 'del':
            $data = UserModel::where('id', 'in', $post_info['id'])->find();
            UserModel::destroy($data['id']);
            return show(200, 'success', '删除成功');
            
                    
            default:
                return show(500, 'error', '你不对劲');
        }
    }
    

    public function admin_post(string $action)
    {
        $post_info = $this->request->post();
        try {
            switch ($action) {
                case 'add_modify':
                    $AdminModel = AdminModel::find($post_info['id']);
                    if(empty($post_info['account'])){
                        return show(500, 'error', '请输入登录账号');
                    }
                    if(empty($post_info['name'])){
                        return show(500, 'error', '请输入管理员名称');
                    }
                    $salt = randomkeys(4);
                    if($AdminModel){
                        if($post_info['account'] != $AdminModel['account']){
                            $AdminModels = AdminModel::where('account', $post_info['account'])->find();
                            if($AdminModels){
                                return show(500, 'error', '登录账号已存在，请修改');
                            }
                        }
                        $AdminModel->account = $post_info['account'];
                        if(!empty($post_info['password'])){
                            $AdminModel->password = password_hash(($post_info['password'] . $salt), PASSWORD_BCRYPT);
                            $AdminModel->salt = $salt;
                        }
                        $AdminModel->name = $post_info['name'];
                        $AdminModel->power = $post_info['power'];
                        $AdminModel->save();
                        return show(200, 'success', '修改成功');
                    }
                    if(empty($post_info['password'])){
                        return show(500, 'error', '请输入登录密码');
                    }
                    $AdminModel = AdminModel::where('account', $post_info['account'])->find();
                    if($AdminModel){
                        return show(500, 'error', '登录账号已存在，请修改');
                    }
                    AdminModel::create([
                        'account' => $post_info['account'],
                        'password' => password_hash(($post_info['password'] . $salt), PASSWORD_BCRYPT),
                        'salt' => $salt,
                        'name' => $post_info['name'],
                        'power' => $post_info['power'],
                    ]);
                    return show(200, 'success', '添加成功');
                    
                case 'info':
                    $res = AdminModel::find($post_info['id']);
                    $street = array(
                         "用户列表", "支付管理", "充值业务 - 产品列表", "查询业务 - 产品列表", "充值业务 - 订单列表",
                        "查询业务 - 订单列表", "交易挂单数据", "交易订单数据", "充值订单记录", "提现订单记录", "返佣记录", "首页轮播图", "管理员列表", "系统设置管理"
                    );
                    $power_selected = '';
                    foreach($street as $key => $name) {
                        $selected = 'selected';
                        if(strpos($res['power'], $name) === false){
                            $selected = '';
                        }
                        $power_selected .= "<option value='{$name}' $selected>{$name}</option>";
                    }
                    $res['power_selected'] = $power_selected;

                    return show(200, 'success', '获取信息成功', (array)$res->getData());

                case 'del':
                    AdminModel::destroy($post_info['id']);
                    return show(200, 'success', '删除成功');
                default:
                    return show(500, 'error', '你不对劲');
            }
        } catch (DbException $e) {
            return show(500, 'error', $e->getMessage());
        }
    }


    public function account_post(string $action)
    {
        $post_info = $this->request->post();
        try {
            switch ($action) {
                case 'account':
                    if(empty($post_info['account'])){
                        return show(500, 'error', '登录账号不可为空');
                    }
                    $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
                    if(!empty($post_info['password'])){
                        $salt = randomkeys(4);
                        $admin_info->password = password_hash(($post_info['password'] . $salt), PASSWORD_BCRYPT);
                        $admin_info->salt = $salt;
                    }
                    $admin_info->account = $post_info['account'];
                    $admin_info->save();
                    return show(200, 'success', '信息修改成功');
                case 'avatar':
                    $base64_img = $this->request->post('result');
                    // 存放图片到该用户的专有目录内
                    $up_dir = dirname(__DIR__, 2) . '/public/storage/avatar/';
                    if (!file_exists($up_dir) && !mkdir($up_dir) && !is_dir($up_dir)) {
                        return show(500, 'error', '图片缓存目录创建失败，请联系平台客服处理！');
                    }
                    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_img, $image)) {
                        $poststamp = $image[2];
                        if (in_array($poststamp, array('pjpeg', 'jpeg', 'jpg', 'png'))) {
                            $new_file = $up_dir . $this->admin_info['account'] . '.' . $poststamp;
                            if (!file_put_contents($new_file, base64_decode(str_replace($image[1], '', $base64_img)))) {
                                return show(500, 'error', '图片上传失败');
                            }
                            $admin_info = AdminModel::where('id', $this->admin_info['id'])->find();
                            if ($admin_info) {
                                $admin_info->avatar = '/storage/avatar/' . $this->admin_info['account'] . '.' . $poststamp;
                                $admin_info->save();
                                return show(200, 'success', '头像上传成功');
                            }
                        } else {
                            return show(500, 'error', '图片上传类型错误');
                        }
                    }
                    return show(500, 'error', '图片上传错误');
                default:
                    return show(500, 'error', '你不对劲');
            }
        } catch (DbException $e) {
            return show(500, 'error', $e->getMessage());
        }
    }

    

    public function admin_footer(string $action)
    {
        $post_info = $this->request->post();
        switch ($action) {
            case 'out_order':
                $order_cz = Order::where('status', 0)->where('type', 1)->count();
                $order_cx = Order::where('status', 0)->where('type', 2)->count();
                $recharge = Recharge::where('status', 1)->count();
                $withdrawal = Withdrawal::where('status', 0)->count();
                $data = [
                    'order_cz' => $order_cz,
                    'order_cx' => $order_cx,
                    'recharge' => $recharge,
                    'withdrawal' => $withdrawal,
                ];
                return show(200, 'success', '查询成功', $data);

            default:
                return show(500, 'error', '请求出错');
        }
    }
    


    public function setting_post(string $action)
    {
        switch ($action) {
            case 'setting':
                foreach ($this->request->post() as $k => $v) {
                    if (!isset($this->config[$k])) {
                        ConfigModel::create([
                            'k' => $k,
                            'v' => $v
                        ]);
                    } else {
                        $ConfigModel = ConfigModel::find($k);
                        $ConfigModel->v = $v;
                        $ConfigModel->save();
                    }
                }
                CacheModel::destroy('config');
                return show(200, 'success', '修改成功');
                

            case 'upload':

                $uploadDir = 'storage/images/'; // 指定上传目录
                
                $file = (array)$this->request->file();
                $keyname = key($file);
                $fileType = $_FILES[$keyname]['type'];
                $fileExtension = pathinfo($_FILES[$keyname]['name'], PATHINFO_EXTENSION);
                $fileName = uniqid() . '.' . $fileExtension; // 使用唯一的字符串作为文件名
                $tmpName = $_FILES[$keyname]['tmp_name'];
                $uploadPath = $uploadDir . $fileName;
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // 允许的图片类型
                if (!in_array($fileType, $allowedTypes)) {
                    // 文件类型不在允许的图片类型列表中
                    return show(404, 'error', '文件类型错误');
                }
                // 将临时文件移动到上传目录
                if (move_uploaded_file($tmpName, $uploadPath)) {
                    $result = [
                        'default' => '/'.$uploadDir.$fileName,
                        'data' => '/'.$uploadDir.$fileName,
                    ];
                    return json($result);
                } else {
                    return show(404, 'error', '文件上传失败');
                }


            default:
                return show(500, 'error', '你不对劲');
        }

    }

    public function login_check()
    {
        $post_info = $this->request->post();
        $admin_info = AdminModel::where('account', '=', $post_info['account'])->find();

        //判断是否输入账号密码
        if (empty($post_info['account']) || empty($post_info['password'])) {
            return show(500, 'error', '账号或密码不得为空');
        }
        if ($admin_info && password_verify(($post_info['password'] . $admin_info->salt), $admin_info->password)) {
            $ip = $this->request->ip();
            Session::set('admin', $admin_info->getData());
            Session::set('admin.login_ip', $ip);
            return show(200, 'success', '登录成功', getConfig('backstage_entrance'));
        }
        return show(500, 'error', '请检查您输入的用户名或密码是否正确。');
    }

    // 后台管理员退出登录
    public function logout()
    {
        Session::delete('admin');
        return redirect((string)url(getConfig('backstage_entrance').'/login'));
    }


    // 图片上传（Logo & 二维码）
    public function upload_post()
    {
        $file = (array)$this->request->file();
        $keyname = key($file);
        $file = $file[$keyname];
        switch ($keyname) {
            case 'a_recommend_upload':
            case 'b_recommend_upload':
            case 'contact_service_upload':
            case 'user_avatar_upload':
            case 'upload':
                $uploadDir = 'storage/'; // 指定上传目录
                $fileType = $_FILES[$keyname]['type'];
                $fileExtension = pathinfo($_FILES[$keyname]['name'], PATHINFO_EXTENSION);
                $fileName = uniqid() . '.' . $fileExtension; // 使用唯一的字符串作为文件名
                $tmpName = $_FILES[$keyname]['tmp_name'];
                $uploadPath = $uploadDir . $fileName;
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // 允许的图片类型
                if (!in_array($fileType, $allowedTypes)) {
                    // 文件类型不在允许的图片类型列表中
                    return show(404, 'error', '文件类型错误');
                }
                // 将临时文件移动到上传目录
                if (move_uploaded_file($tmpName, $uploadPath)) {
                    // 上传成功处理
                    return show(200, 'success', '上传成功', '/'.$uploadDir.$fileName);
                } else {
                    return show(404, 'error', '文件上传失败');
                }
                
            default:
                return show(404, 'error', '非白名单文件，禁止上传' .$keyname);
        }
    }
}
<?php
declare (strict_types=1);
namespace app\controller;
use app\middleware\AdminAuth;

use app\model\Admin as AdminModel;
use app\model\User as UserModel;
use app\model\BankCard;
use app\model\Order;
use app\model\Product;
use app\model\Slide;
use app\model\Recharge;
use app\model\RebateRecord;
use app\model\Withdrawal;
use app\model\TransactionOrder;
use app\model\TransactionProduct;

use think\App;
use think\facade\View;
use think\facade\Cache;
use think\Request;
use Yurun\Util\HttpRequest;

class AdminList
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
    
    

    public function user_list()
    {
        //顺序排列判断
        if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['dir']) {
            $column = $_REQUEST['columns'][$_REQUEST['order'][0]['column']]['data'];
            $dir = $_REQUEST['order'][0]['dir'];
        }
        $par[] = ['id|mobile|nickname', 'like', '%' . $_REQUEST['search']['value'].'%'];
        $data = UserModel::where($par)->order($column??'id', $dir??'desc')->order('id', 'asc')->limit(intval($_REQUEST['start']),intval($_REQUEST['length']))->select();
        foreach($data as $key => $vo) {
            $vo['t_user_info'] = UserModel::find($vo['tid_1']??'');
        }
        $totalRecords = $totalDisplay = UserModel::where($par)->count();
        $result = [
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data'            => $data,
        ];
        
        return json($result);
    }
    

    public function product_list()
    {
        //顺序排列判断
        if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['dir']) {
            $column = $_REQUEST['columns'][$_REQUEST['order'][0]['column']]['data'];
            $dir = $_REQUEST['order'][0]['dir'];
        }

        $par[] = ['type', '=', $_REQUEST['type']];
        $par[] = ['name|describe', 'like', '%' . $_REQUEST['search']['value'].'%'];
        $data = Product::where($par)->order($column??'id', $dir??'desc')->order('id', 'asc')->limit(intval($_REQUEST['start']),intval($_REQUEST['length']))->select();
        foreach($data as $key => $vo) {
    
        }
        $totalRecords = $totalDisplay = Product::where($par)->count();
        $result = [
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data'            => $data,
        ];
        
        return json($result);
    }
    

    public function slide_list()
    {
        //顺序排列判断
        if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['dir']) {
            $column = $_REQUEST['columns'][$_REQUEST['order'][0]['column']]['data'];
            $dir = $_REQUEST['order'][0]['dir'];
        }
        $par[] = ['id', 'like', '%' . $_REQUEST['search']['value'].'%'];
        $data = Slide::where($par)->order($column??'id', $dir??'desc')->order('id', 'asc')->limit(intval($_REQUEST['start']),intval($_REQUEST['length']))->select();
        foreach($data as $key => $vo) {
    
        }
        $totalRecords = $totalDisplay = Slide::where($par)->count();
        $result = [
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data'            => $data,
        ];
        
        return json($result);
    }
    

    public function recharge_list()
    {
        //顺序排列判断
        if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['dir']) {
            $column = $_REQUEST['columns'][$_REQUEST['order'][0]['column']]['data'];
            $dir = $_REQUEST['order'][0]['dir'];
        }
        if(!empty($_REQUEST['uid'])){
            $par[] = ['uid', '=', $_REQUEST['uid']];
        }
        $par[] = ['order_number|wallet_address', 'like', '%' . $_REQUEST['search']['value'].'%'];
        $data = Recharge::where($par)->order($column??'id', $dir??'desc')->order('id', 'asc')->limit(intval($_REQUEST['start']),intval($_REQUEST['length']))->select();
        foreach($data as $key => $vo) {
            $vo['user_info'] = UserModel::find($vo['uid']);

        }
        $totalRecords = $totalDisplay = Recharge::where($par)->count();
        $result = [
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data'            => $data,
        ];
        
        return json($result);
    }
    

    public function withdrawal_list()
    {
        //顺序排列判断
        if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['dir']) {
            $column = $_REQUEST['columns'][$_REQUEST['order'][0]['column']]['data'];
            $dir = $_REQUEST['order'][0]['dir'];
        }
        if(!empty($_REQUEST['uid'])){
            $par[] = ['uid', '=', $_REQUEST['uid']];
        }
        $par[] = ['order_number|wallet_address', 'like', '%' . $_REQUEST['search']['value'].'%'];
        $data = Withdrawal::where($par)->order($column??'id', $dir??'desc')->order('id', 'asc')->limit(intval($_REQUEST['start']),intval($_REQUEST['length']))->select();
        foreach($data as $key => $vo) {
            $vo['user_info'] = UserModel::find($vo['uid']);
        }
        $totalRecords = $totalDisplay = Withdrawal::where($par)->count();
        $result = [
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data'            => $data,
        ];
        
        return json($result);
    }
    

    public function order_cz_list()
    {
        //顺序排列判断
        if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['dir']) {
            $column = $_REQUEST['columns'][$_REQUEST['order'][0]['column']]['data'];
            $dir = $_REQUEST['order'][0]['dir'];
        }

        if(!empty($_REQUEST['columns'][3]['search']['value'])){
            $par[] = ['product_id', '=', substr($_REQUEST['columns'][3]['search']['value'], 8)];
        }
        if(!empty($_REQUEST['columns'][10]['search']['value'])){
            $par[] = ['status', '=', substr($_REQUEST['columns'][10]['search']['value'], 7)];
        }

        if(!empty($_REQUEST['uid'])){
            $par[] = ['uid', '=', $_REQUEST['uid']];
        }
        $par[] = ['type', '=', 1];
        $par[] = ['order_number|product_info|order_info', 'like', '%' . $_REQUEST['search']['value'].'%'];
        $data = Order::where($par)->order($column??'id', $dir??'desc')->order('id', 'asc')->limit(intval($_REQUEST['start']),intval($_REQUEST['length']))->select();
        // 判断时间
        if(!empty($_REQUEST['columns'][13]['search']['value'])){
            $dates = explode(' 至 ', $_REQUEST['columns'][13]['search']['value']);
            if(!empty($dates[0]) && !empty($dates[1])){
                $data = Order::where($par)->whereTime('create_time', 'between', [$dates[0], $dates[1]])->order($column??'id', $dir??'desc')->order('id', 'asc')->limit(intval($_REQUEST['start']),intval($_REQUEST['length']))->select();
            }
        }
        foreach($data as $key => $vo) {
            $vo['user_info'] = UserModel::find($vo['uid']);

            $order_info = '';
            foreach ($vo['order_info'] as $item) {
                
                
                
                if (preg_match('/\[(.*?)\](.*)/', $item, $matches)) {
                    
                    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
                    
                    
                    if (in_array(pathinfo($matches[2], PATHINFO_EXTENSION), $allowedExtensions)) {
                        
                        $order_info .= $matches[1] . '：
                        <div class="symbol symbol-50px" onclick="picture_views_modal(`'.$matches[2].'`)">
                            <img src="' . $matches[2] . '" alt="">
                        </div><br>';
                    } else {
                        $order_info .= $matches[1] . '：' . $matches[2] . '<br>';
                        if(phone_info($matches[2])){
                            $order_info .= '运营商：' . phone_info($matches[2], 1) . '<br>';
                            $order_info .= '下单前余额：' . $vo['phone_yue_a'] . '<br>';
                        }
                    }

                    // $result = checkIfImageExists(url('/')->domain(true) . $matches[2]);
                    // if ($result == 1) {
                    //     $order_info .= $matches[1] . '：
                    //     <div class="symbol symbol-50px" onclick="picture_views_modal(`'.$matches[2].'`)">
                    //         <img src="' . $matches[2] . '" alt="">
                    //     </div><br>';
                    // } else {
                    //     $order_info .= $matches[1] . '：' . $matches[2] . '<br>';
                    //     if(getTelecomOperator($matches[2]) != '未知'){
                    //         $order_info .= '运营商：' . getTelecomOperator($matches[2], 1) . '<br>';
                            
                    //         $order_info .= '下单前余额：' . $vo['phone_yue_a'] . '<br>';
                            
                    //     }
                    // }
                }
            }
            
            $vo['order_info'] = $order_info;

        }
        $totalRecords = $totalDisplay = Order::where($par)->count();
        // 判断时间
        if(!empty($_REQUEST['columns'][13]['search']['value'])){
            $dates = explode(' 至 ', $_REQUEST['columns'][13]['search']['value']);
            if(!empty($dates[0]) && !empty($dates[1])){
                $totalRecords = $totalDisplay = Order::where($par)->whereTime('create_time', 'between', [$dates[0], $dates[1]])->count();
            }
        }
        $result = [
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data'            => $data,
        ];
        
        return json($result);
    }

    public function order_cx_list()
    {
        //顺序排列判断
        if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['dir']) {
            $column = $_REQUEST['columns'][$_REQUEST['order'][0]['column']]['data'];
            $dir = $_REQUEST['order'][0]['dir'];
        }
        if(!empty($_REQUEST['columns'][3]['search']['value'])){
            $par[] = ['product_id', '=', substr($_REQUEST['columns'][3]['search']['value'], 8)];
        }
        if(!empty($_REQUEST['columns'][8]['search']['value'])){
            $par[] = ['status', '=', substr($_REQUEST['columns'][8]['search']['value'], 7)];
        }
        if(!empty($_REQUEST['uid'])){
            $par[] = ['uid', '=', $_REQUEST['uid']];
        }
        $par[] = ['type', '=', 2];
        $par[] = ['order_number|product_info|order_info', 'like', '%' . $_REQUEST['search']['value'].'%'];
        $data = Order::where($par)->order($column??'id', $dir??'desc')->order('id', 'asc')->limit(intval($_REQUEST['start']),intval($_REQUEST['length']))->select();
        // 判断时间
        if(!empty($_REQUEST['columns'][10]['search']['value'])){
            $dates = explode(' 至 ', $_REQUEST['columns'][10]['search']['value']);
            if(!empty($dates[0]) && !empty($dates[1])){
                $data = Order::where($par)->whereTime('create_time', 'between', [$dates[0], $dates[1]])->order($column??'id', $dir??'desc')->order('id', 'asc')->limit(intval($_REQUEST['start']),intval($_REQUEST['length']))->select();
            }
        }
        foreach($data as $key => $vo) {
            $vo['user_info'] = UserModel::find($vo['uid']);

            $order_info = '';
            foreach ($vo['order_info'] as $item) {
                if (preg_match('/\[(.*?)\](.*)/', $item, $matches)) {
                    if($matches[1] == "理财信息"){
                        $vo['clue'] = $matches[2]??"";
                    }
                    if($matches[1] == "上传图片"){
                        $vo['image'] = $matches[2]??"";
                    }
                }
            }
        }
        $totalRecords = $totalDisplay = Order::where($par)->count();
        // 判断时间
        if(!empty($_REQUEST['columns'][10]['search']['value'])){
            $dates = explode(' 至 ', $_REQUEST['columns'][10]['search']['value']);
            if(!empty($dates[0]) && !empty($dates[1])){
                $totalRecords = $totalDisplay = Order::where($par)->whereTime('create_time', 'between', [$dates[0], $dates[1]])->count();
            }
        }
        $result = [
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data'            => $data,
        ];
        
        return json($result);
    }

    public function transaction_product_list()
    {
        //顺序排列判断
        if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['dir']) {
            $column = $_REQUEST['columns'][$_REQUEST['order'][0]['column']]['data'];
            $dir = $_REQUEST['order'][0]['dir'];
        }
        $par[] = ['id', 'like', '%' . $_REQUEST['search']['value'].'%'];
        $data = TransactionProduct::where($par)->order($column??'id', $dir??'desc')->order('id', 'asc')->limit(intval($_REQUEST['start']),intval($_REQUEST['length']))->select();
        foreach($data as $key => $vo) {
            $vo['user_info'] = UserModel::find($vo['uid']);

        }
        $totalRecords = $totalDisplay = TransactionProduct::where($par)->count();
        $result = [
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data'            => $data,
        ];
        
        return json($result);
    }

    public function transaction_order_list()
    {
        //顺序排列判断
        if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['dir']) {
            $column = $_REQUEST['columns'][$_REQUEST['order'][0]['column']]['data'];
            $dir = $_REQUEST['order'][0]['dir'];
        }
        if(!empty($_REQUEST['uid'])){
            $par[] = ['uid', '=', $_REQUEST['uid']];
        }
        $par[] = ['order_number', 'like', '%' . $_REQUEST['search']['value'].'%'];
        $data = TransactionOrder::where($par)->order($column??'id', $dir??'desc')->order('id', 'asc')->limit(intval($_REQUEST['start']),intval($_REQUEST['length']))->select();
        foreach($data as $key => $vo) {
            $vo['user_info'] = UserModel::find($vo['uid']);
            $vo['sell_uid_info'] = UserModel::find($vo['sell_uid']);

        }
        $totalRecords = $totalDisplay = TransactionOrder::where($par)->count();
        $result = [
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data'            => $data,
        ];
        
        return json($result);
    }

    public function bank_card_list()
    {
        //顺序排列判断
        if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['dir']) {
            $column = $_REQUEST['columns'][$_REQUEST['order'][0]['column']]['data'];
            $dir = $_REQUEST['order'][0]['dir'];
        }
        if(!empty($_REQUEST['uid'])){
            $par[] = ['uid', '=', $_REQUEST['uid']];
        }
        $par[] = ['name|mobile|wx_account|zfb_account', 'like', '%' . $_REQUEST['search']['value'].'%'];
        $data = BankCard::where($par)->order($column??'id', $dir??'desc')->order('id', 'asc')->limit(intval($_REQUEST['start']),intval($_REQUEST['length']))->select();
        foreach($data as $key => $vo) {
            $vo['user_info'] = UserModel::find($vo['uid']);

        }
        $totalRecords = $totalDisplay = BankCard::where($par)->count();
        $result = [
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data'            => $data,
        ];
        
        return json($result);
    }

    public function user_t_list()
    {
        //顺序排列判断
        if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['dir']) {
            $column = $_REQUEST['columns'][$_REQUEST['order'][0]['column']]['data'];
            $dir = $_REQUEST['order'][0]['dir'];
        }
        $par[] = ['tid_1|tid_2|tid_3|tid_4|tid_5|tid_6|tid_7|tid_8|tid_9|tid_10', 'like', $_REQUEST['uid']];
        $par[] = ['id', 'like', '%' . $_REQUEST['search']['value'].'%'];
        $data = UserModel::where($par)->order($column??'id', $dir??'desc')->order('id', 'asc')->limit(intval($_REQUEST['start']),intval($_REQUEST['length']))->select();
        foreach($data as $key => $vo) {
            if($vo['tid_1'] == $_REQUEST['uid']){
                $vo['type'] = '一级';
            }
            if($vo['tid_2'] == $_REQUEST['uid']){
                $vo['type'] = '二级';
            }
            if($vo['tid_3'] == $_REQUEST['uid']){
                $vo['type'] = '三级';
            }
            if($vo['tid_4'] == $_REQUEST['uid']){
                $vo['type'] = '四级';
            }
            if($vo['tid_5'] == $_REQUEST['uid']){
                $vo['type'] = '五级';
            }
            if($vo['tid_6'] == $_REQUEST['uid']){
                $vo['type'] = '六级';
            }
            if($vo['tid_7'] == $_REQUEST['uid']){
                $vo['type'] = '七级';
            }
            if($vo['tid_8'] == $_REQUEST['uid']){
                $vo['type'] = '八级';
            }
            if($vo['tid_9'] == $_REQUEST['uid']){
                $vo['type'] = '九级';
            }
            if($vo['tid_10'] == $_REQUEST['uid']){
                $vo['type'] = '十级';
            }
        }
        $totalRecords = $totalDisplay = UserModel::where($par)->count();
        $result = [
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data'            => $data,
        ];
        
        return json($result);
    }

    public function rebate_record_list()
    {
        //顺序排列判断
        if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['dir']) {
            $column = $_REQUEST['columns'][$_REQUEST['order'][0]['column']]['data'];
            $dir = $_REQUEST['order'][0]['dir'];
        }
        if(!empty($_REQUEST['uid'])){
            $par[] = ['uid', '=', $_REQUEST['uid']];
        }
        $par[] = ['order_number', 'like', '%' . $_REQUEST['search']['value'].'%'];
        $data = RebateRecord::where($par)->order($column??'id', $dir??'desc')->order('id', 'asc')->limit(intval($_REQUEST['start']),intval($_REQUEST['length']))->select();
        foreach($data as $key => $vo) {
            $vo['user_info'] = UserModel::find($vo['uid']);
        }
        foreach($data as $key => $vo) {
            $vo['t_user_info'] = UserModel::find($vo['tid']);
        }
        $totalRecords = $totalDisplay = RebateRecord::where($par)->count();
        $result = [
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data'            => $data,
        ];
        
        return json($result);
    }


    public function admin_list()
    {
        //顺序排列判断
        if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['dir']) {
            $column = $_REQUEST['columns'][$_REQUEST['order'][0]['column']]['data'];
            $dir = $_REQUEST['order'][0]['dir'];
        }
        $par[] = ['name|account', 'like', '%' . $_REQUEST['search']['value'].'%'];
        $par[] = ['id', '<>', 1];
        $data = AdminModel::where($par)->order($column??'id', $dir??'desc')->order('id', 'asc')->limit(intval($_REQUEST['start']),intval($_REQUEST['length']))->select();
        foreach($data as $key => $vo) {

        }
        $totalRecords = $totalDisplay = AdminModel::where($par)->count();
        $result = [
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data'            => $data,
        ];
        
        return json($result);
    }

}

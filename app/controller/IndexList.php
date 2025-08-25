<?php
declare (strict_types=1);

namespace app\controller;
use app\middleware\UserAuth;
use app\model\User as UserModel;
use app\model\Batch;
use app\model\Order;
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

class IndexList
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
    
    public function order_cz_list()
    {
        if(!empty($_REQUEST['content'])){
            $par[] = ['order_number|order_info', 'like', '%' . $_REQUEST['content'].'%'];
        }
        if(!empty($_REQUEST['product_id'])){
            $par[] = ['product_id', '=', $_REQUEST['product_id']];
        }
        if($_REQUEST['status'] != 4){
            $par[] = ['status', '=', $_REQUEST['status']];
        }
        
        $par[] = ['product_type', '=', '0'];
        
        $par[] = ['type', '=', 1];
        $par[] = ['uid', '=', $this->user_info['id']];
        
        $data = Order::where($par)->order('id', 'desc')->select();
        $result = [
            'code'    => 0,
            'data'    => [
                'list'    => $data,
            ],
        ];
        return json($result);
    }
    
    public function order_cx_list()
    {
        if(!empty($_REQUEST['content'])){
            $par[] = ['order_number|order_info', 'like', '%' . $_REQUEST['content'].'%'];
        }
        if($_REQUEST['status'] != 4){
            $par[] = ['status', '=', $_REQUEST['status']];
        }
        $par[] = ['type', '=', 2];
        $par[] = ['uid', '=', $this->user_info['id']];
        $data = Order::where($par)->order('id', 'desc')->select();
        $result = [
            'code'    => 0,
            'data'    => [
                'list'    => $data,
            ],
        ];
        return json($result);
    }


    
    public function out_order_list()
    {
        if(!empty($_REQUEST['product_id'])){
            $par[] = ['product_id', '=', $_REQUEST['product_id']];
        }
        $par[] = ['type', '=', 1];
        $par[] = ['status', '=', 2];
        if(!empty($_REQUEST['confirm_status'])){
            $par[] = ['confirm_status', '=', $_REQUEST['confirm_status']];
        }
        $par[] = ['uid', '=', $this->user_info['id']];
        $data = Order::where($par)->order('id', 'desc')->select();
        $result = [
            'code'    => 0,
            'data'    => [
                'list'    => $data,
            ],
        ];
        return json($result);
    }


    
    public function agency_center_list()
    {
        $par[] = ['tid_'.$_REQUEST['type'], '=', $this->user_info['id']];

        $data = UserModel::where($par)->order('id', 'desc')->select();
        $result = [
            'code'    => 0,
            'data'    => [
                'list'    => $data,
            ],
        ];
        return json($result);
    }


    
    public function batch_list()
    {
        $par[] = ['status', '=', $_REQUEST['status']];

        $par[] = ['uid', '=', $this->user_info['id']];
        $data = Batch::where($par)->order('id', 'desc')->select();
        $result = [
            'code'    => 0,
            'data'    => [
                'list'    => $data,
            ],
            'batch_ok_count' => Batch::where('uid', $this->user_info['id'])->where('status', 0)->count(),
            'batch_no_count' => Batch::where('uid', $this->user_info['id'])->where('status', 1)->count(),
        ];
        return json($result);
    }

    
    public function transaction_my_sale_list()
    {
        if(!empty($_REQUEST['status'])){
            $par[] = ['status', '=', $_REQUEST['status']];
        }
        $par[] = ['uid', '=', $this->user_info['id']];
        $data = TransactionProduct::where($par)->order('id', 'desc')->select();
        $result = [
            'code'    => 0,
            'data'    => [
                'list'    => $data,
            ],
        ];
        return json($result);
    }

    
    public function transaction_index_list()
    {
        if(!empty($_REQUEST['user_status'])){
            $par[] = ['uid', '=', $this->user_info['id']];
        }
        if(!empty($_REQUEST['upper_lower'])){
            $order_name = 'unit_price';
            $order_asc = 'desc';
        }else{
            $order_name = 'unit_price';
            $order_asc = 'asc';
        }
        
        $par[] = ['status', '=', 1];
        $data = TransactionProduct::where($par)->order($order_name, $order_asc)->select();
        foreach($data as $key => $vo) {
            $vo['user_info'] = UserModel::field('avatar,nickname')->find($vo['uid']);

            $vo['TransactionOrder_count'] = TransactionOrder::where('pid', $vo['id'])->where('status', 3)->count();
            $vo['pay_amount_s'] = TransactionOrder::where('pid', $vo['id'])->where('status', 3)->sum('pay_amount');
            
        }
        $result = [
            'code'    => 0,
            'data'    => [
                'list'    => $data,
            ],
            'TransactionProduct_count' => TransactionProduct::where('uid', $this->user_info['id'])->count(),
            'TransactionOrder_count' => TransactionOrder::where('uid', $this->user_info['id'])->where('status', 'in', '0,1')->count(),
        ];
        return json($result);
    }

    
    public function transaction_order_list()
    {
        if($_REQUEST['status'] != 'null'){
            $par[] = ['status', '=', $_REQUEST['status']];
        }
        $par[] = ['uid|sell_uid', '=', $this->user_info['id']];
        $data = TransactionOrder::where($par)->order('id', 'desc')->select();
        foreach($data as $key => $vo) {
            $vo['user_info'] = UserModel::field('avatar,nickname')->find($vo['uid']);
        }
        $result = [
            'code'    => 0,
            'data'    => [
                'list'    => $data,
            ],
        ];
        return json($result);
    }

    
    public function order_list()
    {
        if(!empty($_REQUEST['content'])){
            $par[] = ['order_number|order_info', 'like', '%' . $_REQUEST['content'].'%'];
        }
        if(!empty($_REQUEST['product_type'])){
            $par[] = ['product_type', '=', $_REQUEST['product_type']];
        }
        if($_REQUEST['status'] != 4){
            $par[] = ['status', '=', $_REQUEST['status']];
        }
        
        $par[] = ['uid', '=', $this->user_info['id']];
        $data = Order::where($par)->order('id', 'desc')->select();
        foreach($data as $key => $vo) {
            $order_info = '';
            foreach ($vo['order_info'] as $item) {
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
                    }
                }
            }
            
            $vo['order_info'] = $order_info;
        }
        $result = [
            'code'    => 0,
            'data'    => [
                'list'    => $data,
            ],
        ];
        return json($result);
    }
}
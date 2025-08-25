<?php

// 应用公共文件
use app\model\Cache as CacheModel;
use app\model\Config as ConfigModel;
use app\model\User as UserModel;
use app\model\Order;
use app\model\Product;
use app\model\RebateRecord;
use app\model\Phone;

use ip2region\Ip2Region;
use think\db\exception\DbException;
use think\facade\Request;
use think\facade\Session;
use think\response\Json;
use Yurun\Util\HttpRequest;
use yzh52521\filesystem\facade\Filesystem;

/**
 * Json接口统一输出
 * @param int $code 状态码
 * @param string $status 状态信息: "success" or "error"
 * @param string $message 返回内容
 * @param mixed $data 返回的数据
 * @param int $httpStatus HTTP状态码
 * @return Json
 */
function show(int $code = 200, string $status = 'success', string $message = "嗯", Mixed $data = null, int $httpStatus = 200): Json
{
    return json([
        "code"    => $code,
        "status"  => $status,
        "message" => $message,
        "data"    => $data,
    ], $httpStatus);
}

/**
 * API返回信息统一输出
 * @param int $code 状态码
 * @param string $status 状态信息: "success" or "error"
 * @param string $message 返回内容
 * @param mixed $data 返回的数据
 * @return array
 */
function shows(int $code = 200, string $status = 'success', string $message = "嗯", Mixed $data = null): array
{
    return [
        "code"    => $code,
        "status"  => $status,
        "message" => $message,
        "data"    => $data,
    ];
}

/**
 * 字符过滤器（防XSS）
 * @param mixed $string 内容
 * @return mixed
 */
function daddslashes(mixed $string): mixed
{
    if (is_array($string)) {
        foreach ($string as $key => $val) {
            $string[$key] = daddslashes($val);
        }
    } else {
        if (empty($string)) {
            return '';
        }
        $string = addslashes($string);
    }
    return $string;
}


/**
 * 随机生成字符
 * @param int $length 字符长度
 * @param string $method 方法：text or number
 * @return string
 */
function randomkeys(int $length, string $method = 'text'): string
{
    $key = '';
    if ($method === 'number') {
        $pattern = '1234567890';
        $max = 9;
    } elseif ($method === 'lowercase') {
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
        $max = 35;
    } elseif ($method === 'en') {
        $pattern = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
        $max = 51;
    } else {
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
        $max = 61;
    }
    for ($i = 0; $i < $length; $i++) {
        // 生成php随机数
        $key .= $pattern[random_int(0, $max)];
    }
    return $key;
}


/**
 * 随机生成汉字
 * @param int $num 字符长度
 * @return string
 */
function randomchinese(int $num): string
{
    $b = '';
    for ($i = 0; $i < $num; $i++) {
        // 使用chr()函数拼接双字节汉字，前一个chr()为高位字节，后一个为低位字节
        $a = chr(random_int(0xB0, 0xD0)) . chr(random_int(0xA1, 0xF0));
        // 转码
        $b .= iconv('GB2312', 'UTF-8', $a);
    }
    return $b;
}

/**
 * 替换字符串的中间部分
 * @param string $str 输入字符串
 * @param string $replaceChar 要替换的单个字符
 * @param int $leftLen 左边保留正常显示的长度
 * @param int $rightLen 右面保留正常显示的长度
 * @param bool $notEnoughReplace 计算后要替换的字符串长度不足时，输入的字符串是否进行整体替换
 * @return string
 */
function strReplaceMiddle(string $str, string $replaceChar = '*', int $leftLen = 3, int $rightLen = 3, bool $notEnoughReplace = true): string
{
    $len = mb_strlen($str);
    $replaceLen = $len - $leftLen - $rightLen;

    if ($replaceLen > 0) {
        $replaceStr = str_repeat($replaceChar, $replaceLen);
    } else {
        // 计算后要替换的字符串长度不足时，$replaceLen = $len - $frontLen - $backLen;
        $replaceStr = str_repeat($replaceChar, $len);
        return $notEnoughReplace ? $replaceStr : $str;
    }
    return mb_substr($str, 0, $leftLen) . $replaceStr . mb_substr($str, $leftLen + $replaceLen);
}

/**
 * 通过IP地址获取地理位置
 * @param string $ip IP地址
 * @return string 地理位置
 */
function getIpCity(string $ip = '127.0.0.1', $province = null): string
{
    try {
        // 无视IPv6地址
        if (Request::isValidIP($ip, 'ipv6')) {
            return '无法识别IPv6地理位置';
        }
        // 取得 国家|区域|省份|城市|ISP
        $citydata = Ip2Region::newWithVectorIndex()->search($ip);
        // 将地址信息根据|分割为数组并剔除空值与重复值
        $citydata = array_unique(array_filter(explode('|', $citydata)));
        $hello = explode(' ', implode(' ', $citydata));

        if($province == 1){
            return $hello[1] . ' - ' . $hello[2];
        }
        return $hello[1];
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

/**
 * 获取系统配置信息
 * @param null|string $name 字段名（英文），为空则以数组的形式返回全部
 * @return array|string|bool 内容
 */
function getConfig(null|string $name = null): array|string|bool
{
    // 如果没有向函数传入字段名，则读取缓存并直接以数组形式输出全部配置信息
    if (!empty($name)) {
        // 以字段名查找并输出对应的值，如不存在对应的值，则直接输出字符串空值
        return ConfigModel::where('k', '=', $name)->value('v', '');
    }
    // 从数据库缓存表内读取配置缓存，并通过tp框架自带缓存引擎缓存结果10秒
    $configCache = CacheModel::where('k', 'config')->value('v');
    // 如果缓存为空
    if (empty($configCache)) {
        // 从站点配置表内读取全部配置信息
        $result = ConfigModel::column('k,v');
        // 如果读取配置信息失败，返回false
        if (!$result || !is_array($result)) {
            return false;
        }
        $cache = [];
        foreach ($result as $row) {
            $cache[$row['k']] = $row['v'];
        }
        // 对站点配置信息进行序列化存储
        $results = serialize($cache);
        CacheModel::create([
            'k'      => 'config',
            'v'      => $results,
            'expire' => 0
        ], ['k', 'v', 'expire'], true);
        // 重新读取一遍缓存信息，并通过tp框架自带缓存引擎缓存结果10秒
        $configCache = CacheModel::where('k', 'config')->cache(10)->value('v');
    }
    // 对系统缓存站点配置信息进行反序列化
    return unserialize($configCache);
}





// 折扣查询
function discount($product_id, $amount_money)
{
    $Product = Product::find($product_id);

    $amount = $amount_money;
    $paymentAmount = $amount;
    $discount = 0;
    foreach ($Product['discount']  as $vo) {
        if ($amount >= $vo["mini_amount"] && $amount <= $vo["maxi_amount"]) {
            $discountAmount = $amount - ($amount * ($vo["discount"] / 10));
            $paymentAmount = $amount - $discountAmount;
            $inDiscountRange = 1;
            $discount = $vo["discount"];
            break;
        }
    }
    $data = [
        'inDiscountRange' => $inDiscountRange??0, // 是否在折扣范围 1-是 0-不是
        'discountAmount' => number_format($discountAmount??0, 2), // 折扣金额
        'paymentAmount' => $paymentAmount, // 支付金额
        'discount' => $discount, // 优惠折扣比例
        'cnyAmount' => number_format($paymentAmount / getConfig('rate')??0, 2), // 支付金额
    ];

    return $data;
}



function checkIfImageExists($imageUrl) {
    $imageInfo = @getimagesize($imageUrl);
    
    if ($imageInfo === false) {
        // 无法获取图像信息，表示图片无法打开
        return 2;
    } else {
        // 图片可以打开
        return 1;
    }
}



function subordinate($tid_1) {
    $tid_2 = UserModel::find($tid_1['tid_1']??null);
    $tid_3 = UserModel::find($tid_2['tid_1']??null);
    $tid_4 = UserModel::find($tid_3['tid_1']??null);
    $tid_5 = UserModel::find($tid_4['tid_1']??null);
    $tid_6 = UserModel::find($tid_5['tid_1']??null);
    $tid_7 = UserModel::find($tid_6['tid_1']??null);
    $tid_8 = UserModel::find($tid_7['tid_1']??null);
    $tid_9 = UserModel::find($tid_8['tid_1']??null);
    $tid_10 = UserModel::find($tid_9['tid_1']??null);
    $data = [
        'tid_1' => $tid_1['id']??null,
        'tid_2' => $tid_2['id']??null,
        'tid_3' => $tid_3['id']??null,
        'tid_4' => $tid_4['id']??null,
        'tid_5' => $tid_5['id']??null,
        'tid_6' => $tid_6['id']??null,
        'tid_7' => $tid_7['id']??null,
        'tid_8' => $tid_8['id']??null,
        'tid_9' => $tid_9['id']??null,
        'tid_10' => $tid_10['id']??null,
    ];
    return $data;
}



function rebate($order_number) {
    $order_info = Order::where('order_number', $order_number)->find();
    $product_info = Product::find($order_info['product_id']);
    $user_info = UserModel::find($order_info['uid']);
    if(!empty($product_info['kickback_rtion_1']) && !empty($user_info['tid_1'])){
        $amount = $order_info['cny_amount'] * ($product_info['kickback_rtion_1'] / 100);
        $t_user_info = UserModel::find($user_info['tid_1']);
        RebateRecord::create([
            'uid' => $order_info['uid'],
            'tid' => $user_info['tid_1'],
            'order_number' => $order_info['order_number'],
            'amount' => $amount,
            'level' => 1,
        ]);
        $t_user_info->balance += $amount;
        $t_user_info->save();
    }
    if(!empty($product_info['kickback_rtion_2']) && !empty($user_info['tid_3'])){
        $amount = $order_info['cny_amount'] * ($product_info['kickback_rtion_2'] / 100);
        $t_user_info = UserModel::find($user_info['tid_2']);
        RebateRecord::create([
            'uid' => $order_info['uid'],
            'tid' => $user_info['tid_2'],
            'order_number' => $order_info['order_number'],
            'amount' => $amount,
            'level' => 2,
        ]);
        $t_user_info->balance += $amount;
        $t_user_info->save();
    }
    if(!empty($product_info['kickback_rtion_3']) && !empty($user_info['tid_3'])){
        $amount = $order_info['cny_amount'] * ($product_info['kickback_rtion_3'] / 100);
        $t_user_info = UserModel::find($user_info['tid_3']);
        RebateRecord::create([
            'uid' => $order_info['uid'],
            'tid' => $user_info['tid_3'],
            'order_number' => $order_info['order_number'],
            'amount' => $amount,
            'level' => 3,
        ]);
        $t_user_info->balance += $amount;
        $t_user_info->save();
    }
    if(!empty($product_info['kickback_rtion_4']) && !empty($user_info['tid_4'])){
        $amount = $order_info['cny_amount'] * ($product_info['kickback_rtion_4'] / 100);
        $t_user_info = UserModel::find($user_info['tid_4']);
        RebateRecord::create([
            'uid' => $order_info['uid'],
            'tid' => $user_info['tid_4'],
            'order_number' => $order_info['order_number'],
            'amount' => $amount,
            'level' => 4,
        ]);
        $t_user_info->balance += $amount;
        $t_user_info->save();
    }
    if(!empty($product_info['kickback_rtion_5']) && !empty($user_info['tid_5'])){
        $amount = $order_info['cny_amount'] * ($product_info['kickback_rtion_5'] / 100);
        $t_user_info = UserModel::find($user_info['tid_5']);
        RebateRecord::create([
            'uid' => $order_info['uid'],
            'tid' => $user_info['tid_5'],
            'order_number' => $order_info['order_number'],
            'amount' => $amount,
            'level' => 5,
        ]);
        $t_user_info->balance += $amount;
        $t_user_info->save();
    }
    if(!empty($product_info['kickback_rtion_6']) && !empty($user_info['tid_6'])){
        $amount = $order_info['cny_amount'] * ($product_info['kickback_rtion_6'] / 100);
        $t_user_info = UserModel::find($user_info['tid_6']);
        RebateRecord::create([
            'uid' => $order_info['uid'],
            'tid' => $user_info['tid_6'],
            'order_number' => $order_info['order_number'],
            'amount' => $amount,
            'level' => 6,
        ]);
        $t_user_info->balance += $amount;
        $t_user_info->save();
    }
    if(!empty($product_info['kickback_rtion_7']) && !empty($user_info['tid_7'])){
        $amount = $order_info['cny_amount'] * ($product_info['kickback_rtion_7'] / 100);
        $t_user_info = UserModel::find($user_info['tid_7']);
        RebateRecord::create([
            'uid' => $order_info['uid'],
            'tid' => $user_info['tid_7'],
            'order_number' => $order_info['order_number'],
            'amount' => $amount,
            'level' => 7,
        ]);
        $t_user_info->balance += $amount;
        $t_user_info->save();
    }
    if(!empty($product_info['kickback_rtion_8']) && !empty($user_info['tid_8'])){
        $amount = $order_info['cny_amount'] * ($product_info['kickback_rtion_8'] / 100);
        $t_user_info = UserModel::find($user_info['tid_8']);
        RebateRecord::create([
            'uid' => $order_info['uid'],
            'tid' => $user_info['tid_8'],
            'order_number' => $order_info['order_number'],
            'amount' => $amount,
            'level' => 8,
        ]);
        $t_user_info->balance += $amount;
        $t_user_info->save();
    }
    if(!empty($product_info['kickback_rtion_9']) && !empty($user_info['tid_9'])){
        $amount = $order_info['cny_amount'] * ($product_info['kickback_rtion_9'] / 100);
        $t_user_info = UserModel::find($user_info['tid_9']);
        RebateRecord::create([
            'uid' => $order_info['uid'],
            'tid' => $user_info['tid_9'],
            'order_number' => $order_info['order_number'],
            'amount' => $amount,
            'level' => 9,
        ]);
        $t_user_info->balance += $amount;
        $t_user_info->save();
    }
    if(!empty($product_info['kickback_rtion_10']) && !empty($user_info['tid_10'])){
        $amount = $order_info['cny_amount'] * ($product_info['kickback_rtion_10'] / 100);
        $t_user_info = UserModel::find($user_info['tid_10']);
        RebateRecord::create([
            'uid' => $order_info['uid'],
            'tid' => $user_info['tid_10'],
            'order_number' => $order_info['order_number'],
            'amount' => $amount,
            'level' => 10,
        ]);
        $t_user_info->balance += $amount;
        $t_user_info->save();
    }
    return 1;
}



function power($power, $name)
{
    $selected = '1';
    if(strpos($power, $name) === false){
        $selected = '2';
    }
    return $selected;
}




function getTelecomOperator($phone, $type = 0) {
    $postData = array(
        'key' => 'b9I8kweccpt6uizL9rHtgFkGuS',
        'phone' => $phone
    );
    // 初始化 cURL
    $ch = curl_init();

    // 设置 cURL 选项
    curl_setopt($ch, CURLOPT_URL, 'https://ap.xiaoyun.top/api/xy/xhzw');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));  // 将数据编码为 URL 字符串
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // 执行 cURL 请求
    $response = curl_exec($ch);
    // 关闭 cURL 资源
    curl_close($ch);

    if ($response === false) {
        return '查询失败';
    } else {
        $responseData = json_decode($response, true);
        if($responseData['code'] == 200){
            if($type == 0){
                
                return $responseData['data']['oldIsp'];
            }else{
                return $responseData['data']['area'] .' - ' . $responseData['data']['city'] . '（'. $responseData['data']['oldIsp']. '）';
            }
            
        }
        return '查询失败';
    }
}


function phone_yue_bak($phone) {
    if(getTelecomOperator($phone) == '移动'){
        $channel = 'mobile_balance';
    }
    if(getTelecomOperator($phone) == '联通'){
        $channel = 'unicom_balance';
    }
    if(getTelecomOperator($phone) == '电信'){
        $channel = 'telecom_balance';
    }
    
    $postData = array(
        'id' => '241111155762',
        'key' => '11882c0cf4235b24d86aa48cba76f172',
        'channel' => $channel,
        'mobile' => $phone
    );
    // 初始化 cURL
    $ch = curl_init();

    // 设置 cURL 选项
    curl_setopt($ch, CURLOPT_URL, 'http://api.gfggf.cn/api/gateway');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));  // 将数据编码为 URL 字符串
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // 执行 cURL 请求
    $response = curl_exec($ch);

    // 关闭 cURL 资源
    curl_close($ch);

    // 处理响应
    if ($response === false) {
        return '查询失败';
    } else {
        $responseData = json_decode($response, true);
        print_r($responseData);exit;
        if($responseData['code'] == 200){
            return $responseData['data']['curFee'];
        }
        return '查询失败';
    }
}


function nsend($API_URL, $get_post_data, $type, $ifsign, $sk = '')
{
    $get_post_data = http_build_query($get_post_data);
    if ($ifsign) {
        $sign = md5($get_post_data . $sk);
      
        $res = nsend_curl($API_URL, $type, $get_post_data, $sign);
    } else {
      
        $res = nsend_curl($API_URL, $type, $get_post_data, null);
    }
    return $res;
}


function phone_yue($phone) {
    $postData = array(
        'key' => 'A98zmt',
        'mobile' => $phone
    );
    $res = nsend('https://api.taolale.com/api/Inquiry_Phone_Charges/get',$postData,'POST',true,'');
    if($res['code'] != 200){
        return '查询失败';
    }else{
        return $res['data']['mobile_fee'];
    }
}

function nsend_curl($API_URL, $type, $get_post_data, $sign= '')
{
    $ch = curl_init();
    if ($type == 'POST') {
        curl_setopt($ch, CURLOPT_URL, $API_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $get_post_data);
    } elseif ($type == 'GET') {
        curl_setopt($ch, CURLOPT_URL, $API_URL . '?' . $get_post_data);
    }
    if ($sign) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['sign:' . $sign]);
    }
    curl_setopt($ch, CURLOPT_REFERER, $API_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $resdata = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($resdata,true);
}



/**
 * 根据手机号获取运营商以及地理归属信息（国内）
 * @param int|string $phone 手机号
 * @return array|bool
 */
function phone_info(int|string $phone, $type = 0)
{
    if (!preg_match("/^1[3456789]\d{9}$/", $phone)) {
        return false;
    }
    try {
        $phone_info = Phone::find(substr($phone, 0, 7));
        if ($phone_info) {
            if($type == 0){
                return $phone_info['isp'];
            }else{
                return $phone_info['province'] .' - ' . $phone_info['city'] . '（'. $phone_info['isp']. '）';
            }
        }
        return false;
    } catch (DbException $e) {
        return [];
    }
}
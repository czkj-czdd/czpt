<?php
declare (strict_types=1);

namespace app\middleware;
use app\model\User as UserModel;
use Closure;
use think\App;
use think\facade\Session;
use think\Request;
use think\Response;

class UserAuth
{
    protected Request $request;
    
    /**
     * 应用实例
     * @var App
     */
    protected App $app;

    
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->request = $this->app->request;
    }
    
    
    /**
     * 处理请求
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        header('X-Powered-By: Kun');
        
        // 方法白名单
        $White_list_Controller = ['login', 'login_post', 'register', 'register_post', 'order_query', 'epay_notify_url'];
        $thisAction = $request->action();
        if (!in_array($thisAction, $White_list_Controller)) {

            // 获取当前用户
            $user_info = Session::get('user');
            if (empty($user_info['id']) || empty($user_info['login_ip']) || $user_info['login_ip'] !== $request->ip()) {
            
                Session::delete('user');
                if ($request->isAjax()) {
                    return show(403, 'error', '未登录，禁止请求');
                }
                return redirect('login');
            }
        }

        // 中间件handle方法的返回值必须是一个Response对象。
        return $next($request);
    }
}

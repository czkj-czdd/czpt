<?php
declare (strict_types=1);

namespace app\middleware;

use Closure;
use think\facade\Session;
use think\Request;
use think\Response;

class AdminAuth
{
    /**
     * 处理请求
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 方法白名单
        $White_list_Controller = ['login', 'login_check', 'password'];
        $thisAction = $request->action();

        if (!in_array($thisAction, $White_list_Controller)) {
            // 获取当前用户
            $admin_info = Session::get('admin');
            if (empty($admin_info['id']) || empty($admin_info['login_ip']) || $admin_info['login_ip'] !== $request->ip()) {
                if ($request->isAjax()) {
                    return show(403, 'error', '未登录，禁止请求');
                }
                return redirect((string)url(getConfig('backstage_entrance').'/login'));
            }
        }

        // 中间件handle方法的返回值必须是一个Response对象。
        return $next($request);
    }
}

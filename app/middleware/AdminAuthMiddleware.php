<?php

namespace app\middleware;

use app\service\AdminAuthService;
use app\utils\AdminCache;
use Carbon\Carbon;
use Hejunjie\EncryptedRequest\EncryptedRequestHandler;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

class AdminAuthMiddleware implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        // 获取路由数据
        $route = $request->route;
        $path = $route->getPath();
        // 获取请求参数
        $param = $request->all();
        // 验证请求信息
        $encrypted = new EncryptedRequestHandler();
        try {
            $request->data = $encrypted->handle($param['en_data'] ?? '', $param['timestamp'] ?? '', $param['sign'] ?? '');
        } catch (\Exception $e) {
            return fail($request, 900012, [], $e->getMessage());
        }
        // 验证用户登录
        $token = $request->header('X-Auth-Token') ?? null;
        $request->admins = null;
        $whitelisting = [
            '/admin-api/auth/login',
        ];
        if (!in_array($path, $whitelisting)) {
            if (empty($token)) {
                return fail($request, 900004);
            }
        }
        if (!empty($token)) {
            $loginCheck = self::loginCheck($token);
            if (is_int($loginCheck)) {
                if (!in_array($path, $whitelisting)) {
                    return fail($request, $loginCheck);
                }
            } else {
                $request->admins = $loginCheck;
            }
        }
        if (config('app.debug') == 1) {
            sublog('接口调用', $route->getName(), $request->method(), [
                'data' => $request->data,
                'admins' => $request->admins
            ]);
        }
        return $handler($request);
    }

    public static function loginCheck($token): array|int
    {
        $admins = AdminCache::get()->get($token);
        return !empty($admins) ? json_decode($admins, true) : 900009;
    }
}

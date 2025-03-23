<?php

namespace app\middleware;

use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

class AccessMiddleware implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        $response = $handler($request);
        // 给响应添加跨域相关的http头
        $response->withHeaders([
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers' => 'Content-Type, accessToken',
        ]);
        return $response;
    }
}

<?php

/**
 * Here is your custom functions.
 */


use Carbon\Carbon;
use Carbon\Exceptions\InvalidTimeZoneException;
use Hejunjie\Tools\Log;
use support\Response;

/**
 * Api响应成功
 *
 * @param object $request Webman\Http\Request对象
 * @param array|object $data 返回数据
 * 
 * @return Response
 */
function success($request, $data = [], $message = ''): Response
{
    $request->res = [
        'code' => 0,
        'message' => !empty($message) ? $message : (config('code')[0] ?? 'error'),
        'data' => empty($data) ? [] : $data
    ];
    return json($request->res, JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES + JSON_PRESERVE_ZERO_FRACTION);
}

/**
 * Api响应失败
 *
 * @param object $request Webman\Http\Request对象
 * @param array $data 返回数据
 * 
 * @return Response
 */
function fail($request, $code = 500, $data = [], $message = ''): Response
{
    // 记录错误信息
    $request->res = [
        'code' => $code,
        'message' => !empty($message) ? $message : (config('code')[$code] ?? 'error'),
        'data' => empty($data) ? [] : $data
    ];
    return json($request->res, JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES + JSON_PRESERVE_ZERO_FRACTION);
}

/**
 * 日志信息存储
 *
 * @param string $paths 存储路径
 * @param string $title 存储名称
 * @param string $contents 存储内容
 * 
 * @return void
 */
function sublog($paths, $title, $message, $context): void
{
    $date = Carbon::now()->timezone(config('app')['default_timezone'])->format('Y-m-d');
    $log = new Log\Logger([
        new Log\Handlers\FileHandler(runtime_path("logs/{$date}/{$paths}")),
        new Log\Handlers\ConsoleHandler()
    ]);
    $log->info($title, $message, $context);
}

/**
 * 构建树形结构
 *
 * @param array $data 
 * @return array 
 */
function buildTree(array $elements, int $parentId = 0): array
{
    // 过滤出所有的子项
    $branch = array_filter($elements, fn($el) => $el['parentId'] === $parentId);

    // 按 order 排序
    usort($branch, fn($a, $b) => $a['order'] <=> $b['order']);

    // 递归构建子树
    foreach ($branch as &$item) {
        $item['children'] = buildTree($elements, $item['id']);
    }

    return array_values($branch);
}

/**
 * 递归对树形结构进行排序
 *
 * @param array $tree 
 * @return array 
 */
function sortTree(array $tree): array
{
    // 对当前层级的节点按 order 排序
    usort($tree, function ($a, $b) {
        return $a['order'] <=> $b['order'];
    });

    // 递归对子节点排序
    foreach ($tree as &$node) {
        if (!empty($node['children'])) {
            $node['children'] = sortTree($node['children']);
        }
    }
    return $tree;
}


/**
 * 获取图片地址信息
 *
 * @param string $str 路径信息
 * 
 * @return string
 */
function getImageUrl($str): string
{
    if (strpos($str, 'http://') === false && strpos($str, 'https://') === false) {
        $str = config('app')['image_url'] . '/' . $str;
    }
    return $str;
}

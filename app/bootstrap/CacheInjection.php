<?php

namespace app\bootstrap;

use app\cache\AdminLoginCache;
use app\utils\AdminCache;
use Hejunjie\Cache\FileCache;
use Hejunjie\Cache\RedisCache;
use Webman\Bootstrap;

class CacheInjection implements Bootstrap
{
    public static function start($worker): void
    {
        $cache = new RedisCache(
            new FileCache(
                new AdminLoginCache(),
                runtime_path('admin/login'),
                (3600 * 24 * 7)
            ),
            [
                'host' => config('redis.default.host'),
                'port' => config('redis.default.port'),
                'password' => !empty(config('redis.default.password')) ? config('redis.default.password') : null,
                'db' => config('redis.default.database'),
                'ttl' => (3600 * 24),
            ],
            'admin:token:',
            true
        );
        AdminCache::set($cache);
    }
}

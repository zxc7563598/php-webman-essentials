<?php

namespace app\utils;

use Hejunjie\Cache\Interfaces\DataSourceInterface;

class AdminCache
{
    protected static ?DataSourceInterface $instance = null;

    public static function set(DataSourceInterface $cache): void
    {
        self::$instance = $cache;
    }

    public static function get(): DataSourceInterface
    {
        if (!self::$instance) {
            throw new \RuntimeException('Logger instance not initialized');
        }
        return self::$instance;
    }
}

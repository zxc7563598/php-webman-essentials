<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

use support\Request;

return [
    'debug' => getenv('DEBUG'),
    'app_name' => getenv('APP_NAME'),
    'error_webhook_url' => getenv('ERROR_WEBHOOK_URL'),
    'error_reporting' => E_ALL,
    'default_timezone' => getenv('TIMEZONE'),
    'request_class' => Request::class,
    'public_path' => base_path() . DIRECTORY_SEPARATOR . 'public',
    'runtime_path' => base_path(false) . DIRECTORY_SEPARATOR . 'runtime',
    'controller_suffix' => 'Controller',
    'controller_reuse' => false,
    'app_url' => getenv('APP_URL'),
    'image_url' => getenv('IMAGE_URL')
];

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

use Webman\Route;
use app\controller\AdminApi;

Route::group('/admin-api', function () { // 后台管理系统接口
    // 认证相关
    Route::post('/auth/login', [AdminApi\AuthenticationController::class, 'login'])->name('[认证相关-登录]');
    Route::post('/auth/logout', [AdminApi\AuthenticationController::class, 'logout'])->name('[认证相关-退出登录]');
    Route::post('/auth/switch-role', [AdminApi\AuthenticationController::class, 'switchRole'])->name('[认证相关-切换角色]');
    Route::post('/auth/update-password', [AdminApi\AuthenticationController::class, 'updatePassword'])->name('[认证相关-修改密码]');

    // 用户管理
    Route::post('/users/list', [AdminApi\AdminUserController::class, 'list'])->name('[用户管理-获取管理员列表（分页）]');
    Route::post('/users/detail', [AdminApi\AdminUserController::class, 'detail'])->name('[用户管理-获取管理员详情]');
    Route::post('/users/create-or-update', [AdminApi\AdminUserController::class, 'createOrUpdate'])->name('[用户管理-创建或更新管理员信息]');
    Route::post('/users/delete', [AdminApi\AdminUserController::class, 'delete'])->name('[用户管理-删除管理员]');
    Route::post('/users/update-password', [AdminApi\AdminUserController::class, 'updatePassword'])->name('[用户管理-修改管理员密码]');
    Route::post('/users/update-profile', [AdminApi\AdminUserController::class, 'updateProfile'])->name('[用户管理-修改管理员个人信息]');

    // 角色管理
    Route::post('/roles/list', [AdminApi\AdminRoleController::class, 'list'])->name('[角色管理-获取角色列表（分页）]');
    Route::post('/roles/all', [AdminApi\AdminRoleController::class, 'all'])->name('[角色管理-获取所有角色列表]');
    Route::post('/roles/create-or-update', [AdminApi\AdminRoleController::class, 'createOrUpdate'])->name('[角色管理-创建或更新角色]');
    Route::post('/roles/delete', [AdminApi\AdminRoleController::class, 'delete'])->name('[角色管理-删除角色]');
    Route::post('/roles/permissions', [AdminApi\AdminRoleController::class, 'permissions'])->name('[角色管理-获取角色的菜单权限树]');

    // 权限管理
    Route::post('/permissions/menu', [AdminApi\AdminPermissionController::class, 'menu'])->name('[权限管理-获取全部菜单]');
    Route::post('/permissions/menu/validate', [AdminApi\AdminPermissionController::class, 'validateMenu'])->name('[权限管理-验证菜单是否存在]');
    Route::post('/permissions/menu/buttons', [AdminApi\AdminPermissionController::class, 'buttons'])->name('[权限管理-获取菜单下的按钮]');
    Route::post('/permissions/menu/create-or-update', [AdminApi\AdminPermissionController::class, 'createOrUpdateMenu'])->name('[权限管理-添加或修改菜单]');
    Route::post('/permissions/menu/toggle', [AdminApi\AdminPermissionController::class, 'toggleMenu'])->name('[权限管理-快速切换菜单的启用状态]');
    Route::post('/permissions/menu/delete', [AdminApi\AdminPermissionController::class, 'deleteMenu'])->name('[权限管理-删除菜单]');
    Route::post('/permissions/role/users', [AdminApi\AdminPermissionController::class, 'assignUsersToRole'])->name('[权限管理-角色与用户绑定]');
})->middleware([
    app\middleware\AccessMiddleware::class,
    app\middleware\AdminAuthMiddleware::class
]);

// 允许所有的options请求
Route::options('[{path:.+}]', function () {
    return response('', 204)
        ->withHeaders([
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers' => 'Content-Type, accessToken',
        ]);
});

Route::disableDefaultRoute(); // 关闭默认路由

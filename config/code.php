<?php

return [
    0 => trans('success'), // 成功

    900001 => trans("Invalid request parameters"), // 请求参数异常
    900002 => trans("Signature verification failed"), // 签名验证异常
    900003 => trans("Expired access token"), // 过期的访问
    900004 => trans("Data parsing error"), // 数据解析异常
    900005 => trans("User session expired"), // 账号登录已过期
    900006 => trans("Incorrect username or password"), // 账号或密码错误
    900007 => trans("Account has been disabled"), // 账号已停用
    900008 => trans("Incorrect verification code"), // 验证码错误
    900009 => trans("Authentication failed"), // 身份验证失败
    900010 => trans("Role does not exist"), // 角色不存在
    900011 => trans("Permission does not exist"), // 权限不存在
];

# Webman Essentials

这是一个基于 [Webman](https://www.workerman.net/) 框架的项目。之所以创建这个项目，是因为作为一个开发者，在启动新项目时，环境配置常常会浪费大量时间。因此，我提前配置好了一个框架，并结合后台管理系统：[Vue-Naive-Admin](https://github.com/zxc7563598/vue-admin-essentials.git)，使开发者可以快速启动一个项目。

## 主要特性

- **自定义异常处理**：提供更友好的错误信息和日志。
- **跨域请求中间件**：简化了跨域请求的配置。
- **后台接口加密鉴权**：加强接口的安全性，支持加密和鉴权。
- **RBAC（基于角色的访问控制）**：实现用户角色管理，可以结合 [Vue-Naive-Admin](https://github.com/zxc7563598/vue-admin-essentials.git) 直接开始开发业务代码，无需再编写后台账号管理、角色管理等代码。
- **默认启用 Fiber 协程**：如果安装了 Swoole 扩展，可以直接切换到 Swoole 协程模式，提升性能。
- **数据库、Redis 配置整合**：所有的数据库和 Redis 配置都已调整，并集成到了 `.env` 文件中，直接配置 `.env` 即可使用。

## 安装与使用

### 环境要求
- PHP >= 8.1
- Composer
- Swoole（可选，如果需要启用 Swoole 协程）

### 使用方式

1. **克隆项目**：
    ```bash
    git clone https://github.com/zxc7563598/php-webman-essentials.git
    ```
2. **进入项目目录**：
    ```bash
    cd php-webman-essentials
    ```
3. **安装依赖**：
    ```bash
    composer install
    ```
4. **配置环境**：
    ```bash
    cp .env.example .env
    ```
    修改 `.env`​ 配置文件，填入实际的环境配置（如数据库、Redis 等）。
5. **初始化数据库**：
    ```bash
    php vendor/bin/phinx migrate
    ```
6. **运行项目**：
    ```bash
    php start.php start -d
    ```

### 访问后台管理系统

项目中集成了 [Vue-Naive-Admin](https://github.com/zxc7563598/vue-admin-essentials.git) 作为前端后台管理系统。你可以根据需要修改并与该后台系统进行对接，快速开发自己的业务功能。

## 相关链接

* [Webman 官方文档](https://www.workerman.net/doc/webman/install.html)
* [调整过的 Vue-Naive-Admin GitHub 地址](https://github.com/zxc7563598/vue-admin-essentials.git)

## License

该项目基于 MIT 许可证开源，详情请见 [LICENSE]()。

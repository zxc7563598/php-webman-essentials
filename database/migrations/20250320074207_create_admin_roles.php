<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

final class CreateAdminRoles extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        // 创建表
        $table = $this->table('admin_roles', ['id' => 'id', 'engine' => 'InnoDB', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '管理员角色表']);
        // 添加字段
        $table->addColumn('admin_id', 'integer', ['limit' => MysqlAdapter::INT_BIG, 'null' => false, 'default' => 0, 'comment' => '管理员id'])
            ->addColumn('role_id', 'integer', ['limit' => MysqlAdapter::INT_BIG, 'null' => false, 'default' => 0, 'comment' => '角色id'])
            ->addColumn('created_at', 'integer', ['limit' => MysqlAdapter::INT_BIG, 'null' => false, 'comment' => '创建时间'])
            ->addColumn('updated_at', 'integer', ['limit' => MysqlAdapter::INT_BIG, 'null' => true, 'comment' => '更新时间'])
            ->addColumn('deleted_at', 'integer', ['limit' => MysqlAdapter::INT_BIG, 'null' => true, 'comment' => '逻辑删除'])
            ->create();
        // 预填充信息
        $rows = [
            [
                'id' => 1,
                'admin_id' => 1,
                'role_id' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ]
        ];
        $table->insert($rows)->saveData();
    }
}

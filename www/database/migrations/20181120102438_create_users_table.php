<?php


use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function change()
    {
        $this->table('users')
            ->addColumn('username', 'string')
            ->addColumn('name', 'string')
            ->addColumn('gender', 'string')
            ->addColumn('email', 'string')
            ->addColumn('phone', 'string')
            ->addColumn('role', 'string')
            ->addColumn('work', 'string')
            ->addColumn('password', 'string')
            ->addColumn('avatar', 'string', ['null' => true])
            ->addColumn('status','string', ['default' => 10])
            ->addIndex(['username'], ['unique' => true])
            ->addIndex(['email'], ['unique' => true])
            ->addIndex(['phone'], ['unique' => true])
            ->addTimestamps()
            ->create();
    }
}

<?php


use Phinx\Migration\AbstractMigration;

class CustomersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->table('customers')
            ->addColumn('structure', 'string')
            ->addColumn('name' , 'string')
            ->addColumn('email', 'string')
            ->addColumn('phone', 'string')
            ->addColumn('city', 'string')
            ->addColumn('country', 'string')
            ->addColumn('address', 'string')
            ->addColumn('siteweb', 'string', ['null' => true])
            ->addColumn('status','string', ['default' => 10])
            ->addTimestamps()
            ->addIndex(['name'], ['unique' => true])
            ->addIndex(['email'], ['unique' => true])
            ->addIndex(['phone'], ['unique' => true])
            ->addIndex(['siteweb'], ['unique' => true])
            ->create();
    }
}

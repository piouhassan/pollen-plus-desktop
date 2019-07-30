<?php


use Phinx\Migration\AbstractMigration;

class ProjectsTable extends AbstractMigration
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
        $this->table('projects')
            ->addColumn('name', 'string')
            ->addColumn('type' , 'string')
            ->addColumn('budget', 'string')
            ->addColumn('description', 'text', ['limit' => \Phinx\Db\Adapter\MysqlAdapter::TEXT_LONG])
            ->addColumn('started_at', 'datetime')
            ->addColumn('ended_at', 'datetime')
            ->addColumn('start', 'boolean', ['default' => false])
            ->addColumn('finish', 'boolean', ['default' => false])
            ->addColumn('customer_id', 'integer')
            ->addColumn('status','string', ['default' => 10])
            ->addColumn('month', 'string')
            ->addIndex(['name'], ['unique' => true])
            ->addForeignKey('customer_id', 'customers','id', ['delete' => 'CASCADE'])
            ->addTimestamps()
            ->create();
    }
}

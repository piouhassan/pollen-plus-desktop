<?php


use Phinx\Migration\AbstractMigration;

class CreateDatabaseTable extends AbstractMigration
{

    public function change()
    {
        $this->table('databases')
            ->addColumn('fichier', 'string')
            ->addTimestamps()
            ->create();
    }
}

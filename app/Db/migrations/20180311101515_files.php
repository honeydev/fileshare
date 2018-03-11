<?php


use Phinx\Migration\AbstractMigration;

class Files extends AbstractMigration
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
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $files = $this->table('files', ['id' => false, 'primary_key' => 'id', 'identify' => true]);
        $files->addColumn('name', 'char', ['limit' => 255, 'null' => false]);
        $files->addColumn('uri', 'char', ['limit' => 255, 'null' => false]);
        $files->addColumn('size', 'char', ['limit' => 128, 'null' => false]);
        $files->addColumn('mime', 'char', ['limit' => 128, 'null' => false]);
        $files->addColumn('owner_id', 'integer', ['limit' => 11, 'null' => false]);
        $files->addColumn('id', 'integer', ['limit' => 11, 'null' => false]);
        $files->addForeignKey(
            'owner_id',
            'users',
            'id',
            ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION']
        );
        $files->create();
    }
}

<?php


use Phinx\Migration\AbstractMigration;

class UsersSettings extends AbstractMigration
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
        $usersSettings = $this->table(
            'users_settings',
            ['primary_key' => 'user_id', 'null' => false, 'id' => false]
        );
        $usersSettings->addColumn('account_status', 'boolean');
        $usersSettings->addColumn(
            'access_lvl',
            'integer',
            ['limit' => 1, 'default' => 1]
        );
        $usersSettings->addColumn('user_id', 'integer', [
            'null' => false,
            'limit' => 11
            ]
        );
        $usersSettings->addForeignKey(
            'user_id',
            'users',
            'id',
            ['delete' => 'CASCADE', 'update' => 'CASCADE']
        );
        $usersSettings->create();
    }
}

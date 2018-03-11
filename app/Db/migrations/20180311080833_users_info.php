<?php


use Phinx\Migration\AbstractMigration;

class UsersInfo extends AbstractMigration
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
        $usersInfo = $this->table('users_info', [
            'id' => false,
            'primary_key' => 'user_id',
            'null' => false
            ]
        );
        $usersInfo->addColumn('name', 'string', ['limit' => 255]);
        $usersInfo->addColumn('avatar_uri', 'string', ['limit' => 255]);
        $usersInfo->addColumn('user_id', 'integer', ['limit' => 11, 'null' => false]);
        $usersInfo->addForeignKey(
                'user_id',
                'users',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            );
        $usersInfo->create();
    }
}

<?php
/**
 * @class BaseMigration
 */

declare(strict_types=1);

namespace Fileshare\Db\migrations;

use Phinx\Migration\AbstractMigration;
use Illuminate\Database\Capsule\Manager as Capsule;

class BaseMigration extends AbstractMigration
{

    /**
     * @var \Illuminate\Database\Schema\MySqlBuilder
     */
    protected $schema;

    protected function init()
    {
        $capsule = new \Illuminate\Database\Capsule\Manager;
        $capsule->addConnection(array(
                'driver' => 'mysql',
                'host' => 'localhost',
                'database' => 'fileshare',
                'username' => 'honey',
                'password' => 'd5d7',
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
            )
        );

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        $this->schema = (new Capsule)->schema();
    }
}
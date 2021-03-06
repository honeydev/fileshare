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
        $this->schema = (new Capsule)->schema();
    }
}
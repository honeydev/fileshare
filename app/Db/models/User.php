<?php

declare(strict_types=1);

namespace Fileshare\Db\models;

class User
{
    use \Fileshare\Db\cruds\Users;
    use \Fileshare\Db\cruds\UsersInfo;
    use \Fileshare\Db\cruds\UsersSettings;
    /** @property \Pdo */
    private $db;

    public function __construct($container)
    {
        $this->db = $container->get('db');
    }

    public function __call($methodName, $args)
    {
        if (method_exists($this, $methodName)) {
            $this->$methodName(...$args);
        } else {
            throw new \InvalidArgumentException(`Method ${$methodName} not exist`);          
        }
    }
}

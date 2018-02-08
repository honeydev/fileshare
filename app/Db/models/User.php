<?php

declare(strict_types=1);

namespace Fileshare\Db\models;

class User
{
    use \Fileshare\Db\cruds\Users;
    use \Fileshare\Db\cruds\UsersSettings;
    use \Fileshare\Db\cruds\UsersInfo {
        \Fileshare\Db\cruds\UsersInfo::__construct as initUsersInfo;
    }
    /** @property \Pdo */
    private $db;

    public function __construct($container)
    {
        $this->db = $container->get('db');
        $this->initUsersInfo($container);
    }

    public function __call($methodName, $args)
    {
        if (method_exists($this, $methodName)) {
            return $this->$methodName(...$args);
        }
        throw new \InvalidArgumentException(`Method ${$methodName} not exist`);
    }
}

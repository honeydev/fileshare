<?php

/** @interface DatabaseInterface */

declare(strict_types=1);

namespace Fileshare\Db;

class mysqlDb implements DatabaseInterface
{
    /** @object \Pdo connected to mysql database */
    private $mysql;

    private $users;

    public function __contstruct($container)
    {
        $db = $container['settings']['db'];
        $pdo = new \PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'], $db['user'], $db['pass']);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        return $pdo;
    }

    /** @throws \InvalidArgumentException */
    public function query(string $table, string $query, array $args): bool
    {
        if (!property_exists($this, $table)) {
            throw new \InvalidArgumentException(`Unknow table ${$table}`);
        }
        if (!method_exists($this->$table, $query)) {
            throw new \InvalidArgumentException(`Unknown method ${$query}`);
        }
        $this->$table->$query($args);
    }
}

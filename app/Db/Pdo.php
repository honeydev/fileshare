<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/4/17
 * Time: 8:59 PM
 */

namespace Fileshare\Db;

class Pdo
{
    private $pdo;

    public function __construct($container)
    {
        $this->pdo = $container->get('db');
    }

    public function query($query)
    {

    }
}
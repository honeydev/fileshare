<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/4/17
 * Time: 9:11 PM
 */

namespace Fileshare\Auth;


class RegisterAuth
{

    public function __construct($container)
    {
        parent::__construct($container);
        $this->pdo = $container->get('db');
    }

    public function auth($regFormData)
    {
        try {
            //db query
        } catch (\InvalidArgumentException $e) {
            return false;
        }
    }
}
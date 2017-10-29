<?php

/**
 * Created by PhpStorm.
 * User: honey
 * Date: 10/10/17
 * Time: 16:44
 */
namespace Fileshare\CRUDs;

trait UsersCRUDs
{
    protected function selectUserByLogin($login)
    {
        $query = "SELECT username, token, id FROM users WHERE login = '$login'";
        $this->db->query($query);
    }

    protected function addUser($userInfo)
    {
        extract($userInfo);
        $addUser = "INSERT INTO users (uername, hash, id) VALUES ('$username', '$hash', NULL)";
        $addUserInfo = "INSERT INTO userinfo name VALUES '$name'";
    }
}

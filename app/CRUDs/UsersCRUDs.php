<?php
/** 
 * @trait UsersCRUDs require in class @property $db - PDO 
 * class instance
 */
namespace Fileshare\CRUDs;

trait UsersCRUDs
{
    protected function findEqualUserEmail($email)
    {
        $getIdIfEmailsEqual = "SELECT id FROM users WHERE email = '$email'";
        $equalsId = $this->db->query($getIdIfEmailsEqual);
        return $equalsId->fetch();
    }
}

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

    protected function addUserInUsers($userData)
    {
        extract($userData);
    	$addUserInBase = "INSERT INTO users (email, hash, id) VALUES (
    		'$email', '$hash', NULL)";
		$addUserInBase = $this->db->query($addUserInBase);
		return $addUserInBase;
    }
}

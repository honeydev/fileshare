<?php
/** 
 * @trait UsersCRUDs require in class @property $db - PDO 
 * class instance
 */

declare(strict_types=1);

namespace Fileshare\CRUDs;

trait UsersCRUDs
{
    protected function findEqualUserEmail(string $email)
    {
        $getIdIfEmailsEqual = "SELECT id FROM users WHERE email = '$email'";
        $equalsId = $this->db->query($getIdIfEmailsEqual);
        return $equalsId->fetch();
    }

    protected function addUserInUsers(array $userData)
    {
        //expected var $email, $hash
        extract($userData);
    	$addUser = "INSERT INTO users (email, hash, id) VALUES (:email, :hash, NULL)";
		$this->db->prepare($addUser);
		$addUser->execure(['email' => $email, 'hash' => $hash]);
    }

    protected function deleteUser(array $userIdentificator)
    {
        //expected var $identificatorType, $identificatorValue
        extract($userIdentificator); 
        $deleteUser = "DELETE FROM users WHERE '$identificatorType' = '$identificatorValue'";
        $this->db->query($deleteUser);
    }

    protected function selectUserData(array $userIdentificator)
    {
        extract($userIdentificator);
        echo $identificatorType;
        $userData = "SELECT email, hash FROM users WHERE $identificatorType = '$identificatorValue'";
        $userData = $this->db->query($userData);
        $userData = $userData->fetch();
        return $userData;
    }
}

<?php
/** 
 * @trait UsersCRUDs require in class @property $db - PDO 
 * class instance
 */

namespace Fileshare\CRUDs;

trait UsersCRUDs
{
    /**
     * @param string $email
     * @return mixed {bool|array}
     */
    protected function findEqualUserEmail(string $email)
    {
        $getIdIfEmailsEqual = "SELECT id FROM users WHERE email = '$email'";
        $equalsId = $this->db->query($getIdIfEmailsEqual);
        return $equalsId->fetch();
    }

    protected function addUserInUsers(array $userData): string
    {
        //expected var $email, $hash
        extract($userData);
    	$addUser = "INSERT INTO users (email, hash, id) VALUES (:email, :hash, NULL)";
		$request = $this->db->prepare($addUser);
		$request->execute(['email' => $email, 'hash' => $hash]);
		return $this->db->lastInsertId();
    }
    /**
     * @param array $userIdentificator asscoc array were key type of select data from base
     * (id, email)
     * @return {void}
     */
    protected function deleteUser(array $columnValue)
    {
        extract($columnValue);
        $deleteUser = "DELETE FROM users WHERE '$column' = '$value'";
        $this->db->query($deleteUser);
    }

    /**
     * @param {array} $userIdentificator asscoc array were key type of select data from base
     * (id | email) ["identificatorType" => 'id', "identificatorValue" => "some value"]
     * @return {array|boolean} - return false if user not exist in base
     */
    protected function selectUserData(array $columnValue)
    {
        extract($columnValue);
        $userData = "SELECT email, hash, id FROM users WHERE $column = '$value'";
        $userData = $this->db->query($userData);
        $userData = $userData->fetch();
        return $userData;
    }

    protected function selectConcreteUserData(string $userId): array
    {
        $userId = (int) $userId;
        $selectConcreteUserData = "SELECT users.email, users.id, usersInfo.name,  usersInfo.avatarUri, usersSettings.accountStatus, usersSettings.accessLvl FROM users LEFT JOIN usersInfo ON users.id = usersInfo.userId LEFT JOIN usersSettings ON users.id = usersSettings.userId WHERE users.id = $userId";
        $selectConcreteUserData = $this->db->query($selectConcreteUserData);
        return $selectConcreteUserData->fetch();
    }
}

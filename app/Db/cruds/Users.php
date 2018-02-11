<?php
/** 
 * @trait UsersCRUDs require in class @property $db - PDO 
 * class instance
 */
namespace Fileshare\Db\cruds;

trait Users
{
    /**
     * @return mixed {bool|array}
     */
    protected function findEqualUserEmail(string $email)
    {
        $getIdIfEmailsEqual = "SELECT id FROM users WHERE email = '$email'";
        $equalsId = $this->db->query($getIdIfEmailsEqual);
        return $equalsId->fetch();
    }
    /**
     * @param array $userData keys email => string, hash => string
     * @return string
     */
    protected function addUserInUsers(array $userData): string
    {
        extract($userData);
    	$addUser = "INSERT INTO users (email, hash, id) VALUES (:email, :hash, NULL)";
		$request = $this->db->prepare($addUser);
		$request->execute(['email' => $email, 'hash' => $hash]);
		return $this->db->lastInsertId();
    }
    /**
     * @return {void}
     */
    protected function deleteUser(string $userId)
    {
        $deleteUser = "DELETE FROM users WHERE id = '$userId'";
        $userId = $this->db->query($deleteUser);
        $userId = $userId->fetch();
        return $userId;
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
    /**
     * @param string $userId
     * @return array
     */
    protected function selectConcreteUserData(string $userId): array
    {
        $userId = (int) $userId;
        $selectConcreteUserData = "
            SELECT users.email, users.id, usersInfo.name,  usersInfo.avatarUri, usersSettings.accountStatus, usersSettings.accessLvl 
            FROM users LEFT JOIN usersInfo ON users.id = usersInfo.userId LEFT JOIN usersSettings 
            ON users.id = usersSettings.userId WHERE users.id = $userId
            ";
        $selectConcreteUserData = $this->db->query($selectConcreteUserData);
        return $selectConcreteUserData->fetch();
    }
    /**
     * @param array $columnAndValue column name, column value
     * @return string|bool
     */
    public function selectUserIdByEmail(string $email)
    {
        $selectId = "SELECT id FROM users WHERE email = '$email'";
        $selectId = $this->db->query($selectId);
        $selectId = $selectId->fetch();
        if ($selectId === false) {
            return $selectId;
        } else {
            return $selectId[0];
        }
    }
}

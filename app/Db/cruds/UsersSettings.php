<?php
/**
 * @trait UsersCRUDs require in class @property $db - PDO
 * class instance
 */

declare(strict_types=1);

namespace Fileshare\Db\cruds;

trait UsersSettings
{
    /**
     * @param string $id
     * @return {array|false}
     */
    protected function selectUserSettings(array $columnValue)
    {
        extract($columnValue);
        $selectUserSettings = "SELECT accountStatus, accessLvl, userId FROM usersSettings WHERE $column = '$value'";
        $selectUserSettings = $this->db->query($selectUserSettings);
        $selectUserSettings = $selectUserSettings->fetch();
        return $selectUserSettings;
    }
    /**
     * @param array $userSettings
     * @return {PDOStatement|false}
     */
    protected function addUserSettings(array $userSettings)
    {
        $accessLvl = $userSettings['accessLvl'];
        $id = $userSettings['id'];
        $addSetting = "INSERT INTO usersSettings (accessLvl, userId) VALUES ($accessLvl, $id)";
        return $this->db->query($addSetting);
    }
}

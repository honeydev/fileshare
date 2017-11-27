<?php
/**
 * @trait UsersCRUDs require in class @property $db - PDO
 * class instance
 */

declare(strict_types=1);

namespace Fileshare\CRUDs;

trait UsersSettingsCRUDs
{
    protected function selectUserSettings(string $id)
    {
        $selectUserSettings = "SELECT accountStatus, accessLvl, id FROM usersSettings WHERE id = '$id'";
        $selectUserSettings = $this->db->prepare($selectUserSettings);
        $selectUserSettings = $selectUserSettings->execute($selectUserSettings);
        return $selectUserSettings->fetch();
    }

    protected function addUserSettings(array $userSettings)
    {
        $accessLvl = $userSettings['accessLvl'];
        $id = $userSettings['id'];
        $addSetting = "INSERT INTO usersSettings (accessLvl, userId) VALUES ($accessLvl, $id)";
        return $this->db->query($addSetting);
    }
}

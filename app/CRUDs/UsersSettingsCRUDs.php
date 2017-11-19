<?php
/**
 * @trait UsersCRUDs require in class @property $db - PDO
 * class instance
 */

declare(strict_types=1);

namespace Fileshare\CRUDs;

trait UsersSettingsCRUDs
{
    protected function selectUserSettings($id)
    {
        $selectUserSettings = "SELECT accountStatus, accessLvl, id FROM usersSettings WHERE id = '$id'";
        $selectUserSettings = $this->db->prepare($selectUserSettings);
        $selectUserSettings = $selectUserSettings->execute($selectUserSettings);
        return $selectUserSettings->fetch();
    }

    protected function addUserSettings($userSettings)
    {
        $accountStatus = $userSettings['accountStatus'];
        $accessLvl = $userSettings['accessLvl'];
        $id = $userSettings['id'];
        $addSetting = "INSERT INTO usersSettings (accountStatus, accessLvl, id) VALUES 
            accountStatus = '$accountStatus', accessLvl = '$accessLvl', id = '$id'";
        return $this->db->query($addSetting);
    }
}

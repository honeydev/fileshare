<?php

/** cruds from table userInfo */

declare(strict_types=1);

namespace Fileshare\CRUDs;

trait UsersInfoCRUDs
{
    private $crudsHelper;

    public function __construct($container)
    {
        $this->crudsHelper = $container->get('CRUDsHelper');
    }

    /**
     * @return {mixed} PDOStatement|false
     */
    protected function addUserInfo(array $userInfo): array
    {
        $queryKeys = $this->crudsHelper->getKeysSection($userInfo);
        $queryValues = $this->crudsHelper->getValuesSection($userInfo);
        $addUserInfo = "INSERT INTO usersInfo $queryKeys VALUES $queryValues";
        return $this->db->query($addUserInfo);
    }

    /**
     * @param $userIdentificator asscoc array were key type of select data from base
     * (userid || email) ["identificatorType" => 'userid', "identificatorValue" => "some value"]
     * @return array
     */
    protected function selectUserInfo(array $userIdentificator): array
    {
        ectract($userIdentificator);
        $selectUserInfo = "SELECT name, avatarUri FROM userInfo WHERE $userIdentificator = '$identificatorType'";
        $userInfo = $this->db->query($userData);
        return $userInfo->fetch();
    }
}

<?php

/** cruds from table userInfo */

declare(strict_types=1);

namespace Fileshare\Db\cruds;

trait UsersInfo
{
    private $crudsHelper;

    public function __construct($container)
    {
        $this->crudsHelper = $container->get('CRUDsHelper');
    }

    /**
     * @return mixed {PDOStatement|false}
     */
    protected function addUserInfo(array $userInfo)
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
        extract($userIdentificator);
        $selectUserInfo = "SELECT name, avatarUri FROM usersInfo WHERE $column = '$value'";
        $userInfo = $this->db->query($selectUserInfo);
        return $userInfo->fetch();
    }
}

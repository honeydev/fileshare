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

    protected function addUserInfo(array $userInfo)
    {
        $queryKeys = $this->crudsHelper->getKeysSection($userInfo);
        $queryValues = $this->crudsHelper->getValuesSection($userInfo);
        $addUserInfo = "INSERT INTO usersInfo $queryKeys VALUES $queryValues";
        var_dump('query', $addUserInfo);
        return $this->db->query($addUserInfo);
    }
}

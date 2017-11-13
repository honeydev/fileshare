<?php

declare(strict_types=1);

namespace Fileshare\Services;

class DeleteUserService
{
    use \Fileshare\Checkers\UsersChecker;
    use \Fileshare\CRUDs\UsersCRUDs;

    public function __construct($container)
    {

    }
    /**
     * 
     * @param  [assoc array] contain two keys:
     * @string identificatorType (maybe id or email),
     * @string identificatorValue 
     */
    public function deleteUser(array $userIdentificator)
    {
        try {
            $this->checkUserIdentificator($userIdentificator);
            $this->deleteUser($userIdentificator);
        } catch (Fileshare\Exceptions\DatabaseException $e) {

        }
    }
}

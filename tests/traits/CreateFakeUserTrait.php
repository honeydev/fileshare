<?php
/**
 * @trait CreateFakeUserTrait
 */
declare(strict_types=1);

namespace FileshareTests\traits;

use \Codeception\Util\Debug as debug;

trait CreateFakeUserTrait
{
    /** @return created user id */
    private function createUser(array $fakeUsersData): string
    {
        if (array_key_exists('users', $fakeUsersData)) {
            $userId = $this->insertInUsers($fakeUsersData['users']);
        } else {
            throw new \InvalidArgumentException('Failed fake user data, didn`t contain main key users');
        }
        if (array_key_exists('usersSettings', $fakeUsersData)) {
            $fakeUsersData['usersSettings']['userId'] = $userId;
            $this->insertInUsersSettings($fakeUsersData['usersSettings']);
        }
        if (array_key_exists('usersInfo', $fakeUsersData)) {
            $fakeUsersData['usersInfo']['userId'] = $userId;
            $this->insertInUsersInfo($fakeUsersData['usersInfo']);
        }
        return $userId;
    }

    private function insertInUsers(array $tableData)
    {
        $this->tester->haveInDatabase('users', $tableData);
        $id = $this->tester->grabFromDatabase('users', 'id', array('email' => $tableData['email']));
        return $id;
    }

    private function insertInUsersInfo(array $tableData)
    {
        $this->tester->haveInDatabase('usersInfo', $tableData);
    }

    private function insertInUsersSettings(array $tableData)
    {
        $this->tester->haveInDatabase('usersSettings', $tableData);
    }
}

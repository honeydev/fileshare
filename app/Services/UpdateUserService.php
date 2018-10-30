<?php

declare(strict_types=1);

namespace Fileshare\Services;

use Fileshare\Models\User;
use \Fileshare\Transformers\NewProfileDataTransformer;
use \Codeception\Util\Debug as debug;

class UpdateUserService
{
    /**
     * @property \Fileshare\Services\CryptoService
     */
    private $cryptoService;

    public function __construct($container)
    {
        $this->cryptoService = $container->get('CryptoService');
    }
    /**
     * @return void
     */
    public function update(User $user, array $newUserData)
    {
        if (array_key_exists('newPassword', $newUserData)) {
            $newUserData['newPassword'] = $this->cryptoService->getPasswordHash(
                $newUserData['newPassword']
            );
        }
        $newUserData = NewProfileDataTransformer::transform($newUserData);
        $this->saveNewUserDataByModelName($user, $newUserData);
    }
    /**
     * @return void
     */
    private function saveNewUserDataByModelName(User $user, array $newUserData)
    {
        debug::debug($newUserData);
        foreach ($newUserData as $modelName => $newModelValues) {
            $this->addNewUserDataToModels($user, $newModelValues, $modelName);
        }
    }
    /**
     * @return void
     */
    private function addNewUserDataToModels(User $user, array $newUserData, string $modelName)
    {
        foreach ($newUserData as $newValuesPair) {
            $key = $newValuesPair->key;
            $value = $newValuesPair->value;
            if ($this->modelNameIsRelationModel($user, $modelName)) {
                $relationModel = $user->$modelName;
                $relationModel->$key = $value;
                $relationModel->save();
            } else {
                debug::debug($value);
                $user->$key = $value;
                $user->save();
            }
        }
//        debug::debug($user);
    }

    private function modelNameIsRelationModel(User $user, string $modelName): bool
    {
        $userReflect = new \ReflectionClass($user);
        $userShortClassName = $userReflect->getShortName();
        return strtolower($userShortClassName) !== strtolower($modelName);
    }
}

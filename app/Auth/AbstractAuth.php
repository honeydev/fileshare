<?php

declare(strict_types=1);

namespace Fileshare\Auth;

use \Tokenly\TokenGenerator\TokenGenerator;
use Illuminate\Database\Eloquent\Model as EloquentModel;

abstract class AbstractAuth
{
    protected $container;
    protected $logger;

    public function __construct($container)
    {
        $this->container = $container;
        $this->logger = $container->get('Logger');
    }

    abstract public function auth($dataToCheck);

    public function generateToken(int $length = 40, string $prefix = ''): string
    {
        return (new TokenGenerator())->generateToken($length, $prefix);
    }

    protected function userExist(string $email): bool
    {
        if (empty(EloquentModel::where('email', $email)->first())) {
            return false;
        }
        return true;
    }

    protected function passwordHashCorrect(EloquentModel $user, string $password): bool
    {
        if (!password_verify($password, $user->password)) {
            return false;
        }
        return true;
    }
}

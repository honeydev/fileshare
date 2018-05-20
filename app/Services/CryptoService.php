<?php

declare(strict_types=1);

namespace Fileshare\Services;

use Fileshare\Exceptions\ValidateException as ValidateException;
use \Firebase\JWT\JWT;
use \Codeception\Util\Debug as debug;

class CryptoService
{
    /**
     * @throws ValidateException
     */
    public function getPasswordHash(string $password): string
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if ($hash !== false) {
            return $hash;
        }
        throw new ValidateException("Password {$password} hash generate failed");
    }
    /**
     * @throws ValidateException
     */
    public function passwordVerify(string $inputPassword, string $targetHash): bool
    {
        if (password_verify($inputPassword, $targetHash)) {
            return true;
        }
        throw new ValidateException("Invalid password {$inputPassword}");
    }

    public function generateJwtToken(array $jwtOptions): string
    {
        debug::debug($jwtOptions);
        $now = new \DateTime();
        $tokenInvalidityTime = new \DateTime("now + 12 hours");

        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $tokenInvalidityTime->getTimeStamp(),
            "jti" => base64_encode(random_bytes(8)),
            "iss" => $jwtOptions['appHost'],
            "sub" => $jwtOptions['identifier']
        ];

        $token = JWT::encode($payload, $jwtOptions["secretKey"], "HS256");
        return $token;
    }
}

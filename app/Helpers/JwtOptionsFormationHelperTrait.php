<?php
/**
 * @trait require Pimple\Container as $container property
 */
declare(strict_types=1);

namespace Fileshare\Helpers;

trait JwtOptionsFormationHelperTrait
{
    public function jwtOptionsPrepare(string $identifier)
    {
        return [
            "identifier" => $identifier,
            
        ];
    }
}

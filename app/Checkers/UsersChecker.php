<?php

declare(strict_types=1);

namespace Fileshare\Checkers;

trait UsersChecker
{
    protected function checkUserIdentificator(array $userIdentificator)
    {
        if (!array_key_exists('identificatorType', $identification)) {
            throw new \InvalidArgumentException('Array userIdentificator must contain key "identificatorType"');
        }
        if (!array_key_exists('identificatorValue', $identification)) {
            throw new \InvalidArgumentException('Array userIdentificator must contain key "identificatorValue"');      
        }
        return true;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 9/11/17
 * Time: 11:31 PM
 */
declare(strict_types=1);

namespace Fileshare\Validators;

abstract class AbstractValidator
{
    protected $regExpPattern = [];
    /**
     * @method validate - validate some data
     * @param {mixed} $dataFromValidation
     */
    public abstract function validate($dataFromValidation);

    protected function dataIsMatchRegExp($pattern, string $validationData) {
        \Codeception\Util\Debug::debug('abstract validator', $pattern, $validationData);
        if (preg_match($pattern, $validationData)) {
            return true;
        }
        return false;
    }
}
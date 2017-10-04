<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 9/11/17
 * Time: 11:31 PM
 */
namespace Fileshare\Validators;

abstract class AbstractValidator
{
    protected $regExpPattern;
    /**
     * @method validate - validate some data
     * @param {array} $dataFromValidation
     */
    public abstract function validate($patternType);

    protected function dataIsMatchRegExp($pattern, $validationData) {
        if (preg_match($pattern, $validationData)) {
            return true;
        }
        return false;
    }
}
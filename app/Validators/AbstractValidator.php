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
    /**
     * @method {mixed} validate - validate some data
     */
    public abstract function validate($dataForValidation);
}
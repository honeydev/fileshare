<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 19/11/17
 * Time: 18:01
 */

namespace Fileshare\Helpers;

class PrepareErrorHelper
{
    public function prepareErrorMessage($exception)
    {
        $errorMessage = [];
        $errorMessage['error'] = $exception->getMessage();
        $errorMessage['code'] = $exception->getCode();
        $errorMessage['file'] = $exception->getFile();
        $errorMessage['line'] = $exception->getLine();
        $errorMessage['stackString'] = $exception->getTraceAsString();
        $errorMessage['stackArray'] = explode('#', $errorMessage['stackString']);
        return $errorMessage;
    }
}

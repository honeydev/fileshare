<?php

declare(strict_types=1);

namespace Fileshare\Helpers;

class PrepareErrorHelper
{
    public function prepareErrorAsArray($exception, $errorType = null): array
    {
        $errorMessage = [];
        $errorMessage['error'] = $exception->getMessage();
        $errorMessage['code'] = $exception->getCode();
        $errorMessage['file'] = $exception->getFile();
        $errorMessage['line'] = $exception->getLine();
        $errorMessage['stackString'] = $exception->getTraceAsString();
        $errorMessage['stackArray'] = explode('#', $errorMessage['stackString']);
        $errorMessage["status"] = "failed";
        $errprMessage["errorType"] = $errorType;
        return $errorMessage;
    }

    public function prepareErrorAsString($exception): string
    {
        $errorMessage = '';
        $errorMessage .= $exception->getMessage();
        $errorMessage .= $exception->getCode();
        $errorMessage .= $exception->getFile();
        $errorMessage .= $exception->getLine();
        $errorMessage .= $exception->getTraceAsString();
        return $errorMessage;
    }
}

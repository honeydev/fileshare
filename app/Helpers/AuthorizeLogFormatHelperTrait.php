<?php

declare(strict_types=1);

namespace Fileshare\Helpers;

trait AuthorizeLogFormatHelperTrait
{
    private function prepareFailedAuthorizeLog(\Exception $e): string
    {
        $request = $this->container->get('request');
        $logMessage = '';
        $logMessage .= "Failed request on authorize account " . $this->loginData['email'];
        $logMessage .= ' from ip address' . $request->getServerParam('REMOTE_ADDR');
        $logMessage .= $this->prepareErrorHelper->prepareErrorAsString($e);
        return $logMessage;
    }

    private function prepareSuccessAuthorizeLog(): string
    {
        $request = $this->container->get('request');
        $logMessage = '';
        $logMessage .= "Success authorize account " . $this->loginData['email'];
        $logMessage .= ' from ip address' . $request->getServerParam('REMOTE_ADDR');
        return $logMessage;
    }
}

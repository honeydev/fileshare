<?php
/**
 * @trait OwnerMiddlewareLogHelperTrait
 */
declare(strict_types=1);

namespace Fileshare\Helpers;
 
trait OwnerMiddlewareLogHelperTrait
{
    private function prepareFailedProfileChange(\Exception $e): string
    {
    	var_dump($this->id);
        $logMessage = 'Failed attempt check owner with id' . $this->id;
        $logMessage .= 'by user ' . $this->sessionModel->user->email . "\n\t with id  \t"  . $this->sessionModel->user->id;
        return $logMessage;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/4/17
 * Time: 9:17 PM
 */

namespace Fileshare\Middlewares;

use Fileshare\Exceptions\FileshareException as FileshareException;

abstract class AbstractMiddleware
{
    protected $container;
    private $sessionModel;

    public function __construct($container)
    {
        $this->container = $container;
        $this->sessionModel = $container->get('SessionModel');
    }

    protected function userAlreadyAuthorized()
    {
        if ($this->sessionModel->authorizeStatus) {
            throw new FileshareException('User already authorized');
        }
    }

    protected function prepareErrorToJsonSend($e, $errorType)
    {
        $error = [
            'errorType' => $errorType,
        ];
        if ($this->container->get('settings')['displayErrorDetails']) {
            $error['fullError'] = $e->getErrorMessage();
        }
        return $error;
    }
}

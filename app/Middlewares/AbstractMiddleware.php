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
    protected $prepareErrorHelper;
    private $sessionModel;

    public function __construct($container)
    {
        $this->container = $container;
        $this->sessionModel = $container->get('SessionModel');
        $this->prepareErrorHelper = $container->get('PrepareErrorHelper');
    }

    protected function userAlreadyAuthorized()
    {
        if ($this->sessionModel->authorizeStatus) {
            throw new FileshareException('User already authorized');
        }
    }

    protected function sendErrorWithJson($errorElements, $response)
    {
            $error = [
                'loginStatus' => 'failed',
                'errorType' => $errorElements['errorType']
            ];

        if (false) {
            $error = array_merge($error, $this->prepareErrorHelper->prepareErrorMessage($errorElements['exception']));
        }
        return $response->withJson($error, $errorElements['errorCode']);
    }
}

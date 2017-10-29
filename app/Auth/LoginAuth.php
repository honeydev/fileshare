<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/4/17
 * Time: 8:36 PM
 */

namespace Fileshare\Auth;

use Fileshare\Exceptions\FileshareException as FileshareException;

class LoginAuth extends AbstractAuth
{
    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function auth($loginFormData)
    {
        try {
            //db query
        } catch (FileshareException $e) {
            $this->logger->error($e->getErrorMessage());
            return false;
        }
        return true;
    }
}
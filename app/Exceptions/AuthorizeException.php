<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 17/11/17
 * Time: 21:54
 */

namespace Fileshare\Exceptions;


class AuthorizeException extends AbstractAppException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
        $this->prepareMessage();
        $this->prepareStack();
    }
}

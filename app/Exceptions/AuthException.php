<?php

namespace Fileshare\Exceptions;

class AuthException extends AbstractAppException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
        $this->prepareMessage();
        $this->prepareStack();
    }
}

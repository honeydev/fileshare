<?php

namespace Fileshare\Exceptions;

class AccessException extends AbstractAppException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
        $this->prepareMessage();
        $this->prepareStack();
    }
}

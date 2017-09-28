<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 9/12/17
 * Time: 12:19 AM
 */
declare(strict_types=1);

namespace Fileshare\Exceptions;

class FileshareException extends AbstractAppException
{
    public function __construct(string $message) 
    {
        parent::__construct($message);
        $this->prepareMessage();
        $this->prepareStack();
    }

    final protected function prepareMessage() 
    {
        $errorMessage = [];
        $errorMessage['error'] = $this->getMessage();
        $errorMessage['code'] = $this->getCode();
        $errorMessage['file'] = $this->getFile();
        $errorMessage['line'] = $this->getLine();
        $this->errorMessage = $errorMessage;
    }

    final protected function prepareStack()
    {
        $this->errorStack = explode('#', $this->getTraceAsString());
    }

    public function getErrorMessage() 
    {
        return $this->errorMessage;
    }

    public function getErrorStack()
    {
        return $this->errorStack;
    }
}

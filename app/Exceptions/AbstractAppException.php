<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 9/14/17
 * Time: 9:09 PM
 */
declare(strict_types=1);

namespace Fileshare\Exceptions;

abstract class AbstractAppException extends \Exception
{
    protected $errorMessage;

    public function __construct(string $message) {
        parent::__construct($message);
    }

    protected function prepareMessage()
    {
        $errorMessage = [];
        $errorMessage['error'] = $this->getMessage();
        $errorMessage['code'] = $this->getCode();
        $errorMessage['file'] = $this->getFile();
        $errorMessage['line'] = $this->getLine();
        $this->errorMessage = $errorMessage;
    }

    protected function prepareStack()
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
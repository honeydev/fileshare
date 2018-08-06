<?php
/**
 * @class ValidateException
 */
declare(strict_types=1);

namespace Fileshare\Exceptions;

class FileTypeException extends AbstractAppException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
        $this->prepareMessage();
        $this->prepareStack();
    }
}
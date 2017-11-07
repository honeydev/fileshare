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
}

<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 9/14/17
 * Time: 9:15 PM
 */
declare(strict_types=1);

namespace Fileshare\Exceptions;

class DatabaseException extends AbstractAppException
{
    private $databaseError;

    public function __construct(string $message) {
        {
            parent::__construct($message);
            $this->prepareMessage();
            $this->prepareStack();
        }
    }
}

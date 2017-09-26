<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 9/14/17
 * Time: 9:15 PM
 */

namespace Fileshare\Exceptions;

class DatabaseException
{
    private $databaseError;

    public function __construct(string $message, $container) {
        parent::__construct($message, $container);
    }
}
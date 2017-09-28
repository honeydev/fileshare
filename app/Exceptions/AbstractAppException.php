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
    public function __construct(string $message) {
        parent::__construct($message);
    }
    /**
     * @return [array]
     */
    abstract public function getErrorMessage();
    /**
     * @return [array] 
     */
    abstract public function getErrorStack();

    abstract protected function prepareMessage();

    abstract protected function prepareStack();
}
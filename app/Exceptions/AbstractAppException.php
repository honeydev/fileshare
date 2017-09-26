<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 9/14/17
 * Time: 9:09 PM
 */
namespace Fileshare\Exceptions;

abstract class AbstractAppException extends \Exception
{
    protected $logger;
    protected $sessionModel;

    public function __construct(string $message, $container) {
        parent::__construct($message);
        $this->logger = $container->get('logger');
        $this->sessionModel = $container->get('SessionModel');
        $this->prepareMessage();
        $this->logging();
    }
    /**
     * @method preapareMessage - create error message.
     */
    abstract protected function prepareMessage();

    /**
     * @method logging write string in file
     */
    abstract protected function logging();
}
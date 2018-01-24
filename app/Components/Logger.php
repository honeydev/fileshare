<?php

namespace Fileshare\Components;

class Logger
{
    /** @property \Monolog\Logger */
    private $errorLogger;
    /** @property \Monolog\Logger */
    private $noticeLogger;
    /** @property \Monolog\Logger */
    private $warningLogger;
    /** @property \Monolog\Logger */
    private $authorizeLogger;

    public function __construct($container)
    {
        $this->errorLogger = $container->get('ErrorLogger');
        $this->noticeLogger = $container->get('NoticeLogger');
        $this->warningLogger = $container->get('WarningLogger');
        $this->authorizeLogger = $container->get('AuthorizeLogger');
    }
    
    public function errorlog(string $message)
    {
        $this->errorLogger->error($message);
    }
    
    public function noticeLog(string $message)
    {
        $this->noticeLogger->notice($message);
    }

    public function warningLog(string $message)
    {
        $this->warningLogger->warning($message);
    }

    public function authorizeLog(string $message)
    {
        $this->authorizeLogger->notice($message);
    }
}
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
    /** @property \Monolog\Logger */
    private $accessLogger;
    /** @propety bool */
    private $logging;

    public function __construct($container)
    {
        $this->logging = $container->get('settings')['logging'];
        $this->errorLogger = $container->get('ErrorLogger');
        $this->noticeLogger = $container->get('NoticeLogger');
        $this->warningLogger = $container->get('WarningLogger');
        $this->authorizeLogger = $container->get('AuthorizeLogger');
        $this->accessLogger = $container->get('AccessLogger');
    }
    /** @throw \InvalidArgumentException */
    public function __call($name, $arguments)
    {
        if (!method_exists($this, $name)) {
            throw new \InvalidArgumentException("Logger no found {$name}");
        }

        if ($this->logging) {
            $this->$name(...$arguments);
        }
    }
    
    private function errorlog(string $message)
    {
        $this->errorLogger->error($message);
    }
    
    private function noticeLog(string $message)
    {
        $this->noticeLogger->notice($message);
    }

    private function warningLog(string $message)
    {
        $this->warningLogger->warning($message);
    }

    private function authorizeLog(string $message)
    {
        $this->authorizeLogger->notice($message);
    }

    private function accessLog(string $message)
    {
        $this->accessLogger->notice($message);
    }
}

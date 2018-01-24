<?php

namespace FileshareTests\unit\components;

use Codeception\Util\Fixtures;
use \Codeception\Util\Debug as debug;

class LoggerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $container;

    private $logger;
    /** @property string */
    private $logsDir;

    protected function _before()
    {
        $this->container = Fixtures::get('container');
        $this->logger = $this->container->get('Logger');
        $this->logsDir = dirname(dirname(dirname(__DIR__))) . "/logs/";
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->seeErrorLogFile();
        $this->seeWarningsLogFile();
        $this->seeNoticeLogFile();
        $this->seeAuthorizeLogFile();
    }

    private function seeErrorLogFile()
    {
        $logId = $this->generateRandomTokenForLogTestIdent();
        $this->logger->errorLog('Test error log ' . $logId);
        $this->tester->seeFileFound($this->logsDir . 'errors.log');
        $this->tester->openFile($this->logsDir . 'errors.log');
        $this->tester->seeInThisFile('Test error log ' . $logId);
    }

    private function seeWarningsLogFile()
    {
        $logId = $this->generateRandomTokenForLogTestIdent();
        $this->logger->warningLog('Test warnings log ' . $logId);
        $this->tester->seeFileFound($this->logsDir . 'warnings.log');
        $this->tester->openFile($this->logsDir . 'warnings.log');
        $this->tester->seeInThisFile('Test warnings log ' . $logId);
    }

    private function seeNoticeLogFile()
    {
        $logId = $this->generateRandomTokenForLogTestIdent();
        $this->logger->noticeLog('Test notice log ' . $logId);
        $this->tester->seeFileFound($this->logsDir . 'notices.log');
        $this->tester->openFile($this->logsDir . 'notices.log');
        $this->tester->seeInThisFile('Test notice log ' . $logId);
    }

    private function seeAuthorizeLogFile()
    {
        $logId = $this->generateRandomTokenForLogTestIdent();
        $this->logger->authorizeLog('Test authorize log ' . $logId);
        $this->tester->seeFileFound($this->logsDir . 'authorizes.log');
        $this->tester->openFile($this->logsDir . 'authorizes.log');
        $this->tester->seeInThisFile('Test authorize log ' . $logId);
    }

    private function generateRandomTokenForLogTestIdent()
    {
        return uniqid('log'); 
    }
}
<?php

declare(strict_types=1);

namespace FileshareTests\unit\db;

use \Codeception\Util\Debug as debug;

class UsersDbTest extends \FileshareTests\unit\AbstractTest
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     * @property \Fileshare\Db\mysqlDb
     */
    private $mysqlDb;

    public function __construct()
    {
        parent::__construct();
    }

    protected function _before()
    {
        $this->mysqlDb = new \Fileshare\Db\UsersDb($this->container);
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {

    }

    private function testCorrectQuery()
    {

    }
}

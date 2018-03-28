<?php

namespace FileshareTests\unit\components;

use Codeception\Util\Fixtures;
use \Codeception\Util\Debug as debug;
use FileshareTests\unit\AbstractTest as AbstractTest;
use \Fileshare\Transformers\CamelCaseKeyTransformer as CamelCaseKeyTransformer;
class CamelCaseKeyTransformerTest extends AbstractTest
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $camelCaseKeyTransformer;


    public function __construct()
    {
        parent::__construct();
    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $UNDERSCORE_KEYS_ARRAY = ['hello_world' => "hello world", "user_name" => "user name"];
        $result = CamelCaseKeyTransformer::transform($UNDERSCORE_KEYS_ARRAY);
        $this->tester->assertEquals(
            ['helloWorld' => "hello world", "userName" => "user name"],
            $result
        );
    }
}

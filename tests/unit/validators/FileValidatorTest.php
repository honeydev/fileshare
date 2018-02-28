<?php
/**
 * @class FileValidatorTest
 */

declare(strict_types=1);

class FileValidatorTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $fileValidator;

    protected function _before()
    {
    }

    protected function _after()
    {
        $this->container = Fixtures::get('container');
        $this->fileValidator = $this->container->get('FileValidator');
    }
    // tests
    public function testSomeFeature()
    {

    }

    private function sendCorrectImages()
    {
        
    }

    private function sendImagesWithIncorrectExtension()
    {

    }

    private function sendNotImageWithImageExtension()
    {

    }
}

<?php
/**
 * @class FileValidatorTest
 */

declare(strict_types=1);

use Codeception\Util\Fixtures;
use \Codeception\Util\Debug as debug;

class ImageValidatorTest extends \Codeception\Test\Unit
{
    use \FileshareTests\unit\traits\CreateFileTrait;
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $imageValidator;

    protected function _before()
    {
        $this->container = Fixtures::get('container');
        $this->imageValidator = $this->container->get('ImageValidator');
    }

    protected function _after()
    {

    }
    // tests
    public function testSomeFeature()
    {
        $this->testValidImages();
        $this->testInvalidImages();
    }

    private function testValidImages()
    {
        $images = $this->createValidUploadedImages();

        foreach ($images as $image) {
            $this->tester->assertNull($this->imageValidator->validate($image));
        }
    }

    private function testInvalidImages()
    {
        $images = $this->createInvalidUploadedImages();

        foreach ($images as $image) {
            $this->tester->expectException('\Fileshare\Exceptions\ValidateException', function () use ($image) {
                $this->imageValidator->validate($image);
            });
        }
    }
}



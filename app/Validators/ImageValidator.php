<?php
/**
 * @class ImageValidator
 */

declare(strict_types=1);

namespace Fileshare\Validators;

use \Codeception\Util\Debug as debug;
use Fileshare\Exceptions\ValidateException;

class ImageValidator extends FileValidator
{
    public function __construct()
    {
        $this->allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'ico');
        $this->allowedMimeTypes =  array(
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon/'
        );
    }

    /**
     * @param $image array
     * @throws ValidateException
     */
    public  function validate($image)
    {
        $this->fileName = $image['name'];
        $this->fileExtension = $this->calculateExtension('1.jpeg');
        $this->checkExtension($image['name']);
        $this->checkMimeType($image['type']);
        $this->checkFile($image['file']);
    }

    /**
     * @throws ValidateException
     */
    protected function checkFile(string $pathToFile)
    {
        if (!getimagesize($pathToFile)) {
            throw new ValidateException("File {$this->fileName} it's not image");
        }
    }
}

<?php
/**
 * @class ImageValidator
 */

declare(strict_types=1);

namespace Fileshare\Validators;

use \Codeception\Util\Debug as debug;
use Fileshare\Exceptions\ValidateException;
use \Slim\Http\UploadedFile;

class ImageValidator extends FileValidator
{
    public function __construct(int $maxFileSize)
    {
        parent::__construct($maxFileSize);
        $this->allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'ico');
        $this->allowedMimeTypes =  array(
            'image/jpeg', 
            'image/jpeg', 
            'image/png',
            'image/gif',
            'image/bmp',
            'image/vnd.microsoft.icon/'
        );
    }
    /**
     * @param  \Slim\Http\UploadedFile;
     * @throws ValidateException
     */
    public  function validate($image)
    {
        $this->checkExtension($image);
        $this->checkMimeType($image);
        $this->checkFileSize($image);
    }
}

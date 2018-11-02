<?php

declare(strict_types=1);

namespace Fileshare\Validators;

use \Codeception\Util\Debug as debug;
use Fileshare\Exceptions\ValidateException;
use \Slim\Http\UploadedFile;

class UnknownFileValidator extends FileValidator
{
    public  function validate($image)
    {
        $this->checkFileSize($image);
    }
}

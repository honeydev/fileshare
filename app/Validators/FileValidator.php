<?php
/**
 * @class FileValidator
 */

declare(strict_types=1);

namespace Fileshare\Validators;

use \Codeception\Util\Debug as debug;
use Fileshare\Exceptions\ValidateException;

abstract class FileValidator extends AbstractValidator
{
    /** @var array */
    protected $allowedMimeTypes;
    /** @var array */
    protected $allowedExtensions;
    /**
     * @var string
     */
    protected $fileExtension;
    /**
    * @var string
    */
    protected $fileName;

    protected abstract function checkFile(string $pathToFile);

    /**
     * @throws ValidateException
     */
    protected function checkExtension(string $fileName)
    {
        $extensionMatchExist = false;

        foreach ($this->allowedExtensions as $allowExtension) {
            $extensionMatchExist = $this->dataIsMatchRegExp("/.{$allowExtension}$/", $fileName);
            if ($extensionMatchExist) return null;
        }

        if (!$extensionMatchExist) {
            throw new ValidateException("File $fileName has incorrect extension");
        }
    }

    /**
     * @throws ValidateException
     */
    protected function checkMimeType(string $type)
    {
        if ($this->allowedMimeTypes[$this->fileExtension] !== $type) {
            throw new ValidateException("File {$this->fileName} have invalid mime type {$type}");
        }
    }

    protected function calculateExtension(string $fileName): string
    {
        $dotPosition = strrpos($fileName, ".");
        return rtrim(substr($fileName, $dotPosition + 1, strlen($fileName)));
    }
}

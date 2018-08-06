<?php
/**
 * @class FileValidator
 */
declare(strict_types=1);

namespace Fileshare\Validators;

use \Codeception\Util\Debug as debug;
use Fileshare\Exceptions\{ValidateException, FileTypeException};
use \Slim\Http\UploadedFile;

abstract class FileValidator extends AbstractValidator
{
    /**
     * @property {array}
     */
    protected $allowedMimeTypes;
    /**
     * @property {array}
     */
    protected $allowedExtensions;
    /**
     * @property int
     */
    protected $maxFileSize;

    public function __construct(int $maxFileSize)
    {
        $this->maxFileSize = $maxFileSize;
    }

    public static function validateAccordType(UploadedFile $file, string $fileType, int $maxFileSize): string
    {
        if ($fileType === "image") {
            $validator = new ImageValidator($maxFileSize);
        } else {
            $validator = new UnknownFileValidator($maxFileSize);
            $fileType = 'unknown';
        }

        $validator->validate($file);
        return $fileType;
    }

    /**
     * @throws ValidateException
     */
    protected function checkExtension(UploadedFile $file)
    {
        $extension = $this->calculateExtension($file->getClientFilename());

        if (!in_array($extension, $this->allowedExtensions)) {
            throw new ValidateException("File " . $this->getClientFilename() . "has invalid extension {$extension}");
        }
    }
    /**
     * @throws ValidateException
     */
    protected function checkMimeType(UploadedFile $file)
    {
        if (!in_array($file->getClientMediaType(), $this->allowedMimeTypes)) {
            throw new FileTypeException("File " . $file->getClientFilename() . " has invalid mime type " 
                . $file->getClientFilename());
        }
    }

    protected function calculateExtension(string $fileName): string
    {
        $dotPosition = strrpos($fileName, ".");
        return rtrim(substr($fileName, $dotPosition + 1, strlen($fileName)));
    }

    protected function checkFileSize(UploadedFile $file, $maxSize = null)
    {
        if (empty($maxSize)) {
            $maxSize = $this->maxFileSize;
        }

        $fileSize = $file->getSize();
        if ($fileSize === null) {
            throw new ValidateException("Invalid uploaded file");
        }

        if ($fileSize > $maxSize) {
            throw new ValidateException("Invalid uploaded file size {$fileSize}");
        }
    }
}

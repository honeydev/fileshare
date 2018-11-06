<?php
/**
 * @class ProfileValidateMiddleware validate profile change request
 */
declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Exceptions\{FileTypeException, ValidateException};
use Fileshare\Helpers\StringFormatHelper;
use Fileshare\Validators\FileValidator;
use Fileshare\Helpers\FileSizeFormatHelper;
use \Codeception\Util\Debug as debug;

class FileValidationMiddleware extends AbstractMiddleware
{
    private $maxFileSize;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->maxFileSize = FileSizeFormatHelper::mbytesToBytes($container->get("settings")["maxFileSize"]);
    }
    
    public function __invoke(Request $request, Response $response, $next)
    {
        if (empty($file = $request->getUploadedFiles()['file'])) {
            throw new \InvalidArgumentException("File not finded in request");
        }
        $fileType = StringFormatHelper::transformMimeToFileType($file->getClientMediaType());

        try {
            $fileType = FileValidator::validateAccordType($file, $fileType, $this->maxFileSize);            
        } catch (ValidateException $e) {
            $this->logger->errorLog("Invalid file validation " . $file->getClientFileName());
            $response = $this->sendErrorWithJson([
                'status' => 'faield',
                'errorType' => 'invalid_file',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
            return $response;
        } catch (FileTypeException $e) {
            $this->logger->errorLog("Invalid file validation " . $file->getClientFileName());
            $response = $this->sendErrorWithJson([
                'status' => 'faield',
                'errorType' => 'invalid_file',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
            return $response;
        }
        $request = $request->withAttribute("fileType", $fileType);
        $response = $next($request, $response);
        return $response;
    }
}

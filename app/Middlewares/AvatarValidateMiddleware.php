<?php
/**
 * @class ProfileValidateMiddleware validate profile change request
 */
declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Exceptions\ValidateException as ValidateException;
use Fileshare\Helpers\StringFormatHelper;
use Fileshare\Validators\FileValidator;
use Fileshare\Helpers\FileSizeFormatHelper;
use \Codeception\Util\Debug as debug;

class AvatarValidateMiddleware extends AbstractMiddleware
{
    /**
     * @property int
     */
    private $maxAvatarSize;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->maxAvatarSize = FileSizeFormatHelper::mbytesToBytes($container->get('settings')['maxAvatarSize']);
    }
    
    public function __invoke(Request $request, Response $response, $next)
    {
        try {
            $avatarFile = $request->getUploadedFiles()["file"];
            $fileType = StringFormatHelper::transformMimeToFileType($avatarFile->getClientMediaType());
            FileValidator::validateAccordType($avatarFile, $fileType, $this->maxAvatarSize);
            $response = $next($request, $response);
        } catch (ValidateException $e) {
            $response = $this->sendErrorWithJson([
                'status' => 'faield',
                'errorType' => 'invalid_file',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
            return $response;
        }
        return $response;
    }
}

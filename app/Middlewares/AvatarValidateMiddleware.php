<?php
/**
 * @class ProfileValidateMiddleware validate profile change request
 */
declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Exceptions\ValidateException as ValidateException;
use \Codeception\Util\Debug as debug;

class AvatarValidateMiddleware extends AbstractMiddleware
{
    /**
     * @property \Fileshare\Validators\ImageValidator
     */
    private $imageValidator;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->imageValidator = $container->get("ImageValidator");
    }
    
    public function __invoke(Request $request, Response $response, $next)
    {
        try {
            $avatarFile = $request->getUploadedFiles()["avatar"];
            $this->imageValidator->validate($avatarFile);
            $next($request, $response);
            return $response;
        } catch (ValidateException $e) {
            $response = $this->sendErrorWithJson([
                'status' => 'faield',
                'errorType' => 'invalid_file',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
            return $response;
        }
    }
}

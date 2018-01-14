<?php

declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class SessionMiddleware extends AbstractMiddleware
{
    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        $envelopment = $this->getEnvVars($request);
        $sessionService = $this->container->get('SessionService');
        $sessionService->runSession($envelopment);
        $response = $next($request, $response);
        return $response;
    }

    private function getEnvVars(Request $request): array
    {
        function userAgentIsTestBrowser(Request $request) {
            define('HEADERS', $request->getHeaders());
            if (array_key_exists('user-agent', HEADERS) && HEADERS['user-agent'][0] === 'Symfony BrowserKit') {
                return true;
            }
            return false;
        }

        $envelopment = [];
        $envelopment['ip'] = $request->getServerParam('REMOTE_ADDR');
        /*
            i can't emulare global vars $_SERVER in test envelopment for my
            functional tests, so add adres here
        */
        if (empty($envelopment['ip']) && userAgentIsTestBrowser($request)) {
             $envelopment['ip'] = '192.168.1.2';
        }
        
        return $envelopment;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 9/12/17
 * Time: 12:19 AM
 */

declare(strict_types=1);

namespace Fileshare\Exceptions;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ErrorException extends AbstractAppException
{
    private $errorMessage;

    public function __construct(string $message, $container) {
        parent::__construct($message, $container);
        $this->logging();
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }

    final protected function prepareMessage() {
        $error = $this->getMessage();
        $code = $this->getCode();
        $file = $this->getFile();
        $line = $this->getLine();
        $this->errorMessage = "App throw error ${error}, code ${$code}.
            In file ${file} on line ${line}.
            ";
    }

    final protected function logging() {
        $this->logger->error($this->errorMessage);
    }
}
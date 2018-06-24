<?php

declare(strict_types=1);

namespace Fileshare\Services;

use \Codeception\Util\Debug as debug;

class UploadsMovmentService
{
    /**
     * @property string
     */
    private $storageDir;

    public function __construct()
    {
        $this->storageDir = dirname(dirname(__DIR__)) . "/sorage";
    }
    /**
     * @throws IOException
     */
    public function movment(string $tmpFileName, string $destinationFolder): bool
    {
        //implement
    }
}


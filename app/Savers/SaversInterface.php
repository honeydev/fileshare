<?php

declare(strict_types=1);

namespace Fileshare\Savers;

use \Slim\Http\UploadedFile;
use Fileshare\Models\FileInterface;

interface SaversInterface
{
    public function save(UploadedFile $file, array $params): FileInterface;
}

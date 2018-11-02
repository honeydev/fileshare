<?php

declare(strict_types=1);

namespace Fileshare\Tasks;

use Carbon\Carbon;
use Fileshare\Exceptions\IOException;
use Fileshare\Models\File;
use \Codeception\Util\Debug as debug;

class CleanOldFilesTask
{
    /**
     * @property int
     */
    private $storageTime;
    /**
     * @property Fileshare\Services\DeleteFileService
     */
    private $deleteFileService;

    private $logger;

    public function __construct($container)
    {
        $this->storageTime = $container->get('settings')['storageTime'];
        $this->deleteFileService = $container->get('DeleteFileService');
        $this->logger = $container->get('Logger');
    }

    public function do()
    {
        try {
            $this->cleanFiles();
        } catch (IOException $e) {
            $this->logger->errorLog($e->getMessage());
            throw $e;
        }
    }

    /**
     * @throws Fileshare\Exceptions\IOException
     */
    private function cleanFiles()
    {
        $files = File::all();
        foreach ($files as $file) {
            $currentTime = Carbon::now();
            $fileCreateTime = $file->created_at;
            $diffTime = $currentTime->diffInHours($fileCreateTime);
            if ($diffTime > $this->storageTime) {
                $file->delete();
                $this->deleteFileService->delete($file);
            }
        }
    }
}

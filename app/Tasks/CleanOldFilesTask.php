<?php

declare(strict_types=1);

namespace Fileshare\Tasks;

use Carbon\Carbon;
use Fileshare\Models\File;
use \Codeception\Util\Debug as debug;

class CleanOldFilesTask
{
    /**
     * @property int
     */
    private $storageTime;

    public function __construct($container)
    {
        $this->storageTime = $container->get('settings')['storageTime'];
    }

    public function do()
    {
        $files = File::all();
        foreach ($files as $file) {
            $currentTime = Carbon::now();
            $fileCreateTime = $file->created_at;
            $diffTime = $currentTime->diffInHours($fileCreateTime);
            if ($diffTime > $this->storageTime) {
                $file->delete();
            }
        }
    }
}

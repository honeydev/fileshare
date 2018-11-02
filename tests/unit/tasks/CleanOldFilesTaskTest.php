<?php

declare(strict_types=1);

namespace FileshareTests\unit\tasks;

use \Fileshare\Models\File;
use Codeception\Util\Fixtures;
use \Codeception\Util\Debug as debug;

class CleanOldFilesTaskTest extends \Codeception\Test\Unit
{
    use \FileshareTests\traits\CreateFilesTrait;

    private $storageTime;

    private $cleanOldFilesTask;

    protected function _before()
    {
        $container = Fixtures::get('container');
        $this->createFilesAnonymous(30);
        $this->storageTime = $container->get('settings')['storageTime'];
        $this->cleanOldFilesTask = $container->get('CleanOldFilesTask');
    }

    public function testCleanOldFiles()
    {
        $this->makeFilesOld();
        $this->cleanOldFilesTask->do();
        $this->assertEmpty(File::all());
    }

    private function makeFilesOld()
    {
        $files = File::all();
        foreach ($files as $file) {
            $file->setCreatedAt($file->created_at->subHours($this->storageTime + 1));
            $file->save();
        }
    }
}

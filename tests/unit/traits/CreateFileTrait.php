<?php
/**
 * @trait CreateFileTrait
 */

declare(strict_types=1);

namespace FileshareTests\unit\traits;


trait CreateFileTrait
{
    private function createValidUploadedImages():array
    {
        return array(
            array(
                'file' => codecept_data_dir('images/1.jpeg'),
                'name' => '1.jpeg',
                'type' => 'image/jpeg'
            )
        );
    }

    private function createInvalidUploadedImages():array
    {
        return array(
            array(
                'file' => codecept_data_dir('archives/archive.tar.gz'),
                'name' => 'image.jpg',
                'type' => 'image/jpeg'
            )
        );
    }
}

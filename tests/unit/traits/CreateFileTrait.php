<?php
/**
 * @class CreateFileTrait
 */

declare(strict_types=1);

namespace FileshareTests\unit\traits;


trait CreateFileTrait
{
    private function createValidUploadedImages():array
    {
        $images = [];
        $images[] = array('file' => codecept_data_dir('images/1.jpeg'), 'name' => '1.jpeg', 'type' => 'image/jpeg');
        return $images;
    }

    private function createFileArray($fileData)
    {

    }
}

<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 14.10.18
 * Time: 15:24
 */

namespace Fileshare\Services;

use \Fileshare\Models\File;

class SelectFilesCountService
{
    public function select(): int
    {
        $files = File::raw('SELECT * FROM files WHERE id NOT IN (SELECT parentId FROM avatars)')->get();
        return count($files);
    }
}

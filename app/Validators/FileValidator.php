<?php
/**
 * @class FileValidator
 */

declare(strict_types=1);

namespace Fileshare\Validators;

use Codeception\Util\Fixtures;

class FileValidator extends AbstractValidator
{
    /** @var array */
    private $allowExtensions;

    public function validate($file)
    {
        $this->allowExtensions = array(
            "image" => ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'ico'],
            "videos" => ['mp4', 'avi', 'wmv', 'mov', 'mkv', '3gp', 'flw', 'swf'],
            "audio" => ['mp3', 'wav', 'wave', 'acc', 'ogg'],
            "archive" => ['7z', 'gz', 'rar', 'tar', 'tar-gz', 'tar.gz', 'zip', 'cbr']
        );
    }
}
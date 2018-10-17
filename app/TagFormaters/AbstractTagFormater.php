<?php

declare(strict_types=1);

namespace Fileshare\TagFormaters;

use Fileshare\Helpers\StringFormatHelper;

abstract class AbstractTagFormater implements TagFormaterInterface
{
    abstract public function format(array $attributes): array;

    public static function create(string $mime): TagFormaterInterface
    {
        $fileType = StringFormatHelper::transformMimeToFileType($mime);
        if ($fileType === "image") {
            return new ImageTagFormater();
        }
        return new UnknownTagFormater();
    }
}

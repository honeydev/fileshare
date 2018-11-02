<?php

declare(strict_types=1);

namespace Fileshare\TagFormaters;

use Fileshare\Helpers\AttributeFormatHelper;

class ImageTagFormater extends AbstractTagFormater implements TagFormaterInterface
{
    public function format(array $attributes): array
    {
        return [
            "openTag" => "<img",
            "closeOpenTag" => ">",
            "attributes" => AttributeFormatHelper::joinAttributes($attributes),
            "closeTag" => null
        ];
    }
}

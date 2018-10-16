<?php

declare(strict_types=1);

namespace Fileshare\TemplateFormaters;

use Fileshare\Helpers\AttributeFormatHelper;

class ImagePreviewTemplateFormater implements TemplateFormaterInterface
{
    public static function format(array $attributes): string
    {
        return "<img" . AttributeFormatHelper::joinAttributes($attributes) . ">";
    }
}

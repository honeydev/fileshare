<?php

declare(strict_types=1);

namespace Fileshare\TemplateFormaters;

interface TemplateFormaterInterface
{
    public static function format(array $attributes): string;
}

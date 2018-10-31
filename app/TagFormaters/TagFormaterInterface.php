<?php

declare(strict_types=1);

namespace Fileshare\TagFormaters;

interface TagFormaterInterface
{
    public function format(array $attributes): array;

    public static function create(string $mime): TagFormaterInterface;
}

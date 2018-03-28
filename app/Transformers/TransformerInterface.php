<?php

declare(strict_types=1);

namespace Fileshare\Transformers;

interface TransformerInterface
{
    public static function transform($dataToTransform);
}

<?php

declare(strict_types=1);

namespace Fileshare\Transformers;

interface TransformerInterface
{
	/**
	 * @param mixed
	 * @return mided
	 */
    public static function transform($dataToTransform);
}

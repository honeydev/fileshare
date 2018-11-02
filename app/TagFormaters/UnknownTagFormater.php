<?php

declare(strict_types=1);

namespace Fileshare\TagFormaters;

use Fileshare\Helpers\AttributeFormatHelper;

class UnknownTagFormater extends AbstractTagFormater implements TagFormaterInterface
{
    public function format(array $attributes): array
    {
        return (AbstractTagFormater::create('image'))->format($attributes);
    }
}

<?php

declare(strict_types=1);

namespace Fileshare\Validators;

use Fileshare\Exceptions\ValidateException;

class SortTypeValidator extends AbstractValidator
{
    /**
     * @const array
     */
    const ALLOW_SORT_TYPES = ['early_to_late', 'late_to_early'];

    /**
     * @param $sortType string
     * @throws ValidateException
     */
    public function validate($sortType)
    {
        if (!in_array($sortType, self::ALLOW_SORT_TYPES)) {
            throw new ValidateException("Unknown files {$sortType}");
        }
    }
}

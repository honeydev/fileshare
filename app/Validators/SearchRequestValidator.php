<?php

declare(strict_types=1);

namespace Fileshare\Validators;

use \Fileshare\Exceptions\ValidateException;

class SearchRequestValidator extends AbstractValidator
{
    /**
     * @property int
     */
    const MAX_ALLOW_REQUEST_LEN = 200;
    /* empty string pattern */
    protected $regExpPattern = "/^$|\s+/";
    /**
     * @throws Fileshare\Exceptions\ValidateException
     */
    public function validate($searchRequest)
    {
        if ($this->dataIsMatchRegExp($this->regExpPattern, $searchRequest)) {
            throw new ValidateException("Empty search request");
        }

        if (strlen($searchRequest) > self::MAX_ALLOW_REQUEST_LEN) {
            throw new ValidateException(sprintf("Search request length cant be more than %d symbols", self::MAX_ALLOW_REQUEST_LEN));
        }
        return true;
    }
}


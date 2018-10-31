<?php

declare(strict_types=1);

namespace Fileshare\Validators;

use Fileshare\Exceptions\ValidateException;

class CursorValidator extends AbstractValidator
{
    /**
     * @var int
     */
    private $maxAllowCursorValue;

    public function __construct(int $maxAllowCursorValue)
    {
        $this->maxAllowCursorValue = $maxAllowCursorValue;
    }
    /**
     * @param $cursor int
     * @throws InvalidRequestArgumentException
     */
    public function validate($cursor)
    {
        if ($this->firstPageNotFulled($cursor)) {
            return true;
        }

        if ($cursor > $this->maxAllowCursorValue || $cursor < 1) {
            throw new ValidateException("Cursor '{$cursor}' more then allow cursor value '{$this->maxAllowCursorValue}'");
        }
    }

    private function firstPageNotFulled(int $cursor): bool
    {
        return $this->maxAllowCursorValue === 0 && $cursor === 1;
    }
}

<?php

namespace Fileshare\Validators;

use Fileshare\Exceptions\InvalidRequestArgumentException;
use Fileshare\Exceptions\ValidateException;

class BrowseFilesArgumentsValidator extends AbstractValidator
{
    /**
     * @const array
     */
    const ALLOW_SORT_TYPES = ['early_to_late', 'late_to_early'];
    /**
     * @var int
     */
    private $maxAllowCursorValue;

    public function __construct(int $maxAllowCursorValue)
    {
        $this->maxAllowCursorValue = $maxAllowCursorValue;
    }
    /**
     * @param $browseFilesArguments array
     * @throws InvalidRequestArgumentException
     */
    public function validate($browseFilesArguments)
    {
        $this->checkSortType($browseFilesArguments['sortType']);
        $this->checkCursor($browseFilesArguments['cursor']);
    }
    /**
     * @param string $sortType
     * @throws InvalidRequestArgumentException
     */
    private function checkSortType(string $sortType)
    {
        if (!in_array($sortType, self::ALLOW_SORT_TYPES)) {
            throw new InvalidRequestArgumentException("Unknown files {$sortType}");
        }
    }
    /**
     * @param string $cursor
     * @throws InvalidRequestArgumentException
     */
    private function checkCursor(int $cursor)
    {
        if ($this->firstPageNotFulled($cursor)) {
            return true;
        }

        if ($cursor > $this->maxAllowCursorValue || $cursor < 1) {
            throw new InvalidRequestArgumentException("Cursor '{$cursor}' more then allow cursor value '{$this->maxAllowCursorValue}'");
        }
    }

    private function firstPageNotFulled(int $cursor): bool
    {
        return $this->maxAllowCursorValue === 0 && $cursor === 1;
    }
}

<?php

declare(strict_types=1);

namespace Fileshare\Services;

use Fileshare\Helpers\SelectHelper;
use Illuminate\Database\Eloquent\Builder;

class SliceFilesQueryService
{
    /**
     * @property int
     */
    private $filesOnPage;

    public function __construct($container)
    {
        $this->filesOnPage = $container->get('settings')['filesOnPage'];
    }

    public function slice(Builder $query, int $cursor): Builder
    {
        return $query
            ->offset(SelectHelper::getOffset($cursor, $this->filesOnPage))
            ->limit($this->filesOnPage);
    }
}

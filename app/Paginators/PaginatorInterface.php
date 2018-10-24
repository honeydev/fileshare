<?php

declare(strict_types=1);

namespace Fileshare\Paginators;


interface PaginatorInterface
{
    public function paginate(int $currentPage, int $pagesCount, array $params): array;
}

<?php

declare(strict_types=1);

namespace Fileshare\Services;

use \Codeception\Util\Debug as debug;
use \Fileshare\Models\{File, User, Avatar};
use function Funct\Collection\first;

class SelectFilesService
{
    /**
     * @property int
     */
    private $filesOnPage;

    public function __construct($container)
    {
        $this->filesOnPage = $container->get('settings')['filesOnPage'];
    }

    public function select($sortType, $page)
    {
        $files = File::raw('SELECT * FROM files WHERE id NOT IN (SELECT parentId FROM avatars)')
            ->orderBy(...$this->getOrderParams($sortType))
            ->leftJoin('users', 'users.id', '=', 'files.ownerId')
            ->leftJoin('users_info', 'users.id', '=', 'users_info.userId')
            ->select(
                'users.email as ownerEmail',
                'users_info.name as ownerName',
                'users_info.avatarUri as ownerAvatar',
                'files.*'
            )
            ->limit($this->filesOnPage)
            ->offset($this->getOffset($page))
            ->get();
        return $files->toArray();
    }

    private function getOffset(int $page): int
    {
        $start = $page - 1;
        return $start * $this->filesOnPage;
    }

    private function getOrderParams($sortType = 'late_to_early'): array
    {
        if ($sortType === 'late_to_early') {
            return ["files.created_at", "DESC"];
        } elseif ($sortType === 'early_to_late') {
            return ["files.created_at", "ASC"];
        } else {
            throw new \InvalidArgumentException("Unknown files browse order type {$sortType}");
        }
    }
}

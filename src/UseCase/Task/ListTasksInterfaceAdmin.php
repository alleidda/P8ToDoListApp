<?php

declare(strict_types=1);

namespace App\UseCase\Task;

use App\DTO\ListTasksDTOAdmin;
use App\Entity\Task;
use App\Entity\User;

interface ListTasksInterfaceAdmin
{
    /**
     * @return array{
     *     total_items: int,
     *     total_pages: int,
     *     items_per_page: int,
     *     page: int,
     *     embedded: Task[]
     * }
     */
    public function __invoke(User $user, ListTasksDTOAdmin $listTasksDTOAdmin): array;
}


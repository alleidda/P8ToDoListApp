<?php

declare(strict_types=1);

namespace App\UseCase\Task;

use App\DTO\ListTasksDTOAdmin;
use App\Entity\User;
use App\Repository\TaskRepository;
use Doctrine\ORM\NonUniqueResultException;

final class ListTasksAdmin implements ListTasksInterfaceAdmin
{
    public function __construct(
        private readonly TaskRepository $repository
    ) {
    }

    /**
     * @throws NonUniqueResultException
     */
    public function __invoke(User $user, ListTasksDTOAdmin $listTasksDTOAdmin): array
    {
        $page = $listTasksDTOAdmin->getPage();
        $completed = $listTasksDTOAdmin->isCompleted();
        $anon = $listTasksDTOAdmin->isAnon();

        return match ($anon) {
            true => $this->repository->getAnonPaginatedTasks($page),
            false => $this->repository->getPaginatedTasksAdmin($user, $page, $completed),
        };
    }
}

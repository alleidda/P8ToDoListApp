<?php

declare(strict_types=1);

namespace App\UseCase\Task;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

final class CreateTask implements CreateTaskInterface
{
    public function __construct(
        private readonly EntityManagerInterface $manager,
        private readonly Security $security
    ) {
    }

    public function __invoke(Task $task): void
    {
        /** @var User $user */
        $user = $this->security->getUser();

        $task->setUser($user);
        $task->setCompleted(false);

        $this->manager->persist($task);
        $this->manager->flush();
    }
}
